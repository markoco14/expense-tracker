<nav>
    <ul class="secondary-navigation">
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
</nav>
