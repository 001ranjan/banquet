<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FoodCategory extends Model
{
	use HasFactory;

	protected $guarded = ['id'];
	protected $fillable = ['parent_id', 'name', 'status', 'is_deleted'];

	// Newly Added
	public function children()
    {
        return $this->hasMany(FoodCategory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(FoodCategory::class, 'parent_id');
    }

	function food_items(){
	 	// return $this->hasMany('App\Models\FoodItem','category_id','id')->where('status',1)->where('is_deleted',0)->orderBy('name','ASC');
		return $this->hasMany('App\Models\FoodItem', 'category_id', 'id')
			->where('status', 1)
			->where('is_deleted', 0)
			->orderBy('name', 'ASC');
	}
}
