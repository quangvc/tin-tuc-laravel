<style>
    .has_error{
        border-color: red !important;
        border-radius: 3px !important;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <nav class="navbar navbar-expand-sm bg-light">

                <div class="container-fluid">
                <!-- Links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" href="http://127.0.0.1:8080/dashboard/">User</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8080/dashboard/category">Category</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="http://127.0.0.1:8080/dashboard/post">Post</a>
                    </li>
                </ul>
                </div>
            
            </nav>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2>EDIT USER</h2>
            
                <form action="/dashboard/update/{{ $user->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'has_error' : '' }}" id="name" value="{{ $user->name }}">
                        @error('name')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'has_error' : '' }}" id="email" value="{{ $user->email }}">
                        @error('email')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label ">Phone</label>
                        <input type="text" name="phone" class="form-control {{ $errors->has('phone') ? 'has_error' : '' }}" id="phone" value="{{ $user->phone }}">
                        @error('phone')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label ">Address</label>
                        <input type="text" name="address" class="form-control {{ $errors->has('address') ? 'has_error' : '' }}" id="address" value="{{ $user->address }}">
                        @error('address')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="avatar" class="form-label ">Avatar</label>
                        <input type="file" name="avatar" class="form-control {{ $errors->has('avatar') ? 'has_error' : '' }}" id="avatar" value="{{ $user->profile_photo_path }}">
                        <img src="{{ BASE_URL }}/public/avatars/{{ $user->profile_photo_path }}" alt="" width="60">
                        @error('avatar')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>

                    <label for="">Status: &nbsp;</label>
                    <div class="form-check form-check-inline">                        
                        <input class="form-check-input" type="radio" name="status" id="sta1" value="1" checked>
                        <label class="form-check-label" for="sta1">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="sta0" value="0">
                        <label class="form-check-label" for="sta0">Non-active</label>
                    </div>

                    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                    <label for="">Role: &nbsp;</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="role1" value="1" checked>
                        <label class="form-check-label" for="role1">User</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="role0" value="0">
                        <label class="form-check-label" for="role0">Admin</label>
                    </div>

                    <br><br>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            
        </div>
    </div>
</x-app-layout>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
      integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>