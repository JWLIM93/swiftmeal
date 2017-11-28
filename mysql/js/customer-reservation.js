let paxCount = 1;

var upPaxButton = document.querySelector('#up-pax');
var downPaxButton = document.querySelector('#down-pax');
var paxCounterDisplay = document.querySelector('#number-of-pax-container');
var counterTextNode = document.createTextNode(paxCount);
paxCounterDisplay.appendChild(counterTextNode);
var listOfTimeSelection = document.getElementsByClassName('time-selection');
var listOfDateSelection = document.getElementsByClassName('date-selection');
var timeSelected = '';
var dateSelected = '';
var confirmDialog = new mdc.dialog.MDCDialog(
    document.querySelector('#confirm-dialog')
);

var pax;

upPaxButton.addEventListener('mousedown', () => {
    if (paxCount > 0 && paxCount < 10) {
        paxCount++;
        paxCounterDisplay.innerText = paxCount;
        pax = paxCount;
    }
    upPaxButton.classList.add('mdc-elevation--z12');
});

upPaxButton.addEventListener('mouseup', () => {
    upPaxButton.classList.remove('mdc-elevation--z12');
});

downPaxButton.addEventListener('mousedown', () => {
    if (paxCount > 1 && paxCount <= 10) {
        paxCount--;
        paxCounterDisplay.innerText = paxCount;
        pax = paxCount;
    }
    downPaxButton.classList.add('mdc-elevation--z12');
});

downPaxButton.addEventListener('mouseup', () => {
    downPaxButton.classList.remove('mdc-elevation--z12');
});

var date = new Date();
var dateSelectionList = document.getElementById('select-date-list');

for (let x = 0; x < 7; x++) {
    var nextDate = new Date(date.getTime());
    nextDate.setDate(date.getDate() + x);

    var newDateItem = document.createElement('LI');
    newDateItem.id =
        nextDate.getFullYear() +
        '-' +
        (nextDate.getMonth() + 1) +
        '-' +
        nextDate.getDate();
    newDateItem.className = 'mdc-list-item date-selection';
    var textNode = document.createTextNode(
        nextDate.getFullYear() +
            '-' +
            (nextDate.getMonth() + 1) +
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
            tempElement.style.backgroundColor = 'transparent';
        }

        let element = document.getElementById(
            listOfDateSelection[i].getAttribute('id')
        );
        element.style.fontWeight = 'bold';
        element.style.backgroundColor = 'var(--mdc-theme-primary)';
        dateSelected = listOfDateSelection[i].getAttribute('id');
    });
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
            tempElement.style.backgroundColor = 'transparent';
        }

        let element = document.getElementById(
            listOfTimeSelection[i].getAttribute('id')
        );
        element.style.fontWeight = 'bold';
        element.style.backgroundColor = 'var(--mdc-theme-primary)';
        timeSelected = listOfTimeSelection[i].getAttribute('id');
    });
}

document.querySelector('#to-directions-fab').addEventListener('click', () => {
    confirmDialog.show();
});

// Listen for invite dialog activator
confirmDialog.listen('MDCDialog:accept', function() {
    $.ajax({
        url:
            'scripts/friend-operations.php?Pax=' +
            parseInt(pax) +
            '&Time=' +
            timeSelected +
            '&Date=' +
            dateSelected,
        data: {
            action: 'ReservePlace2'
        },
        type: 'post',
        success: function(output) {
            if (output === 'succeed') {
                window.location = 'current-location.php';
            } else {
                console.log(output);
            }
        }
    });
});

confirmDialog.listen('MDCDialog:cancel', function() {
    dialogUnderlay.style.display = 'none';
});

// Animate floating action button
window.onscroll = function() {
    hideFAB();
};

function hideFAB() {
    if (document.body.scrollTop > 1 || document.documentElement.scrollTop > 1) {
        document
            .getElementById('to-directions-fab')
            .classList.add('mdc-fab--exited');
    } else {
        document
            .getElementById('to-directions-fab')
            .classList.remove('mdc-fab--exited');
    }
}
