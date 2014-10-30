<?php

namespace Fimdomeio\Caravel;
use \Debugbar;

class BoatsController extends \BaseController {

	public function __construct(){
		$this->title = 'Boats';
		//parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$fields   = ['name', 'build_date'];
		$contents = Boat::all(); 

		$debugArray = ['Testing', 1,2,3];
		//don't forget the use at the top
		Debugbar::error("example debugging messages generated at ".basename(__FILE__)." around line ".__LINE__);
		Debugbar::info($debugArray);
		Debugbar::warning('You\'d better watch out..');
		Debugbar::addMessage('Another message', 'custom Label');

		return \View::make('caravel::admin.index')->with('title', $this->title)->with('fields', $fields)->with('contents', $contents);

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
