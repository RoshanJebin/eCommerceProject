@extends('admin.layout')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('admin.messages')
                    <div class="col-md-9">
                        <h4 class="card-title">User list</h4>
                    </div>
                    <div class="col-md-3" style="text-align: right;">
                        <a href="{{ route('users.create') }}" class="btn btn-block btn-sm btn-gradient-primary">+ Add new
                            User</a>
                    </div>
                </div>
                <hr>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="table-responsive">
                        <table class="data-table table table- table-hover">
                            <thead>
                                <tr class="heading">
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users)
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <?php $index = $key + 1; ?>
                                            <td>{{ $index }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->status == 1)
                                                    <span class="text-success">Active</span>
                                                @else
                                                    <span class="text-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td><img src="{{ asset('storage/images/user/' . $user->image) }}" alt=""
                                                    class="thumbnail"></td>
                                            <td>
                                                <div>
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-sm btn-success">Edit</a>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                        style="display: inline;">
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        {{ csrf_field() }}
                                                        <button class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
