<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php";?>

<!-- Page Content -->
<!-- FEATURE IMAGE
	================================================== -->
	<section class="feature-image feature-image-default" data-type="background" data-speed="2">
		<h1 style="font-size:40px;"><strong>Resources</strong></h1>
	</section>

  <!-- MAIN CONTENT
	================================================== -->
    <div class="container">
	    <div class="row" id="primary">

		    <div id="content" class="col-sm-12">

			    <section class="main-content">
			    	<p class="lead">
              Welcome to the Health Services resource page! On this page, we will provide you with useful resources and websites to help make
              your life healtheir a little bit easier.
              <strong>We recommend adding this page to your bookmarks for convenient future reference.</strong></p>
			    	<hr>

			    	<div class="resource-row clearfix">
				    	<div class="resource">
					    	<img src="images/onlyayurved.jpg" class="img-rounded" alt="onlyayurved" width="100%">
					    	<h3><a href="http://onlyayurved.com/" target="_blank" style="text-decoration:none; color:#dd5638;">Only Ayurved</a></h3>
					    	<p>Home Remedy Ayurveda Tips by Only Ayurved that now get ride of all kind of body diseases Acne Home Remedies Pimple, recover your Black Spot and more.
</p>
					    	<p>Ayurveda in Hindi, आयुर्वेद : आयुर्वेद तन, मन और आत्‍मा के बीच संतुलन बनाकर स्‍वास्‍थ्‍य में सुधार करता है। आयुर्वेद में न केवल ...</p>
					    	<a href="http://onlyayurved.com/" class="btn btn-success" target="_blank" style="text-decoration:none; ">Get started with Ayurveda</a>
				    	</div>
				    	<div class="resource">
					    	<center><img src="images/yoga.png" alt="Yoga" class="img-rounded" width="38%"></center>
					    	<h3><a href="http://yoga.com" target="_blank" style="text-decoration:none; color:#dd5638;">Yoga</a></h3>
					    	<p>Yoga.com is more than just a site about yoga with asanas, yoga videos and articles. It's a friendly community of beautiful people who chose to be free, open and more.</p>
					    	<p>An award winning yoga resource for the exploration of yoga postures, meditation techniques, pranayama, yoga therapy, and the history & philosophy of yoga.</p>
					    	<a href="http://yoga.com" class="btn btn-success" target="_blank" style="text-decoration:none; ">Get started with Yoga</a>
				    	</div>
				    	<div class="resource">
					    	<img src="images/SafeHomeopathic.jpg" class="img-rounded" alt="homeopathy" width="80%">
					    	<h3><a href="https://abchomeopathy.com/" target="_blank" style="text-decoration:none; color:#dd5638;">ABC Homeopathy</a></h3>
					    	<p>ABC Homeopathy provides Introduction to homeopathy, remedies shop, and online homeopathic remedy finder which suggests homeopathic remedies based on the symptoms entered.</p>
					    	<p>It provides homeopathic remedies whic are widely used in homeopathy.</p>
					    	<a href="https://abchomeopathy.com/" target="_blank" class="btn btn-success" style="text-decoration:none; ">ABC Homeopathy</a>
				    	</div>
			    	</div>
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
