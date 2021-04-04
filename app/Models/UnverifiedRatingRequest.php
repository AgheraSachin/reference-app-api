<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnverifiedRatingRequest extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'unverified_request_ratings';

    public $fillable = ['from_user_id', 'email', 'published', 'reviewer_full_name', 'reviewer_occupations', 'rating', 'comment', 'last_request_on', 'last_request_count', 'reviwed_on', 'url_token'];
}
