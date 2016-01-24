<?php

namespace LaravelAcl;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'supply';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['spares_id', 'quantity', 'note'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

public function spares()
    {
        return $this->belongsTo('LaravelAcl\Spares');
    }
}
