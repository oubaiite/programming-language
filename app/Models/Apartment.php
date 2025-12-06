<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Apartment extends Model
{
    use Notifiable;
     protected $fillable=['site','type','number_of_room','description','price','user_id','city','area'];
     protected $hidden = ['user_id','id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
