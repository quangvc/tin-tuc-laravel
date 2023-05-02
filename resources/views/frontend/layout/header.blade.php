<?php
$menu = config('menu');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <!-- Favicon  -->
    <link rel="icon" href="{{ BASE_URL }}resources/img/core-img/favicon.ico">
    
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ BASE_URL }}resources/style.css">
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader">
        <div class="preload-content">
            <div id="world-load"></div>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <nav class="navbar navbar-expand-lg">
                        <!-- Logo -->
                        <a class="navbar-brand" href="http://127.0.0.1:8080/"><img src="{{ BASE_URL }}resources/img/core-img/logo.png" alt="Logo"></a>
                        <!-- Navbar Toggler -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#worldNav" aria-controls="worldNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <!-- Navbar -->
                        <div class="collapse navbar-collapse" id="worldNav">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="http://127.0.0.1:8080/">Home <span class="sr-only">(current)</span></a>
                                </li>

                                @foreach ($menu as $men) 

                                @if (isset($men['items']))
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="http://127.0.0.1:8080/category/{{ $men['route'] }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $men['label'] }}</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach ($men['items'] as $item)
                                        <a class="dropdown-item" href="http://127.0.0.1:8080/category/{{ $item['route'] }}">{{ $item['label'] }}</a>
                                        {{-- {{ route($item['route']) }} --}}
                                        @endforeach
                                    </div>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="http://127.0.0.1:8080/category/{{ $item['route'] }}">{{ $men['label'] }}</a>
                                </li>
                                @endif                                
                                @endforeach

                            </ul>
                            <!-- Search Form  -->
                            <div id="search-wrapper">
                                <form >
                                    <input type="text" id="search" placeholder="Search something..." name="key">
                                    <div id="close-icon"></div>
                                    <input class="d-none" type="submit" value="">
                                </form>
                            </div>

                            @if (Route::has('login'))
                                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                            @auth

                                <ul class="navbar-nav ml-auto">                                    

                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-2xs" aria-hidden="true"></i>&nbsp;{{ Auth::user()->name }}</a>

                                    <li class="nav-item dropdown">
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('profile.show') }}">{{ __('Profile') }}</a>
                                        {{-- <a class="dropdown-item" href="{{ route('logout') }}">{{ __('Logout') }}</a> --}}
                                        
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <div class="nav-item">
                                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            this.closest('form').submit(); " role="button">
                                                    <i class="fas fa-sign-out-alt"></i>
                                    
                                                    {{ __('Log Out') }}
                                                </a>
                                            </div>
                                        </form>

                                    </div>
                                    </li>
                                </ul>

                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                        
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                                @endif
                            @endauth
                            @endif

                        </div>
                    </nav>

                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area">

        <!-- Hero Slides Area -->
        <div class="hero-slides owl-carousel">
            <!-- Single Slide -->
            <div class="single-hero-slide bg-img background-overlay" style="background-image: url({{ BASE_URL }}resources/img/blog-img/banner1.jpg);"></div>
            <!-- Single Slide -->
            <div class="single-hero-slide bg-img background-overlay" style="background-image: url({{ BASE_URL }}resources/img/blog-img/banner2.jpg);"></div>
        </div>

        <!-- Hero Post Slide -->
        <div class="hero-post-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero-post-slide">
                            <!-- Single Slide -->
                            <div class="single-slide d-flex align-items-center">
                                <div class="post-number">
                                    <p>1</p>
                                </div>
                                <div class="post-title">
                                    <a href="single-blog.html">How Did van Gogh’s Turbulent Mind Depict One of the Most Complex</a>
                                </div>
                            </div>
                            <!-- Single Slide -->
                            <div class="single-slide d-flex align-items-center">
                                <div class="post-number">
                                    <p>2</p>
                                </div>
                                <div class="post-title">
                                    <a href="single-blog.html">Lorem ipsum dolor sit amet consectetur adipisicing elit</a>
                                </div>
                            </div>
                            <!-- Single Slide -->
                            <div class="single-slide d-flex align-items-center">
                                <div class="post-number">
                                    <p>3</p>
                                </div>
                                <div class="post-title">
                                    <a href="single-blog.html">Sed commodi, quam distinctio rem quisquam aperiam quia explicabo iusto reiciendis magnam</a>
                                </div>
                            </div>
                            <!-- Single Slide -->
                            <div class="single-slide d-flex align-items-center">
                                <div class="post-number">
                                    <p>4</p>
                                </div>
                                <div class="post-title">
                                    <a href="single-blog.html">Blanditiis molestias illum mollitia odio corporis consectetur iure impedit voluptatem!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ********** Hero Area End ********** -->