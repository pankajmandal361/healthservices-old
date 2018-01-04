<?php ob_start() ?>
<?php include ("includes/header.php") ?>
<?php include ("includes/navigation.php") ?>

<?php
  if(isset($_COOKIE['temp_access_code'])){
    if(isset($_GET['email']) && isset($_GET['code'])){
      $email = escape($_GET['email']);
      $code = escape($_GET['code']);
      $sql = "SELECT recoveryCode FROM users WHERE user_email = '{$email}' ";
      $result = query($sql);
      if(!$result){
        die("Query failed due to ".mysqli_error($connection));
      }
      if(row_count($result) == 1){
        $row = fetchArray($result);
        $recoveryCode = $row['recoveryCode'];
        if($recoveryCode === $code){
          $sql = "UPDATE users SET recoveryCode = 'ZEB-nc4300' WHERE user_email = '{$email}' ";
          $result = query($sql);
          if(!$result){
            die("Query failed due to ".mysqli_error($connection));
          }
          $value = md5($email.microtime());
          setcookie('reset', $value, time()+300);
          redirect("reset.php?email=$email");
        }
        else{
          $message = <<<DELIMITER
          <div class="alert alert-danger fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <i class="fa fa-frown-o fa-2x" aria-hidden="true"></i>
           Sorry!... The link has expired.
  </div>
DELIMITER;
          set_message($message);
          redirect("recover.php");
        }
      }
      else{
        $message = <<<DELIMITER
        <div class="alert alert-danger fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <i class="fa fa-frown-o fa-2x" aria-hidden="true"></i>
         Sorry!... The link has expired.
</div>
DELIMITER;
        set_message($message);
        redirect("recover.php");
      }
    }
    else{
      $message = <<<DELIMITER
      <div class="alert alert-danger fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <i class="fa fa-frown-o fa-2x" aria-hidden="true"></i>
       Sorry!... The link has expired.
</div>
DELIMITER;
      set_message($message);
      redirect("recover.php");
    }
  }
  else{
    $message = <<<DELIMITER
    <div class="alert alert-danger fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <i class="fa fa-frown-o fa-2x" aria-hidden="true"></i>
       Sorry!... The link has expired.
    </div>
DELIMITER;
    set_message($message);
    redirect("recover.php");
}
?>
