<?php
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Boat extends Eloquent implements StaplerableInterface {

	 use EloquentTrait;
	// Add your validation rules here
	public static $rules = [
		'name' => 'required',
		'build_date' => 'required|date',
		'published' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'build_date', 'description', 'image', 'published'];

	public function __construct(array $attributes = array()) {
    $this->hasAttachedFile('image', [
  	  'styles' => [
    	  'medium' => '300x300',
        'thumb' => '100x100'
    	]
    ]);
    parent::__construct($attributes);
  }
}
