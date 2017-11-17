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
var loadingBar = document.getElementById('loading-progress');
var listOfTimeSelection = document.getElementsByClassName('time-selection');

snackbar.show(snackbarMessageObj);

// Instantiate snackbar
mdc.snackbar.MDCSnackbar.attachTo(document.querySelector('.mdc-snackbar'));

// Instantiate confirmation dialog
mdc.dialog.MDCDialog.attachTo(document.querySelector('.mdc-dialog'));

// CLick listeners for confirmation dialog
confirmReserveDialog.listen('MDCDialog:accept', function() {
    $.ajax({
        url: 'scripts/friend-operations.php?Pax=' + (Accepts.length + 1),
        data: { action: 'ReservePlace' },
        type: 'post',
        success: function(output) {
            if (output === 'succeed') {
                window.location = '/mysql/current-location.php';
            } else {
                console.log(output);
            }
        }
    });
});

confirmReserveDialog.listen('MDCDialog:cancel', function() {
    console.log('canceled');
});

// Click listener for FAB
document
    .querySelector('#confirm-reservation-fab')
    .addEventListener('click', () => {
        loadingBar.style.display = 'none';
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

// Time selector listener
for (let i = 0; i < listOfTimeSelection.length; i++) {
    listOfTimeSelection[i].addEventListener('click', () => {
        for (let r = 0; r < listOfTimeSelection.length; r++) {
            let tempElement = document.getElementById(
                listOfTimeSelection[r].getAttribute('id')
            );
            tempElement.style.color = 'white';
            tempElement.style.fontWeight = 'normal';
        }

        let element = document.getElementById(
            listOfTimeSelection[i].getAttribute('id')
        );
        element.style.color = 'var(--mdc-theme-secondary)';
        element.style.fontWeight = 'bold';
    });
}
