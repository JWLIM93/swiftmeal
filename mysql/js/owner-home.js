var inputFields = document.querySelectorAll('.mdc-text-field');
var confirmDialog = document.querySelector('#confirm-add-container');
let listOfRestaurants = document.getElementsByClassName('restaurant-item');
var addRestaurant = document.querySelector('#add-restaurant-container');
var areaName = '';

for (let i = 0; i < inputFields.length; i++) {
    mdc.textField.MDCTextField.attachTo(inputFields[i]);
}

document.querySelector('#new-restaurant-fab').addEventListener('click', () => {
    if (addRestaurant.style.display != 'grid') {
        addRestaurant.style.display = 'grid';
    } else {
        addRestaurant.style.display = 'none';
        confirmDialog.style.display = 'none';
    }
});

$(document).ready(function() {
    $('#area').on('change', function() {
        var string = $(this).val();
        var arr = string.split(',');
        areaID = arr[3];
    });
});

document.getElementById('area').addEventListener('change', () => {
    var string = $('#area :selected').val();
    var arr = string.split(',');
    areaName = arr[3];
    console.log(areaName);
    console.log(arr);
});

document.querySelector('#confirm-add-button').addEventListener('click', () => {
    $.ajax({
        url:
            'scripts/owner-operations.php?block=' +
            document.getElementById('restaurant-block').value +
            '&building=' +
            document.getElementById('restaurant-building').value +
            '&floor=' +
            document.getElementById('restaurant-floor').value +
            '&street=' +
            document.getElementById('restaurant-street').value +
            '&unit=' +
            document.getElementById('restaurant-unit').value +
            '&lat=' +
            document.getElementById('restaurant-lat').value +
            '&long=' +
            document.getElementById('restaurant-lng').value +
            '&postal=' +
            document.getElementById('postal-code').value +
            '&restname=' +
            document.getElementById('restaurant-name').value +
            '&area=' +
            areaName,
        data: { action: 'addRestaurant' },
        type: 'post',
        success: function(output) {
            confirmDialog.style.display = 'none';
            addRestaurant.style.display = 'none';
        }
    });
});

// Animate floating action button
window.onscroll = function() {
    hideFAB();
};

function hideFAB() {
    if (document.body.scrollTop > 1 || document.documentElement.scrollTop > 1) {
        document
            .getElementById('new-restaurant-fab')
            .classList.add('mdc-fab--exited');
    } else {
        document
            .getElementById('new-restaurant-fab')
            .classList.remove('mdc-fab--exited');
    }
}

for (let i = 0; i < listOfRestaurants.length; i++) {
    listOfRestaurants[i].addEventListener('mouseover', () => {
        let restaurantItem = listOfRestaurants[i];
        let goToButton = listOfRestaurants[i].childNodes[5];
        goToButton.style.display = 'block';
        restaurantItem.style.backgroundColor = 'var(--mdc-theme-primary)';
    });
    listOfRestaurants[i].addEventListener('mouseout', () => {
        let restaurantItem = listOfRestaurants[i];
        let goToButton = listOfRestaurants[i].childNodes[5];
        goToButton.style.display = 'none';
        restaurantItem.style.backgroundColor = 'rgba(129, 129, 129, 0.3)';
    });
    listOfRestaurants[i].addEventListener('click', () => {
        // Redirection here
        window.location = 'owner-restaurant-details.php';
    });
}

function showConfirmDialog() {
    confirmDialog.style.display = 'grid';
}
