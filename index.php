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
    <!-- slider starts here -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./images/slide-1.jfif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./images/slide-2.jfif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./images/slide-3.jfif" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- slider ends here -->


    <!-- categories start here -->
    <div class="container my-3">
        <h2 class="text-center">iDiscuss -Browse Categories</h2>
        <div class="row">

        <!-- fetch all the categories -->
        <?php
        $sql = "SELECT * FROM `categories`";
        $result = mysqli_query($connection,$sql);
        $num = 1;
        while($row = mysqli_fetch_assoc($result)){

            $id= $row['category_id'];
            $category_name = $row['category_name'];
            $category_description= $row['category_description'];
            // use a for loop to iterate  through Categories
            echo '<div class="col-md-4 col-sm-12 text-center my-3">
            <div class="card" style="width: 18rem;">
                <img src="./images/card-'.$num.'.jfif" alt="No-img Found">
                <div class="card-body">
                    <h5 class="card-title"><a class="text-decoration-none text-dark" href="/forum/threadlist.php?id='.$id.'">'.$category_name.'</a></h5>
                    <p class="card-text">'.substr($category_description,0,80).'...</p>
                    <a href="#" class="btn btn-primary">View Threads</a>
                </div>
            </div>
        </div>';
        $num = $num + 1;
        }
        ?>
                

            

        </div>
    </div>

    <!-- categories ends here -->


    <!-- footer file add -->
    <?php include './partials/_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>