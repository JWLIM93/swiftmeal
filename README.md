# swiftmeal-web

## Design Status

| Page                              | Status        | Comments                                              |
| --------------------------------- | ------------- | ----------------------------------------------------- |
| index.html                        | Done          |                                                       |
| register.html                     | Done          |                                                       |
| customer-home.html                | Done          | Requires tight integration. Please integrate with me. |
| customer-edit-profile.html        | Done          |                                                       |
| customer-change-password.html     | Done          |                                                       |
| customer-friends.html             | Done          |                                                       |
| recommendation-hdetails.html      | Up-next       | For hawker.                                           |
| recommendation-rdetails.html      | Up-next       | For restuarants.                                      |
| recommendation-reservation.html   | Not started   | Only for restaurants.                                 |
| recommendation-nav.html           | Not started   | Common for hawker and restaurant.                     |
| customer-notifications.html       | Not started   |                                                       |
| customer-history.html             | Not started   |                                                       |


## Integration 1 (30th October, 6.30pm)
#### Pre-requisite
| Tasks                                                         | By            | Comments                                                                          |
| ------------------------------------------------------------- | ------------- | --------------------------------------------------------------------------------- |
| Pull and format data from Google Places API.                  | Jeremy        | Pull above 75k records                                                            |
| Push new data to local SQL tables                             | Jun Wei       | To validate every other fields in the schema                                      |
| Push new data to alicloud's MySQL                             | Jun Wei       | @Jun Wei alicloud instance                                                        |
| Display customer information at edit profile                  | Jeremy        | Full name, email address, full name                                               |
| Check/Validate for fields in edit profile and update DB       | Jeremy        | Only update NON-EMPTY fields, customer can choose which field to change (no pw)   |
| Check/Validation password in change password and update DB    | Jeremy        | Should be inline with login/reg validations                                       |
| Login with client and server validation                       | Kok Leong     | AJAX background call if possible, I will update the UI with progress indicator    |
| Register with client and server validation                    | Kok Leong     | AJAX background call if possible, I will update the UI with prgoress indicator    |
| Authenticated object after login is successful                | Kok Leong     | This object will be essential and stored in cookies?session?                      |
| Retrieve and display 5 recomd. (random) and push to DB        | Kok Leong     | Trending places toggle: OFF                                                       |
| Retrieve and display 5 recomd. (based on likes) and push to DB| Kok Leong     | Trending places toggle: ON                                                        |
| Store customer selected place into session/cookies            | Kok Leong     | Full place object (all details should be present)                                 |
| Display customer's friend list                                | Jun Wei       | Get total count and list of all friends                                           |
| Add new friend (Request & Accept)                             | Jun Wei       | Once accepted both parties will be friends (A > B) & (B > A)                      |
| Delete friend                                                 | Jun Wei       | Do not delete records (set isValid flag)                                          |
| MORE TO BE ADDED !!                                           |               |                                                                                   |

<!-- #### Plan
**New data and latest schema should be in both local and alicloud instance before integration**

Steps are PER SCREEN basis
1. Merge UI and PHP functionality codes
2. Test against local server
3. Check pre-requisite fulfilled or not
4. If yes, change from local to alicloud ip for db connection ON THE SPOT
5. Test against alicloud instance for mySQL
6. If all above passed, the specific screen will be marked with "Integration Done"

Repeat for all screens that are required for the above pre-requisites.
If the pre-requisites did not list your part, it will fall into integration 2! Sorry :(

Please do check that your PHP functions are all working to speed up the process and know where to change to alicloud instance db connection.

For MySQL use @Junwei instance. -->

## Changes (5 Nov):

#change-password

Fab location changed, NEW DIALOG for update password failure, new current new and confirm new password fields, fixed fields ID from previously.

#recommendation-invite

Added new selector count header.

#customer-home

**REVAMPED CUSTOMER HOME, now includes reviews**

Update default text for online friends indicator to "No Online Friends" (both activator and dialog popout), map is now interactable due to a new flow of event, reworked underlying div css layout.
New flow for recommendation selection. (Area > FlyToAreaDefaultLatLng > Recommend button > 5 recommendations appear with 5 markers on map > click on 1 recommendation > selected marker focused > click on marker > Recommendation details popup > close/select recommendation) **Use loading bar whenever there's page load or content load**

#edit-profile
Updated css, merge required

#invite-lobby
New screen, clean merge required. To keep background query for accepted invite request. 

#current-location
Show for all friends in a invite group for them to input their current location in string.

#place-direction
Map direction from entered current location and show to user. Revamp WIP

#customer-notifications
Central place for friends and place invites/requests. Revamp WIP
