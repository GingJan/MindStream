<?php

namespace MindStream\Models;

use Illuminate\Notifications\Notifiable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable implements Transformable
{
    use TransformableTrait, Notifiable, EntrustUserTrait;

    const ENABLED = 1;
    const DISABLED = 0;

    public $table = 'accounts';

    protected $guarded = ['password', 'is_enabled', 'uuid', 'id'];

    protected $hidden = ['password'];

    protected $primaryKey = 'uuid';

    public function user()
    {
        return $this->belongsTo(User::class, 'uuid', 'uuid', 'user');
    }
}
