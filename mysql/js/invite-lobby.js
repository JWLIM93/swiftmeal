const snackbar = new mdc.snackbar.MDCSnackbar(
    document.querySelector('.mdc-snackbar')
);
const snackbarMessageObj = {
    message: 'Waiting for friends ...',
    timeout: 9999999
};
var confirmReserveDialog = new mdc.dialog.MDCDialog(
    document.querySelector('.mdc-dialog')
);

snackbar.show(snackbarMessageObj);

// Instantiate snackbar
mdc.snackbar.MDCSnackbar.attachTo(document.querySelector('.mdc-snackbar'));

// Instantiate confirmation dialog
mdc.dialog.MDCDialog.attachTo(document.querySelector('.mdc-dialog'));

// CLick listeners for confirmation dialog
confirmReserveDialog.listen('MDCDialog:accept', function() {
    window.location = '/mysql/current-location.php';
});

confirmReserveDialog.listen('MDCDialog:cancel', function() {
    console.log('canceled');
});

// Click listener for FAB
document
    .querySelector('#confirm-reservation-fab')
    .addEventListener('click', () => {
        confirmReserveDialog.show();
    });

// Animate floating action button
window.onscroll = function() {
    hideFAB();
};

function hideFAB() {
    if (document.body.scrollTop > 1 || document.documentElement.scrollTop > 1) {
        document
            .getElementById('confirm-reservation-fab')
            .classList.add('mdc-fab--exited');
    } else {
        document
            .getElementById('confirm-reservation-fab')
            .classList.remove('mdc-fab--exited');
    }
}
