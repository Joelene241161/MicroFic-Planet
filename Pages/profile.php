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

   <?php include "../components/navbarAccount.php";
    ?>

    <?php
    require_once '../config.php';

    // Check if user is logged in
    if (!isset($_SESSION['userID'])) {
        header("Location: logIn.php");
        exit();
    }

    // Get user data
    $stmt = $conn->prepare("SELECT * FROM users WHERE userID = ?");
    $stmt->bind_param("i", $_SESSION['userID']);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    // Handle logout
    if (isset($_GET['logout'])) {
        session_destroy();
        header("Location: login.php");
        exit();
    }
    ?>

    <section class="marginTop1 MarginLeft">

    <div class="d-flex row-3 mediumTop">
                 <div class="ImageContainer tinyMarginRight">
                 <img src="../uploads/<?php echo $user['profileImg'] ?>" 
             alt="Profile image" class="profileImg">
                 </div>
                <h2 class="lato-regular WhiteTextBig smallMarginRight">@<?php echo htmlspecialchars($user['userName']) ?></h2>
                <p class="LightBlueText lato-regular tinyMarginRight">34 followers</p>
                <p class="LightBlueText lato-regular">5 Stories</p>
            </div>

    <a href="./account.php" class="d-flex ItemsRight marginRight">
        <button type="button" class="secondary-Button d-flex row-12 buttonHeight lato-bold">
            <img src="../Assets/Icons/settings.png" class="marginRight IconSize">
                Account
        </button>
    </a>
    </section>

 <section>
    <div class="d-flex flex-row-lg bodyMargin flex-wrap">

    <!-- Not logged in/guest -->
        <?php //include "components/sidebarGuest.php";?>

    <!-- logged in -->
         <?php include "../components/sidebar.php";?>
    
        </div>  <!-- left side -->


        <div class="col-8 MarginLeft">
  
        <?php include "../components/selectGenre.php";?>
    
        <div class="CardGroup">
        <?php include "../components/StoryCardAccount.php";?>

        <?php include "../components/StoryCardAccount.php";?>
        <div>

        </div>  <!-- right side -->
    </div>  <!-- entire row -->

 </section>

    <?php include "../components/footerAccount.php";?>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
</body>
</html>