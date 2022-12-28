@extends('layouts.app')

@section('content')
    <h3>Projects</h3>

    <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
        <div class="form-group">
            <input type="text" class="form-control pl-4 rounded-pill" id="amount" placeholder="Search projects">
        </div>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProject">Add Projects</a>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session()->has('failed'))
        <div class="alert alert-success">{{ session('failed') }}</div>
    @endif
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Project Name</th>
                <th scope="col">Client</th>
                <th scope="col">Members</th>
                <th scope="col">To-dos</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <th>
                        {{-- <img class="img-fluid rounded-circle mr-2" width="40px"
                            src="{{ asset('assets/images/default-profile.jpg') }}"> --}}
                        {{ $project->title }}
                    </th>
                    <td class="{{ $project->client ?? 'text-muted' }}">
                        {{ $project->client ?: 'No Client' }}</td>
                    <td>
                        <a href="{{ route('project-members', $project->id) }}">
                            <span class="badge badge-primary p-2">Rahmat Rendy Prayogo</span>
                        </a>
                    </td>
                    <td>-</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('project-members', $project->id) }}">Manage Members</a>
                                </li>
                                {{-- kirim data id kesini coy biar diterima modal --}}
                                <li><a class="dropdown-item edit-project" href="#" data-bs-toggle="modal"
                                        data-bs-target="#editProject" data-id="{{ $project->id }}">Edit Project</a></li>
                                <li><a class="dropdown-item" href="{{ route('archive', $project->id) }}">Archive Project</a>
                                </li>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <li><button type="submit" class="dropdown-item">Delete Project</button></li>
                                </form>
                            </ul>
                        </div>
                    </td>
                </tr>

            @empty
                <div class="alert alert-info">Projects empty.</div>
            @endforelse
        </tbody>
    </table>

    <!-- Modal Tambah -->
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
                                </div>
                            </div>
                            <div class="tab-pane fade" id="members">
                                <div class="my-3 row g-3">
                                    <div class="col-10 mb-4">
                                        <label for="client" class="form-label">Client</label>
                                        <select id="client" name="client" class="form-select">
                                            <option selected>Choose client...</option>
                                            @forelse ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                            @empty
                                                <div class="alert alert-info">Client is Empty, add it here : <a
                                                        href="{{ route('clients.index') }}"></a></div>
                                            @endforelse
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
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editProject" tabindex="-1" aria-labelledby="editProjectLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header mb-0 border-0">
                    <h5 class="modal-title ml-3" id="editProjectLabel">Edit Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-2 mt-0">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#editTabGeneral" class="nav-link active" data-bs-toggle="tab">General</a>
                        </li>
                        <li class="nav-item">
                            <a href="#editTabMembers" class="nav-link" data-bs-toggle="tab">Members</a>
                        </li>
                    </ul>
                    <form action="{{ route('projects.update', $project->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="tab-content mx-2">
                            <div class="tab-pane fade show active" id="editTabGeneral">
                                <div class="my-3 row g-3">
                                    <div class="col-12">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" id="title">
                                    </div>
                                    <div class="col-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" class="form-control" id="description" cols="30" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="editTabMembers">
                                <div class="my-3 row g-3">
                                    <div class="col-12">
                                        <label for="client" class="form-label">Client</label>
                                        <select id="client" name="client" class="form-select">
                                            <option value="1" selected>Choose client...</option>
                                            @forelse ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                            @empty
                                                <div class="alert alert-info">Client is Empty, add it here : <a
                                                        href="{{ route('clients.index') }}"></a></div>
                                            @endforelse
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
    </div>

    <script>
        $(document).on("click", ".edit-project", function() {
            var projectId = $(this).data('id');
            $('#editProject form').attr('action', 'projects/' + projectId);

            $.ajax({
                url: '/projects/' + projectId,
                type: 'GET',
                cache: false,
                success: function(response) {
                    // cari input lalu masukkan data
                    $('#editProject #title').val(response.data.title);
                    $('#editProject #description').val(response.data.description);
                    $('#editProject #client option[value=' + response.data.client_id + ']').attr(
                        'selected', 'selected');
                }
            })
        });
    </script>
@endsection
