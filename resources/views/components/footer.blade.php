    <footer style="padding-bottom:5rem;">
        <p>all rights reserved c 2022</p>
        <p>thank you for playing</p>
    </footer>
    <x-bottom-nav />
    <script async defer>
        const hamburgerMenu = document.getElementById('hamburger-menu');
        const hamburgerToggle = document.getElementById('hamburger-toggle');
        hamburgerToggle.addEventListener('click', ()=>{
            if (hamburgerMenu.classList.contains('hamburger-block-hidden')) {
                hamburgerMenu.classList.remove('hamburger-block-hidden');
                hamburgerMenu.classList.add('hamburger-block');
            } else {
                hamburgerMenu.classList.add('hamburger-block-hidden');
                hamburgerMenu.classList.remove('hamburger-block');
            }
        });
    </script>
    </body>
</html>
