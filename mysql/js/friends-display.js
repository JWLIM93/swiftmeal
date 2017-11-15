// Variable Declarations
let status;
let interval;
let FriendRequestChecker = [];
let FriendsChecker = [];
let OnlineFriendsChecker = [];
let OnlineFriendsAmount = 0;
let RecommendationCounter = 0;
// First Run of Check Online
checkOnline();

// Check Online Function will poll everything
function checkOnline() {
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
                    DisplayOnlineFriends(json.OnlineFriends[i].Name);
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
            }
        },
    }).responseText;
}

function AcceptRequests(uid) {
    $.ajax({
        url: 'scripts/friend-operations.php?Requester=' + uid,
        data: {action: 'confirmRequest'},
        type: 'post',
        success: function(output) {
            let index = FriendRequestChecker.indexOf(uid);
            if (index > -1) {
                FriendRequestChecker.splice(index, 1);
            }
            let parent = document.getElementById('pending-request-list');
            let child = document.getElementById(uid);
            parent.removeChild(child);
        },
    });
}

function DenyRequests(uid) {
    $.ajax({
        url: 'scripts/friend-operations.php?Deletee=' + uid,
        data: {action: 'denyRequest'},
        type: 'post',
        success: function(output) {
            let index = FriendRequestChecker.indexOf(uid);
            if (index > -1) {
                FriendRequestChecker.splice(index, 1);
            }
            let parent = document.getElementById('pending-request-list');
            let child = document.getElementById(uid);
            parent.removeChild(child);
        },
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
    spannode1.className = 'mdc-list-item__text__secondary';
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

function DisplayOnlineFriends(name) {
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

interval = setInterval(checkOnline, 3000);