<?php

namespace LaravelAcl;

use Illuminate\Database\Eloquent\Model;

class Spares extends Model
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'spares';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['spar', 'price', 'note','file','model','category'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

public function cars()
    {
        return $this->belongsToMany('LaravelAcl\Cars');
    }
public function spares()
    {
        return $this->belongsTo('LaravelAcl\Spares');
    }
public function supply()
    {
        return $this->belongsTo('LaravelAcl\Supply' , 'id', 'spares_id');
    }
}
