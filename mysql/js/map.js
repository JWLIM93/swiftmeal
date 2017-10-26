mapboxgl.accessToken = 'pk.eyJ1IjoianVzdGxuZiIsImEiOiJjajhzeXhrdWIwZ3p2MnFvNDFvZnF4cnh3In0.Fyue5JNW7KqTtDvd_fLGhQ';
let map = new mapboxgl.Map({
    container: 'map',
    zoom: 14,
    center: [103.860330, 1.283951],
    style: 'mapbox://styles/justlnf/cj8vbviqsf3de2rqnn2ns0a9p',
});

document.getElementById('recommended-list').addEventListener('click', () => {
    // Fly to a random location by offsetting the point -74.50, 40
    // by up to 5 degrees.
    map.flyTo({
        center: [
            -74.50 + (Math.random() - 0.5) * 10,
            40 + (Math.random() - 0.5) * 10]
    });
})
