<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	 <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/login_style.css">
	 <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
	 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
	 <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">


</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <form class="form-signin">
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputEmail">Email address</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember password</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
              <hr class="my-4">
              <button id="google_login" onclick="setCookie('link', 'google', 1)" class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i><a href="<?php 
							if(isset($google_client_id) && isset($google_redirect_uri))
							{
							  echo 'https://accounts.google.com/o/oauth2/auth?response_type=code&redirect_uri='.urlencode($google_redirect_uri).'&client_id='.$google_client_id.'=&scope='.urlencode($google_scope).'&access_type=offline&approval_prompt=force';
							}
							?>"> Sign in with Google</button>
              <button id="linkedin_login" onclick="setCookie('link', 'linkedin', 1)" class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-linkedin mr-2"></i><a href="
							<?php 
							if(isset($client_id) && isset($redirect_uri))
							{
							  echo 'https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id='.$client_id.'&redirect_uri='.$redirect_uri.'&state=fooobar&scope=r_liteprofile%20r_emailaddress%20w_member_social';
							}
							?>">
	         Sign in with Linkedin</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
<script>
function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
}
</script>