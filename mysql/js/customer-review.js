/*
This page will consist of the folllowing function
	viewAllReviews(restID) 
		
*/
let numberOfReview = 0;
// viewAllReviews(1);
// Take in restuarant ID and give you a list of reviews
function viewAllReviews() {
    let restID;
    if (document.getElementById('restaurant') !== null) {
        restID = document.getElementById('restaurant').value;
    } else {
        restID = sessionStorage.getItem('history-restid');
    }
    console.log(restID);
    $.ajax({
        url: 'scripts/review-operations.php?restID=' + restID,
        data: { action: 'reviewRequest' },
        type: 'post',
        success: function(data) {
            if (data === 'Fail to query db' || data === '') {
                document.getElementById('likes-dislikes-container').innerHTML =
                    'THERE ARE CURRENTLY NO REVIEWS FOR THIS RESTAURANT';
            } else {
                let json = JSON.parse(data);
                document
                    .getElementById('recommendation-like')
                    .addEventListener('click', function() {
                        $.ajax({
                            url:
                                'scripts/review-operations.php?flag=' +
                                1 +
                                '&restID=' +
                                restID +
                                '&count=' +
                                parseInt(json.Likes['Likes']),
                            data: { action: 'updatelikes' },
                            type: 'post',
                            success: function(output) {
                                console.log(output);
                                document.getElementById(
                                    'recommendation-like'
                                ).nextSibling.textContent =
                                    parseInt(json.Likes['Likes']) + 1;
                            }
                        });
                    });
                document
                    .getElementById('recommendation-dislike')
                    .addEventListener('click', function() {
                        $.ajax({
                            url:
                                'scripts/review-operations.php?flag=' +
                                0 +
                                '&restID=' +
                                restID +
                                '&count=' +
                                parseInt(json.Likes['Dislikes']),
                            data: { action: 'updatelikes' },
                            type: 'post',
                            success: function(output) {
                                console.log(output);
                                document.getElementById(
                                    'recommendation-dislike'
                                ).nextSibling.textContent =
                                    parseInt(json.Likes['Dislikes']) + 1;
                            }
                        });
                    });
                document.getElementById(
                    'recommendation-like'
                ).nextSibling.textContent =
                    json.Likes['Likes'];
                document.getElementById(
                    'recommendation-dislike'
                ).nextSibling.textContent =
                    json.Likes['Dislikes'];
                if (numberOfReview !== json.Reviews.length) {
                    numberOfReview = json.Reviews.length;
                }
                $('#reviews-list-group-subheader').text(
                    'Reviews ( ' + numberOfReview + ' )'
                );
                for (i = 0; i < json.Reviews.length; i++) {
                    if (json.Reviews[i].isVisible == 1) {
                        $('#reviews-list').append(
                            '<li role="separator" class="mdc-list-divider"></li>'
                        );
                        $('#reviews-list').append(
                            '<li id="reviews-list-item" class="mdc-list-item"> <span class="mdc-list-item__text">' +
                                json.Reviews[i].Name +
                                '<span class="mdc-list-item__text__secondary">' +
                                json.Reviews[i].content +
                                '</span> </span> <span class="mdc-list-item__end-detail"> <time datetime="2014-01-28T04:36:00.000Z">' +
                                json.Reviews[i].DateReviewed +
                                ', ' +
                                json.Reviews[i].TimeReviewed +
                                '</time> <span id="up-down-vote-container"> <a onclick="updateVoteStatus(' +
                                restID +
                                ',' +
                                json.Reviews[i].ReviewID +
                                ',0);" id="down-vote' +
                                json.Reviews[i].ReviewID +
                                '" class="material-icons" aria-label="Down Vote Review" title="Down Vote Review"> thumb_down </a> <span> <a onclick="updateVoteStatus(' +
                                restID +
                                ',' +
                                json.Reviews[i].ReviewID +
                                ',1);" id="up-vote' +
                                json.Reviews[i].ReviewID +
                                '" class="material-icons" aria-label="Up Vote Review" title="Up Vote Review"> thumb_up </a> </span> </span> </span> </li>'
                        );
                        setFocusToUpVote(
                            json.Reviews[i].ReviewID,
                            json.Reviews[i].Upvote,
                            json.Reviews[i].Downvote
                        );
                    }
                }
            }
        }
    }).responseText;
}

// Justin you need to do something regarding the css for this
function setFocusToUpVote(reviewID, upVote, downVote) {
    if (upVote == 1 || downVote == 1) {
        if (upVote == 1) {
            $('#up-vote' + reviewID).css('color', 'var(--mdc-theme-primary)');
            $('#down-vote' + reviewID).css('color', '');
        } else if (downVote == 1) {
            $('#down-vote' + reviewID).css('color', 'var(--mdc-theme-primary)');
            $('#up-vote' + reviewID).css('color', '');
        }
    } else {
        $('#down-vote' + reviewID).css('color', '');
        $('#up-vote' + reviewID).css('color', '');
    }
}

// By taking in the reviewID and Vote status
// voteStatus 0 == DownVote
// voteStatus 1 == Upvote
function updateVoteStatus(restID, reviewID, voteStatus) {
    console.log('updateVoteStatus');
    console.log(restID);
    console.log(reviewID);
    console.log(voteStatus);
    console.log(
        'scripts/review-operations.php?reviewID=' +
            reviewID +
            '&voteStatus=' +
            voteStatus
    );
    // alert("updateVoteStatus");
    $.ajax({
        url:
            'scripts/review-operations.php?reviewID=' +
            reviewID +
            '&voteStatus=' +
            voteStatus,
        data: { action: 'updateVoteStatus' },
        type: 'post',
        success: function() {
            // Clearing of the list and add it back again
            $('#reviews-list').empty();
            viewAllReviews(restID);
        }
    }).responseText;
}
