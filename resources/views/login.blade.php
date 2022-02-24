<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="app.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="//unpkg.com/alpinejs" defer></script>
    </head>
    <body>
        <nav>
            <a href="/">Home</a>
            @guest
                <a href="/signup">Sign Up</a>
                <a href="/login">Log In</a>
            @endguest
            @auth
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit">Log Out</button>
                </form>
                <p>Welcome back, mother fucker!</p>
            @endauth
        </nav>
        <div>
            <div>
                <h1>Log In</h1>
                @if (session()->has('success'))
                    <p
                        x-data="{ show: true }"
                        x-init="setTimeout(() => show = false, 4000)"
                        x-show="show"
                    >
                    {{ session('success') }}</p>
                @endif
                <form action="login" method="post" class="form">
                    @csrf
                    <div class="control-group">
                        <label 
                            for="username" 
                            class="form-label"
                            >
                            Username
                        </label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username"
                            class="form-control"
                            >
                    </div>
                    <div class="control-group">
                        <label 
                            for="password" 
                            class="form-label"
                            >
                            Password
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password"
                            class="form-control"
                            >
                    </div>
                    <div class="control-group">
                        <button 
                            type="submit" 
                            name="submit" 
                            class="form-control"
                            >
                            Log In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
