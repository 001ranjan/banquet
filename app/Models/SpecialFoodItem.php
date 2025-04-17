<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialFoodItem extends Model
{
    use HasFactory;

    protected $table = "special_food_items";
    protected $fillable = [
        'customer_id',
        'category_id',
        'name',
        'price',
        'description',
        'status',
        'type',
        'is_deleted',
    ];
    public $timestamps = true;


    // Newly Added
	public function category()
    {
        return $this->belongsTo(FoodCategory::class, 'category_id', 'id');
    }

    // Newly Added
	public function customer()
    {
        return $this->belongsTo(User::class, 'category_id', 'id');
    }
}
