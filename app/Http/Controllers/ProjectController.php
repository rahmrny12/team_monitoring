<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\UserProject;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::leftJoin('clients', 'clients.id', '=', 'projects.client_id')->get(['projects.id', 'title', 'description', 'clients.name as client', 'status']);
        $clients = Client::latest()->get();
        $title = 'Project Management';
        return view('projects.index', compact('title', 'projects', 'clients'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'client' => 'required',
        ]);

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'progress',
            'client_id' => $request->client,
        ]);

        return to_route('projects.index')->with(['success' => 'Berhasil menambahkan projek baru!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // get dari model lalu letakkan di parameter data
        return response()->json([
            'success' => true,
            'data'    => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        
        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'progress',
            'client_id' => $request->client,
        ]);

        return to_route('projects.index')->with(['success' => 'Berhasil mengedit projek baru!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('projects.index')->with(['success' => 'Berhasil menghapus data projek!']);
    }
    
    public function archive(Project $project)
    {
        $project->update([
            'status' => 'archive',
        ]);

        return to_route('projects.index')->with(['success' => 'Berhasil mengarsipkan data projek!']);
    }
}
