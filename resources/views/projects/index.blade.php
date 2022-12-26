@extends('layouts.app')

@section('content')
    <h3>Projects</h3>

    <div class="d-flex justify-content-between align-items-center my-5">
        <div class="form-group">
            <input type="text" class="form-control pl-4 rounded-pill" id="amount" placeholder="Search projects">
        </div>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProject">Add Projects</a>
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
                        <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                            id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
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

    <!-- Modal -->
    <div class="modal fade" id="addProject" tabindex="-1" aria-labelledby="addProjectLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header mb-0 border-0">
                    <h5 class="modal-title ml-3" id="addProjectLabel">New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-2 mt-0">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#general" class="nav-link active" data-bs-toggle="tab">General</a>
                        </li>
                        <li class="nav-item">
                            <a href="#members" class="nav-link" data-bs-toggle="tab">Members</a>
                        </li>
                    </ul>
                    <form action="{{ route('projects.store') }}" method="post">
                        @csrf
                        <div class="tab-content mx-2">
                            <div class="tab-pane fade show active" id="general">
                                <div class="my-3 row g-3">
                                    <div class="col-12">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" id="title">
                                    </div>
                                    <div class="col-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" class="form-control" id="description" cols="30" rows="3"></textarea>
                                    </div>
                                    <div class="col-10">
                                        <label for="client" class="form-label">Client</label>
                                        <select id="client" name="client" class="form-select">
                                            <option selected>Choose client...</option>
                                            <option>Hamzah</option>
                                            <option>Wahyu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="members">
                                <div class="my-3 row g-3">
                                    <div class="col-12 mb-4">
                                        <label for="member" class="form-label">Member</label>
                                        <select id="member" name="member" class="form-select">
                                            <option selected>Choose member...</option>
                                            <option>Rendy</option>
                                            <option>Yahya</option>
                                            <option>Ferdi</option>
                                            <option>Rafi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 p-0">
                            <button type="submit" class="btn btn-primary">Save Project</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
