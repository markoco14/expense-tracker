<header class="mobile-header">
    <p style="margin: 0; color:rgb(245,245,245);"><strong>Expensave</strong></p>
    <nav class="bottom-nav">
        <ul style="display: flex; gap:1rem; list-style: none; color:white;">
        @guest
            <li data-icon="true">
                <i id="hamburger-toggle" class="fas fa-bars"></i>
            </li>
            <li>
                <a href="/" style="color:white;">Home</a>
            </li>
            <li>
                <a href="login" style="color:white;">Log In</a>
            </li>
        @endguest
        @auth
        <li>
                <i id="hamburger-toggle" class="fas fa-bars"></i>
            </li>
            <li>
                <a href="tracking" style="color:white;">Tracking</a>
            </li>
            <li>
                <a href="progress" style="color:white;">Progress</a>
            </li>            
        @endauth
        </ul>
    </nav>
    <ul id="hamburger-menu" class="hamburger-block-hidden">
    @guest
            <li>
                <a href="/">Home</a>
            </li>
            <li>
                <a href="signup" style="color:white;">Sign Up</a>
            </li>
            <li>
                <a href="login" style="color:white;">Log In</a>
            </li>
            @endguest
            @auth
                <li>
                    <a href="spending" style="color:white;">Spending</a>
                </li>
                <li>
                    <a href="profile" style="color:white;">Profile</a>
                </li>
                <li>
                    <a href="details" style="color:white;">Details</a>
                </li>
                <li>
                    <a href="logout" style="color:white;">Log out</a>
                </li>
            @endauth
        </ul>
        </header>
