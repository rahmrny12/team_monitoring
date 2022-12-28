<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\UserProject;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = User::join('recrutments', 'users.id', '=', 'recrutments.user_id')
                                ->join('organizations', 'organizations.id', '=', 'recrutments.organization_id')->get(['users.name', 'users.id', 'users.email']);
        $title = 'User Management';
        return view('members.index', compact('title', 'members'));
    }

    public function membersByProject($project_id) {
        $members = User::join('user_projects', 'users.id', '=', 'user_projects.user_id')
            ->where('user_projects.id', '=', $project_id)
            ->get();
        $project = Project::find($project_id);
        $organizationMembers = User::join('recrutments', 'users.id', '=', 'recrutments.user_id')
                                ->join('organizations', 'organizations.id', '=', 'recrutments.organization_id')->get(['users.name', 'users.id']);
        
        $title = 'User Management';
        return view('members.members_by_project', compact('title', 'members', 'project', 'organizationMembers'));
    }

    public function addMember(Request $request, $project_id)
    {
        $this->validate($request, [
            'user_id' => 'required',
        ]);

        UserProject::create([
            'user_id' => $request->user_id,
            'project_id' => $project_id,
        ]);

        return to_route('members')->with(['success' => 'Berhasil menambahkan member baru!']);
    }

    public function removeMember($user, $user_id)
    {
        // $user->delete([
        //     ''
        // ]);

        return to_route('users.index')->with(['success' => 'Berhasil menghapus data projek!']);
    }
    
    public function deleteMember(User $user)
    {
        $user->delete();

        return to_route('users.index')->with(['success' => 'Berhasil menghapus data projek!']);
    }
}
