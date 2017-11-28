// Variable Declarations
let status;
let interval;
let FriendRequestChecker = [];
let FriendsChecker = [];
let OnlineFriendsChecker = [];
let OnlineFriendsAmount = 0;
let RecommendationCounter = 0;
let Accepts = [];
let MealRequests = [];
let HistoryMeals = [];
var CheckboxCount = 0;
// First Run of Check Online
checkOnline();

// Check Online Function will poll everything
function checkOnline() {
    if (
        document.getElementById('invitation-lobby-header') !== null &&
        document.getElementById('invitation-lobby-description') !== null
    ) {
        document.getElementById(
            'invitation-lobby-header'
        ).innerHTML = sessionStorage.getItem('RestName');
        document.getElementById(
            'invitation-lobby-description'
        ).innerHTML = sessionStorage.getItem('RestAdd');
    }

    status = $.ajax({
        url: 'scripts/online-poller.php',
        success: function(data) {
            // document.getElementById("ShowOnline").innerHTML = data;
            let json = JSON.parse(data);
            if (OnlineFriendsAmount !== json.OnlineFriends.length) {
                OnlineFriendsAmount = json.OnlineFriends.length;
            }
            for (i = 0; i < json.OnlineFriends.length; i++) {
                if (
                    OnlineFriendsChecker.indexOf(json.OnlineFriends[i].UID) ===
                    -1
                ) {
                    RecommendationCounter++;
                    OnlineFriendsChecker.push(json.OnlineFriends[i].UID);
                    DisplayOnlineFriends(
                        json.OnlineFriends[i].Name,
                        json.OnlineFriends[i].UID
                    );
                }
            }
            RecommendationCounter = 0;
            for (i = 0; i < json.FriendRequests.length; i++) {
                if (
                    FriendRequestChecker.indexOf(json.FriendRequests[i].UID) ===
                    -1
                ) {
                    DisplayFriendRequests(
                        json.FriendRequests[i].Date,
                        json.FriendRequests[i].Name,
                        json.FriendRequests[i].UID
                    );
                    FriendRequestChecker.push(json.FriendRequests[i].UID);
                }
            }
            for (i = 0; i < json.Friends.length; i++) {
                if (FriendsChecker.indexOf(json.Friends[i].UID) === -1) {
                    DisplayFriends(json.Friends[i].Date, json.Friends[i].Name);
                    FriendsChecker.push(json.Friends[i].UID);
                }
            }
            for (i = 0; i < json.AcceptedMealRequests.length; i++) {
                if (Accepts.indexOf(json.AcceptedMealRequests[i].UID) === -1) {
                    DisplayInviteLobby(json.AcceptedMealRequests[i].Name);
                    Accepts.push(json.AcceptedMealRequests[i].UID);
                }
            }

            for (i = 0; i < json.MealRequests.length; i++) {
                if (MealRequests.indexOf(json.MealRequests[i].PlaceID) === -1) {
                    DisplayMealRequests(
                        json.MealRequests[i].Name,
                        json.MealRequests[i].Date,
                        json.MealRequests[i].Time,
                        json.MealRequests[i].Restname,
                        json.MealRequests[i].UID,
                        json.MealRequests[i].PlaceID,
                        json.MealRequests[i].Lat,
                        json.MealRequests[i].Long,
                        json.MealRequests[i].Street,
                        json.MealRequests[i].RestID
                    );
                    MealRequests.push(json.MealRequests[i].PlaceID);
                }
            }

            for (i = 0; i < json.History.length; i++) {
                if (HistoryMeals.indexOf(json.History[i].RestID) === -1) {
                    DisplayHistory(
                        json.History[i].Restname,
                        json.History[i].Date,
                        json.History[i].Time,
                        json.History[i].Street,
                        json.History[i].RestID
                    );
                    HistoryMeals.push(json.History[i].RestID);
                }
            }

            if (document.getElementById('pending-invite-header') !== null) {
                document.getElementById('pending-invite-header').innerHTML =
                    'Pending Invites - ' + MealRequests.length;
            }

            if (document.getElementById('accepted-count-container') !== null) {
                document.getElementById('accepted-count-container').innerHTML =
                    Accepts.length + ' Accepted';
            }

            if (FriendRequestChecker.length === 0) {
                if (
                    document.getElementById('pending-request-container') !==
                    null
                ) {
                    document.getElementById(
                        'pending-request-container'
                    ).style.display =
                        'none';
                }
            } else {
                if (
                    document.getElementById('pending-request-container') !==
                    null
                ) {
                    document.getElementById(
                        'pending-request-container'
                    ).style.display =
                        'grid';
                }
            }
            if (FriendsChecker.length === 0) {
                if (
                    document.getElementById('friends-list-container') !==
                        null &&
                    document.getElementById('friends-list-container')
                        .className !== 'mdc-layout-grid__inner'
                ) {
                    document.getElementById('friends-list-header').innerHTML =
                        'No Friends Available';
                }
            } else {
                if (
                    document.getElementById('friends-list-container') !==
                        null &&
                    document.getElementById('friends-list-container')
                        .className !== 'mdc-layout-grid__inner'
                ) {
                    document.getElementById('friends-list-header').innerHTML =
                        FriendsChecker.length + ' Friends Available';
                }
            }
            CheckboxCount = 0;
            var selected = document.getElementsByClassName(
                'mdc-checkbox__native-control'
            );
            for (j = 0; j < selected.length; j++) {
                if (selected[j].checked === true) {
                    CheckboxCount++;
                }
            }
            if (document.getElementById('selection-count-header') !== null) {
                document.getElementById('selection-count-header').innerHTML =
                    CheckboxCount + ' friend selected';
            }
        }
    }).responseText;
}

function AcceptRequests(uid) {
    $.ajax({
        url: 'scripts/friend-operations.php?Requester=' + uid,
        data: { action: 'confirmRequest' },
        type: 'post',
        success: function(output) {
            let index = FriendRequestChecker.indexOf(uid);
            if (index > -1) {
                FriendRequestChecker.splice(index, 1);
            }
            let parent = document.getElementById('pending-request-list');
            let child = document.getElementById(uid);
            parent.removeChild(child);
        }
    });
}

function DenyRequests(uid) {
    $.ajax({
        url: 'scripts/friend-operations.php?Deletee=' + uid,
        data: { action: 'denyRequest' },
        type: 'post',
        success: function(output) {
            let index = FriendRequestChecker.indexOf(uid);
            if (index > -1) {
                FriendRequestChecker.splice(index, 1);
            }
            let parent = document.getElementById('pending-request-list');
            let child = document.getElementById(uid);
            parent.removeChild(child);
        }
    });
}

function AcceptMealRequests(
    uid,
    place,
    lat,
    long,
    restname,
    street,
    date,
    time,
    restid
) {
    $.ajax({
        url:
            'scripts/friend-operations.php?Requester=' +
            uid +
            '&PlaceID=' +
            place,
        data: { action: 'AcceptMealRequest' },
        type: 'post',
        success: function(output) {
            let index = MealRequests.indexOf(place);
            if (index > -1) {
                MealRequests.splice(index, 1);
            }
            let parent = document.getElementById('pending-invite-list');
            let child = document.getElementById(place);
            parent.removeChild(child);
            sessionStorage.setItem('Longitude', lat);
            sessionStorage.setItem('Latitude', long);
            sessionStorage.setItem('RestName', restname);
            sessionStorage.setItem('RestAdd', street);
            $.ajax({
                url:
                    'scripts/friend-operations.php?Pax=' +
                    2 +
                    '&Time=' +
                    time +
                    '&Date=' +
                    date +
                    '&placeid=' +
                    place +
                    '&restid=' +
                    restid,
                data: { action: 'ReservePlace2' },
                type: 'post',
                success: function(output) {
                    if (output === 'succeed') {
                        window.location = 'current-location.php';
                    } else {
                        console.log(output);
                    }
                }
            });
        }
    });
}

function DeclineMealRequests(uid, place) {
    $.ajax({
        url:
            'scripts/friend-operations.php?Requester=' +
            uid +
            '&PlaceID=' +
            place,
        data: { action: 'DenyMealRequest' },
        type: 'post',
        success: function(output) {
            let index = MealRequests.indexOf(place);
            if (index > -1) {
                MealRequests.splice(index, 1);
            }
            let parent = document.getElementById('pending-invite-list');
            let child = document.getElementById(place);
            parent.removeChild(child);
        }
    });
}

function DisplayFriendRequests(date, name, uid) {
    // 1. create list element
    let listnode = document.createElement('li');
    listnode.className = 'mdc-list-item';
    listnode.id = uid;
    // 2. create image element
    let imgnode = document.createElement('img');
    imgnode.className = 'mdc-list-item__start-detail grey-bg';
    imgnode.src = '/src/ic_person_white_24px.svg';
    imgnode.width = '56';
    imgnode.height = '56';
    imgnode.alt = 'avatar';
    // 3. create name and date added span element
    let spannode1 = document.createElement('span');
    spannode1.className = 'mdc-list-item__text';
    let spannode2 = document.createElement('span');
    spannode2.className = 'mdc-list-item__text__secondary';
    let textnode1 = document.createTextNode(name + ' ');
    let textnode2 = document.createTextNode('Added you on ' + date);
    spannode2.appendChild(textnode2);
    spannode1.appendChild(textnode1);
    spannode1.appendChild(spannode2);
    // 4. create request span element
    let spannode3 = document.createElement('span');
    spannode3.id = 'request-span';
    spannode3.className = 'mdc-list-item__end-detail';
    let anode1 = document.createElement('a');
    anode1.className = 'material-icons';
    anode1.title = 'Accept request';
    anode1.addEventListener('click', function() {
        AcceptRequests(uid);
    });
    // anode1.aria-label="Accept request";
    let spannode4 = document.createElement('span');
    let anode2 = document.createElement('a');
    anode2.className = 'material-icons';
    anode2.title = 'Deny request';
    anode2.addEventListener('click', function() {
        DenyRequests(uid);
    });
    // anode1.aria-label="Decline request";
    let textnode3 = document.createTextNode('check');
    let textnode4 = document.createTextNode('close');
    anode1.appendChild(textnode3);
    anode2.appendChild(textnode4);
    spannode4.appendChild(anode2);
    spannode3.appendChild(anode1);
    spannode3.appendChild(spannode4);
    // 5. Final assembly
    listnode.appendChild(imgnode);
    listnode.appendChild(spannode1);
    listnode.appendChild(spannode3);
    if (document.getElementById('pending-request-list') !== null) {
        document.getElementById('pending-request-list').appendChild(listnode);
    }
}

function DisplayFriends(date, name) {
    // create list node
    let listnode = document.createElement('li');
    listnode.className = 'mdc-grid-tile';
    // create div node
    let divnode = document.createElement('div');
    divnode.className = 'mdc-grid-tile__primary';
    let imgnode = document.createElement('img');
    imgnode.className = 'mdc-grid-tile__primary-content';
    imgnode.src = '/src/ic_person_white_24px.svg'; // note the path
    divnode.appendChild(imgnode);
    // create span node
    let spannode1 = document.createElement('span');
    spannode1.className = 'mdc-grid-tile__secondary';
    let spannode2 = document.createElement('span');
    spannode2.className = 'mdc-grid-tile__title';
    let textnode1 = document.createTextNode(name);
    spannode2.appendChild(textnode1);
    let spannode3 = document.createElement('span');
    spannode3.className = 'mdc-grid-tile__support-text';
    let textnode2 = document.createTextNode('Since ' + date);
    spannode3.appendChild(textnode2);
    spannode1.appendChild(spannode2);
    spannode1.appendChild(spannode3);
    // Final assemble
    listnode.appendChild(divnode);
    listnode.appendChild(spannode1);
    if (document.getElementById('friends-list') !== null) {
        document.getElementById('friends-list').appendChild(listnode);
    }
}

function DisplayOnlineFriends(name, uid) {
    // -----------------customer home display---------------------------
    let listnode = document.createElement('li');
    listnode.className = 'mdc-grid-tile';
    let divnode = document.createElement('div');
    divnode.className = 'mdc-grid-tile__primary';
    let imgnode = document.createElement('img');
    imgnode.className = 'mdc-grid-tile__primary-content';
    imgnode.src = '/src/ic_person_white_24px.svg'; // note the path
    divnode.appendChild(imgnode);
    let spannode = document.createElement('span');
    spannode.className = 'mdc-grid-tile__secondary';
    let spannode1 = document.createElement('span');
    spannode1.className = 'mdc-grid-tile__title';
    spannode1.innerHTML = name;
    spannode.appendChild(spannode1);
    listnode.appendChild(divnode);
    listnode.appendChild(spannode);
    // -----------------recommendation invite--------------------------------
    let divnode2 = document.createElement('div');
    divnode2.className = 'mdc-layout-grid__cell mdc-layout-grid__cell--span-12';
    let divnode3 = document.createElement('div');
    divnode3.className = 'mdc-form-field';
    let divnode4 = document.createElement('div');
    divnode4.className = 'mdc-checkbox';
    divnode4.id = 'tester';
    let labelnode = document.createElement('label');
    labelnode.setAttribute(
        'for',
        'friend-' + RecommendationCounter + '-checkbox'
    );
    // labelnode.for="friend-"+RecommendationCounter+"-checkbox";
    labelnode.innerHTML = name;
    let inputnode = document.createElement('input');
    inputnode.type = 'checkbox';
    inputnode.id = 'friend-' + RecommendationCounter + '-checkbox';
    inputnode.className = 'mdc-checkbox__native-control';
    inputnode.value = uid;
    let divnode5 = document.createElement('div');
    divnode5.className = 'mdc-checkbox__background';
    divnode5.innerHTML =
        '<svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24"><path class="mdc-checkbox__checkmark__path" fill="none" stroke="white" d="M1.73,12.91 8.1,19.28 22.79,4.59" /></svg><div class="mdc-checkbox__mixedmark"></div>';
    let svgnode = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    svgnode.setAttribute('class', 'mdc-checkbox__checkmark');
    svgnode.setAttribute('viewBox', '0 0 24 24');
    let pathnode = document.createElement('path');
    pathnode.className = 'mdc-checkbox__checkmark__path';
    pathnode.setAttribute('fill', 'none');
    pathnode.setAttribute('stroke', 'white');
    pathnode.setAttribute('d', 'M1.73,12.91 8.1,19.28 22.79,4.59');
    svgnode.appendChild(pathnode);
    let divnode6 = document.createElement('div');
    divnode6.className = 'mdc-checkbox__mixedmark';
    //    divnode5.appendChild(svgnode);
    //    divnode5.appendChild(divnode6);
    divnode4.appendChild(inputnode);
    divnode4.appendChild(divnode5);
    divnode3.appendChild(divnode4);
    divnode3.appendChild(labelnode);
    divnode2.appendChild(divnode3);

    if (
        document.getElementById('active-friends') !== null &&
        document.getElementById('dialog-header') !== null
    ) {
        document.getElementById('active-friends').innerHTML =
            OnlineFriendsAmount + ' friends online';
        document.getElementById('dialog-header').innerHTML =
            OnlineFriendsAmount + ' Online Friends';
    }
    if (document.getElementById('active-friends-list') !== null) {
        document.getElementById('active-friends-list').appendChild(listnode);
    }
    if (document.getElementById('friends-list-container') !== null) {
        if (
            document.getElementById('friends-list-container').className ===
            'mdc-layout-grid__inner'
        ) {
            document
                .getElementById('friends-list-container')
                .appendChild(divnode2);
            mdc.checkbox.MDCCheckbox.attachTo(
                document.querySelector('.mdc-checkbox')
            );
        }
    }
}

function DisplayInviteLobby(name) {
    let listnode = document.createElement('li');
    listnode.className = 'mdc-list-item';
    listnode.id = 'lobby-list-item';
    let imgnode = document.createElement('img');
    imgnode.className = 'mdc-list-item__start-detail';
    imgnode.src = '/src/ic_person_white_24px.svg';
    imgnode.width = '56';
    imgnode.height = '56';
    imgnode.alt = 'Avatar';
    let textnode = document.createTextNode(name);
    listnode.appendChild(imgnode);
    listnode.appendChild(textnode);
    if (document.getElementById('lobby-list') !== null) {
        document.getElementById('lobby-list').appendChild(listnode);
    }
}

function DisplayMealRequests(
    name,
    date,
    time,
    restname,
    uid,
    placeid,
    lat,
    long,
    street,
    restid
) {
    var listnode = document.createElement('li');
    listnode.className = 'mdc-list-item';
    listnode.id = placeid;
    var imgnode = document.createElement('img');
    imgnode.className = 'mdc-list-item__start-detail grey-bg';
    imgnode.src = '/src/ic_restaurant_white_24px.svg';
    imgnode.width = '56';
    imgnode.height = '56';
    imgnode.alt = 'restaurant';
    var spannode = document.createElement('span');
    spannode.className = 'mdc-list-item__text';
    var textnode = document.createTextNode(restname);
    var spannode2 = document.createElement('span');
    spannode2.className = 'mdc-list-item__text__secondary';
    var textnode2 = document.createTextNode(
        'Invited by ' + name + ' on ' + date + ', ' + time
    );
    spannode2.appendChild(textnode2);
    spannode.appendChild(textnode);
    spannode.appendChild(spannode2);
    var spannode3 = document.createElement('span');
    spannode3.className = 'mdc-list-item__end-detail';
    spannode3.id = 'invite-span';
    var anode1 = document.createElement('a');
    anode1.className = 'material-icons';
    anode1.title = 'Accept Invitation';
    anode1.innerHTML = 'check';
    anode1.addEventListener('click', function() {
        AcceptMealRequests(
            uid,
            placeid,
            lat,
            long,
            restname,
            street,
            date,
            time,
            restid
        );
    });
    var spannode4 = document.createElement('span');
    var anode2 = document.createElement('a');
    anode2.className = 'material-icons';
    anode2.title = 'Decline Invitation';
    anode2.innerHTML = 'close';
    anode2.addEventListener('click', function() {
        DeclineMealRequests(uid, placeid);
    });
    spannode4.appendChild(anode2);
    spannode3.appendChild(anode1);
    spannode3.appendChild(spannode4);
    listnode.appendChild(imgnode);
    listnode.appendChild(spannode);
    listnode.appendChild(spannode3);
    if (document.getElementById('pending-invite-list') !== null) {
        document.getElementById('pending-invite-list').appendChild(listnode);
    }
}

function DisplayHistory(name, date, time, street, restid) {
    var listnode = document.createElement('li');
    listnode.className = 'mdc-list-item';
    listnode.id = name;
    listnode.name = street;
    var imgnode = document.createElement('img');
    imgnode.className = 'mdc-list-item__start-detail grey-bg';
    imgnode.src = '/src/ic_restaurant_white_24px.svg';
    imgnode.height = '56';
    imgnode.width = '56';
    imgnode.alt = 'restaurant';
    var spannode = document.createElement('span');
    spannode.className = 'mdc-list-item__text';
    var textnode = document.createTextNode(name);
    var spannode2 = document.createElement('span');
    spannode2.className = 'mdc-list-item__text__secondary';
    var textnode2 = document.createTextNode('Visited on ' + date + ', ' + time);
    spannode2.appendChild(textnode2);
    spannode.appendChild(textnode);
    spannode.appendChild(spannode2);
    var anode = document.createElement('a');
    anode.id = 'add-review-button';
    anode.className = 'material-icons mdc-list-item__end-detail';
    anode.title = 'Add Review';
    anode.innerHTML = 'mode_comment';
    anode.name = restid;
    anode.addEventListener('click', function() {
        var reviewsDialog = document.querySelector('#reviews-dialog');
        var dialogUnderlay = document.getElementById('dialog-underlay');
        if (reviewsDialog.style.display != 'block') {
            document.getElementById('dialog-description').innerHTML = name;
            document.getElementById(
                'dialog-sub-description'
            ).innerHTML = street;
            sessionStorage.setItem('history-restid', restid);
            viewAllReviews();
            reviewsDialog.style.display = 'block';
            dialogUnderlay.style.display = 'block';
        } else {
            reviewsDialog.style.display = 'none';
            dialogUnderlay.style.display = 'none';
        }
    });
    listnode.appendChild(imgnode);
    listnode.appendChild(spannode);
    listnode.appendChild(anode);
    if (document.getElementById('past-recommendations-list') !== null) {
        document
            .getElementById('past-recommendations-list')
            .appendChild(listnode);
    }
}

interval = setInterval(checkOnline, 500);
