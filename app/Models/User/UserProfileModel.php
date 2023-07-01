<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfileModel extends Model
{
    protected $table = 'UserProfile';
    protected $primaryKey = 'userid';

    protected $fillable = [
        'real_name',
        'email'
    ];
}
