<!DOCTYPE html>
<html>
<head>

	<title> Facebook Archiver - Main </title>

	<link rel="stylesheet" href="css/style.css" media="screen" />



	<script src="js/fbarchiver.js"></script>	

</head>

<body>

	<div id="wraper">

	<div id="fb-root"></div>
	<!-- Starts up facebook's JS API -->
  <script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '411476732220632', // App ID
        status     : true, // check login status
        cookie     : true, // enable cookies to allow the server to access the session
        xfbml      : true  // parse XFBML
      });
    };

    // Load the SDK Asynchronously
    (function(d){
      var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
      js = d.createElement('script'); js.id = id; js.async = true;
      js.src = "//connect.facebook.net/en_US/all.js";
      d.getElementsByTagName('head')[0].appendChild(js);
    }(document));
  </script>

	<fb:login-button show-faces="true" width="200" max-rows="1" scope="publish_actions">
	  </fb:login-button>

		<div id="header">
			
			<h1>
				Welcome to Facebook Archiver!
			</h1>

			<p> Easily manage the posts that interested you. </p>

		</div>

		<div id="content">

			<div id="posts">
				
				<div class="post">
					<span class="date"></span>
					<blockquote class="post-data">
					</blockquote>
				</div>

			</div>
			
		</div>

		<div id="footer">
			<p> Designed and built by ++completar++ </p>			
			<p> Checkout the source code at <a href="#">Github</a>.</p>
		</div>
	</div>

</body>
</html>