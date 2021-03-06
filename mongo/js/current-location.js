// Click listener for FAB
document.querySelector('#to-directions-fab').addEventListener('click', () => {
    sessionStorage.setItem(
        'startLocation',
        document.querySelector('#current-location-box').value
    );
    window.location = 'place-direction.php';
});

// Animate floating action button
window.onscroll = function() {
    hideFAB();
};

function hideFAB() {
    if (document.body.scrollTop > 1 || document.documentElement.scrollTop > 1) {
        document
            .getElementById('to-directions-fab')
            .classList.add('mdc-fab--exited');
    } else {
        document
            .getElementById('to-directions-fab')
            .classList.remove('mdc-fab--exited');
    }
}
