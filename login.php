<?php ob_start(); ?>
<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php";?>

<?php
$user_email_err = $user_password_err = $login_error = "";
$user_email = $user_password = $check = "";

if(isset($_POST['swaagatam'])){

    if(empty($_POST['user_email'])){
        $user_email_err = "<span style='color:#ff5252;'>Please enter your email.</span>";
    }
    else{
      $user_email = escape($_POST['user_email']);
    }

    if(empty($_POST['user_password'])){
        $user_password_err = "<span style='color:#ff5252;'>Please enter your password.</span>";
    }
    else{
        $user_password = escape($_POST['user_password']);
    }


    if(!empty($user_email) && !empty($user_password)){
        $query = "SELECT * FROM users WHERE user_email = '{$user_email}' ";
        $select_user_query = mysqli_query($connection, $query);

        $count = mysqli_num_rows($select_user_query);
        if($count === 0){
            $login_error = "<span style='color:#1E88E5'>Either </span><span style='color:#4CAF50'>email </span><span style='color:#1E88E5'>or </span><span style='color:#4CAF50'>password </span><span style='color:#1E88E5'>is </span><span style='color:#e53935'>wrong</span><span style='color:#1E88E5'>.</span>";
        }
        else{

            while($row = mysqli_fetch_assoc($select_user_query)){
                $db_user_id = $row['user_id'];
                $db_username = $row['username'];
                $db_user_email = $row['user_email'];
                $db_user_password = $row['user_password'];
                $db_user_firstname = $row['user_firstname'];
                $db_user_lastname = $row['user_lastname'];
                $db_user_gender = $row['user_gender'];
                $db_user_role = $row['user_role'];
                $db_user_status = $row['user_status'];
            }

            $password = crypt($user_password, $db_user_password);

            if($user_email !== $db_user_email && $password !== $db_user_password){
                //header("Location: login.php");
                $login_error = "<span style='color:#1E88E5'>Either </span><span style='color:#4CAF50'>email </span><span style='color:#1E88E5'>or </span><span style='color:#4CAF50'>password </span><span style='color:#1E88E5'>is </span><span style='color:#e53935'>wrong</span><span style='color:#1E88E5'>.</span>";
            }
            else if($user_email === $db_user_email && $password === $db_user_password && $db_user_role === 'admin' && $db_user_status === 'approved' ){

                $_SESSION['username'] = $db_username;
                $_SESSION['user_email'] = $db_user_email;
                $_SESSION['user_firstname'] = $db_user_firstname;
                $_SESSION['user_lastname'] = $db_user_lastname;
                $_SESSION['user_gender'] = $db_user_gender;
                $_SESSION['user_role'] = $db_user_role;
                header("Location: /healthservices/admin/");

            }
            else if($user_email === $db_user_email && $password === $db_user_password && $db_user_role === 'subscriber' && $db_user_status === 'approved' ){

                $_SESSION['username'] = $db_username;
                $_SESSION['user_email'] = $db_user_email;
                $_SESSION['user_firstname'] = $db_user_firstname;
                $_SESSION['user_lastname'] = $db_user_lastname;
                $_SESSION['user_gender'] = $db_user_gender;
                $_SESSION['user_role'] = $db_user_role;
                header("Location: index.php");

            }
            else if($user_email === $db_user_email && $password === $db_user_password && $db_user_role === 'subscriber' && $db_user_status === 'unapproved'){
                echo "<h4 class='text-info text-center'>Your account is under verification.</h4>";
            }

            else{
                //header("Location: login.php");
                $login_error = "<span style='color:#1E88E5'>Either </span><span style='color:#4CAF50'>email </span><span style='color:#1E88E5'>or </span><span style='color:#4CAF50'>password </span><span style='color:#1E88E5'>is </span><span style='color:#e53935'>wrong</span><span style='color:#1E88E5'>.</span>";
            }
        }

    }// End of if.

}// End of if.
?>
<div class="container">
    <div class="row" style="margin-top:2%">
        <div class="col-sm-4 col-md-3"></div>
        <div class="col-sm-4 col-md-4 col-md-offset-1">
          <?php display_message(); ?>
            <!-- User Login -->
            <h4 class="text-center"><?php echo $login_error; ?></h4>
            <h2 class="text-center"><i class="fa fa-lock fa-lg"></i> User Login </h2>
            <form action="" method="POST" novalidate>
                <div class="form-group">
                    <label for="usrname"><i class="fa fa-user fa-lg" aria-hidden="true"></i></span> Username</label>
                    <input type="email" name="user_email" class="form-control" placeholder="Enter Email" value="<?php echo $user_email; ?>">
                    <?php echo $user_email_err; ?>
                </div>

                <div class="form-group">
                    <label for="psw"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></span> Password</label>
                    <input type="password" name="user_password" class="form-control" placeholder="Enter Password">
                    <?php echo $user_password_err;?>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit" name="swaagatam"><i class="fa fa-power-off"></i> Login</button>
                </div>
                <div class="form-group text-center">
                  <a href="recover.php"><u>Forget password?</u></a>
                </div>
            </form>
        </div>
        <div class="col-sm-4 col-md-3"></div>
    </div>
</div>
