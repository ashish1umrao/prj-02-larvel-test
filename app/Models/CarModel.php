<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    protected $table = 'cars_model';
    protected $primaryKey = 'id';

// A Car model belongs to car 

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
