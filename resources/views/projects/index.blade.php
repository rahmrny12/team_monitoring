@extends('layouts.app')

@section('content')
    <h3>Projects</h3>

    <div class="d-flex justify-content-between align-items-center my-5">
        <div class="form-group">
            <input type="text" class="form-control pl-4 rounded-pill" id="amount" placeholder="Search projects">
        </div>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">Add Projects</a>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Members</th>
                <th scope="col">To-dos</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>
                    <img class="img-fluid rounded-circle mr-2" width="40px"
                        src="{{ asset('assets/images/default-profile.jpg') }}">
                    Aplikasi Bansos
                </th>
                <td>
                    <span class="badge badge-primary p-2">Rahmat Rendy Prayogo</span>
                </td>
                <td>2</td>
                <td>
                    <div class="dropdown">
                        <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Manage Project</a></li>
                            <li><a class="dropdown-item" href="#">Edit Project</a></li>
                            <li><a class="dropdown-item" href="#">Archive Project</a></li>
                            <li><a class="dropdown-item" href="#">Delete Project</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
