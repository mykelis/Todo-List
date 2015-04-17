<?php

class TasksController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('csrf' , array('on' => ['post', 'put']));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tasks = Tasks::all();
		return View::make('todos.index')->with('tasks', $tasks);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('todos.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'title' => array('required', 'unique:tasks,name')
		);

		$validator = Validator::make(Input::all(), $rules);
		//test if fails
		if ($validator->fails()) {
			return Redirect::route('todos.create')->withErrors($validator)->withInput();
		}
		$name = Input::get('title');
		$list = new TodoList();
		$list->name = $name;
		$list->save();
		return Redirect::route('todos.index')->withMessage('Your new list has been created!');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$list = Tasks::findOrFail($id);
		$items = $list->listItems()->get();
		return $items;
		return View::make('todos.show')
			->withList($list)
			->withItems($items);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$list = Tasks::findorFail($id);
		return View::make ('todos.edit')->withList($list);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'name' => array('required', 'tasks')
		);

		$validator = Validator::make(Input::all(), $rules);
		//test if fails
		if ($validator->fails()) {
			return Redirect::route('todos.edit', $id)->withErrors($validator)->withInput();
		}
		$name = Input::get('name');
		$list = Tasks::findOrFail($id);
		$list->name = $name;
		$list->update();
		return Redirect::route('todos.index')->withMessage('List updated');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$tasks = Tasks::findOrFail($id)->delete();
		return Redirect::route('todos.index')->withMessage('Item Deleted');
	}


}