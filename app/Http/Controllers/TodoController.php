<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::join('users', 'users.id', '=', 'todos.user_id')
            ->get(['todos.id', 'task', 'is_complete', 'todos.created_at', 'users.name as member']);

        $users = User::join('recrutments', 'users.id', '=', 'recrutments.user_id')
            ->join('organizations', 'organizations.id', '=', 'recrutments.organization_id')->get(['users.name', 'users.id']);

        $title = 'Todos List';
        return view('todos.index', compact('title', 'todos', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'task' => 'required',
            'user' => 'required',
        ]);

        Todo::create([
            'task' => $request->task,
            'user_id' => $request->user,
            'is_complete' => 0,
        ]);

        return to_route('todos.index')->with(['success' => 'Berhasil menambahkan todo baru!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
