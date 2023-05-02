<style>
    td.content {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        line-height: 1.5rem;
        max-height: 5rem;
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-box-orient: vertical;
        max-width: 30rem;
    }

</style>
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
                    <a class="nav-link " href="http://127.0.0.1:8080/dashboard/category">Category</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="http://127.0.0.1:8080/dashboard/post">Post</a>
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
                  <th scope="col" >Title</th>
                  <th scope="col">Cover image</th>
                  <th scope="col">Content</th>
                  <th scope="col">Author</th>
                  <th scope="col">Category</th>                                
                  <th scope="col">Updated at</th>
                  <th scope="col"><a href="http://127.0.0.1:8080/dashboard/post/create" class="btn btn-primary">Create</a></th>
                </tr>
              </thead>
              <tbody>        
                  @foreach ($posts as $post)
                      <tr>      
                          <th scope="row">{{ $loop->index+1 }}</th>
                          <td style="width: 20%">{{ $post->title }}</td>
                          <td><img src="{{ BASE_URL }}/public/cover_images/{{ $post->cover_image }}" alt="" style="max-width: 120"></td>
                          <td  class="content"> {{ $post->content }}</td>
                          <td > {{ $post->user->name }}</td>
                          <td > {{ $post->category->name }}</td>
                          <td > {{ $post->updated_at }}</td>
                          <td>
                              <a href="post/edit/{{ $post->id }}" class="btn btn-warning">Edit</a>
                              <a onclick="return confirm ('Xác nhận xóa post này!')" href="post/delete/{{ $post->id }}"class="btn btn-danger">Delete</a>
                              @if ($post->status == 0)                                  
                                <a class="btn btn-info" onclick="return confirm('Public this post?')"
                                href="{{ route('update_status', ['id' => $post->id, 'status' => 1 ]) }}">Public</a>
                              @endif
                                                            
                              @if ($post->status == 1)                                  
                                <a class="btn btn-info" onclick="return confirm('Hide this post?')"
                                href="{{ route('update_status', ['id' => $post->id, 'status' => 0 ]) }}">Hide</a>
                              @endif
                            </td>
                        </tr>
                  @endforeach     
          
              </tbody>
            </table>
          
            {{ $posts->appends(request()->all())->links(); }}

            </div>
        </div>
    </div>
</x-app-layout>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">  