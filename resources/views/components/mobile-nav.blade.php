<header class="primary-header flex">
    <div class='logo'>
        <p>Expensave</p>
    </div>
    <nav>
        <ul class="primary-navigation flex">
        @guest
            <li>
                <a href="/">Home</a>
            </li>
            <li>
                <a href="login">Log In</a>
            </li>
        @endguest
        @auth
            <li>
                <a href="tracking">Tracking</a>
            </li>
            <li>
                <a href="progress">Progress</a>
            </li>            
        @endauth
            <button class="primary-nav-toggle">
                <i id="hamburger-toggle" class="fas fa-2x fa-bars"></i>
            </button class="primary-nav-toggle">
        </ul>
        <ul id="hamburger-menu" class="secondary-navigation flex hamburger-block-hidden">
        @guest
            <li>
                <a href="/">Home</a>
            </li>
            <li>
                <a href="signup">Sign Up</a>
            </li>
            <li>
                <a href="login">Log In</a>
            </li>
            @endguest
            @auth
                <li>
                    <a href="spending">Spending</a>
                </li>
                <li>
                    <a href="profile">Profile</a>
                </li>
                <li>
                    <a href="details">Details</a>
                </li>
                <li>
                    <a href="logout">Log out</a>
                </li>
            @endauth
        </ul>
    </nav>
</header>
