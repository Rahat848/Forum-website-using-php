<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true) {
    $loggedin = true;
} else {
    $loggedin = false;
}
echo '<nav class="navbar navbar-expand-lg  navbar-dark  bg-dark ">
<div class="container-fluid">
    <a class="navbar-brand" href="/forum">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/forum">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/forum/about.php">About</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Top Categories
                </a>
                <ul class="dropdown-menu">';

                $sql = "SELECT category_name, category_id FROM `categories` LIMIT 3";
                $result = mysqli_query($connection,$sql);
                while($row = mysqli_fetch_assoc($result)){
                   echo '<li><a class="dropdown-item" href="threadlist.php?id='.$row['category_id'].'">'.$row['category_name'].'</a></li>';  
                }
               
            echo    '</ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/forum/contact.php">Contact</a>
            </li>
        </ul>';
        
if ($loggedin) {
    echo '<div class="mx-2 d-flex">
    <form class="d-flex" role="search" action="search.php" method="get">
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
            <p class="text-light my-0 mx-2">Welcome ' . $_SESSION['useremail'] . '</p>
            <a href="partials/_logout.php" class="btn btn-outline-danger mx-3">
            logout
        </a>
        </form>';
}
if (!$loggedin) {
    echo '
        <div class="mx-2 d-flex">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
            <button class="btn btn-outline-success mx-3" data-bs-toggle="modal" data-bs-target="#loginmodal">
                Login
            </button> 
            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#signupmodal">
                signup
            </button>';
}

echo '</div>
        
    </div>
</div>
</nav>';


include "_loginmodal.php";
include "_signupmodal.php";
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
    echo '<div class="alert my-0 alert-success alert-dismissible fade show" role="alert">
    <strong>success!</strong> you can now login.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>