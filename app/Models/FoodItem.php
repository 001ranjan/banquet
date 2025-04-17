<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FoodItem extends Model
{
	use HasFactory;

	protected $table = "food_items";
    protected $fillable = [
        'category_id',
        'menu_ids', // Added menu_ids
        'name',
        'price',
        'description',
        'status',
        'type',
        'is_deleted',
    ];
    public $timestamps = true;



    // Convert JSON to an array automatically
    protected $casts = [
        'menu_ids' => 'array',
    ];
    

	// Newly Added
	public function category()
    {
        return $this->belongsTo(FoodCategory::class, 'category_id', 'id');
    }

    // Get menu names from stored menu IDs
    // public function getMenusAttribute() {
    //     return Menu::whereIn('id', $this->menu_ids ?? [])->get();
    // }
    public function getMenusAttribute() {
        $menuIds = is_array($this->menu_ids) ? $this->menu_ids : json_decode($this->menu_ids, true) ?? [];
        return Menu::whereIn('id', $menuIds)->get();
    }
}
