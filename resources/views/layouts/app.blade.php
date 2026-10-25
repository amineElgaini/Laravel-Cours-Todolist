<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tasks') - Laravel To-Do</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: system-ui, sans-serif; background: #f3f4f6; margin: 0; color: #1f2937; }
        nav { background: #111827; color: #fff; padding: 14px 24px; display: flex; justify-content: space-between; align-items: center; }
        nav a, nav span { color: #fff; text-decoration: none; margin-left: 14px; }
        nav .brand { font-weight: bold; font-size: 18px; margin-left: 0; }
        main { max-width: 760px; margin: 28px auto; padding: 0 16px; }
        h1 { margin: 0 0 16px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; }
        .header h1 { margin: 0; }
        .card { background: #fff; padding: 24px; border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,.1); }
        .narrow { max-width: 420px; margin: 0 auto; }
        label { display: block; margin: 14px 0 4px; font-weight: 600; }
        input[type=text], input[type=email], input[type=password], input[type=date], input[type=file], select, textarea {
            width: 100%; padding: 9px 10px; border: 1px solid #d1d5db; border-radius: 6px; font: inherit; }
        .check { font-weight: normal; }
        .btn { display: inline-block; background: #2563eb; color: #fff; border: 0; padding: 9px 16px; border-radius: 6px; cursor: pointer; text-decoration: none; font: inherit; margin-top: 16px; }
        .header .btn { margin-top: 0; }
        .btn.small { margin-top: 0; padding: 6px 12px; }
        .btn.secondary { background: #6b7280; }
        .btn.danger { background: #dc2626; }
        .link { background: none; border: 0; color: #fff; cursor: pointer; font: inherit; margin-left: 14px; padding: 0; }
        form.inline { display: inline; }
        .alert { padding: 12px 16px; border-radius: 6px; margin-bottom: 16px; }
        .alert.success { background: #dcfce7; color: #166534; }
        .alert.error { background: #fee2e2; color: #991b1b; }
        .field-error { color: #dc2626; margin: 4px 0 0; font-size: 14px; }
        .stats { display: flex; gap: 12px; margin-bottom: 14px; }
        .stats span { background: #fff; padding: 8px 14px; border-radius: 6px; font-size: 14px; }
        .filters { display: flex; gap: 8px; margin-bottom: 14px; align-items: center; }
        .filters select { width: auto; }
        .task { background: #fff; display: flex; align-items: center; gap: 12px; padding: 14px 16px; border-radius: 8px; margin-bottom: 10px; box-shadow: 0 1px 2px rgba(0,0,0,.08); }
        .task.done .title { text-decoration: line-through; color: #9ca3af; }
        .task .info { flex: 1; }
        .task .title { font-weight: 600; color: inherit; text-decoration: none; }
        .meta { font-size: 13px; color: #6b7280; margin-top: 4px; display: flex; gap: 10px; align-items: center; }
        .badge { color: #fff; padding: 2px 8px; border-radius: 99px; font-size: 12px; }
        .overdue { color: #dc2626; font-weight: 600; }
        .check-btn { background: none; border: 0; font-size: 24px; cursor: pointer; }
        .actions a { margin-right: 8px; color: #2563eb; text-decoration: none; font-size: 14px; }
        .actions button { background: none; border: 0; color: #dc2626; cursor: pointer; font: inherit; font-size: 14px; }
        .empty { text-align: center; color: #6b7280; padding: 30px; }
        .muted { color: #6b7280; font-size: 14px; }
        .center { text-align: center; }
    </style>
</head>
<body>
    <nav>
        <a class="brand" href="{{ route('tasks.index') }}">✅ Laravel To-Do</a>
        <div>
            @auth
                <span>Hello, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button class="link">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    <main>
        @include('partials.flash')
        @yield('content')
    </main>
</body>
</html>
