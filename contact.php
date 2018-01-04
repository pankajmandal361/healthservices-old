<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php";?>
<?php
 $name_err = $email_err = $message_err = "";
 $name_check = $email_check = $message_check = $success =  "";
 if(isset($_POST['submit'])){

   if(empty($_POST['name'])){
     $name_err = "<span id='error'>Name is required.</span>";
   }
   else{
     $_POST['name'] = escape($_POST['name']);
     if (!preg_match("/^[a-zA-Z ]*$/",$_POST['name'])){
       $name_err = "<span id='error'>Only letter and white space are allowed.</span>";
     }
     else{
       $subject = $_POST['name'];
       $name_check = "ok";
     }
   }


   if(empty($_POST['email'])){
     $email_err = "<span id='error'>Email is required.</span>";
   }
   else{
     $_POST['email'] = escape($_POST['email']);
     if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
       $email_err = "<span id='error'>Invalid email.</span>";
     }
     else{
       $headers = $_POST['email'];
       $email_check = "ok";
     }
   }

   if(empty($_POST['message'])){
     $message_err = "<span id='error'>You can't leave this empty.</span>";
   }
   else{
     $message = escape($_POST['message']);
     $message_check = "ok";
   }

   if($message_check === "ok" && $email_check === "ok" && $name_check === "ok"){
     $to = 'pankajmandal1094@gmail.com';
    //  mail($to, $subject, $message, $headers);
     $success =  <<<DELIMITER
     <div class="alert alert-success fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Thanks!</strong> For your contact.
    </div>
DELIMITER;
   }


 }
 ?>

<!-- FEATURE IMAGE
================================================== -->
<section class="feature-image feature-image-default" data-type="background" data-speed="2">
  <h1 style="font-size:40px"><strong>Contact</strong></h1>
</section>


<!-- MAIN CONTENT
================================================== -->
<div class="container">
  <div class="row" id="primary">

    <div id="content" class="col-sm-12">
      <span class="col-xs-12  col-sm-12 col-md-12 text-center"> <?php echo $success; ?> </span>
      <section class="main-content" style="padding-top:5%; padding-bottom:5%;">
        <p class="lead">Have any questions? Feel free to get in touch with us! We&rsquo;ll do our best to get back to you.</p>

        <form role="form" class="clearfix" method="post">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="sr-only" for="contact-name">Name</label>
              <input type="text" class="form-control input-lg" name="name" id="contact-name" placeholder="Your name" >
              <?php echo $name_err; ?>
              </div>
            </div><!-- end col -->

            <div class="col-sm-6">
              <div class="form-group">
                <label class="sr-only" for="contact-email">Email</label>
              <input type="email" class="form-control input-lg" name="email" id="contact-email" placeholder="Your email" >
              <?php echo $email_err; ?>
              </div>
            </div><!-- end col -->

            <div class="col-sm-12">
              <div class="form-group">
                <label class="sr-only" for="contact-words">Message</label>
                <textarea class="form-control input-lg" name="message" id="contact-words" placeholder="Your message" rows="3" ></textarea>
                <?php echo $message_err; ?>
              </div>
            </div><!-- end col -->
          </div><!-- row -->
        <input type="submit" class="btn btn-info btn-lg pull-right"name="submit" value="Get in touch &raquo;">
          </form>

      </section>

    </div><!-- content -->

  </div><!-- primary -->
</div><!-- container -->


<!-- SIGN UP SECTION
================================================== -->
<section id="signup" data-type="background" data-speed="4" style="padding-top:5%;padding-bottom:5%;">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <?php if(isset($_SESSION['username']) === false):?>
          <?php if(isset($_SESSION['doc_username']) === false): ?>
            <h2 style="color:#B0BEC5;">Do you really want to stay healthy and fit <strong>forever</strong>?</h2>
            <p><a href="signup.php" class="btn btn-lg btn-block btn-success">Yes, sign me up!</a></p>
          <?php else: ?>
            <h2 style="color:#B0BEC5;">Please check the latest awesome stuffs</h2>
            <p><a href="doctors/" class="btn btn-lg btn-block btn-success">Yes, Take me there!</a></p>
          <?php endif; ?>
        <?php else: ?>
          <h2 style="color:#B0BEC5;">Please check the latest awesome stuffs</h2>
          <p><a href="users/" class="btn btn-lg btn-block btn-success">Yes, Take me there!</a></p>
        <?php endif;?>
      </div><!-- end col -->
    </div><!-- row -->
  </div><!-- container -->
</section><!-- signup -->

<!-- Footer -->
<?php include "includes/footer.php";?>
