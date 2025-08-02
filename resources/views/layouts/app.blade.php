<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TaskPro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    @auth
    <div class="flex h-screen" x-data="{ sidebarOpen: window.innerWidth >= 768 }">
        <!-- Sidebar Show Button (when hidden, now in topbar) -->
        <!-- Moved to topbar below -->
        <!-- Sidebar -->
        <div :class="[sidebarOpen ? 'w-64' : 'w-0', 'fixed md:static z-30 top-0 left-0 h-full bg-gray-900 text-white flex flex-col transition-all duration-300 overflow-hidden']"
            x-show="sidebarOpen"
            x-bind="window.innerWidth < 768 ? { '@click.away': () => sidebarOpen = false } : {}"
            style="min-width:0;">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-700 flex items-center gap-3 relative">
                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    TR
                </div>
                <span x-show="sidebarOpen" class="text-lg font-semibold transition-all duration-300">Todo.rich</span>
                <!-- Sidebar Toggle Icon -->
                <button @click="sidebarOpen = !sidebarOpen" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded p-2 z-40" title="Toggle Sidebar">
                    <i :class="sidebarOpen ? 'fas fa-angle-double-left' : 'fas fa-angle-double-right'"></i>
                </button>
            </div>
            <!-- Navigation Menu -->
            <nav class="flex-1 p-4">
                <ul class="space-y-2" x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    <li>
                        <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition-colors {{ request()->routeIs('home') ? 'bg-gray-800' : '' }}">
                            <i class="fas fa-home text-gray-400"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tasks.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition-colors {{ request()->routeIs('tasks.index') ? 'bg-gray-800' : '' }}">
                            <i class="fas fa-tasks text-gray-400"></i>
                            <span>Tasks</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tasks.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition-colors {{ request()->routeIs('tasks.create') ? 'bg-gray-800' : '' }}">
                            <i class="fas fa-star text-gray-400"></i>
                            <span>New Task</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- Bottom Menu -->
            <div class="p-4 border-t border-gray-700">
                <ul class="space-y-2" x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    <li>
                        <a href="{{ route('settings') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition-colors {{ request()->routeIs('settings') ? 'bg-gray-800' : '' }}">
                            <i class="fas fa-cog text-gray-400"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition-colors text-left">
                                <i class="fas fa-sign-out-alt text-gray-400"></i>
                                <span>Log Out</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <!-- Top Navigation Bar -->
            <header class="bg-white border-b border-gray-200 px-6 py-3 flex items-center justify-between">
                <!-- Left: Sidebar Show Button (when hidden) and Search Bar -->
                <div class="flex items-center gap-4 flex-1 max-w-md">
                    <button x-show="!sidebarOpen" @click="sidebarOpen = true" class="text-blue-600 hover:text-blue-800 focus:outline-none transition" style="display:none;" x-cloak title="Show Sidebar">
                        <i class="fas fa-bars fa-lg"></i>
                    </button>
                    <form action="{{ route('tasks.index') }}" method="GET" class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="q" value="{{ request('q') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for tasks...">
                    </form>
                </div>
                <!-- User Info and Actions -->
                <div class="flex items-center gap-4">
                    <!-- User Profile -->
                    <div class="flex items-center gap-3">
                        @if(Auth::user()->profile_picture_url)
                            <img src="{{ Auth::user()->profile_picture_url }}" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-blue-200">
                        @else
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-medium">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="text-left hidden md:block">
                            <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>
    @else
    <!-- Guest Main Content Area -->
    <div class="min-h-screen flex flex-col">
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>
    @endauth
</body>

</html>