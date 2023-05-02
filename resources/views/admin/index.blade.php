@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
@if (session('error'))
  <div class="alert alert-danger">
      {{ session('error') }}
  </div>
@endif
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        {{-- <th scope="col">Address</th> --}}
        <th scope="col">Status</th>
        <th scope="col"><a href="http://127.0.0.1:8080/dashboard/create" class="btn btn-primary">Create</a></th>
      </tr>
    </thead>
    <tbody>        
        @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $loop->index+1 }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                {{-- <td>{{ $user->address }}</td> --}}
                <td>{{ $user->status == 1 ? 'Active' : 'Non-active' }}</td>
                @if ($user->role == 0)
                    <td><strong>Quản trị viên</strong></td>
                @else
                  <td>
                    <a href="http://127.0.0.1:8080/dashboard/edit/{{ $user->id }}" class="btn btn-warning">Edit</a>
                    <a onclick="return confirm ('Xác nhận xóa user này!')" href="http://127.0.0.1:8080/dashboard/delete/{{ $user->id }}"class="btn btn-danger">Delete</a>
                  </td>
                @endif
              </tr>
        @endforeach     

    </tbody>
  </table>

  {{ $users->appends(request()->all())->links(); }}


  