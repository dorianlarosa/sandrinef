//////////
// REVEAL
//////////
const ratio = 0;
var options = {
    root: null,
    rootMargin: '-150px',
    threshold: ratio
}

const handleIntersect = function (entries, observer) {

    entries.forEach(function (entry) {
        if (entry.intersectionRatio > ratio) {
            entry.target.classList.remove('reveal');
            observer.unobserve(entry.target);

            
        }

        console.log(entry.intersectionRatio);
    })
}
document.documentElement.classList.add('reveal-loaded');

var observer = new IntersectionObserver(handleIntersect, options);

document.querySelectorAll('.reveal').forEach(function(r){
    observer.observe(r);
});
///////////
// DISABLE TRANSITION WHEN REZIZE PAGE
///////////////

(function () {
    const classes = document.body.classList;
    let timer = 0;
    window.addEventListener('resize', function () {
        if (timer) {
            clearTimeout(timer);
            timer = null;
        } else
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


/////////////
// MAP
/////////////
var containerMap = document.getElementById('container-map');
if (containerMap) {

    var mymap = L.map('container-map', {
        scrollWheelZoom: false
    }).setView([47.247137736670425, 6.029912247186932], 12); //Creation de la map, à injecter dans la div contenant l'id #map, nous lui ajoutons sa position de depart aisin que le zoom de depart

    L.tileLayer('https://api.mapbox.com/styles/v1/dorianlarosa/ckc52xh061a7o1iqz7uzme99a/tiles/256/{z}/{x}/{y}?&access_token=pk.eyJ1IjoiZG9yaWFubGFyb3NhIiwiYSI6ImNqdzdpaTQ1eTA1NGw0OHFyaGU0ajBoYTgifQ.ZMdWM536gbUJIpztyYLvzA#10.0/42.362400/-71.020000/0}', {
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoiZG9yaWFubGFyb3NhIiwiYSI6ImNqdzdpaTQ1eTA1NGw0OHFyaGU0ajBoYTgifQ.ZMdWM536gbUJIpztyYLvzA'
    }).addTo(mymap);


    // ICON MAP

    var templateUrl = object_name.templateUrl;

    var customIcon = L.icon({
        iconUrl: templateUrl + '/images/marker.png',

        iconSize: [37, 50], // size of the icon
        iconAnchor: [18.5, 50], // point of the icon which will correspond to marker's location
        popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    var marker = L.marker([47.247137736670425, 6.029912247186932], {
        icon: customIcon
    }).addTo(mymap);

}