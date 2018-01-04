<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"?>
<?php

  $user_firstname_err = $user_lastname_err = $username_err = $user_password_err = $user_gender_err = $user_email_err = "";
  $alert = $alert_email = "";
  $user_firstname = $user_lastname = $username = $user_password = $user_gender = $user_email = $check = $success =  "";

  if(isset($_POST['user_signup'])){

    if(empty($_POST['user_firstname'])){
      $user_firstname_err = "<span id='error'>Please enter your first name.</span>";
      $firstname_check = "";
    }
    else{
      $firstname = escape($_POST['user_firstname']);
          if(!preg_match("/^[a-zA-Z ]*$/",$firstname)){
            $user_firstname_err = "<span id='error'>Only letters and white space allowed.</span>";
            $user_firstname = $firstname;
            $firstname_check = "";
          }
          else{
            $user_firstname = $firstname;
            $firstname_check = "ok";
          }
    }

    if(empty($_POST['user_lastname'])){
      $user_lastname_err = "<span id='error'>Please enter your last name.</span>";
      $lastname_check = "";
    }
    else{
      $lastname = escape($_POST['user_lastname']);
          if(!preg_match("/^[a-zA-Z ]*$/",$lastname)){
            $user_lastname_err = "<span id='error'>Only letters and white space allowed.</span>";
            $user_lastname = $lastname;
            $lastname_check = "";
          }
          else{
            $user_lastname = $lastname;
            $lastname_check = "ok";
          }
    }

    if(empty($_POST['user_gender'])){
      $user_gender_err = "<span id='error'>Please select your gender.</span>";
      $gender_check = "";
    }
    else{
      $user_gender = escape($_POST['user_gender']);
      $gender_check = "ok";
    }

    if(empty($_POST['username'])){
      $username_err = "<span id='error'>Please enter your username.</span>";
      $username_check = "";
    }
    else{
      $username = escape($_POST['username']);
      $username_check = "ok";
    }

    if(empty($_POST['user_password'])){
      $user_password_err = "<span id='error'>Please enter your password.</span>";
      $password_check = "";
    }
    else{
      $user_password = escape($_POST['user_password']);
      $password_check = "ok";
    }

    if(empty($_POST['user_email'])){
      $user_email_err = "<span id='error'>Please enter your email.</span>";
      $email_check = "";
    }
    else{
      $email = escape($_POST['user_email']);
      if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        $user_email_err = "<span id='error'>Invalid email.</span>";
        $user_email = $email;
        $email_check = "";
      }
      else
      {
        $user_email = $email;
        $email_check = "ok";
      }
    }

if($firstname_check==="ok" && $lastname_check==="ok" && $gender_check==="ok" && $username_check==="ok" && $password_check==="ok" && $email_check==="ok"){

  $query = "SELECT * FROM users WHERE user_email = '{$user_email}' ";
  $result = mysqli_query($connection, $query);
  $count1 = mysqli_num_rows($result);

  $query = "SELECT * FROM users WHERE username = '{$username}' ";
  $result = mysqli_query($connection, $query);
  $count2 = mysqli_num_rows($result);

  # Checking user already available or not.
  if($count1 > 0 ){
    $alert_email = "<span id='error'>Email Id has taken.</span>";
  }
  else if($count2 > 0){
    $alert = "<span id='error'>User already exists.</span>";
  }
  else{

    $query = "SELECT randSalt FROM users ";
    $select_randsalt_query = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row['randSalt'];

    $user_password = crypt($user_password, $salt);

    $verificationCode = md5(uniqid(mt_rand(), true));

    $query = "INSERT INTO users (user_firstname, user_lastname, username, user_password, user_gender, user_email,  user_role, user_status, signup_date, accountVerificationCode) ";

    $query .= " VALUES ('{$user_firstname}','{$user_lastname}', '{$username}','{$user_password}','{$user_gender}', '{$user_email}', 'subscriber', 'unapproved', now(), '{$verificationCode}' ) ";

    $signup_user_query = mysqli_query($connection, $query);

    if(!$signup_user_query){
      die("Query failed because ".mysqli_error($connection));
    }

    $msg = "Please verify your account within 12 hours.
            NOTE: This link will expire after 12 hours.
            http://yestocode.com/healthservices/accountVerification.php?email=$user_email&verificationCode=$verificationCode
    ";
    send_email($user_email, 'Account verification', $msg, 'From: noreply@healthservices.com');
    $success = <<<DELIMITER
    <div class="alert alert-success fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Thanks!</strong> Thanks for Signing Up with us.
    </div>
    <div class="alert alert-info fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        A <i>verification </i> link has sent to your email.
    </div>
DELIMITER;

  }

}// End of if.

  }// End of if(isset($_POST['user_signup']))

?>


<!-- Page Content -->
<div class="container" style="margin-top:2%;">

    <div class="row">
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xs-offset-4 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
          <?php echo $success; ?>
      </div><!-- End of col -->
    </div><!-- End of row -->
    <div class="row">
      <div class="col-sm-6 col-md-8">
        <div><h2 class="text-center" style="color:#00796B;">Follow Us On</h2></div>
        <div class="text-center">
          <div class="img-responsive">
            <a href=""><img src="images/facebook.ico" width="88" alt="facebook" class="img-circle"></a>
            <a href=""><img src="images/Google-Plus.png" width="90" alt="google-plus" class="img-circle"></a>
            <a href=""><img src="images/twitter.ico" width="80" alt="twitter" class="img-circle"></a>
            <a href=""><img src="images/pinterest-3-xxl.png" width="73" alt="pinterest"></a>
          </div>
        </div>
      </div><!-- end of col -->

     <!-- Taking user data via form -->
      <div class="col-sm-6 col-md-4">
        <form role="form" action="" method="post" novalidate autocomplete="on">

          <div class="form-group">
            <label for="firsname">Firs Name: </label>
            <input type="text" class="form-control" name="user_firstname" id="firstname" value="<?php echo $user_firstname;?>" placeholder="enter first name" >
            <?php echo $user_firstname_err; ?>
          </div><!-- end of form-group -->

         <div class="form-group">
           <label for="lastname">Last Name: </label>
           <input type="text" name="user_lastname" id="lastname" class="form-control" value="<?php echo $user_lastname;?>" placeholder="enter last name">
           <?php echo $user_lastname_err; ?>
         </div><!-- end of form-group-->

          <div class="form-group">
            <label for="gender">Gender:</label>
            <select name="user_gender" id="gender">
              <option value="male">Select Gender</option>
              <option value="male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select><?php echo $user_gender_err; ?>
          </div><!-- end of form-group-->

          <div class="form-group">
            <label for="username">Username: </label>
            <input type="text" name="username" id="username" class="form-control" value="<?php echo $username;?>" placeholder="enter username">
            <?php echo $username_err; ?>
            <?php echo $alert;?>
          </div><!-- end of form-group-->

          <div class="form-group">
            <label for="password">Password: </label>
            <input type="password" name="user_password" id="password" class="form-control" placeholder="enter password">
            <?php echo $user_password_err; ?>
          </div><!-- end of form-group-->

          <div class="form-group">
            <label for="email">Email: </label>
            <input type="email" name="user_email" id="email" class="form-control" value="<?php echo $user_email;?>" placeholder="enter your email">
            <?php echo $user_email_err; ?>
            <?php echo $alert_email;?>
          </div><!-- end of form-group-->

          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <button type="submit" name="user_signup" class="btn btn-success btn-block" style="font-size:13px"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign Up</button>
              </div>
              <div class="col-sm-6">

              </div>
            </div><!-- End of row -->
          </div><!-- end of form-group-->

        </form><!-- end of form -->

      </div><!-- end of  col -->
    </div>
    <!-- /.row -->
</div>
