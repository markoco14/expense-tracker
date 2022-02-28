<nav>
    <a href="/">Home</a>
    @guest
        <a href="signup">Sign Up</a>
        <a href="login">Log In</a>
    @endguest
    @auth
        <a href="record">Record</a>
        <a href="logout">Log out</a>
        <p>Welcome back!</p>
    @endauth
</nav>
