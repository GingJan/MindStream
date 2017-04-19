<?php

namespace MindStream\Repositories;

use MindStream\Models\Account;

/**
 * Class AccountRepositoryEloquent
 * @package namespace MindStream\Repositories;
 */
class AccountRepositoryEloquent extends CommonRepositoryEloquent
{
    public $fieldSearchable = [
        'type'
    ];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Account::class;
    }

    public function create(array $attr)
    {
        $attr['password'] = bcrypt($attr['password']);
        $attr['uuid'] = uniqid();
        
        return parent::create($attr);
    }
}
