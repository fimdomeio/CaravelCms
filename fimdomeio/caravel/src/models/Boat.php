<?php

namespace Fimdomeio\Caravel;
class Boat extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'name' => 'required',
		'build_date' => 'required|date',
		'published' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'build_date', 'description', 'image', 'published'];

}
