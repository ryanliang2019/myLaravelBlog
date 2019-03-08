<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Logins extends Model
{
    protected $table = 'logins';

	protected $hidden = ['real_pass'];

	public $timestamps = false;
}
