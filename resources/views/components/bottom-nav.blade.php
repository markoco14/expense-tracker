<nav>
    <ul class="secondary-navigation">
        <li>
            <button class="primary-nav-toggle">
                <i id="hamburger-toggle" class="fa fa-2x fa-bars"></i>
            </button class="primary-nav-toggle">
        </li>
    @guest
        {{-- <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li> --}}
        <li>
            <button href="/"><i class="fa fa-home"></i></button>
        </li>
        <li>
            <button href="login"><i class="fa fa-sign-in-alt"></i></button>
        </li>
    @endguest
    @auth
        <li>
            <button href="tracking"><i class="fa fa-money-bill"></i></button>
        </li>
        <li>
            <button href="progress"><i class="fa fa-chart-line"></i></button>
        </li>            
    @endauth
    </ul>
</nav>
