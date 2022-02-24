<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $table = 'cars';

    protected $primaryKey = 'id';


    protected $fillable = ['name','founded','description','car_image'];
    

    // Car Model Function

    public function carmodels()
    {
        return $this->hasMany(CarModel::class);
    }

    // Car Head Quarter room
    public function headQuarter()
    {
        return $this->hasOne(headQuarter::class);
    }

    // Car enginess model
    public function engines()
    {
        return $this->hasManyThrough(
                Engine::class, 
                Carmodel::class,
                'car_id',
                'model_id'
            );
    }

    // Define a has one through relationship
    
    public function productionDate()
    {
        return $this->hasOneThrough(
            CarProductionData::class,
            Carmodel::class,
            'car_id',
            'model_id'
        );
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
        
    }
    
    
}
