// Get required components for interaction
var activeFriendDialog = document.getElementById('active-friends-dialog');
var dialogUnderlay = document.getElementById('dialog-underlay');
var inviteDialog = new mdc.dialog.MDCDialog(
    document.querySelector('#invite-dialog')
);
var recommendations = document.getElementsByClassName('mdc-list-item');
var recommendationMarkers = document.getElementsByClassName('marker');
var recommendationFocusDialog = document.getElementById(
    'recommendation-focus-dialog'
);
var recommendationDialogProceedButton = document.getElementById(
    'recommendation-focus-dialog-proceed-button'
);
var loadingBar = document.getElementById('loading-progress');
var recommendButton = document.getElementById('request-recommendations');
var recommendedList = document.getElementById('recommended-list');

var trendingButton = document.getElementById('trending-button');
var coordinates = [];
var toggle = 0;
var areaID = "";

// Dialog instantiation
mdc.dialog.MDCDialog.attachTo(document.querySelector('#invite-dialog'));

// Toggle button instantiation
mdc.iconToggle.MDCIconToggle.attachTo(
    document.querySelector('.mdc-icon-toggle')
);

// Recommend button listener
recommendButton.addEventListener('click', () => {
    loadingBar.style.display = 'block';
    recommendedList.style.display = 'block';
    coordinates = [];
    if (areaID && toggle ===0) {
        $.ajax({
            type: 'POST',
            url: 'scripts/ajax-data.php',
            data: 'areaID=' + areaID,
            success: function (html) {
                $('#restaurant').html(html);
                populateMarkers();
                window.mdc.autoInit();
                // $.getScript("js/map.js");
                $("#restaurant li").click(function () {
                    document.getElementById("restaurant").value=$(this).attr('name');
                    var selectedrest = $(this).children();
                    for (i = 0; i < selectedrest.length; i++) {
                        if (
                            selectedrest[i].id ===
                            'selected-restaurant-name'
                        ) {
                            console.log(selectedrest[i]);
                            document.getElementById('restaurant').name =
                                selectedrest[i].textContent;
                        }
                    }
                    var location = $(this).attr('id');
                    var arrayLocation = location.split(",");
                    var long = arrayLocation[0];
                    var lat = arrayLocation[1];
                    sessionStorage.setItem('Longitude',parseFloat(arrayLocation[0]));
                    sessionStorage.setItem('Latitude',parseFloat(arrayLocation[1]));
                    markerToMapFocus(lat,long);
                    let markers=document.getElementsByClassName("marker");
                    for(i=0;i<markers.length;i++){
                        markers[i].style.borderColor = null;
                        markers[i].style.borderStyle = null;
                        markers[i].style.borderWidth = null;
                    }
                    let markerToFocus = document.getElementById("r"+$(this).attr('value'));
                    // After which, set focus on the marker corresponds to the list item.
                    markerToFocus.style.borderColor = "var(--mdc-theme-primary)";
                    markerToFocus.style.borderStyle = "solid";
                    markerToFocus.style.borderWidth = "2.5px";
                });
            }
        });
    } else if (areaID && toggle ===1) {
        $.ajax({
            type: 'POST',
            url: 'scripts/ajax-data-random.php',
            data: 'areaID=' + areaID,
            success: function (html) {
                $('#restaurant').html(html);
                populateMarkers();
                window.mdc.autoInit();
                // $.getScript("js/map.js");
                $("#restaurant li").click(function () {
                    document.getElementById("restaurant").value=$(this).attr('name');
                    var selectedrest = $(this).children();
                    for (i = 0; i < selectedrest.length; i++) {
                        if (
                            selectedrest[i].id ===
                            'selected-restaurant-name'
                        ) {
                            console.log(selectedrest[i]);
                            document.getElementById('restaurant').name =
                                selectedrest[i].textContent;
                        }
                    }
                    var location = $(this).attr('id');
                    var arrayLocation = location.split(",");
                    var long = arrayLocation[0];
                    var lat = arrayLocation[1];
                    sessionStorage.setItem('Longitude',parseFloat(arrayLocation[0]));
                    sessionStorage.setItem('Latitude',parseFloat(arrayLocation[1]));
                    markerToMapFocus(lat,long);
                    let markers=document.getElementsByClassName("marker");
                    for(i=0;i<markers.length;i++){
                        markers[i].style.borderColor = null;
                        markers[i].style.borderStyle = null;
                        markers[i].style.borderWidth = null;
                    }
                    let markerToFocus = document.getElementById("r"+$(this).attr('value'));
                    // After which, set focus on the marker corresponds to the list item.
                    markerToFocus.style.borderColor = "var(--mdc-theme-primary)";
                    markerToFocus.style.borderStyle = "solid";
                    markerToFocus.style.borderWidth = "2.5px";
                });
            }
        });
    }
    else {
        $('#restaurant').html('<li id="recommended-place-1" class="mdc-list-item" data-mdc-auto-init="MDCRipple">' +
                '<span class="mdc-list-item__text">' +
                'No Restaurant!' +
                '</span>' +
                '</li>');
        window.mdc.autoInit();
    }
});

// Active Friends popup listener
document.querySelector('#active-friends').addEventListener('click', () => {
    if (activeFriendDialog.style.display != 'block') {
        activeFriendDialog.style.display = 'block';
        dialogUnderlay.style.display = 'block';
    } else {
        // dialog.style.display= "none";
    }
});

document.querySelector('#dialog-close-button').addEventListener('click', () => {
    if (activeFriendDialog.style.display != 'block') {
        activeFriendDialog.style.display = 'block';
        dialogUnderlay.style.display = 'block';
    } else {
        activeFriendDialog.style.display = 'none';
        dialogUnderlay.style.display = 'none';
    }
});

// Recommendation Focus dialog listener
document
    .querySelector('#recommendation-focus-dialog-close-button')
    .addEventListener('click', () => {
        if (recommendationFocusDialog.style.display != 'block') {
            recommendationFocusDialog.style.display = 'block';
            dialogUnderlay.style.display = 'block';
        } else {
            recommendationFocusDialog.style.display = 'none';
            dialogUnderlay.style.display = 'none';
            document.getElementById('reviews-list').innerHTML = '';
            document.getElementById('reviews-list-group-subheader').innerHTML =
                '';
        }
    });

recommendationDialogProceedButton.addEventListener('click', () => {
    recommendationFocusDialog.style.display = 'none';
    // dialogUnderlay.style.display = "none";
    inviteDialog.show();
});

// Listen for invite dialog activator
inviteDialog.listen('MDCDialog:accept', function() {
    loadingBar.style.display = 'block';
    dialogUnderlay.style.display = 'none';
    window.location =
        '/mysql/recommendation-invite.php?Place=' +
        document.getElementById('restaurant').value;
});

inviteDialog.listen('MDCDialog:cancel', function() {
    dialogUnderlay.style.display = 'none';
    window.location =
        '/mysql/customer-reservation.php?Place=' +
        document.getElementById('restaurant').value;
});

// Listen for dialog underlay layer click, dimiss all pop-ups
dialogUnderlay.addEventListener('click', () => {
    // Clear active friends dialog
    activeFriendDialog.style.display = 'none';

    // Clear recommendation focus dialog
    recommendationFocusDialog.style.display = 'none';

    dialogUnderlay.style.display = 'none';
});

// Listen if user selects any recommendations from the list
document.getElementById('recommended-list').addEventListener('click', () => {});

trendingButton.addEventListener('click', () => {
    if (toggle === 0){
        toggle = 1 ;
    }
    else{
        toggle = 0;
    }
});

$(document).ready(function() {
    $('#area').on('change', function () {
        var string = $(this).val();
        var arr = string.split(",");
        areaID = arr[0];
    });
});

document.getElementById('area').addEventListener('change', () => {
    var string = $('#area :selected').val();
    var arr = string.split(',');
    var lat = arr[2];
    var long = arr[1];
    updateMapToNewLocation(lat, long);
    coordinates = [];
});
