<?php ob_start() ?>
<?php include ("includes/header.php") ?>
<?php include ("includes/navigation.php") ?>
<?php
  $email_err = $email_check = "";
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    #validating user Email
    if(empty($_POST['email'])){
      $email_err = <<<DELIMITER
      <div class="alert alert-danger fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Email can not be empty.
      </div>
DELIMITER;
    }
    else{
       $email = escape($_POST['email']);
       $email_check = "ok";
    }
    if(isset($_SESSION['token']) && $email_check === 'ok' && $_POST['token'] == $_SESSION['token']){

      $sql = "SELECT doc_username FROM doctors where doc_email = '{$email}' ";
      $result = query($sql);
      if(!$result){
        die("Query failed due to ".mysqli_error($connection));
      }
      $count = mysqli_num_rows($result);
         if($count == 1){
            $row = fetchArray($result);
            $doc_username = $row['doc_username'];
            $recoveryCode = md5($email.microtime());
            setcookie('temp_access_code', $recoveryCode, time()+600);

            $sql = "UPDATE doctors SET recoveryCode = '{$recoveryCode}' WHERE doc_email = '{$email}' ";
            $result = query($sql);
            if(!$result){
              die("Query failed due to ".mysqli_error($connection));
            }

            $subject = "Reset Password";
            $msg = "
                    Click the given link to recover your password.
                    Note: This link is only available once and will expire within 10 minutes.
                    http://yestocode.com/healthservices/rejoincode.php?email=$email&code=$recoveryCode";

            $headers = "From: noreply@healthservices.com";
            if(!send_email($email, $subject, $msg, $headers)){
              $email_err = <<<DELIMITER
              <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Can not send password recovery mail.
              </div>
DELIMITER;
            }
            else{
              $email_err = <<<DELIMITER
              <div class="alert alert-info fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Please check your email to recover password.
              </div>
DELIMITER;
              set_message($email_err);
              // redirect("index.php");
            }
        }
        else{
            $email_err = <<<DELIMITER
            <div class="alert alert-danger fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              User does not exists.
            </div>
DELIMITER;
        }//End of email exists.

   }else {
    //  redirect("index.php");
   }

  }//End of if($_SERVER['REQUEST_METHOD'])
?>
<div class="container">
<div class="row" style="margin-top:6%">

  <div class="col-md-6 col-md-offset-3">

    <?php echo $email_err; ?>
    <?php echo display_message(); ?>

    <div class="col-md-12" style="border:1px solid lightgrey; border-radius:5px;" ><br>

        <h4 class="text-center text-info" style="font-size:20px;"><b>Recover Password</b></h4><br>

        <form role="form" action="" method="post">

          <div class="form-group text-info">
            <label for="email"><i class="fa fa-user-md fa-lg"></i> Email Address:</label>
            <input type="email" name="email" placeholder="Enter Email" class="form-control" id="email"/>
          </div><!-- End of input email -->

          <div class="row">
            <div class="col-sm-5">
              <div class="form-group">
                <button type="reset" name="reset" class="btn btn-danger btn-block" style="font-size:13px"><i class="fa fa-remove"></i> Cancle</button>
              </div><!-- End of cancle button -->
            </div><!-- End of col -->

            <div class="col-sm-5 col-sm-offset-2">
              <div class="form-group">
                <button type="submit" name="recover" class="btn btn-success btn-block" style="font-size:13px"><i class="fa fa-power-off"></i> Submit</button>
              </div><!-- End of submit button -->

              <input type="hidden" name="token" value="<?php echo tokenGenerator();?>" class="hide"><br>

            </div><!-- End of col -->

          </div><!-- End of row -->

        </form><!-- End of form -->

    </div><!-- End of div -->

  </div><!-- End of col -->

</div><!-- end of row -->
</div><!-- end of container -->
