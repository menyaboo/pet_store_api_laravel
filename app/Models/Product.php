<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table= 'product';

    protected $fillable = [
        'name',
        'model',
        'photo_file',
        'rate',
        'price',
        'amount',
        'description',
        'category_id',
    ];

    public function type() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
