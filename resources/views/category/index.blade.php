<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            <!-- A grey horizontal navbar that becomes vertical on small screens -->
            <nav class="navbar navbar-expand-sm bg-light">

                <div class="container-fluid">
                <!-- Links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8080/dashboard/" >User</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="http://127.0.0.1:8080/dashboard/category">Category</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8080/dashboard/post">Post</a>
                    </li>
                </ul>
                </div>
                <form class="d-flex" >
                    <input class="form-control me-2" type="text" placeholder="Search" name="key">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
            </nav>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

              @if (session('message'))
              <div class="alert alert-success">
                  {{ session('message') }}
              </div>
          @endif
          <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Parent category</th>
                  <th scope="col"><a href="http://127.0.0.1:8080/dashboard/category/create" class="btn btn-primary">Create</a></th>
                </tr>
              </thead>
              <tbody>        
                  @foreach ($categories as $category)
                      <tr>
                          <th scope="row">{{ $loop->index+1 }}</th>
                          <td>{{ $category->name }}</td>
                          <td>
                          @foreach ($categories as $cate2)
                            @if ($category->parent_id==$cate2->id)
                            {{ $cate2->name }}  
                            @endif
                          @endforeach
                        </td>
                          <td>
                              <a href="category/edit/{{ $category->id }}" class="btn btn-warning">Edit</a>
                              <a onclick="return confirm ('Xác nhận xóa category này!')" href="category/delete/{{ $category->id }}"class="btn btn-danger">Delete</a>
                          </td>
                        </tr>
                  @endforeach     
          
              </tbody>
            </table>
          
            {{ $categories->appends(request()->all())->links(); }}

            </div>
        </div>
    </div>
</x-app-layout>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">