    <footer style="padding-bottom:5rem;">
        <p>all rights reserved c 2022</p>
        <p>thank you for playing</p>
    </footer>
    <script async defer>
        const hamburgerMenu = document.getElementById('hamburger-menu');
        const hamburgerToggle = document.getElementById('hamburger-toggle');
        hamburgerToggle.addEventListener('click', ()=>{
            if(hamburgerMenu.getAttribute('class') === 'hamburger-block') {
                hamburgerMenu.setAttribute('class', 'hamburger-block-hidden');
            } else {
                hamburgerMenu.setAttribute('class', 'hamburger-block');
            }
        });
    </script>
    </body>
</html>
