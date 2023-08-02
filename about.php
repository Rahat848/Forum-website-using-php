<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome To iDiscuss - Coding Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        #aboutcontainer {
            min-height: 82vh;
        }
    </style>
</head>

<body>
    <?php include './partials/_dbconnect.php'; ?>

    <!-- header file add -->
    <?php include './partials/_header.php'; ?>

    <div class="container aos-init aos-animate" data-aos="fade-up" id="aboutcontainer">
        <div class="row gx-0">

            <div class="col-lg-6 d-flex flex-column justify-content-center aos-init aos-animate" data-aos="fade-up"
                data-aos-delay="200">
                <div class="content">
                    <h3>This is Forum Website.</h3>
                    <h2>Using PHP ,MySQL ,Bootstrap to create forum website.</h2>
                    <p>
                        Quisquam vel ut sint cum eos hic dolores aperiam. Sed deserunt et. Inventore et et dolor
                        consequatur itaque ut voluptate sed et. Magnam nam ipsum tenetur suscipit voluptatum nam et est
                        corrupti.Earthly ere dares not men whose he, a the tis harold full had native himnot, he was her though seek of harold, sun and had sins the beyond gild. Present.
                    </p>

                    <p class="d-inline-flex gap-1">
                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            Read More...
                        </a>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            Dolor et sed consetetur sanctus lorem. Eirmod at sanctus elitr dolore. Justo ipsum sadipscing est amet amet, at voluptua nonumy amet et, amet diam diam at ipsum ut justo rebum.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-flex align-items-center aos-init aos-animate" data-aos="zoom-out"
                data-aos-delay="200">
                <img src="./images/forumabout.jpg" class="img-fluid" alt="">
            </div>

        </div>
    </div>

    <!-- footer file add -->
    <?php include './partials/_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>