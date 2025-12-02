<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
     protected $fillable=['site','type','number_of_room','owner','owner_phone','valuation','description','price','user_id','city','area'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
