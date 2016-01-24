<?php

namespace LaravelAcl;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cars';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'quantity', 'note'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
