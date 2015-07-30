<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Todolist;

class ListsController extends Controller
{
    public function index() {

        $lists = Todolist::all();

        return view('lists.index')
            ->with('lists', $lists);
    }

    public function create() {

        $list = new Todolist;

        return view('lists.create')
            ->with('list', $list); 
    }

    public function store(Request $request) {

        $list = new Todolist;
        $list->name = $request->get('name');
        $list->description = $request->get('description');
        $list->save();

        return redirect(route('lists.index'))
                ->with('flash_success', 'List created successfully.');
    }

    public function show($id) {

        $list = Todolist::findOrFail($id);

        return view('lists.show')
            ->with('list', $list);
    }

    public function edit($id) {

        $list = Todolist::findOrFail($id);

        return view('lists.create')
            ->with('list', $list);
    }

    public function update($id, Request $request) {

        $list = Todolist::findOrFail($id);
        $list->name = $request->get('name');
        $list->description = $request->get('description');
        $list->save();

        return redirect(route('lists.edit', $id))
                ->with('flash_success', 'List updated successfully.');
    }

    public function delete() {
        return view('lists.show');
    }    
}
