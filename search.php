<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"?>



<!-- Page Content -->
<?php include"includes/blogTitle.php"; ?>
<div class="container">
    <div class="row">

     <!-- Blog Entries Column -->
      <div class="col-md-8">
      <?php

        $search = escape($_POST['search']);
        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
        $search_query = mysqli_query($connection, $query);

        if(!$search_query){
            die("Query Failed ".mysqli_error($connection));
        }

        $count = mysqli_num_rows($search_query);

        if($count == 0){
            echo "<h1><span style='color:red;'>No Result Found</span></h1>";
        }
        else{

            while($row = mysqli_fetch_assoc($search_query)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_status = $row['post_status'];
                $post_views_count = $row['post_views_count'];

                if($post_status == 'published'){

            ?>

            <!-- First Blog Post -->
            <div class="panel panel-default">
              <div class="panel-body" style="padding-top:0px;">
                <h3>
                    <a href="post.php?p_id=<?php echo $post_id; ?>" style="color:#0D47A1; text-decoration:none;"><?php echo $post_title; ?> </a>
                </h3><hr>
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
            <?php
          }#End of if($post_status == 'published')

          }#End of while.

        }#End of else of if($count==0)

    ?>
        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php include "includes/sidebar.php"; ?>
    </div>
    <!-- /.row -->
</div>
