<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    protected $table = 'cars_model';
    protected $primaryKey = 'id';
    
    protected $fillable = ['car_id','model_name','model_image','car_name','updated_at'];
// A Car model belongs to car 

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
