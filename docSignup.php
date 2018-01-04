<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<?php

  $doc_firstname_err = $doc_lastname_err = $doc_username_err = $doc_password_err = $doc_gender_err = $doc_email_err = $alert = "";
  $address_err = $phonenumber_err = $address_check = $phonenumber_check = "";
  $doc_firstname = $doc_lastname = $doc_username = $doc_password = $doc_gender = $doc_email = $check = $address = $phoneNumber = "";

  if(isset($_POST['doc_signup'])){

    if(empty($_POST['doc_firstname'])){
      $doc_firstname_err = "<span id='error'>Please enter your first name.</span>";
      $firstname_check = "";
    }
    else{
      $firstname = escape($_POST['doc_firstname']);
          if(!preg_match("/^[a-zA-Z ]*$/",$firstname)){
            $doc_firstname_err = "<span id='error'>Only letters and white space allowed.</span>";
            $doc_firstname = $firstname;
            $firstname_check = "";
          }
          else{
            $doc_firstname = $firstname;
            $firstname_check = "ok";
          }
    }

    if(empty($_POST['doc_lastname'])){
      $doc_lastname_err = "<span id='error'>Please enter your last name.</span>";
      $lastname_check = "";
    }
    else{
      $lastname = escape($_POST['doc_lastname']);
          if(!preg_match("/^[a-zA-Z ]*$/",$lastname)){
            $doc_lastname_err = "<span id='error'>Only letters and white space allowed.</span>";
            $doc_lastname = $lastname;
            $lastname_check = "";
          }
          else{
            $doc_lastname = $lastname;
            $lastname_check = "ok";
          }
    }

    if(empty($_POST['doc_gender'])){
      $doc_gender_err = "<span id='error'>Please select your gender.</span>";
      $gender_check = "";
    }
    else{
      $doc_gender = escape($_POST['doc_gender']);
      $gender_check = "ok";
    }

    if(empty($_POST['doc_username'])){
      $doc_username_err = "<span id='error'>Please enter your docname.</span>";
      $username_check = "";
    }
    else{
      $doc_username = "Dr. ".escape($_POST['doc_username']);
      $username_check = "ok";
    }

    if(empty($_POST['doc_password'])){
      $doc_password_err = "<span id='error'>Please enter your password.</span>";
      $password_check = "";
    }
    else{
      $doc_password = escape($_POST['doc_password']);
      $password_check = "ok";
    }

    if(empty($_POST['doc_email'])){
      $doc_email_err = "<span id='error'>Please enter your email.</span>";
      $email_check = "";
    }
    else{
      $email = escape($_POST['doc_email']);
      if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        $doc_email_err = "<span id='error'>Invalid email.</span>";
        $doc_email = $email;
        $email_check = "";
      }
      else
      {
        $doc_email = $email;
        $email_check = "ok";
      }
    }

    #Validating address.
    if(empty($_POST['address'])){
      $address_err = "<span id='error'>Enter your address.</span>";
    }
    else{
      $address = escape($_POST['address']);
      $address_check = "ok";
    }

    #Validating Mobile Number.
    if(empty($_POST['phoneNumber'])){
      $phonenumber_err = "<span id='error'>Enter your 10 digit mobile number.</span>";
    }
    else if(!preg_match("/^[0-9 ]*$/",$_POST['phoneNumber'])){
      $phonenumber_err = "<span id='error'>Invalid mobile number.</span>";
    }
    else{
      if((substr($_POST['phoneNumber'],0,1) == 7 || substr($_POST['phoneNumber'],0,1) == 8 || substr($_POST['phoneNumber'],0,1) == 9) && strlen($_POST['phoneNumber']) == 10 ){
        $phoneNumber = escape($_POST['phoneNumber']);
        $phonenumber_check = "ok";
      }
      else{
        $phonenumber_err = "<span id='error'>Invalid mobile number.</span>";
      }
    }


if($firstname_check==="ok" && $lastname_check==="ok" && $gender_check==="ok" && $username_check==="ok" && $password_check==="ok" && $email_check==="ok" && $address_check = "ok" && $phonenumber_check = "ok"){

  $query = "SELECT * FROM doctors WHERE doc_email = '{$doc_email}' ";
  $result = mysqli_query($connection, $query);
  $count1 = mysqli_num_rows($result);

  $query = "SELECT * FROM doctors WHERE doc_username = '{$doc_username}' ";
  $result = mysqli_query($connection, $query);
  $count2 = mysqli_num_rows($result);

  # Checking doc already available or not.
  if($count1 > 0 || $count2 > 0){
    $alert = "<span id='error'>Doctor already exists.</span>";
  }
  else{

    $query = "SELECT randSalt FROM doctors ";
    $select_randsalt_query = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($select_randsalt_query);

    $salt = $row['randSalt'];;

    $doc_password = crypt($doc_password, $salt);

    $query = "INSERT INTO doctors(doc_firstname, doc_lastname, doc_username, doc_password, doc_gender, doc_email,  doc_role, doc_status, 	address, phoneNumber) ";

    $query .= "VALUES ('{$doc_firstname}','{$doc_lastname}', '{$doc_username}','{$doc_password}','{$doc_gender}', '{$doc_email}', 'doctor', 'unapproved', '{$address}', '{$phoneNumber}' ) ";

    $signup_doc_query = mysqli_query($connection, $query);
    if(!$signup_doc_query)die("Couldn't signup because ".mysqli_error($connection));

    echo "<h3 class='text-center'style='color:#00838F;'>Thanks for <span style='color:#4CAF50;'>Joining </span> us.</h3>";
    echo "<h5 class='text-center' style='color:#006064;'>We will send you a confirmation mail for further verification.</h5>";

  }

}// End of if.

  }// End of if(isset($_POST['doc_signup']))

?>


<!-- Page Content -->
<div class="container" style="margin-top:4%;">
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

     <!-- Taking doc data via form -->
      <div class="col-sm-6 col-md-4">
        <form role="form" action="" method="post" novalidate autocomplete="on">

          <div class="form-group">
            <label for="firsname">Firs Name: </label>
            <input type="text" class="form-control" name="doc_firstname" id="firstname" value="<?php echo $doc_firstname;?>" placeholder="enter first name" >
            <?php echo $doc_firstname_err; ?>
          </div><!-- end of form-group -->

         <div class="form-group">
           <label for="lastname">Last Name: </label>
           <input type="text" name="doc_lastname" id="lastname" class="form-control" value="<?php echo $doc_lastname;?>" placeholder="enter last name">
           <?php echo $doc_lastname_err; ?>
         </div><!-- end of form-group-->

          <div class="form-group">
            <label for="gender">Gender:</label>
            <select name="doc_gender" id="gender">
              <option value="male">Select Gender</option>
              <option value="male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select><?php echo $doc_gender_err; ?>
          </div><!-- end of form-group-->

          <div class="form-group">
            <label for="docname">Username: </label>
            <input type="text" name="doc_username" id="docname" class="form-control" value="<?php echo $doc_username;?>" placeholder="enter username">
            <?php echo $doc_username_err; ?>
            <?php echo $alert;?>
          </div><!-- end of form-group-->

          <div class="form-group">
            <label for="password">Password: </label>
            <input type="password" name="doc_password" id="password" class="form-control" placeholder="enter password">
            <?php echo $doc_password_err; ?>
          </div><!-- end of form-group-->

          <div class="form-group">
            <label for="email">Email: </label>
            <input type="email" name="doc_email" id="email" class="form-control" value="<?php echo $doc_email;?>" placeholder="enter email">
            <?php echo $doc_email_err; ?>
            <?php echo $alert;?>
          </div><!-- end of form-group-->

          <div class="form-group">
            <label for="adddress">Address:</label>
            <textarea name="address" rows="4" cols="40" class="form-control" value="<?php echo $address;?>" placeholder="Enter your address here. " id="address"></textarea>
            <?php echo $address_err; ?>
          </div><!-- End of address -->

          <div class="form-group">
            <label for="tel">Mobile No.:</label>
            <input type="text" name="phoneNumber" class="form-control" value="<?php echo $phoneNumber;?>" placeholder="Enter your 10 digit mobile number.">
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <button type="submit" name="doc_signup" class="btn btn-success btn-block" style="font-size:13px"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign Up</button>
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
