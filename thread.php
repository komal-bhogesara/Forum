<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Welcome to iForum</title>
</head>

<body>
    
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_user_id = $row['thread_user_id'];
            //to find the name of posted person
            $sql2 = "SELECT user_email FROM `users` WHERE user_sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $posted_by = $row2['user_email'];
        }
        $showalert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        // echo $method;
        if($method == "POST"){
            $comment = $_POST['comment'];
            $sno = $_POST['sno'];
            
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_time`, `comment_by`) VALUES ('$comment', '$id', current_timestamp(), '$sno')";
            $result = mysqli_query($conn, $sql);
            $showalert = true;

            if($showalert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your comment has been added!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            }
        }
    ?>
    <!-- category container starts here -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each other.
                No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Remain respectful of other members at all times.</p>
            <p>Posted by :  <em><?php echo $posted_by; ?></em></p>
        </div>
    </div>
    <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        echo '<div class="container">
                <h1 class="py-2">Post a Comment</h1>
                <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                    
                    <div class="form-group">
                        <label for="comment">Type your comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
                    </div>
                    <button type="submit" class="btn btn-success">Post Comment</button>
                </form>
            </div>';
        } else {
            echo '<div class="container">
                    <h1 class="py-2">Post a Comment</h1>
                    <p class="lead ">You are not logged in. Please login to post a comment.</p>
                </div>';
        }
    ?>
    
    

    <div class="container">
        <h1 class="py-2">Discussions</h1>
        <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $id = $row['comment_id'];
                $content = $row['comment_content'];
                $comment_time = $row['comment_time'];
                $thread_userid = $row['comment_by'];
                $sql2 = "SELECT user_email FROM `users` where user_sno = '$thread_userid'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);

                echo '<div class="media my-3">
                    <img class="mr-3" src="img/user_default.png" width="30px" alt="...">
                    <div class="media-body">
                    <p class="font-weight-bold my-0">'.$row2['user_email'].' at '.$comment_time.'</p>
                        '.$content.'
                    </div>
                </div>';
            }
            if($noResult){
                echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                    <p class="display-4">No comments found</p>
                    <p class="lead">Be the first person to comment.</p>
                    </div>
                </div>';
            }
        ?>

    </div>
    <?php include 'partials/_footer.php'; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>