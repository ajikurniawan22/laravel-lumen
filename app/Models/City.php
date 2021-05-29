<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class for city
 */
class City extends Model
{
	
	protected $table = 'mr_city';

	protected $fillable = [
        'id', 'province_id', 'type', 'name', 'lat', 'lng', 'is_active'
    ];


}