<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'state',
        'password',
        'income',
        'is_approved',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function wishLists(){
        return $this->hasMany(WishList::class);
    }

    public function getIncomeAttribute($value){
        return $value ? number_format($value, 2) : null;
    }

    public function incomeCertificates(){
        return $this->hasMany(UserIncomeCertificate::class);
    }

    public function latestIncomeCertificate(){
        return $this->hasOne(UserIncomeCertificate::class)->latest();
    }


    public function isIncomeCertificateExpired(){
        // if the latest income certificate is 1 year old, then it is expired
        return $this->latestIncomeCertificate && $this->latestIncomeCertificate->created_at->diffInYears(now()) >= 1;
    }

}
