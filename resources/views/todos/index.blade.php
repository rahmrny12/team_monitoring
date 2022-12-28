@extends('layouts.app')

@section('content')
    <h3>Todos</h3>

    <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
        <div class="form-group">
            <input type="text" class="form-control pl-4 rounded-pill" id="amount" placeholder="Search todos">
        </div>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTodo">Add Todos</a>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session()->has('failed'))
        <div class="alert alert-success">{{ session('failed') }}</div>
    @endif
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">To-do</th>
                <th scope="col">Assignee</th>
                <th scope="col">Created</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($todos as $todo)
                <tr>
                    <th>
                        {{ $todo->task }}
                    </th>
                    <td>{{ $todo->member }}</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item edit-todo" href="#" data-bs-toggle="modal"
                                        data-bs-target="#editTodo" data-id="{{ $todo->id }}">Edit Todo</a></li>
                                <form action="{{ route('todos.destroy', $todo->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <li><button type="submit" class="dropdown-item">Delete Todo</button></li>
                                </form>
                            </ul>
                        </div>
                    </td>
                </tr>

            @empty
                <div class="alert alert-info">Todos empty.</div>
            @endforelse
        </tbody>
    </table>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addTodo" tabindex="-1" aria-labelledby="addTodoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header mb-0 border-0">
                    <h5 class="modal-title ml-3" id="addTodoLabel">New Todo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-2 mt-0">
                    <form action="{{ route('todos.store') }}" method="post">
                        @csrf
                        <div class="col-12">
                            <label for="task" class="form-label">Task</label>
                            <input type="text" class="form-control" name="task" id="task">
                        </div>
                        <div class="col-10 my-4">
                            <label for="user" class="form-label">User</label>
                            <select id="user" name="user" class="form-select">
                                <option value="" selected>Choose user...</option>
                                @forelse ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @empty
                                    <div class="alert alert-info">User is Empty, add it here : <a
                                            href="{{ route('users.index') }}"></a></div>
                                @endforelse
                            </select>
                        </div>
                        <div class="modal-footer border-0 p-0">
                            <button type="submit" class="btn btn-primary">Save Todo</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editTodo" tabindex="-1" aria-labelledby="editTodoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header mb-0 border-0">
                    <h5 class="modal-title ml-3" id="editTodoLabel">Edit Todo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-2 mt-0">
                    <form action="{{ route('todos.store') }}" method="post">
                        @csrf
                        <div class="col-12">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title">
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="3"></textarea>
                        </div>
                        <div class="col-10 mb-4">
                            <label for="user" class="form-label">User</label>
                            <select id="user" name="user" class="form-select">
                                <option value="" selected>Choose user...</option>
                                @forelse ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @empty
                                    <div class="alert alert-info">User is Empty, add it here : <a
                                            href="{{ route('users.index') }}"></a></div>
                                @endforelse
                            </select>
                        </div>
                        <div class="modal-footer border-0 p-0">
                            <button type="submit" class="btn btn-primary">Save Todo</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on("click", ".edit-todo", function() {
            var todoId = $(this).data('id');
            $('#editTodo form').attr('action', 'todos/' + todoId);

            $.ajax({
                url: '/todos/' + todoId,
                type: 'GET',
                cache: false,
                success: function(response) {
                    // cari input lalu masukkan data
                    $('#editTodo #title').val(response.data.title);
                    $('#editTodo #description').val(response.data.description);
                    $('#editTodo #user option[value=' + response.data.user_id + ']').attr(
                        'selected', 'selected');
                }
            })
        });
    </script>
@endsection
