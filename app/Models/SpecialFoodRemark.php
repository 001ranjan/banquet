<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialFoodRemark extends Model
{
    use HasFactory;

    protected $table = "special_food_item_remarks";
    protected $fillable = [
        'special_food_items_id',
        'customer_id',
        'remarks',
    ];
    public $timestamps = true;


    // Newly Added
	public function specialFoodItem()
    {
        return $this->belongsTo(SpecialFoodItem::class, 'special_food_items_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'category_id', 'id');
    }
}
