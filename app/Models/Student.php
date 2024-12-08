<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Record;

class Student extends Model
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'role',
        'family_name',
        'given_name',
        'email',
        'birth_date',
        'admission_date',
        'withdrawal_date',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 認証に使用するカラム名を指定
    public function getAuthIdentifierName()
    {
        return 'email';
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function records()
    {
        return $this->hasMany(Record::class);
    }
}
