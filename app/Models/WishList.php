<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class WishList extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=[];

    protected $appends=['image_url','birth_certificate_url'];

    public function getImageUrlAttribute(){
        return $this->image_path ? Storage::url($this->image_path) : null;
    }

    public function getBirthCertificateUrlAttribute(){
        return $this->birth_certificate_path ? Storage::url($this->birth_certificate_path) : null;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function calculateAge($date_of_birth){
        return $date_of_birth ? now()->diffInYears($date_of_birth) : null;
    }
}
