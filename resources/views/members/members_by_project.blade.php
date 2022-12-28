@extends('layouts.app')

@section('content')
    <h3>Members</h3>
    <span>Project : {{ $project->title }}</span>

    <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
        <div class="form-group">
            <input type="text" class="form-control pl-4 rounded-pill" id="amount" placeholder="Search members">
        </div>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMember">Add Member</a>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session()->has('failed'))
        <div class="alert alert-success">{{ session('failed') }}</div>
    @endif
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <th>
                        <img class="img-fluid rounded-circle mr-2" width="40px"
                            src="{{ asset('assets/images/default-profile.jpg') }}">
                        {{ $member->name }}
                    </th>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li>
                                    <form action="{{ route('remove-member', ['project_id' => $member->project_id, 'user_id' => $member->user_id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item edit-member" type="submit">Remove ember</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>

            @empty
                <div class="alert alert-info">Members empty.</div>
            @endforelse
        </tbody>
    </table>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addMember" tabindex="-1" aria-labelledby="addMemberLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header mb-0 border-0">
                    <h5 class="modal-title ml-3" id="addMemberLabel">New Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('add-member', $project->id) }}" method="post">
                    @csrf
                    <div class="modal-body m-2 mt-0">
                        <div class="col-12">
                            <label for="user_id" class="form-label">Member</label>
                            <select id="user_id" name="user_id" class="form-select">
                                <option selected>Choose member...</option>
                                @forelse ($organizationMembers as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @empty
                                    <div class="alert alert-info">member is Empty, add it here : <a
                                            href="{{ route('members') }}"></a></div>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-0 mb-3">
                        <button type="submit" class="btn btn-primary">Add Member</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
