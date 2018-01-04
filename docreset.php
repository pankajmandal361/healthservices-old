<?php ob_start() ?>
<?php include ("includes/header.php") ?>
<?php include ("includes/navigation.php") ?>

<?php if(reset_docpasssword()): ?>

<div class="container">
  <div class="row" style="margin-top:6%" >
    <?php
            $pass_err = $pass_confirm_err = $reset_err = "";
            $pass_check = $pass_confirm_check = "";

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $email = escape($_GET['email']);
                #Password validation
                if(empty($_POST['password'])){
                  $pass_err = <<<DELIMITER
                  <div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Password can not be empty.
                  </div>
DELIMITER;
                }
                else{
                  #checking password length.
                  if(strlen($_POST['password']) <= 3){
                    $pass_err = <<<DELIMITER
                    <div class="alert alert-danger fade in">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      Password is too short.
                    </div>
DELIMITER;
                  }
                  else if(strlen($_POST['password']) >= 20){
                    $pass_err = <<<DELIMITER
                    <div class="alert alert-danger fade in">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      Password is too large.
                    </div>
DELIMITER;
                  }
                  else{
                    $password = escape($_POST['password']);
                    $pass_check = "ok";
                  }
                }//End of password validation.

                #Confirm Passsword Validation.
                if(empty($_POST['confirm_password'])){
                  $pass_confirm_err = <<<DELIMITER
                  <div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Password must be confirm.
                  </div>
DELIMITER;
                }
                else{
                  $confirm_password = escape($_POST['confirm_password']);
                  $pass_confirm_check = "ok";
                }//End of Confirm password validation.


                #Updating User Password.
                if($pass_check === "ok" && $pass_confirm_check === "ok" && isset($_SESSION['token']) && isset($_POST['token']) && $_POST['token'] === $_SESSION['token']){
                  #Checking Password match or not
                  if($password !== $confirm_password){
                    $reset_err = <<<DELIMITER
                    <div class="alert alert-danger fade in">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      Password did not match.
                    </div>
DELIMITER;
                  }//End of Checking password match.
                  else{
                    $query = "SELECT randSalt FROM doctors ";
                    $select_randsalt_query = mysqli_query($connection, $query);

                    $row = mysqli_fetch_array($select_randsalt_query);
                    $salt = $row['randSalt'];

                    $password = crypt($confirm_password, $salt);
                    $sql = "UPDATE doctors SET doc_password = '{$password}' WHERE doc_email = '{$email}' ";
                    $result = query($sql);
                    if(!$result){
                      die("Query failed due to ".mysqli_error($connection));
                    }
                    $message = <<<DELIMITER
                    <div class="alert alert-success fade in">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      Password successfully changed. Please login.
                    </div>
DELIMITER;
                    set_message($message);
                    redirect("login.php");
                  }

                }//End of Updating User Password.

            }//End of $_SERVER.

          ?>


          <div class="col-md-5 col-md-offset-3">
            <?php
              #Echo Errors.
              echo $pass_err;
              echo $pass_confirm_err;
              echo $reset_err;
            ?>
            <div class="row">
              <div class="col-md-12" style="border:1px solid lightgrey; border-radius:5px" >
                <h3 class="text-center text-info"><b>Reset Password</b></h3><br>
                <form role="form" action="" method="POST">
                  <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Enter new password">
                  </div><!-- End of new password -->

                  <div class="form-group">
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm new password">
                  </div><!-- End of confirm new password -->

                  <input type="hidden" class="hide" name="token" value="<?php echo tokenGenerator(); ?>">

                  <div class="row">
                    <div class="col-md-5">
                      <button type="submit" name="reset" class="btn btn-danger btn-block" style="font-size:13px"><i class="fa fa-remove"></i> Cancle</button>
                    </div><!-- End of RESET -->
                    <div class="col-md-5 col-md-offset-2">
                      <button type="submit" name="reset_password" class="btn btn-success btn-sm btn-block" style="font-size:13px"><i class="fa fa-power-off"></i> Submit</button>
                    </div><!-- End of SUBMIT -->
                  </div><!-- End of row -->

                </form><br><!-- End of form -->
              </div><!-- End of col -->
            </div><!-- End of row -->

          </div><!-- End of col -->
        </div><!-- End of row -->
</div><!-- End of container -->

<?php endif; ?>
