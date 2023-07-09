<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'User';
    protected $primaryKey = 'id';
    protected $attributes = [
        'active' => 1,
        'is_admin' => 0,
        'password' => "",
        'salt' => "",
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

    protected $hidden = [
        'password'
    ];

    private function PasswordCombineWithSalt(string $Password, string $Salt): string {
        return $Password . "jC4Gaq9rcfCzFmMVxf0L" . $Salt;
    }

    public function SetPassword(string $Password): void {
        $Salt = Str::random(30);
        $PasswordToSaveDB = $this->PasswordCombineWithSalt($Password, $Salt);

        $this->fill([
            'password' => Hash::make($PasswordToSaveDB),
            'salt' => $Salt
        ])->save();

        return;
    }

    public function ValidatePassword(string $Password): bool {
        $Salt = $this->salt;
        $PasswordToSaveDB = $this->PasswordCombineWithSalt($Password, $Salt);

        return Hash::check($PasswordToSaveDB, $this->password);
    }
}
