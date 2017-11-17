// Click listener for FAB
document.querySelector('#to-lobby-fab').addEventListener('click', () => {
    let checkboxes = document.getElementsByClassName(
        'mdc-checkbox__native-control'
    );
    for (i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked === true) {
            $.ajax({
                url:
                    'scripts/friend-operations.php?Requester=' +
                    checkboxes[i].value,
                data: { action: 'SendMealRequest' },
                type: 'post',
                success: function(output) {
                    console.log(output);
                }
            });
        }
    }

    window.location = '/mysql/invite-lobby.php';
});

// Animate floating action button
window.onscroll = function() {
    hideFAB();
};

function hideFAB() {
    if (document.body.scrollTop > 1 || document.documentElement.scrollTop > 1) {
        document
            .getElementById('to-lobby-fab')
            .classList.add('mdc-fab--exited');
    } else {
        document
            .getElementById('to-lobby-fab')
            .classList.remove('mdc-fab--exited');
    }
}
