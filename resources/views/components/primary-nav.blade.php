<header class="primary-header flex">
    <div class='logo'>
        <p>Expensave</p>
    </div>
    <ul id="hamburger-menu" class="primary-navigation flex hamburger-block-hidden">
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
</header>
