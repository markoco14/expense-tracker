<nav class="nav">
    @guest
        <p><strong>Expensave</strong></p>
        <div>
            <a href="/">Home</a>
            <a href="login">Log In</a>
            <i id="hamburger-toggle" class="fas fa-bars"></i>
        </div>
    @endguest
    @auth
        <p><strong>Expensave</strong></p>
        <div>
            <a href="tracking">Tracking</a>
            <a href="progress">Progress</a>
            <i id="hamburger-toggle" class="fas fa-bars"></i>
        </div>
    @endauth
</nav>
@guest
    <div id="hamburger-menu" class="hamburger-block-hidden">
        <a href="/">Home</a>
        <a href="signup">Sign Up</a>
        <a href="login">Log In</a>

    </div>            
@endguest
@auth
    <div id="hamburger-menu" class="hamburger-block-hidden">
        <a href="spending">Spending</a>
        <a href="profile">Profile</a>
        <a href="details">Details</a>
        <a href="logout">Log out</a>
    </div>
@endauth
