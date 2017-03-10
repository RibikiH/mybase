(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

logInWithFacebook = function() {
    FB.login(function(response) {
        if (response.authResponse) {
            FB.api('/me', function(response) {
                console.log(response);
                return false;
            });
        } else {
            console.log('User cancelled login or did not fully authorize.');
        }
    }, {
    	scope: 'email',
        return_scopes: true
    });
    return false;
};

logOutFacebook = function () {
    FB.logout(function(response) {
        console.log(response);
    });
};

window.fbAsyncInit = function() {
    FB.init({
        appId: '1252089301545816',
        status : true,
        cookie: true, // This is important, it's not enabled by default
        oauth  : true,
        version: 'v2.8'
    });

    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            // the user is logged in and has authenticated your
            // app, and response.authResponse supplies
            // the user's ID, a valid access token, a signed
            // request, and the time the access token
            // and signed request each expire
            var uid = response.authResponse.userID;
            var accessToken = response.authResponse.accessToken;
            FB.api('/me', function(response) {
                console.log(response);
            });
        }
    });
};