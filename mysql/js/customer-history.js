var reviewsDialog = document.querySelector('#reviews-dialog');
var dialogUnderlay = document.getElementById('dialog-underlay');

mdc.textField.MDCTextField.attachTo(document.querySelector('.mdc-text-field'));

document.querySelector('#add-review-button').addEventListener('click', () => {
    if (reviewsDialog.style.display != 'block') {
        reviewsDialog.style.display = 'block';
        dialogUnderlay.style.display = 'block';
    } else {
        reviewsDialog.style.display = 'none';
        dialogUnderlay.style.display = 'none';
    }
});

document
    .querySelector('#reviews-dialog-close-button')
    .addEventListener('click', () => {
        if (reviewsDialog.style.display != 'block') {
            reviewsDialog.style.display = 'block';
            dialogUnderlay.style.display = 'block';
        } else {
            reviewsDialog.style.display = 'none';
            dialogUnderlay.style.display = 'none';
        }
    });
