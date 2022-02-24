<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $primaryKey = 'id';
    
    protected $fillable = ['id','category_name','category_image','category_slug'];
// A Car model belongs to car 

    public function CategoryModel()
    {
        return $this->belongsTo(CategoryModel::class);
    }
}
