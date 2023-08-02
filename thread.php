<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome To iDiscuss - Coding Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <!-- header file add -->
    <?php include './partials/_dbconnect.php'; ?>

    <?php include './partials/_header.php'; ?>
    <?php
    //link teka id newa jai ja ami index.php file teka categoru er vitor teka pass koracilam.
    $id = $_GET['threadid'];

    $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $description = $row['thread_description'];
        $thread_user_id = $row['thread_user_id'];

        //query the users table to find out the name of user
        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($connection, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];


    }
    ?>

    <?php
    $method = $_SERVER['REQUEST_METHOD'];
    //insert into thread db
    $showAlert = false;
    if ($method == 'POST') {
        $comment = $_POST['comment'];
        $comment = str_replace("<","&lt;","$comment");
        $comment = str_replace(">","&lt;","$comment");
        $sno = $_SESSION['usersno'];
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";

        $result = mysqli_query($connection, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your comment has been added!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }
    }
    ?>
    <!-- category container starts here -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">
                <?php echo $title; ?>
            </h1>
            <p class="lead">
                <?php echo $description; ?>..
            </p>
            <hr class="my-4">
            <p>This is a peer to peer forum. Keep it friendly
                Be courteous and respectful. Appreciate that others may have an opinion different from yours.
                Stay on topic. When creating a new discussion thread, give a clear topic title and put your post in the
                appropriate category. When contributing to an existing discussion, try to stay 'on topic'. If something
                new comes up within a topic that you would like to discuss, start a new thread.
            </p>
            <!-- <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a> -->
            <p>Posted By: <b><?php echo "$posted_by"; ?></b></p>
        </div>
    </div>

    <!-- comment form -->
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true) {
        echo '<div class="container">
        <h1>Post A Comment</h1>
        <form action="' . $_SERVER['REQUEST_URI'] . ' " method="POST">
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="comment"
                    name="comment"></textarea>
                <label for="floatingTextarea">Type Your Comment</label>
            </div>

            <button type="submit" class="btn btn-success mt-2">Post Comment</button>
        </form>
    </div>';
    } else {
        echo '<div class="container">
    <h1>Post A Comment</h1>
        <p class="lead">You are not loggedin. Please login to able to post a comment.</p>
    </div>';
    }
    ?>

    <div class="container mb-5">
        <h1 class="py-2">Discussions</h1>

        <?php
        $id = $_GET['threadid'];

        $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
        $result = mysqli_query($connection, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];

            $thread_user_id = $row['comment_by'];
            $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($connection, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo ' <div class="media d-flex my-3">
            <img width="50px" height="50px" src="./images/userdefault.png" class="mr-3" alt="...">
            <div class="media-body">
            <p class="fw-bold my-0">' . $row2['user_email'] . ' at ' . $comment_time . '</p>
               ' . $content . '
            </div>
        </div>';
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <p class="display-4">No Comments Found</p>
              <p class="lead">Be the first person to ask the question.</p>
            </div>
          </div>';
        }
        ?>
    </div>

    <!-- footer file add -->
    <?php include './partials/_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>