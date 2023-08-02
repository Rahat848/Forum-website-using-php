
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
    $id = $_GET['id'];

    $sql = "SELECT * FROM `categories` WHERE category_id = $id";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $category_name = $row['category_name'];
        $category_description = $row['category_description'];

    }
    ?>

    <!-- discussion post from frontent to data base; insert thread -->
    <?php
    $method = $_SERVER['REQUEST_METHOD'];
    // $th_title = $_POST['title'];
    // $th_desc = $_POST['desc'];
    $sno = $_SESSION['usersno'];
    $showAlert = false;
    if ($method == 'POST') {
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];

        $th_title = str_replace("<","&lt;","$th_title");
        $th_title = str_replace(">","&lt;","$th_title");

        $th_desc = str_replace("<","&lt;","$th_desc");
        $th_desc = str_replace(">","&lt;","$th_desc");
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_category_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";

        $result = mysqli_query($connection, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Thread has been added! please wait for community to respond.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }
    }
    ?>

    <!-- category container starts here -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to
                <?php echo $category_name; ?> forum!
            </h1>
            <p class="lead">
                <?php echo $category_description; ?>..
            </p>
            <hr class="my-4">
            <p>This is a peer to peer forum. Keep it friendly
                Be courteous and respectful. Appreciate that others may have an opinion different from yours.
                Stay on topic. When creating a new discussion thread, give a clear topic title and put your post in the
                appropriate category. When contributing to an existing discussion, try to stay 'on topic'. If something
                new comes up within a topic that you would like to discuss, start a new thread.
            </p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <?php
    // discussion form
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true) {


        echo '<div class="container">
        <h1>Start a discussion</h1>
        <form action="' . $_SERVER["REQUEST_URI"] . ' " method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">keep your title as sort and crisp as possible.</div>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="desc" name="desc"></textarea>
                <label for="floatingTextarea">Elaborate Your Concerns</label>
            </div>

            <button type="submit" class="btn btn-success mt-2">Submit</button>
        </form>
    </div>';
    } else {
        echo '<div class="container">
        <h1>Start a discussion</h1>
        <p class="lead">You are not loggedin. Please login to able to start a discussion.</p>
    </div>';
    }
    ?>
    <div class="container mb-5">
        <h1 class="py-2">Browse Questions</h1>
        <?php
        //link teka id newa jai ja ami index.php file teka categoru er vitor teka pass koracilam.
        $id = $_GET['id'];

        $sql = "SELECT * FROM `threads` WHERE thread_category_id = $id";
        $result = mysqli_query($connection, $sql);

        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;

            $title = $row['thread_title'];
            $desc = $row['thread_description'];
            $id = $row['thread_id'];
            $thread_time = $row['timestamp'];

        
    
            $thread_user_id = $row['thread_user_id'];
            $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($connection, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            
            
            echo ' <div class="media d-flex my-3">
            <img width="50px" height="50px" src="./images/userdefault.png" class="mr-3" alt="...">
            <div class="media-body">
                <h5 class="mt-0"><a class="text-dark text-decoration-none" href="thread.php?threadid=' . $id . '">' . $title . '</a></h5>
               ' . $desc . ' <br> <p class="fw-bold my-0"> Asked By:' . $row2['user_email'] . ' at ' . $thread_time . '</p>

            </div>

        </div>';
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <p class="display-4">No Threads Found</p>
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