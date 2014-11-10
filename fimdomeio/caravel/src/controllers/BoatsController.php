<?php

namespace Fimdomeio\Caravel;
use \Debugbar;

class BoatsController extends \BaseController {

	public function __construct(){
		$this->title  = 'Boats'; //page title
		$this->fields = ['id', 'name', 'build_date']; //listing fields to show on index

		//example buttons for Index page... if var not present Add is created automagically
		$this->indexButtons = [
			[
				'title' => 'add Saillors',
				'url' => '/sailors/create'
			],
		];
	}

	/**
	 * Display a listing of boats
	 *
	 * @return Response
	 */
	public function index()
	{
		$contents = Boat::all($this->fields);

		return \View::make('caravel::admin.boats.index')
			->with('title', $this->title)
			->with('fields', $this->fields)
			->with('buttons', $this->indexButtons)
			->with('contents', $contents);

	}

	/**
	 * Show the form for creating a new boat
	 *
	 * @return Response
	 */
	public function create()
	{
		return \View::make('caravel::admin.boats.create')->with('title', $this->title);
	}

	/**
	 * Store a newly created boat in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = \Validator::make($data = \Input::all(), Boat::$rules);

		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}

		Boat::create($data);

		return \Redirect::route('boats.index');
	}

	/**
	 * Display the specified boat.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$boat = Boat::findOrFail($id);

		return View::make('boats.show', compact('boat'));
	}

	/**
	 * Show the form for editing the specified boat.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$boat = Boat::find($id);

		return View::make('boats.edit', compact('boat'));
	}

	/**
	 * Update the specified boat in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$boat = Boat::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Boat::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$boat->update($data);

		return Redirect::route('boats.index');
	}

	/**
	 * Remove the specified boat from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Boat::destroy($id);

		return \Redirect::route('boats.index');
	}

}
