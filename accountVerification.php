<?php ob_start() ?>
<?php include ("includes/header.php") ?>
<?php include ("includes/navigation.php") ?>
<?php
  {
    if(isset($_GET['email']) && isset($_GET['verificationCode'])){
      $email = escape($_GET['email']);
      $verificationCode = escape($_GET['verificationCode']);
      $sql = "SELECT accountVerificationCode FROM users WHERE user_email = '{$email}' ";
      $result = query($sql);
      if(!$result){
        die("Query failed due to ".mysqli_error($connection));
      }
      if(row_count($result) == 1){
        $row = fetchArray($result);
        $accountVerificationCode = $row['accountVerificationCode'];
        if($verificationCode === $accountVerificationCode){
          $sql = "UPDATE users SET accountVerificationCode = 'Verified by user' WHERE user_email = '{$email}' ";
          $result = query($sql);
          if(!$result){
            die("Query failed due to ".mysqli_error($connection));
          }
          $message = <<<DELIMITER
          <div class="alert alert-success fate in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              Your account has verified and will be activated within 24 hours.
          </div>
DELIMITER;
          set_message($message);
          redirect("login.php");
        }
        else{
          redirect("index.php");
        }
      }
      else{
        redirect("index.php");
      }
    }
    else{
      redirect("index.php");
    }
  }
?>
