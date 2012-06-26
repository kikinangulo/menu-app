<?php 

	require 'fb-sdk/facebook.php';
	
	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => '461415507219301',
	  'secret' => '0b59ed580329ff317cd100e01eda0bd6',
	));
	
	// Get User ID
	$user = $facebook->getUser();
	
	// We may or may not have this data based on whether the user is logged in.
	//
	// If we have a $user id here, it means we know the user is logged into
	// Facebook, but we don't know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
	
	if ($user) {
	  try {
			// Proceed knowing you have a logged in user who's authenticated.
			$user_profile = $facebook->api('/me');
		} catch (FacebookApiException $e) {
			error_log($e);
			$user = null;
		}
	}
	
	// Login or logout url will be needed depending on current user state.
	if ($user) {
	  	$logoutUrl = $facebook->getLogoutUrl(array('next' => 'http://dod-restaurant.cat/menu'));
	} else {
	  	$loginUrl = $facebook->getLoginUrl();
	}
	
?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Menú diari</title>
<script src="http://connect.facebook.net/en_US/all.js"></script>
</head>

<body>


    <div id="fb-root"></div>
    <script>
	
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '461415507219301', // App ID
          status     : true, // check login status
          cookie     : true, // enable cookies to allow the server to access the session
          xfbml      : true  // parse XFBML
        });
    
        // Additional initialization code here
      };
    
      // Load the SDK Asynchronously
      (function(d){
         var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/en_US/all.js";
         ref.parentNode.insertBefore(js, ref);
       }(document));
	   
	   
    </script>
    
    <fb:login-button autologoutlink="true" onlogin="OnRequestPermission();">
    </fb:login-button>
    <script language="javascript" type="text/javascript">
        FB.init({
            appId: 'Your_Application_ID',
            status: true,
            cookie: true,
            xfbml: true
        });
    </script>


</body>
</html>