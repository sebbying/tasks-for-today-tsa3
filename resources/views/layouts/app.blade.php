<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Tasks for Today, a Laravel task management project.">
    <title>@yield('title', 'Today') · Tasks for Today</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <a class="skip-link" href="#main">Skip to content</a>
    <div class="app-shell">
        <aside class="sidebar">
            <a class="brand" href="{{ route('home') }}"><span class="brand-symbol" aria-hidden="true">✓</span><span>Tasks <span class="brand-light">for Today</span></span></a>
            <div class="nav-heading">WORKSPACE</div>
            <nav class="navigation" aria-label="Main navigation">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" @if(request()->routeIs('home')) aria-current="page" @endif><span aria-hidden="true">◉</span> Welcome</a>
                <a href="{{ route('tasks.index') }}" class="nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}" @if(request()->routeIs('tasks.*')) aria-current="page" @endif><span aria-hidden="true">☷</span> Task List</a>
                <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" @if(request()->routeIs('profile')) aria-current="page" @endif><span aria-hidden="true">♙</span> Profile</a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" @if(request()->routeIs('about')) aria-current="page" @endif><span aria-hidden="true">ⓘ</span> About</a>
            </nav>
            <p class="sidebar-note">A clear place to see what needs doing.</p>
        </aside>
        <div class="main-shell">
            <header class="topbar"><span>MY WORKSPACE</span><span>IT0049 · TSA3</span></header>
            <main id="main" class="main-content" tabindex="-1">@yield('content')</main>
            <footer class="footer">Tasks for Today <span>Built with Laravel</span></footer>
        </div>
    </div>
</body>
</html>
