// Click listener for FAB
document.querySelector('#to-lobby-fab').addEventListener('click', () => {
    window.location = '/mysql/invite-lobby.php';
});

// Animate floating action button
window.onscroll = function() {
    hideFAB();
};

function hideFAB() {
    if (document.body.scrollTop > 1 || document.documentElement.scrollTop > 1) {
        document
            .getElementById('to-lobby-fab')
            .classList.add('mdc-fab--exited');
    } else {
        document
            .getElementById('to-lobby-fab')
            .classList.remove('mdc-fab--exited');
    }
}
