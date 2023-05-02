<style>
    .has_error{
        border-color: red !important;
        border-radius: 3px !important;
    }
</style>
<script src="//cdn.ckeditor.com/4.21.0/full/ckeditor.js"></script>
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
                    <a class="nav-link" href="http://127.0.0.1:8080/dashboard/category">Category</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="http://127.0.0.1:8080/dashboard/post">Post</a>
                    </li>
                </ul>
                </div>
            
            </nav>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2>CREATE POST</h2>
                <form action="store" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'has_error' : '' }}" id="title" value="{{ old('title') }}">
                        @error('title')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="comment">Content</label>
                        <textarea class="form-control ckeditor" rows="15" id="comment" name="content"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Category</label>
                        <select class="form-select" aria-label="Default select example" name="category">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>                                
                            @endforeach
                          </select>
                    </div>

                    <div class="mb-3">
                        <label for="cover_img" class="form-label ">Cover image</label>
                        <input type="file" name="cover_img" class="form-control {{ $errors->has('cover_img') ? 'has_error' : '' }}" id="cover_img" value="{{ old('cover_img') }}">
                        @error('cover_img')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>

                    <br><br>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            
        </div>
    </div>
</x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">  

    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
      integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script> --}}