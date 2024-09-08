<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=[];

    protected $appends=['short_body'];

    public function getShortBodyAttribute()
    {
        // remove html tags
        $this->body=strip_tags($this->body);

        return substr($this->body,0,50).'...';
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
