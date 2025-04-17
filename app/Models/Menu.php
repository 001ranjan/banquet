<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus'; // Specify table name

    protected $fillable = [
        'menu_name',
        'description',
        'menu_price',
        'status',
        'is_deleted',
    ];
    public $timestamps = true;

    // Relationship with FoodItem (reverse of the one defined in FoodItem)
    public function foodItems()
    {
        return $this->hasMany(FoodItem::class, 'menu_ids'); // Change from belongsToMany to hasMany
    }

        public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'menu_id'); // Assuming menu_id is the foreign key
    }


}
