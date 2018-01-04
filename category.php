<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php";?>



<!-- Page Content -->
<?php include "includes/blogTitle.php";?>
<div class="container">
    <div class="row">

       <!-- Blog Entries Column -->
        <div class="col-md-8">
           <?php
            if(isset($_GET['category']))
            {
                $post_category_id = escape($_GET['category']);
            }
            $query = "SELECT * FROM posts WHERE post_category_id = {$post_category_id} ";
            $select_all_posts_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($select_all_posts_query);
            if($count>0){
            while($row = mysqli_fetch_assoc($select_all_posts_query)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'],0,200);
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_status = $row['post_status'];
                $post_views_count = $row['post_views_count'];
            ?>

            <!-- First Blog Post -->
            <div class="panel panel-default">
              <div class="panel-body" style="padding-top:0px;">
                <h3>
                    <a href="post.php?p_id=<?php echo $post_id; ?>" style="color:#0D47A1; text-decoration:none;"><?php echo $post_title; ?> </a>
                </h3>
                <?php
                  if(isset($_SESSION['user_role'])){
                      if($_SESSION['user_role'] === 'admin'){
                        if(isset($_GET['p_id'])){
                          $the_post_id = $_GET['p_id'];
                          echo "<a href='admin/posts.php?source=edit_post&p_id={$the_post_id}' class='pull-right'>Edit Post</a>";
                        }
                      }
                  }
                 ?>
                <hr>
                <div style="font-size:13px">
                    <i class="fa fa-user" style="color:#337ab7;"></i> <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                     &#160;<span class="text-success"><i class="fa fa-clock-o"></i> <time><?php echo $post_date; ?></time></span>
                     &#160;<span class="text-info"><i class="fa fa-tags"></i> Tagged: <?php echo $post_tags;?></span>
                     &#160;<span class="badge pull-right bg-success"><?php echo $post_comment_count;?></span>
                </div>
                <br>
                  <a href="post.php?p_id=<?php echo $post_id; ?>">
                     <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="<?php echo $post_image;?>" >
                  </a>
                <br/>
                <p>
                    <?php echo $post_content; ?>...<a href="post.php?p_id=<?php echo $post_id; ?>">
                        Read More &raquo;
                    </a>
                </p>
              </div><!-- End of panel body -->
            </div><!-- End of panel -->

            <?php } }
            else{
              echo "<h1 class='text-center text-info'>
                <i class='fa fa-frown-o fa-5x' aria-hidden='true'></i><br/>Sorry... No Post Found.
              </h1>";
            }
            ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php include "includes/sidebar.php"; ?>
    </div>
    <!-- /.row -->
</div>
