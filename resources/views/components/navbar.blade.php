<nav>
    @guest
        <a href="/">Home</a>
        <a href="signup">Sign Up</a>
        <a href="login">Log In</a>
    @endguest
    @auth
        <a href="profile">Profile</a>
        <a href="tracking">Tracking</a>
        <a href="details">Details</a>
        <a href="logout">Log out</a>
    @endauth
</nav>
