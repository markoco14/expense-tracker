<nav>
    <ul class="secondary-navigation">
        <li>
            <button class="primary-nav-toggle">
                <i id="hamburger-toggle" class="fa fa-2x fa-bars"></i>
            </button class="primary-nav-toggle">
        </li>
    @guest
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="login"><i class="fa fa-sign-in-alt"></i></a>
        </li>
    @endguest
    @auth
        <li>
            <a href="tracking"><i class="fa fa-money-bill"></i></a>
        </li>
        <li>
            <a href="progress"><i class="fa fa-chart-line"></i></a>
        </li>            
    @endauth
    </ul>
</nav>
