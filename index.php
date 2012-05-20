<?php

  if(isset($_GET['post_id']) && !empty($_GET['post_id'])){

    if(isset($_GET['action']) && !empty($_GET['action'])){

      if(isset($_GET['from_id']) && !empty($_GET['from_id'])){
        $from_id = $_GET['from_id'];
      }
      $action = $_GET['action'];
      $post_id = $_GET['post_id'];

    }
  }


?>

<!DOCTYPE html>
<html>
  <head>
    <title> Facebook Archiver </title>

    <link rel="stylesheet" href="css/style.css" media="screen" />

    <script src="js/jquery-1.7.2.min.js"></script>

  </head>
  <body>
    <div id="fb-root"></div>
    <script>
      // Load the SDK Asynchronously
      (function(d){
         var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/en_US/all.js";
         ref.parentNode.insertBefore(js, ref);
       }(document));

      // Init the SDK upon load
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '411476732220632', // App ID
          channelUrl : '//'+window.location.hostname+'/channel', // Path to your Channel File
          status     : true, // check login status
          cookie     : true, // enable cookies to allow the server to access the session
          xfbml      : true  // parse XFBML
        });

        // listen for and handle auth.statusChange events
        FB.Event.subscribe('auth.statusChange', function(response) {
          if (response.authResponse) {


            // user has auth'd your app and is logged into Facebook
            FB.api('/me', function(me){
              if (me.name) {
                document.getElementById('auth-displayname').innerHTML = me.name;
                document.getElementById('auth-loggedout').style.display = 'none';
                document.getElementById('auth-loggedin').style.display = 'block';

                <?php if(isset($action)){
                      if($action == 'insert'){ ?>
                        $.get('http://stormy-beach-2068.herokuapp.com/core/insert.php',
                            {"post_id": <?php echo $post_id; ?>, "from_id" : <?php echo $from_id;?>, "user_id" : me.id}, function(res){
                              console.log(res);
                            alert("Post was successfully archived!");
                          window.history.back();
                        });

                <?php  } else if($action == 'delete')  { ?>

                        $.get('http://stormy-beach-2068.herokuapp.com/core/unarchive.php',
                        {"post_id": "\"" + <?php echo $post_id?> +"\"", "user_id" : me.id}, function(){
                          alert("Post was successfully unarchived!");
                          }); 
                <?php }} else {?>     
  

                  $.get('http://fbarchiver.herokuapp.com/core/archives.php',
                    {'user_id' : me.id}, function(response){
                      var parsedResponse = $.parseJSON(response);
                     
                      for(obj in parsedResponse){

                        if(parsedResponse[obj]){
                          FB.api("/" + parsedResponse[obj].from_id + "_" + parsedResponse[obj].post_id, function(data){
                            $("#posts-wrapper").append("<div class='single-post'> <a href='https://facebook.com/" + data.from.id + "'>"+data.from.name + "</a>");
                            if(data.message)
                              $("#posts-wrapper").append("<div class='post-content'>"+ data.message + "</div>");
                            if(data.picture)
                              $("#posts-wrapper").append("<div class='post-content'><img src='"+ data.picture + "'/></div>");
                            if(data.link)
                              $("#posts-wrapper").append("<div class='post-content'><a href='"+ data.link + "'>"+ data.name + "</a></div>");

                            if(data.video)
                              $("#posts-wrapper").append("<div class='post-content'><embed autoplay='false'  width='100' height='100' src='" +data.video +"'></embed>");
                            $("#posts-wrapper").append("</div>");

                          });
                        }
  
                      }
                    });
                  <?php } ?>

              }
            });


          } else {
            // user has not auth'd your app, or is not logged into Facebook
            document.getElementById('auth-loggedout').style.display = 'block';
            document.getElementById('auth-loggedin').style.display = 'none';
          }
        });

        // respond to clicks on the login and logout links
        document.getElementById('auth-loginlink').addEventListener('click', function(){
          FB.login(function(){}, {scope: "read_stream"});
        });
        document.getElementById('auth-logoutlink').addEventListener('click', function(){
          FB.logout();
        }); 
      } 
    </script>

    <div id="wrapper">
  
	<div id="header">
   		<h1>Welcome to Facebook Archiver</h1> 	
      <p> Easily store your favorite posts. <a href="http://stormy-beach-2068.herokuapp.com/chrome_extension/chrome_extension.crx">Download the Chrome extension</a> </p>
		<div>

		<div id="content">
			<div id="auth-status">
		        <div id="auth-loggedout">
		          <a href="#" class="btn" id="auth-loginlink">Login</a>
		        </div>
		       
		        <div id="auth-loggedin" style="display:none">
		       	  <div class="display-name">
              	Hi, <span id="auth-displayname"></span>  
  	    			  <a href="#" class="btn" id="auth-logoutlink">logout</a>
              <div>
            <div id="posts">
              
              <h2> Check out the posts you've archived! </h2>

              <div id="posts-wrapper">
                
              </div>

            </div>              

	    		 </div>
			</div>

	</div>

  <div id="footer">
    <p> Designed and built by <a href="http://facebook.com/gabrielhidasy">Gabriel Hidasy Rezende</a>, <a href="http://facebook.com/gabriel.massaki">Gabriel Massaki Wakano Bezerra</a>, <a href="http://facebook.com/lucast182">Lucas Tadeu Teixeira</a> e <a href="http://facebook.com/tlgimenes">Tiago Lobato Gimenes</a>. </p>
 </div>
  </div>

  </body>
</html>
