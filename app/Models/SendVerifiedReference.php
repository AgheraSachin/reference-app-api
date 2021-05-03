<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SendVerifiedReference extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'send_verified_reference';

    public $fillable = ['email', 'from_user_id', 'sent_reference_type', 'reference_id', 'access_code', 'access_token', 'created_at', 'updated_at', 'deleted_at'];
}
