var ownrest = [];
var review = [];
var reserve = [];
var status;
var status2;
var status3;
var status4;
var interval;

GetRestaurants();
GetRestaurantDetails();

function GetRestaurantDetails() {
    if (document.getElementById('restaurant-info-sub-header') !== null) {
        console.log(sessionStorage.getItem('RestName'));
        document.getElementById(
            'restaurant-info-sub-header'
        ).innerHTML = sessionStorage.getItem('RestName');
        GetReserveLikes();
        GetReviews();
        GetReservations();
    }
}
//-----------------Get Restaurant Details------------------------
function GetReserveLikes() {
    status2 = $.ajax({
        url:
            'scripts/owner-operations.php?restid=' +
            sessionStorage.getItem('RestID'),
        data: { action: 'getReserveLikes' },
        type: 'post',
        success: function(output) {
            var json = JSON.parse(output);
            document.getElementById('reservations-count-header').innerHTML =
                json.ReserveLikes.Count;
            document.getElementById('likes-count-header').innerHTML =
                json.ReserveLikes.Likes;
            document.getElementById('dislikes-count-header').innerHTML =
                json.ReserveLikes.DisLikes;
        }
    }).responseText;
}

function GetReviews() {
    status3 = $.ajax({
        url:
            'scripts/owner-operations.php?restid=' +
            sessionStorage.getItem('RestID'),
        data: { action: 'getReviews' },
        type: 'post',
        success: function(output) {
            var json = JSON.parse(output);
            for (i = 0; i < json.Reviews.length; i++) {
                if (review.indexOf(json.Reviews[i].RID) === -1) {
                    DisplayReviews(
                        json.Reviews[i].Name,
                        json.Reviews[i].Content,
                        json.Reviews[i].Date,
                        json.Reviews[i].Time
                    );
                    review.push(json.Reviews[i].RID);
                }
            }
            document.getElementById('reviews-pre-header').innerHTML =
                json.Reviews.length;
        }
    }).responseText;
}

function GetReservations() {
    status4 = $.ajax({
        url:
            'scripts/owner-operations.php?restid=' +
            sessionStorage.getItem('RestID'),
        data: { action: 'getReservations' },
        type: 'post',
        success: function(output) {
            console.log(output);
            var json = JSON.parse(output);
            for (i = 0; i < json.Reservations.length; i++) {
                if (reserve.indexOf(json.Reservations[i].BID) === -1) {
                    DisplayReservations(
                        json.Reservations[i].Name,
                        json.Reservations[i].Pax,
                        json.Reservations[i].Date,
                        json.Reservations[i].Time,
                        json.Reservations[i].BID
                    );
                    reserve.push(json.Reservations[i].BID);
                }
            }
        }
    }).responseText;
}

//---------------Get All Owned Restaurants--------------------------------
function GetRestaurants() {
    status = $.ajax({
        url: 'scripts/owner-operations.php',
        data: { action: 'getRestaurants' },
        type: 'post',
        success: function(output) {
            var json = JSON.parse(output);
            if (document.getElementById('restaurant-count-header') !== null) {
                document.getElementById('restaurant-count-header').innerHTML =
                    json.Restaurants.length;
            }
            for (i = 0; i < json.Restaurants.length; i++) {
                if (ownrest.indexOf(json.Restaurants[i].RestID) === -1) {
                    DisplayOwnerRestaurants(
                        json.Restaurants[i].Restname,
                        json.Restaurants[i].Street,
                        json.Restaurants[i].RestID
                    );
                    ownrest.push(json.Restaurants[i].RestID);
                }
            }
        }
    }).responseText;
}

//---------------------Accept or Cancel Reservations---------------------------
function AcceptReservations(bid) {
    $.ajax({
        url: 'scripts/owner-operations.php?BID=' + bid,
        data: { action: 'accept' },
        type: 'post',
        success: function(output) {
            console.log(output);
        }
    });
}

function CencelReservations(bid) {
    $.ajax({
        url: 'scripts/owner-operations.php?BID=' + bid,
        data: { action: 'deny' },
        type: 'post',
        success: function(output) {
            console.log(output);
            let index = reserve.indexOf(bid);
            if (index > -1) {
                reserve.splice(index, 1);
            }
            var parent = document.getElementById('reservations-list');
            var child = document.getElementById(bid);
            parent.removeChild(child.nextSibling);
        }
    });
}

//---------------------Display Dynamic Screens-----------------------
function DisplayOwnerRestaurants(name, street, restid) {
    var listnode = document.createElement('li');
    listnode.id = name;
    listnode.className = 'mdc-list-item restaurant-item';
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
    var textnode2 = document.createTextNode(street);
    spannode2.appendChild(textnode2);
    spannode.appendChild(textnode);
    spannode.appendChild(spannode2);
    var anode = document.createElement('a');
    anode.id = 'go-to-button';
    anode.className = 'material-icons mdc-list-item__end-detail';
    anode.title = 'Add Review';
    anode.innerHTML = 'arrow_forward';
    listnode.appendChild(imgnode);
    listnode.appendChild(spannode);
    listnode.appendChild(anode);
    listnode.addEventListener('click', function() {
        sessionStorage.setItem('RestName', name);
        sessionStorage.setItem('RestID', restid);
        window.location = 'owner-restaurant-details.php';
    });
    listnode.addEventListener('mouseover', function() {
        anode.style.display = 'block';
        listnode.style.backgroundColor = 'var(--mdc-theme-primary)';
    });
    listnode.addEventListener('mouseout', function() {
        anode.style.display = 'none';
        listnode.style.backgroundColor = 'rgba(129, 129, 129, 0.3)';
    });
    if (document.getElementById('restaurants-list') !== null) {
        document.getElementById('restaurants-list').appendChild(listnode);
    }
}

function DisplayReviews(name, content, date, time) {
    var listnodeseparator = document.createElement('li');
    listnodeseparator.className = 'mdc-list-divider';
    listnodeseparator.id = 'separator';
    var listnode = document.createElement('li');
    listnode.className = 'mdc-list-item';
    listnode.id = 'reviews-list-item';
    var spannode = document.createElement('span');
    spannode.className = 'mdc-list-item__text';
    var textnode = document.createTextNode(name);
    var spannode2 = document.createElement('span');
    spannode2.className = 'mdc-list-item__text__secondary';
    var textnode2 = document.createTextNode(content);
    spannode2.appendChild(textnode2);
    spannode.appendChild(textnode);
    spannode.appendChild(spannode2);
    var spannode3 = document.createElement('span');
    spannode3.className = 'mdc-list-item__end-detail';
    var timenode = document.createElement('time');
    timenode.datetime = date + 'TO' + time;
    var textnode3 = document.createTextNode(date + ', ' + time);
    timenode.appendChild(textnode3);
    spannode3.appendChild(timenode);
    listnode.appendChild(spannode);
    listnode.appendChild(spannode3);
    if (document.getElementById('reviews-list') !== null) {
        document.getElementById('reviews-list').appendChild(listnodeseparator);
        document.getElementById('reviews-list').appendChild(listnode);
    }
}

function DisplayReservations(name, pax, date, time, bid) {
    var listnodeseparator = document.createElement('li');
    listnodeseparator.className = 'mdc-list-divider';
    listnodeseparator.id = bid; //"separator";
    var listnode = document.createElement('li');
    listnode.id = bid; //"reservations-list-item";
    listnode.className = 'mdc-list-item';
    var spannode = document.createElement('span');
    spannode.className = 'mdc-list-item__text';
    var textnode = document.createTextNode(name);
    var spannode2 = document.createElement('span');
    spannode2.className = 'mdc-list-item__text__secondary';
    var textnode2 = document.createTextNode(pax + ' Persons');
    spannode2.appendChild(textnode2);
    spannode.appendChild(textnode);
    spannode.appendChild(spannode2);
    //    --------------next span-------------------
    var spannode3 = document.createElement('span');
    spannode3.className = 'mdc-list-item__end-detail';
    var timenode = document.createElement('time');
    timenode.datetime = date + 'TO' + time;
    var textnode3 = document.createTextNode(date + ', ' + time);
    timenode.appendChild(textnode3);
    var spannode4 = document.createElement('span');
    spannode4.id = 'fulfil-reject-reservation-container';
    var anode = document.createElement('a');
    anode.className = 'material-icons';
    anode.id = 'reject-reservation';
    anode.title = 'Reject Reservation';
    anode.innerHTML = 'block';
    anode.addEventListener('click', function() {
        CencelReservations(bid);
    });
    var anode2 = document.createElement('a');
    anode2.className = 'material-icons';
    anode2.id = 'accept-reservation';
    anode2.title = 'Accept Reservation';
    anode2.innerHTML = 'check';
    anode2.addEventListener('click', function() {
        AcceptReservations(bid);
    });
    var spannode5 = document.createElement('span');
    spannode4.appendChild(anode);
    spannode4.appendChild(anode2);
    spannode4.appendChild(spannode5);
    spannode3.appendChild(timenode);
    spannode3.appendChild(spannode4);
    //    -----------last-------------------
    listnode.appendChild(spannode);
    listnode.appendChild(spannode3);
    if (document.getElementById('reservations-list') !== null) {
        document
            .getElementById('reservations-list')
            .appendChild(listnodeseparator);
        document.getElementById('reservations-list').appendChild(listnode);
    }
}

interval = setInterval(GetRestaurantDetails, 1000);
