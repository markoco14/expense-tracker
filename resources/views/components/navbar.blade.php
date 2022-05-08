<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <p class="navbar-brand">ExpenSave</p>
        <button 
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" 
            aria-expanded="false" 
            aria-label="Toggle navigation"
         >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse navbar-nav" id="navbarTogglerDemo01">
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
    </div>
</nav>
