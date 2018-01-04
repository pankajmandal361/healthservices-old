<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php";?>

<!-- Page Content -->
<!-- HERO   ================================================== -->
    <section id="hero" data-type="background" data-speed="5">
    	<article>
    		<div class="container clearfix">
    			<div class="row">

		    		<div class="col-sm-10 col-sm-offset-1 hero-text text-center">
			    		<h1 style="color:#00695C;"><strong>Health first and foremost</strong> <sub style="color:#00897B">success happy life</sub></h1>
		    		</div><!-- col -->

    			</div><!-- row -->
    		</div><!-- container -->
    	</article>
    </section><!-- End of Hero Section -->

    <!-- OPTIN SECTION 	================================================== -->
    <?php if(isset($_SESSION['username']) === false): ?>
      <?php if(isset($_SESSION['doc_username']) === false): ?>
        <section id="optin">
        <div class="container">
          <div class="row">

            <div class="col-sm-8">
              <p><strong>Subscribe to our mailing list.</strong> We'll send something special as a thank you.</p>
            </div><!-- end col -->

            <div class="col-sm-3">
              <button class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#myModal" style="padding:6px;font-size:14px;margin-top:1px;">
                Click here to subscribe
              </button>
            </div><!-- end col -->

          </div><!-- row -->
        </div><!-- container -->
        </section><!-- optin -->
      <?php endif; ?>
    <?php endif; ?>

    <!-- WELCOME TO ONLINE HEALTHSERVICES ==================================== -->
    <section id="welcome" style="background:#fff;padding-top:5%;padding-bottom:5%;">
      <div class="container">
        <div class="section-header text-center">
          <img src="images/logo.png" alt="logo.png" width="130px" />
          <h2><strong>Welcome to Health Services</strong></h2>
        </div><!-- Section HEader -->

        <div class="row">
          <div class="col-sm-12">
            <p class="lead">
              Welcome to Health Services a right place to improve your health &mdash;because we believe in prevention is better than cure.
              <blockquote class="blockquote-reverse">
                We wont let you down, we are here to make you feel good and recover quickly from any desease you are facing, So come and visit us soon...
              </blockquote>
            </p>
          </div>
        </div>
      </div><!-- End of container -->
    </section><!-- End of welcome -->

    <!-- BOOST YOUR health	================================================== -->
	<section id="boost-health" style="padding-top:5%;padding-bottom:5%;">
		<div class="container">

			<div class="section-header text-center">
				<img src="images/health-logo.jpg" alt="health-logo.jpg" class="img-circle" width="150px">
				<h2><strong>How You Can Improve Your Health</strong></h2>
			</div><!-- section-header -->

			<div class="row">
        <div class="col-sm-12">
          <p class="lead">
            You can improve your health by <i>joining us</i>, in return we will give awesome health tips and tricks which will help you to live
            a healthy life. You can even talk to our best doctors and can get help with them.
          </p>
        </div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<h3>What is health?</h3>
					<p>
            Health is the level of functional or metabolic efficiency of a living organism. In humans it is the ability of individuals or communities to adapt and self-manage when facing physical,
            mental or social challenges.
          </p>
				</div><!-- end col -->

				<div class="col-sm-6">
					<h3>Who need it?</h3>
					<p>
            In today's world each and every person need a better health either he/she is healthy or not. But now in these days it's really difficult
            to stay healty and fit forever, so <i>join us</i> and say goodbye to diseases.
          </p>
				</div><!-- end col -->
			</div><!-- row -->

		</div><!-- container -->
	</section><!-- boost-health -->

  <!-- awesome FEATURES
	================================================== -->
	<section id="awesome-features" style="padding-top:5%;padding-bottom:5%;">
		<div class="container">

			<div class="section-header">
				<img src="assets/img/icon-rocket.png" alt="Rocket">
				<h2>Awesome Features</h2>
			</div><!-- section-header -->

			<div class="row">

				<div class="col-sm-2">
					<i class="fa fa-wheelchair fa-3x" aria-hidden="true"></i>
					<h4>Medical Guidance</h4>
				</div><!-- end col -->

				<div class="col-sm-2">
					<i class="fa fa-medkit fa-3x" aria-hidden="true"></i>
					<h4>Emergency Help</h4>
				</div><!-- end col -->

				<div class="col-sm-2">
					<i class="fa fa-ambulance fa-3x" aria-hidden="true"></i>
					<h4>Cardio Monitoring</h4>
				</div><!-- end col -->

				<div class="col-sm-2">
					<i class="fa fa-user-md fa-3x" aria-hidden="true"></i>
					<h4>Best Doctors</h4>
				</div><!-- end col -->

				<div class="col-sm-2">
					<i class="fa fa-stethoscope fa-3x" aria-hidden="true"></i>
					<h4>Direct access to the doctor</h4>
				</div><!-- end col -->

				<div class="col-sm-2">
					<i class="fa fa-mobile fa-3x" aria-hidden="true"></i>
					<h4>Accessible content on your mobile devices</h4>
				</div><!-- end col -->

			</div><!-- row -->
		</div><!-- container -->
	</section><!-- Awesome-features -->

  <!-- our-doctor
	================================================== -->
	<section id="our-doctor" style="padding-top:5%;padding-bottom:5%;">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-md-6">
					<div class="row">
						<div class="col-lg-8">
							<h2>Our Doctors </h2>
						</div><!-- end col -->

					</div><!-- row -->

					<p class="lead">We have highly skilled professional and experienced doctors. They are 100% geniune and they are very sincere.<p>

					<p style="font-size:16px">After successfully signing up with us you can search them by their specialty, type or by their name.</p>

					<p style="font-size:16px">We do promise our doctors won't let you down, they are here to make you feel good and recover quickely from any desease you are facing.</p>

          <p style="font-size:16px">We have four categories of doctors yoga guru, homeopathic doctors, allopathic and ayurvadic doctors.</p>
					<hr>

					<h3>Doctor Categories</h3>
					<div class="row">
						<div class="col-xs-3">
							<figure>
							  <img src="images/yoga-logo.jpg" alt="yoga-logo.jpg" class="img-circle" width="100%"/>
                <figcaption class="text-center">Yoga Guru</figcaption>
							</figure>
						</div><!-- end col -->

						<div class="col-xs-3">
              <figure>
                <img src="images/ayurveda-logo.png" alt="ayurveda-logo.png"  class="img-circle" width="100%"/>
                <figcaption class="text-center">Ayurveda</figcaption>
              </figure>
						</div><!-- end col -->

						<div class="col-xs-3">
              <figure>
                <img src="images/homeopahic-logo - Copy.jpg" alt="homeopahic-logo - Copy.jpg"  class="img-circle" width="88%"/>
                <figcaption class="text-center">Homeopathy</figcaption>
              </figure>
						</div><!-- end col -->

            <div class="col-xs-3">
              <figure>
                <img src="images/allopathy-logo - Copy.jpeg" alt="allopathy-logo - Copy.jpeg"  class="img-circle" width="70%"/>
                <figcaption class="text-center">Allopathy</figcaption>
              </figure>
						</div><!-- end col -->
					</div><!-- row -->

				</div><!-- end col -->
			</div><!-- row -->
		</div><!-- container -->
	</section><!-- our-doctor -->


  <!-- VIDEO FEATURETTE
	================================================== -->
	<section id="featurette" style="padding-top:5%;padding-bottom:5%;">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<h2>Watch the Video</h2>
					<iframe width="660" height="415" style="border-radius:5px;"src="https://www.youtube.com/embed/4nEmArmymMY" frameborder="0" allowfullscreen></iframe>
				</div><!-- end col -->
			</div><!-- row -->
		</div><!-- container -->
	</section><!-- featurette -->


  <!-- TESTIMONIALS
	================================================== -->
	<section id="kudos" style="padding-top:5%;padding-bottom:5%;">
		<div class="container">
			<div class="row">

				<div class="col-sm-8 col-sm-offset-2">
					<h2>What People Are Saying About Us</h2>

					<!-- TESTIMONIAL -->
					<div class="row testimonial">
						<div class="col-sm-4">
							<img src="assets/img/ben.png" alt="ben -Regular user">
						</div><!-- end col -->
						<div class="col-sm-8">
							<blockquote style="text-align:left;">
								I found Health Services a great source, and very helpfull, the tips and tricks are very usefull.
                I apply them in my daily life and I am looking forward to live a healthy lifestyle.
								<cite>&mdash; Rohan</cite>
							</blockquote>
						</div><!-- end col -->
					</div><hr><!-- row -->

					<!-- TESTIMONIAL -->
					<div class="row testimonial">
						<div class="col-sm-8">
							<blockquote class="blockquote-reverse">
							  Health Services is amazing and I honestly think it's the best source from any other sources I have joined a week ago.
                Will definitely be following the health tips in the future. Thanks to Health Services!
								<cite>&mdash; Ajay</cite>
							</blockquote>
						</div><!-- end col -->
            <div class="col-sm-4">
							<img src="assets/img/aj.png" alt="aj -Regular user">
						</div><!-- end col -->
					</div><hr><!-- row -->

					<!-- TESTIMONIAL -->
					<div class="row testimonial">
						<div class="col-sm-4">
							<img src="assets/img/ernest.png" alt="ernest -Regular user">
						</div><!-- end col -->
						<div class="col-sm-8">
							<blockquote style="text-align:left;">
								Health Services is an excillent free source. The content is superb, and you can seen the love and care put into every section. The posts in blog are good, and very helpful! I really can't believe this is free.
                I highly recommend taking advantage of this free source.
								<cite>&mdash; Manish</cite>
							</blockquote>
						</div><!-- end col -->
					</div><!-- row -->

				</div><!-- end col -->

			</div><!-- row -->
		</div><!-- container -->
	</section><!-- kudos -->


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



<!-- MODAL	================================================== -->
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope"></i> Subscribe to our Mailing List</h4>
				</div><!-- modal-header -->

				<div class="modal-body">
					<p>Simply enter your name and email! As a thank you for joining us, we wil give you some awesome tips, <em>for free!</em></p>

					<form class="form-inline" role="form">
						<div class="form-group">
							<label class="sr-only" for="subscribe-name">Your first name</label>
							<input type="text" class="form-control" id="subscribe-name" placeholder="Your first name">
						</div>
						<div class="form-group">
							<label class="sr-only" for="subscribe-email">and your email</label>
							<input type="text" class="form-control" id="subscribe-email" placeholder="and your email">
						</div>
						<input type="submit" class="btn btn-danger" value="Subscribe!">
					</form>

					<hr>

					<p><small>By providing your email you consent to receiving occasional promotional emails &amp; newsletters. <br>No Spam. Just good stuff. We respect your privacy &amp; you may unsubscribe at any time.</small></p>
				</div><!-- modal-body -->

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->
