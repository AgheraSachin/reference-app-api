<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class VerifiedRatingRequest extends Model
{
    use HasFactory;

    public $fillable = ['from_user_id', 'email', 'to_user_id', 'published', 'rating', 'audio', 'video', 'reviwed_on', 'url_token'];

    public function user(){
        return $this->hasOne(User::class,'id','to_user_id');
    }

    public function getVideoAttribute($value)
    {
        if ($value != null) {
            return Storage::url('Video/' . $value);
        }
    }

    public function getAudioAttribute($value)
    {
        if ($value != null) {
            return Storage::url('Audio/' . $value);
        }
    }
}
