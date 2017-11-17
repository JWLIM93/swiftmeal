const snackbar = new mdc.snackbar.MDCSnackbar(
    document.querySelector('.mdc-snackbar')
);
const snackbarMessageObj = {
    message: 'Waiting for friends ...',
    timeout: 9999999
};
var confirmReserveDialog = new mdc.dialog.MDCDialog(
    document.querySelector('#confirm-reserve-dialog')
);
var chooseDateDialog = new mdc.dialog.MDCDialog(
    document.querySelector('#choose-date-dialog')
);
var loadingBar = document.getElementById('loading-progress');
var listOfTimeSelection = document.getElementsByClassName('time-selection');
var listOfDateSelection = document.getElementsByClassName('date-selection');
var timeSelected = '';
var dateSelected = '';

snackbar.show(snackbarMessageObj);

// Instantiate snackbar
mdc.snackbar.MDCSnackbar.attachTo(document.querySelector('.mdc-snackbar'));

// Instantiate confirmation dialog
mdc.dialog.MDCDialog.attachTo(document.querySelector('.mdc-dialog'));

// Click listeners for confirmation dialog
confirmReserveDialog.listen('MDCDialog:accept', function() {
    chooseDateDialog.show();
});

confirmReserveDialog.listen('MDCDialog:cancel', function() {
    console.log('canceled');
});

// Click listeners for choose date dialog
chooseDateDialog.listen('MDCDialog:accept', function() {
    $.ajax({
        url:
            'scripts/friend-operations.php?Pax=' +
            (Accepts.length + 1) +
            '&Time=' +
            timeSelected +
            '&Date=' +
            dateSelected,
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

chooseDateDialog.listen('MDCDialog:cancel', function() {
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
        timeSelected = listOfTimeSelection[i].getAttribute('id');
    });
}

var date = new Date();
var dateSelectionList = document.getElementById('date-selection-list');

for (let x = 1; x < 7; x++) {
    var nextDate = new Date(date.getTime());
    nextDate.setDate(date.getDate() + x);

    var newDateItem = document.createElement('LI');
    newDateItem.id =
        nextDate.getFullYear() +
        '-' +
        nextDate.getMonth() +
        '-' +
        nextDate.getDate();
    newDateItem.className = 'mdc-list-item date-selection';
    var textNode = document.createTextNode(
        nextDate.getFullYear() +
            '-' +
            nextDate.getMonth() +
            '-' +
            nextDate.getDate()
    );
    newDateItem.appendChild(textNode);
    dateSelectionList.appendChild(newDateItem);
}

// Date selector listener
for (let i = 0; i < listOfDateSelection.length; i++) {
    listOfDateSelection[i].addEventListener('click', () => {
        for (let r = 0; r < listOfDateSelection.length; r++) {
            let tempElement = document.getElementById(
                listOfDateSelection[r].getAttribute('id')
            );
            tempElement.style.color = 'white';
            tempElement.style.fontWeight = 'normal';
        }

        let element = document.getElementById(
            listOfDateSelection[i].getAttribute('id')
        );
        element.style.color = 'var(--mdc-theme-secondary)';
        element.style.fontWeight = 'bold';
        dateSelected = listOfDateSelection[i].getAttribute('id');
    });
}
