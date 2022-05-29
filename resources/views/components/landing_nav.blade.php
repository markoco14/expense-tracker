@guest
    <nav class="landing-nav">
@endguest
@auth
    <nav class="landing-nav">
@endauth
        @guest
            <p><strong>Expensave</strong></p>            
        @endguest
        @auth
            <p><strong>Expensave</strong></p>
        @endauth
        
        <div>
            @guest
                <a href="/">Home</a>
                <a href="signup">Sign Up</a>
                <a href="login">Log In</a>
            @endguest
            @auth
                <a href="tracking">Tracking</a>
                <a href="spending">Spending</a>
                <a href="profile">Profile</a>
                <a href="details">Details</a>
                <a href="progress">Progress</a>
                <a href="logout">Log out</a>
            @endauth
        </div>
</nav>
