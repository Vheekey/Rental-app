<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>R3ntals</title>

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>

    <div class="container-fluid">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3 mt-3 text-white">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{ route('home') }}">R3nt@lz</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0 navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::url() == route('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}" title="Home"><i class="fa fa-house-chimney me-2 ms-3"></i><span class="">Home</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::url() == route('users') ? 'active' : '' }}" href="{{ route('users') }}" title="Users"><i class="fa-solid fa-users me-2 ms-3"></i> <span class="">Users</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::url() == route('items') ? 'active' : '' }}" href="{{ route('items') }}" title="Items"><i class="fa-solid fa-swatchbook me-2 ms-3"></i> <span class="">Items</span></a>
                    </li>
                    @if(Request::url() === route('home'))
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#searchDate" aria-expanded="false" aria-controls="searchDate">
                            <i class="fa-solid fa-magnifying-glass me-2 ms-3"></i> Search</a>
                        </li>
                    @endif
                </ul>

              </div>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-4 offset-md-4">
              <div class="collapse multi-collapse" id="searchDate">
                <div class="card card-body">
                    <form action="{{ route('home') }}" method="GET">
                        <div class="input-group mb-2">
                            <label class="input-group-text ms-2" id="start">Start Date</label>
                            <input type="date" class="form-control me-2" placeholder="Username" aria-label="Username" aria-describedby="start" name="start">
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text ms-2" id="end">End Date</span>
                            <input type="date" class="form-control me-2" placeholder="Username" aria-label="Username" aria-describedby="end" name="end">
                        </div>
                        <button class="btn btn-outline-success ms-2" type="submit">Search</button>
                    </form>
                </div>
              </div>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="mb-2">
            @include('layout.notify_errors')
            @include('layout.notify_success')
        </div>

