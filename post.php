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
            if(isset($_GET['p_id'])){
                $the_post_id = escape($_GET['p_id']);
                $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$the_post_id} ";
                $send_query = mysqli_query($connection, $query);
                if(!$send_query){
                    die("<h1 class='text-center'><i class='fa fa-frown-o fa-5x'></i><br/>Sorry... No Post.</h1>.");
                }

            $query = "SELECT * FROM posts WHERE post_id = {$the_post_id} ";
            $select_all_posts_query = mysqli_query($connection, $query);
            $found_posts = mysqli_num_rows($select_all_posts_query);

            if($found_posts > null){
                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_status = $row['post_status'];
                    $post_views_count = $row['post_views_count'];
                ?>

                <!-- Displaying Blog Post -->
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


                <?php }
            }
            else{
              echo "<h1 class='text-center'><i class='fa fa-frown-o fa-5x'></i><br/>Sorry... No Post.</h1>";
            }


          }//End of if(isset($_GET['p_id'])).
            else{
                header("Location: index.php");
            }

            ?>

            <!-- Blog Comment -->

            <?php
                if(isset($_POST['create_comment'])){
                    $the_post_id = escape($_GET['p_id']);
                    if(empty($_POST['comment_content'])){
                      echo "<script>
                        alert('comment field is required.');
                      </script>";
                    }
                    else{
                      $comment_content = escape($_POST['comment_content']);

                      $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, ";
                      $query .= "comment_status, comment_date) Values ($the_post_id,'{$_SESSION['username']}','{$_SESSION['user_email']}', ";
                      $query .= "'{$comment_content}', 'Unapproved', now() ) ";

                      $careate_comment_query = mysqli_query($connection, $query);

                      if(!$careate_comment_query){
                          die('Query Failed. '.mysqli_error($connection));
                      }
                    }
                }

                if(isset($_POST['doctor_comment'])){
                  $the_post_id = escape($_GET['p_id']);
                  if(empty($_POST['comment_content'])){
                    echo "<script>
                      alert('comment field is required.');
                    </script>";
                  }
                  else{
                    $comment_content = escape($_POST['comment_content']);
                    $comment_author = $_SESSION['doc_username'];
                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, ";
                    $query .= "comment_status, comment_date) Values ($the_post_id,'{$comment_author}','{$_SESSION['doc_email']}', ";
                    $query .= "'{$comment_content}', 'Unapproved', now() ) ";
                    $careate_comment_query = mysqli_query($connection, $query);
                    if(!$careate_comment_query){
                        die('Query Failed. '.mysqli_error($connection));
                    }
                  }
                }
            ?>

            <!-- Comment Form  users -->
            <?php
              if(isset($_SESSION['user_role']) != false){
                if(escape($_SESSION['user_role']) === 'subscriber' || escape($_SESSION['user_role']) === 'admin' || escape($_SESSION['doc_role']) === 'doctor' ){
            ?>
            <div class="well">
                <h4><strong>Leave Comment</strong></h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <label for="Comment"></label>
                        <textarea name="comment_content" id="Comment" rows="3" class="form-control" style="resize:none;" required></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary btn-sm pull-right">Comment</button><br/>
                </form>
            </div><!-- end of well -->

            <?php }
                }
          ?>
          <!-- Comment form for doctors -->
          <?php if(isset($_SESSION['doc_role']) != false): ?>
              <?php if($_SESSION['doc_role'] === 'doctor'): ?>
                  <div class="well">
                      <h4><strong>Leave Comment</strong></h4>
                      <form action="" method="post" role="form">
                          <div class="form-group">
                              <label for="Comment"></label>
                              <textarea name="comment_content" id="Comment" rows="3" class="form-control" style="resize:none;" required></textarea>
                          </div>
                          <button type="submit" name="doctor_comment" class="btn btn-primary btn-sm pull-right">Comment</button><br/>
                      </form>
                  </div><!-- end of well -->
              <?php endif; ?>
          <?php endif; ?>
            <hr/>


            <div class="well" style="background:#FAFAFA;">
            <h4>Comments</h4><hr>
            <!-- Posted Comments -->
            <?php
            $query = "SELECT * FROM comments  WHERE comment_post_id = {$the_post_id} AND comment_status = 'approved' ORDER BY comment_date DESC";
            $select_comment_query = mysqli_query($connection, $query);
            if(!$select_comment_query){
                die('Query Failed. '.mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($select_comment_query)){
                $comment_author = $row['comment_author'];
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                ?>

                <!-- Comment -->
                <div class="media">
                    <span class="pull-left">
                        <img src="" alt="" class="media-object img-circle">
                    </span>
                    <div class="media-body">
                          <p title="<?php echo $comment_author.' commented'; ?>">
                              <?php echo $comment_content; ?>
                          </p>
                        <h6 class="media-heading">
                            By: <?php echo $comment_author; ?> <small>on <?php echo $comment_date; ?> </small>
                        </h6>
                    </div>
                </div><hr>

            <?php
            }
            ?>
          </div><!-- End of well -->

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>
    </div>
    <!-- /.row -->
</div>
