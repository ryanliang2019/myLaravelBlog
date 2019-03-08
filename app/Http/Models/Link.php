<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
	protected $table = 'links';

    public $timestamps = false;

    protected $guarded = [];

}
