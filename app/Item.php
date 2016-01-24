<?php

namespace LaravelAcl;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'item';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['order_id','spares_id', 'quantity'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
