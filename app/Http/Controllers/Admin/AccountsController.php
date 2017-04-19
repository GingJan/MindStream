<?php

namespace MindStream\Http\Controllers\Admin;

use Illuminate\Http\Request;
use MindStream\Http\Controllers\Controller;
use MindStream\Criterias\BaseCriteria;
use MindStream\Http\Requests;
use MindStream\Repositories\AccountRepositoryEloquent;
use MindStream\Repositories\UserRepositoryEloquent;
use MindStream\Repositories\Interfaces\AccountRepository;

class AccountsController extends Controller
{

    /**
     * @var AccountRepositoryEloquent
     */
    protected $repository;

    public function __construct(AccountRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 获取账户列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->repository->pushCriteria(app(BaseCriteria::class));

        $accounts = $this->repository->paginateWhere(
            null,
            $request->query('expand', false)
            ['user']
        );

        return view('accounts.index', compact('accounts'));
    }

    /**
     * 删除账号
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid, UserRepositoryEloquent $userRepository)
    {
        \DB::transaction(function() use ($uuid, $userRepository) {
            $this->repository->delete($uuid);
            $userRepository->delete($uuid);
        });

        return $this->successResponse();
    }

    /**
     * 启用/禁用 账号
     * @return \Illuminate\Http\JsonResponse
     */
    public function enable($uuid, UserRepositoryEloquent $userRepository)
    {
        \DB::transaction(function () use ($uuid, $userRepository){
            $userRepository->reverseStatus('is_enabled', $uuid);
            $this->repository->reverseStatus('is_enabled', $uuid);
        });

        return $this->successResponse();
    }
}
