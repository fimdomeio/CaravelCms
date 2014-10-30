<?php

namespace Fimdomeio\Caravel;
use \Debugbar;

class BoatsController extends \BaseController {

	public function __construct(){
		$this->title  = 'Boats'; //page title
		$this->fields = ['name', 'build_date']; //listing fields to show on index

		//example buttons for Index page... if var not present Add is created automagically
		$this->indexButtons = [
			['title' => 'add Saillors',
				'url' => '/sailors/create'
			],
		];
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$contents = Boat::all($this->fields); 

		return \View::make('caravel::admin.index')
			->with('title', $this->title)
			->with('fields', $this->fields)
			->with('buttons', $this->indexButtons)
			->with('contents', $contents);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return \View::make('caravel::admin.boats.create')->with('title', $this->title);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
