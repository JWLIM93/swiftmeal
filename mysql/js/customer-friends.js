var dialog = document.getElementById('add-friend-dialog');

// Click listener for FAB
document.querySelector('#add-friend-fab').addEventListener('click', () => {
    if (dialog.style.display != 'block') {
        dialog.style.display = 'block';
    } else {
        // dialog.style.display= "none";
    }
});

// Click listener for dialog buttons
document.querySelector('#cancel-button').addEventListener('click', () => {
    if (dialog.style.display != 'block') {
        dialog.style.display = 'block';
    } else {
        dialog.style.display = 'none';
    }
});

document
    .querySelector('#friend-request-button')
    .addEventListener('click', () => {
        if (document.querySelector('#tf-box').value !== '') {
            var email = document.querySelector('#tf-box').value;
            $.ajax({
                url: 'scripts/friend-operations.php?RequestEmail=' + email,
                data: { action: 'friendRequest' },
                type: 'post',
                success: function(output) {
                    if (output == 'failed') {
                        alert('Email does not exists'); //edit the validation
                    } else {
                        if (dialog.style.display != 'block') {
                            dialog.style.display = 'block';
                        } else {
                            dialog.style.display = 'none';
                        }
                    }
                }
            });
        }
    });

// Animate floating action button
window.onscroll = function() {
    hideFAB();
};

function hideFAB() {
    if (document.body.scrollTop > 1 || document.documentElement.scrollTop > 1) {
        document
            .getElementById('add-friend-fab')
            .classList.add('mdc-fab--exited');
    } else {
        document
            .getElementById('add-friend-fab')
            .classList.remove('mdc-fab--exited');
    }
}
