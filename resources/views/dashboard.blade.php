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
                {{-- <x-welcome /> --}}
                @include('admin.index')
            </div>
        </div>
    </div>
</x-app-layout>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
