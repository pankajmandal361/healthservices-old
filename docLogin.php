<?php ob_start(); ?>
<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"?>


<?php
$doc_email_err = $doc_password_err = $login_error = "";
$doc_email = $doc_password = $doc_email_check = $doc_password_check = "";

if(isset($_POST['doc_login'])){

    if(empty($_POST['doc_email'])){
        $doc_email_err = "<span style='color:#ff5252;'>Please enter your email.</span>";
        $doc_email_check = "";
    }
    else{
      $doc_email = escape($_POST['doc_email']);
      $doc_email_check = "ok";
    }

    if(empty($_POST['doc_password'])){
        $doc_password_err = "<span style='color:#ff5252;'>Please enter your password.</span>";
        $doc_password_check = "";
    }
    else{
        $doc_password = escape($_POST['doc_password']);
        $doc_password_check = "ok";
    }


    if($doc_email_check === "ok" && $doc_password_check === "ok"){
        $query = "SELECT * FROM doctors WHERE doc_email = '{$doc_email}' ";
        $select_doctor_query = mysqli_query($connection, $query);
        if(!$select_doctor_query){
          die(mysqli_error($connection));
        }

        $count = mysqli_num_rows($select_doctor_query);
        if($count === 0){
            $login_error = "<span style='color:#1E88E5'>Either </span><span style='color:#4CAF50'>email </span><span style='color:#1E88E5'>or </span><span style='color:#4CAF50'>password </span><span style='color:#1E88E5'>is </span><span style='color:#e53935'>wrong</span><span style='color:#1E88E5'>.</span>";
        }
        else{

            while($row = mysqli_fetch_assoc($select_doctor_query)){
                $db_doc_id = $row['doc_id'];
                $db_doc_image = $row['doc_image'];
                $db_doc_username = $row['doc_username'];
                $db_doc_email = $row['doc_email'];
                $db_doc_password = $row['doc_password'];
                $db_doc_firstname = $row['doc_firstname'];
                $db_doc_lastname = $row['doc_lastname'];
                $db_doc_gender = $row['doc_gender'];
                $db_doc_role = $row['doc_role'];
                $db_doc_status = $row['doc_status'];
            }

            $password = crypt($doc_password, $db_doc_password);

            if($doc_email !== $db_doc_email || $password !== $db_doc_password){
                //header("Location: login.php");
                $login_error = "<span style='color:#1E88E5'>Either </span><span style='color:#4CAF50'>email </span><span style='color:#1E88E5'>or </span><span style='color:#4CAF50'>password </span><span style='color:#1E88E5'>is </span><span style='color:#e53935'>wrong</span><span style='color:#1E88E5'>.</span>";
            }
            else if($doc_email === $db_doc_email && $password === $db_doc_password && $db_doc_role === 'admin' && $db_doc_status === 'approved' ){

                $_SESSION['doc_image'] = $db_doc_image;
                $_SESSION['doc_username'] = $db_doc_username;
                $_SESSION['doc_email'] = $db_doc_email;
                $_SESSION['doc_firstname'] = $db_doc_firstname;
                $_SESSION['doc_lastname'] = $db_doc_lastname;
                $_SESSION['doc_gender'] = $db_doc_gender;
                $_SESSION['doc_role'] = $db_doc_role;
                header("Location: http://localhost/cms/admin");

            }
            else if($doc_email === $db_doc_email && $password === $db_doc_password && $db_doc_role === 'doctor' && $db_doc_status === 'approved' ){

              $_SESSION['doc_image'] = $db_doc_image;
              $_SESSION['doc_username'] = $db_doc_username;
              $_SESSION['doc_email'] = $db_doc_email;
              $_SESSION['doc_firstname'] = $db_doc_firstname;
              $_SESSION['doc_lastname'] = $db_doc_lastname;
              $_SESSION['doc_gender'] = $db_doc_gender;
              $_SESSION['doc_role'] = $db_doc_role;
              header("Location: http://yestocode.com/healthservices/doctors");

            }
            else if($doc_email === $db_doc_email && $password === $db_doc_password && $db_doc_role === 'doctor' && $db_doc_status === 'unapproved'){
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
    <div class="row">
        <div class="col-sm-4 col-md-3"></div>
        <div class="col-sm-4 col-md-4 col-md-offset-1">
            <!-- User Login -->
            <h4 class="text-center"><?php echo $login_error; ?></h4>
            <h2 class="text-center"><i class="fa fa-lock fa-lg"></i> Doctor Login </h2>
            <form action="" method="POST" novalidate>
                <div class="form-group">
                    <label for="usrname"><i class="fa fa-user-md fa-lg" aria-hidden="true"></i></span> Username</label>
                    <input type="email" name="doc_email" class="form-control" placeholder="Enter Email" value="<?php echo $doc_email; ?>">
                    <?php echo $doc_email_err; ?>
                </div>

                <div class="form-group">
                    <label for="psw"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></span> Password</label>
                    <input type="password" name="doc_password" class="form-control" placeholder="Enter Password">
                    <?php echo $doc_password_err;?>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit" name="doc_login"><i class="fa fa-power-off"></i> Login</button>
                </div>
                <div class="form-group text-center">
                  <a href="rejoin.php"><u>Forget password?</u></a>
                </div>
            </form>
        </div>
        <div class="col-sm-4 col-md-3"></div>
    </div>
</div>
