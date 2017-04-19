<?php

namespace MindStream\Http\Controllers;

use MindStream\Http\Requests\LoginRequest;
use MindStream\Http\Requests;
use MindStream\Repositories\AccountRepositoryEloquent;
use MindStream\Repositories\UserRepositoryEloquent;
use MindStream\Repositories\Interfaces\AccountRepository;
use MindStream\Validators\AccountValidator;
use MindStream\Http\Requests\AccountRequest;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AccountsController extends Controller
{

    /**
     * @var AccountRepositoryEloquent
     */
    protected $repository;

    /**
     * @var AccountValidator
     */
    protected $validator;

    public function __construct(AccountRepository $repository, AccountValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * @param LoginRequest $request
     * @param UserRepositoryEloquent $userRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request, UserRepositoryEloquent $userRepository)
    {
        $credentials = $request->only(['account', 'password']);
        $token = \JWTAuth::attempt($credentials);

        $account = $this->repository->findOneByField(
            'account', $request->get('account'), ['uuid', 'password']
        );

        $user = $userRepository->find($account->uuid);

        return $this->successResponse(
            ['token' => $token, 'user' => $user]
        );
    }

    /**
     * 退出登录
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        //把jti放入到缓存中,另外可以查下缓存的tag的作用
        \JWTAuth::invalidate(\JWTAuth::getToken());
        return $this->successResponse();
    }

    /**
     * 更新密码
     *
     * @param string $uuid
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword($uuid, AccountRequest $request)
    {
        $this->repository->find($uuid);

        $user = \Auth::user();

        if (\Hash::check($request->input('password'), $user->getAuthPassword())) {
            $this->repository->updateGuardedFieldById(
                ['password' => $request->input(['new_password'])],
                $user->getAuthIdentifier()
            );

            return $this->successResponse();
        }

        throw new BadRequestHttpException('密码错误');
    }

    /**
     * 删除/注销 账号
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRepositoryEloquent $userRepository)
    {
        $user = \Auth::user();

        \DB::transaction(function() use ($user, $userRepository) {
            $this->repository->delete($user->getAuthIdentifier());
            $userRepository->delete($user->getAuthIdentifier());
        });

        return $this->successResponse();
    }
}
