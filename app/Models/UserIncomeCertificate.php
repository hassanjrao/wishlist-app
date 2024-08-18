<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class UserIncomeCertificate extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=[];

    protected $appends=['certificate_url'];

    public function getCertificateUrlAttribute(){
        return $this->path ? Storage::url($this->path) : null;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
