<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome To iDiscuss - Coding Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        #maincontainer {
            min-height: 77vh;
        }
    </style>
</head>

<body>
    <!-- header file add -->
    <?php include './partials/_dbconnect.php'; ?>

    <?php include './partials/_header.php'; ?>



    <div class="container my-3" id="maincontainer">
        <h1>Search results for <em>
                <?php echo $_GET['search']; ?>
            </em></h1>

        <?php
        $noResult = true;
        $query = $_GET['search'];
        $sql = "SELECT * FROM `threads` WHERE MATCH(`thread_title`,`thread_description`) against ('$query')";
        $result = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['thread_title'];
            $description = $row['thread_description'];
            $thread_id = $row['thread_id'];
            $url = "/thread.php?threadid=.'$thread_id.'";
            $noResult = false;
            //display search result
            echo ' <div class="result">
            <h3><a class="text-decoration-none text-dark" href="' . $url . '" class="text-dark">' . $title . '</a> </h3>
            <p>' . $description . '</p>
        </div>';

        }
        if ($noResult) {
            echo '<div class="container">

        <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <p class="display-4">No search data Found</p>
              <p class="lead">Suggestions :
             <ul>
              <li>Make sure that all works are spelled correctly.</li>
              <li>Try different keywords.</li>
              <li>Try more genaral keywords.</li>
              </ul>
              </p>
            </div>
          </div>    
          </div>';
        }

        ?>
    </div>
    <!-- search result ends here -->


    <!-- footer file add -->
    <?php include './partials/_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>