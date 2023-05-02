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
            
            </nav>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2>CREATE CATEGORY</h2>
                <form action="store" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'has_error' : '' }}" id="name" value="{{ old('name') }}">
                        @error('name')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Parent category</label>
                        <select class="form-select" aria-label="Default select example" name="parent_id">
                            <option selected value="">--None</option>
                            @foreach ($categories as $category)
                            @if ($category->parent_id == null)                                
                                <option value="{{ $category->id }}">{{ $category->name }}</option> 
                            @endif
                            @endforeach
                          </select>
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