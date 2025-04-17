<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
	protected $guarded = ['id'];
	protected $casts = [
        'json_data' => 'array',  // Automatically cast json_data as an array
    ];
    
}
