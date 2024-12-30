<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FoodItem extends Model
{
	use HasFactory;

	protected $guarded = ['id'];
	protected $fillable = ['category_id', 'name', 'price', 'description', 'status', 'is_deleted'];

	// Newly Addes
	public function category()
    {
        return $this->belongsTo(FoodCategory::class, 'category_id');
    }

	// Old
	// function category(){
	//  	return $this->hasOne('App\Models\FoodCategory','id','category_id');
	// }
}
