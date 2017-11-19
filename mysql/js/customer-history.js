var reviewsDialog = document.querySelector('#reviews-dialog');
var dialogUnderlay = document.getElementById('dialog-underlay');

mdc.textField.MDCTextField.attachTo(document.querySelector('.mdc-text-field'));

document
    .querySelector('#reviews-dialog-close-button')
    .addEventListener('click', () => {
        if (reviewsDialog.style.display != 'block') {
            reviewsDialog.style.display = 'block';
            dialogUnderlay.style.display = 'block';
        } else {
            document.getElementById('reviews-list').innerHTML = '';
            document.getElementById('reviews-list-group-subheader').innerHTML =
                '';
            reviewsDialog.style.display = 'none';
            dialogUnderlay.style.display = 'none';
        }
    });

document
    .querySelector('#confirm-review-button')
    .addEventListener('click', () => {
        if (document.getElementById('add-review-textarea').value !== '') {
            $.ajax({
                url:
                    'scripts/review-operations.php?restID=' +
                    sessionStorage.getItem('history-restid') +
                    '&content=' +
                    document.getElementById('add-review-textarea').value,
                data: { action: 'addReviews' },
                type: 'post',
                success: function(output) {
                    console.log(output);
                }
            });
        } else {
            alert('Please enter a review to submit');
        }
    });
