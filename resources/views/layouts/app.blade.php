<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laravel To-Do List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">To-Do List</a>
            
            @auth
            <div class="d-flex align-items-center">
                <span class="me-3">Hello {{ Auth::user()->name }}</span>
                <a class="btn btn-primary me-2" href="{{ route('tasks.create') }}">Add Task</a>
                <a class="btn btn-outline-primary me-2" href="{{ route('tasks.index') }}">All Tasks</a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
            </div>
            @else
            <div class="d-flex">
                <a class="btn btn-primary me-2" href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                <a class="btn btn-outline-primary" href="{{ route('register') }}">Register</a>
                @endif
            </div>
            @endauth
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>