    </main>
    <footer style="padding-bottom:5rem;">
        <p>all rights reserved c 2022</p>
        <p>thank you for playing</p>
    </footer>
    <script async defer>
        const hamburgerMenu = document.getElementById('mobile-hamburger-menu');
        const hamburgerToggle = document.getElementById('mobile-hamburger-toggle');
        hamburgerToggle.addEventListener('click', ()=>{
            if (hamburgerMenu.classList.contains('mobile-hamburger-block-hidden')) {
                hamburgerMenu.classList.remove('mobile-hamburger-block-hidden');
                hamburgerMenu.classList.add('mobile-hamburger-block');
            } else {
                hamburgerMenu.classList.add('mobile-hamburger-block-hidden');
                hamburgerMenu.classList.remove('mobile-hamburger-block');
            }
        });
    </script>
    <script async defer>
        const largeDeviceHamburgerMenu = document.getElementById('large-hamburger-menu');
        const largeHamburgerToggle = document.getElementById('large-hamburger-toggle');
        largeHamburgerToggle.addEventListener('click', () => {
            if (largeDeviceHamburgerMenu.classList.contains('large-hamburger-block-hidden')) {
                largeDeviceHamburgerMenu.classList.remove('large-hamburger-block-hidden');
                largeDeviceHamburgerMenu.classList.add('large-hamburger-block');
            } else {
                largeDeviceHamburgerMenu.classList.add('large-hamburger-block-hidden');
                largeDeviceHamburgerMenu.classList.remove('large-hamburger-block');
            }
        });
        const closeHamburgerButton = document.getElementById('close-hamburger-toggle');
        closeHamburgerButton.addEventListener('click', () => {
            largeDeviceHamburgerMenu.classList.add('large-hamburger-block-hidden');
            largeDeviceHamburgerMenu.classList.remove('large-hamburger-block');
        });
    </script>
    </body>
</html>
