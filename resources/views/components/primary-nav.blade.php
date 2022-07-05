<header class="primary-header flex">
    <div class='logo'>
        <span>expen<i class="fas fa-dollar-sign"></i>ave</span>
    </div>
    <ul id="mobile-hamburger-menu" class="mobile-primary-navigation flex mobile-hamburger-block-hidden">
    @guest
        <li>
            <a href="/"><i class="fa fa-home"></i>Home</a>
        </li>
        <li>
            <a href="signup"><i class="fas fa-user-plus"></i>Sign Up</a>
        </li>
        <li>
            <a href="login"><i class="fa fa-sign-in-alt"></i>Log In</a>
        </li>
        @endguest
        @auth
            <li>
                <a href="spending"><i class="fas fa-file-invoice-dollar"></i>Spending</a>
            </li>
            <li>
                <a href="profile"><i class="fas fa-user-edit"></i>Profile</a>
            </li>
            <li>
                <a href="logout"><i class="fas fa-sign-out-alt"></i>Log out</a>
            </li>
        @endauth
    </ul>
    <ul class="primary-navigation flex">
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
                <a href="tracking">Tracking</a>
            </li>
            <li>
                <a href="progress">Progress</a>
            </li>
            <li>
                <button class="primary-nav-toggle">
                    <i id="large-hamburger-toggle" class="fa fa-2x fa-bars"></i>
                </button class="primary-nav-toggle">
            </li>
        @endauth
    </ul>
    <ul id="large-hamburger-menu" class="secondary-navigation large-hamburger-block-hidden">
        <button id="close-hamburger-toggle" aria-role="close-menu"><i class="fa fa-times"></i></button>
        <li>
            <a href="spending">Spending</a>
        </li>
        <li>
            <a href="profile">Profile</a>
        </li>
        <li>
            <a href="logout">Log out</a>
        </li>
    </ul>
</header>
