<header class="primary-header flex">
    <div class='logo'>
        <p>expen<i class="fas fa-dollar-sign"></i>ave</p>
    </div>
    <ul id="hamburger-menu" class="primary-navigation flex hamburger-block-hidden">
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
</header>
