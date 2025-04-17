<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
	use HasFactory;

	protected $table = "customers";
    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'middle_name',
		'father_name',
		'email',
		'mobile',
		'password',
		'address',
		'nationality',
		'country',
		'state',
		'city',
		'zipcode',
		'gender',
		'image',
		'age',
		'is_deleted',
		'remember_token',
    ];
    public $timestamps = true;

	// Newly Added
	public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
