var drivingDirectionBlock = document.querySelector(
    '#driving-direction-container'
);
var transitDirectionBlock = document.querySelector(
    '#transit-direction-container'
);

var restaurantNameNode = document.createTextNode(
    sessionStorage.getItem('RestName')
);

document.querySelector('#restaurant-name').appendChild(restaurantNameNode);

document.querySelectorAll(
    '#from-address'
)[0].childNodes[3].innerText = sessionStorage.getItem('startLocation');

document.querySelectorAll(
    '#from-address'
)[1].childNodes[3].innerText = sessionStorage.getItem('startLocation');

document.querySelectorAll(
    '#to-address'
)[0].childNodes[3].innerText = sessionStorage.getItem('RestAdd');

document.querySelectorAll(
    '#to-address'
)[1].childNodes[3].innerText = sessionStorage.getItem('RestAdd');

// Click listener for FAB
document.querySelector('#done-fab').addEventListener('click', () => {
    window.location = 'customer-home.php';
});

// Animate floating action button
window.onscroll = function() {
    hideFAB();
};

function hideFAB() {
    if (document.body.scrollTop > 1 || document.documentElement.scrollTop > 1) {
        document.getElementById('done-fab').classList.add('mdc-fab--exited');
    } else {
        document.getElementById('done-fab').classList.remove('mdc-fab--exited');
    }
}

// Expandable directions
document
    .querySelector('#navigation-drive-choice')
    .addEventListener('click', () => {
        if (drivingDirectionBlock.style.display != 'block') {
            drivingDirectionBlock.style.display = 'block';
            initMap();
        } else {
            drivingDirectionBlock.style.display = 'none';
        }
    });

document
    .querySelector('#navigation-transit-choice')
    .addEventListener('click', () => {
        if (transitDirectionBlock.style.display != 'block') {
            transitDirectionBlock.style.display = 'block';
            initMap();
        } else {
            transitDirectionBlock.style.display = 'none';
        }
    });
