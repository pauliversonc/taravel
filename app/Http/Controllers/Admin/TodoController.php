<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Todo;
use App\Http\Requests\CreateTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class TodoController extends Controller {

	/**
	 * Display a listing of todo
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $todo = Todo::all();

		return view('admin.todo.index', compact('todo'));
	}

	/**
	 * Show the form for creating a new todo
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
        $region = Todo::$region;

	    return view('admin.todo.create', compact("region"));
	}

	/**
	 * Store a newly created todo in storage.
	 *
     * @param CreateTodoRequest|Request $request
	 */
	public function store(CreateTodoRequest $request)
	{
	    $request = $this->saveFiles($request);
		Todo::create($request->all());

		return redirect()->route(config('quickadmin.route').'.todo.index');
	}

	/**
	 * Show the form for editing the specified todo.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$todo = Todo::find($id);
	    
	    
        $region = Todo::$region;

		return view('admin.todo.edit', compact('todo', "region"));
	}

	/**
	 * Update the specified todo in storage.
     * @param UpdateTodoRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateTodoRequest $request)
	{
		$todo = Todo::findOrFail($id);

        $request = $this->saveFiles($request);

		$todo->update($request->all());

		return redirect()->route(config('quickadmin.route').'.todo.index');
	}

	/**
	 * Remove the specified todo from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Todo::destroy($id);

		return redirect()->route(config('quickadmin.route').'.todo.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            Todo::destroy($toDelete);
        } else {
            Todo::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.todo.index');
    }

}
