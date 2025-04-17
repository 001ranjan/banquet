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
}
