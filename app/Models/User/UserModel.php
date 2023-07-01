<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'User';
    protected $primaryKey = 'id';
    protected $attributes = [
        'active' => 1,
        'is_admin' => 0,
    ];
    protected $fillable = [
        'username',
        'password',
        'salt',
        'usercreate_id',
        'userupdate_id',
        'active',
        'is_admin'
    ];
}
