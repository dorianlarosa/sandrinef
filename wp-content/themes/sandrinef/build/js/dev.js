(function() { 
    const classes = document.body.classList;
    let timer = 0;
    window.addEventListener('resize', function () {
        if (timer) {
            clearTimeout(timer);
            timer = null;
        }
        else
            classes.add('stop-transitions');

        timer = setTimeout(() => {
            classes.remove('stop-transitions');
            timer = null;
        }, 100);
    });
})();



/////////////
// NAVBAR
////////////

document.getElementById("mobile-menu").onclick = function () {
    document.getElementById("menu-menu-principal").classList.toggle("show-mobile-nav");
    this.classList.toggle("is-active");
}