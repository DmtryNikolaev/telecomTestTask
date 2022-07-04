<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body>
    <nav class="navbar navbar-light bg-light justify-content-between container">
        <a class="navbar-brand">Telecom</a>
        <form class="form-inline" action="{{route('search')}}">
            <input type="hidden" name="api_token" value="{{config('apitokens')[0]}}">
            <small>Поиск</small>
            <div class="d-flex">
                <input class="form-control mr-sm-2 me-sm-2" type="text" placeholder="Search" aria-label="Search" id="s" name="search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </div>
        </form>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
<script src="{{asset('js/app.js')}}"></script>
</body>
