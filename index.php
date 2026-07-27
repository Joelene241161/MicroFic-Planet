<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">

    <meta name="author" content="Joelene du Toit 241161">
    <meta name="keywords" content="Social platform where users can post stories, specifically microfiction or flashfiction">
    <title>
        MicroFic Planet
    </title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="css/main.css">

</head>   

<body class="BackgroundBody">

   <?php include "components/navbar.php";
    ?>

 <section>
    <div class="d-flex flex-row-lg bodyMargin">

    <!-- Not logged in/guest
        <div class="col-3 CTACard">
            <h1 class="LightBlueText lato-bold">Join our crew of micro fiction writers</h1>
            <div class="CTATextCard marginTop">
                <h5 class="lato-regular WhiteTextBig">Our stories are as short as possible, ranging from 6 to 300 words long. Let the simplicity feed your creativity and open you and your reader’s minds to imagination and diverse interpretations. </h5>
            </div>
            <div class="d-flex col-11 ItemsRight marginTop">
        <button type="button" class="secondary-Button marginRight">Log In</button>
        <button type="button" class="primary-Button">Sign up</button>
      </div>
        </div> -->

    <!-- logged in -->
        <?php include "components/sidebar.php";
?>
    
        </div>  <!-- left side -->


        <div class="col-8 MarginLeft">
           <div class="dropdown mediumTop">
        <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Story Genre
        </a>

        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Adventure</a></li>
            <li><a class="dropdown-item" href="#">Dystopian</a></li>
            <li><a class="dropdown-item" href="#">Fantasy</a></li>
            <li><a class="dropdown-item" href="#">History</a></li>
            <li><a class="dropdown-item" href="#">Horror</a></li>
            <li><a class="dropdown-item" href="#">Mystery</a></li>
            <li><a class="dropdown-item" href="#">Poetry</a></li>
            <li><a class="dropdown-item" href="#">Romance</a></li>
            <li><a class="dropdown-item" href="#">Sci-fi</a></li>
            <li><a class="dropdown-item" href="#">Thriller</a></li>
        </ul>
    </div>
        <?php include "components/StoryCard.php";
?>
        </div>  <!-- right side -->
    </div>  <!-- entire row -->

 </section>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
</body>
</html>