<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Todo.rich</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header style="display: flex; justify-content: space-between; align-items: center; padding: 20px; margin-bottom: 20px; flex-wrap: wrap; gap: 20px;">
        <div style="display: flex; align-items: center; gap: 8px; font-size: 18px; font-weight: 600; color: #333;">
            <div style="width: 32px; height: 32px; background: #FF6B35; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">TR</div>
            <span>Todo.rich</span>
        </div>
        @auth
        <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
            <span style="font-size: 16px; color: #333;">Hello {{ Auth::user()->name }}</span>
            <a style="padding: 6px 16px; background: #FF6B35; color: #fff; border-radius: 6px; text-decoration: none; font-weight: 500;" href="{{ route('tasks.create') }}">Add Task</a>
            <a style="padding: 6px 16px; border: 1px solid #FF6B35; color: #FF6B35; border-radius: 6px; text-decoration: none; font-weight: 500; background: #fff;" href="{{ route('tasks.index') }}">All Tasks</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline; margin: 0;">
                @csrf
                <button style="padding: 6px 16px; background: #e74c3c; color: #fff; border: none; border-radius: 6px; font-weight: 500; cursor: pointer;" type="submit">Logout</button>
            </form>
        </div>
        @else
        <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
            <a style="padding: 6px 16px; background: #FF6B35; color: #fff; border-radius: 6px; text-decoration: none; font-weight: 500;" href="{{ route('login') }}">Login</a>
            @if (Route::has('register'))
            <a style="padding: 6px 16px; border: 1px solid #FF6B35; color: #FF6B35; border-radius: 6px; text-decoration: none; font-weight: 500; background: #fff;" href="{{ route('register') }}">Register</a>
            @endif
        </div>
        @endauth
    </header>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>