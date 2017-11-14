var dialog = document.getElementById('add-friend-dialog');

// Click listener for FAB
document.querySelector('#add-friend-fab').addEventListener('click', () => {
    if (dialog.style.display != 'block') {
        dialog.style.display = 'block';
    } else {
        // dialog.style.display= "none";
    }
});

// Click listener for dialog buttons
document.querySelector('#cancel-button').addEventListener('click', () => {
    if (dialog.style.display != 'block') {
        dialog.style.display = 'block';
    } else {
        dialog.style.display = 'none';
    }
});

document
    .querySelector('#friend-request-button')
    .addEventListener('click', () => {});

// Animate floating action button
window.onscroll = function() {
    hideFAB();
};

function hideFAB() {
    if (document.body.scrollTop > 1 || document.documentElement.scrollTop > 1) {
        document
            .getElementById('add-friend-fab')
            .classList.add('mdc-fab--exited');
    } else {
        document
            .getElementById('add-friend-fab')
            .classList.remove('mdc-fab--exited');
    }
}
