<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfileModel extends Model
{
    use HasFactory;

    protected $table = 'UserProfile';
    protected $primaryKey = 'userid';

    protected $fillable = [
        'real_name',
        'email'
    ];
    public $timestamps = false;
}
