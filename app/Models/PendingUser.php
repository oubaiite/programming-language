<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingUser extends Model
{
 protected $table='pending_users';
 protected $fillable = ['phone','password','first_name','last_name','personal_photo','photo_of_personal_ID'];
}
