document
    .querySelector('#delete-restaurant-button')
    .addEventListener('click', () => {
        $.ajax({
            url:
                'scripts/owner-operations.php?restid=' +
                sessionStorage.getItem('RestID'),
            data: { action: 'deleteRestaurant' },
            type: 'post',
            success: function(output) {
                window.location = '/mysql/owner-home.php';
            }
        });
    });
