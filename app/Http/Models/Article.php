<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';

	protected $guarded = [];

	public $timestamps = false;
	const CREATED_AT = 'creation_date';
	const UPDATED_AT = 'last_update';	
}
