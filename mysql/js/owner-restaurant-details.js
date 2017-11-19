var inputFields = document.querySelectorAll('.mdc-text-field');
var confirmDialog = document.querySelector('#confirm-add-container');
let listOfRestaurants = document.getElementsByClassName('restaurant-item');
var addRestaurant = document.querySelector('#add-restaurant-container');

for (let i = 0; i < inputFields.length; i++) {
    mdc.textField.MDCTextField.attachTo(inputFields[i]);
}

document.querySelector('#new-restaurant-fab').addEventListener('click', () => {
    if (addRestaurant.style.display != 'grid') {
        addRestaurant.style.display = 'grid';
    } else {
        addRestaurant.style.display = 'none';
    }
});

function showConfirmDialog() {
    confirmDialog.style.display = 'grid';
}
