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

    <!-- logged in -->
        <div class="col-3 CTACard">
            <!-- Hide button if not writer -->
             <?php if ($user['role'] === 'writer'): ?>
                <a href="./createStory.php">
                    <button type="button" class="primary-Button col-12 marginBottomBig">Create a new story +</button>
                </a>
            <?php endif; ?>


            <div class="CTATextCard marginTop">
            <div class="d-flex col-11 marginTop">
                 <img src="../Assets/Icons/Profile.png" class="iconStyle smallMarginRight">
                <h4 class="WhiteTextBig lato-bold">Followed Accounts</h4>
            </div>  <!-- menu content -->

        <div>

            <div class="d-flex col-11 marginTop">
                 <div class="ImageContainer marginRight">
                 <img src="../Assets/profile.jpg" class="profileImg">
                 </div>

                 <a href="./profile.php">
                <h5 class="lato-regular WhiteTextLink smallMarginTop">Username</h5>
                </a>

            </div>  <!-- One profile -->

            <div class="d-flex col-11 marginTop">
                 <div class="ImageContainer marginRight">
                 <img src="../Assets/profile.jpg" class="profileImg">
                 </div>
                <a href="./profile.php">
                <h5 class="lato-regular WhiteTextLink smallMarginTop">Username</h5>
                </a>
            </div>  <!-- One profile -->

            <button type="button" class="secondary-Button marginTop" data-bs-toggle="modal" data-bs-target="#followedModal">Show all</button>

    </div>

            </div>  <!-- menu item top -->

        <!-- second section start -->
            <div class="CTATextCard marginTop">
            <div class="d-flex col-11 marginTop">
                 <img src="../Assets/Icons/Profile.png" class="iconStyle smallMarginRight">
                 <h4 class="WhiteTextBig lato-bold">Saved Stories</h4>
            </div>  <!-- menu content -->

        <div>

             <div class="d-flex col-11 marginTop">
                 <div class="ImageContainer marginRight">
                 <img src="../Assets/profile.jpg" class="profileImg">
                 </div>
                <h5 class="lato-regular WhiteTextLink smallMarginTop marginRight">Story Name</h5>
                <h6 class="DarkBlueText lato-regular mediumTop">Username</h6>
            </div>  <!-- One profile -->

            <div class="d-flex col-11 marginTop">
                 <div class="ImageContainer marginRight">
                 <img src="../Assets/profile.jpg" class="profileImg">
                 </div>
                <h5 class="lato-regular WhiteTextLink smallMarginTop marginRight">Story Name</h5>
                <h6 class="DarkBlueText lato-regular mediumTop">Username</h6>
            </div>  <!-- One profile -->

            <button type="button" class="secondary-Button marginTop" data-bs-toggle="modal" data-bs-target="#savedModal">Show all</button>
        </div>

            </div>  <!-- menu item bottom -->

            <!-- Modal followed accounts -->
<div class="modal fade" id="followedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-theme="dark">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 lato-bold" id="exampleModalLabel">
                <h4 class="WhiteTextBig lato-bold">Followed Accounts</h4>
            </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="lato-regular">These are all of the accounts you follow:</p>

         <div class="d-flex col-11 marginTop">
                 <div class="ImageContainer marginRight">
                 <img src="../Assets/profile.jpg" class="profileImg">
                 </div>
                <h5 class="lato-regular WhiteTextLink smallMarginTop">Username</h5>
            </div>  <!-- One profile -->

            <div class="d-flex col-11 marginTop">
                 <div class="ImageContainer marginRight">
                 <img src="../Assets/profile.jpg" class="profileImg">
                 </div>
                <h5 class="lato-regular WhiteTextLink smallMarginTop">Username</h5>
            </div>  <!-- One profile -->
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal saved stories -->
<div class="modal fade" id="savedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-theme="dark">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 lato-bold" id="exampleModalLabel">
                <h4 class="WhiteTextBig lato-bold">Saved stories</h4>
            </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="lato-regular">These are all of the stories that you have saved:</p>

         <div class="d-flex col-11 marginTop">
                 <div class="ImageContainer marginRight">
                 <img src="../Assets/profile.jpg" class="profileImg">
                 </div>
                <h5 class="lato-regular WhiteTextLink smallMarginTop marginRight">Story Name</h5>
                <h6 class="lato-regular mediumTop">Username</h6>
            </div>  <!-- One profile -->

            <div class="d-flex col-11 marginTop">
                 <div class="ImageContainer marginRight">
                 <img src="../Assets/profile.jpg" class="profileImg">
                 </div>
                <h5 class="lato-regular WhiteTextLink smallMarginTop marginRight">Story Name</h5>
                <h6 class="lato-regular mediumTop">Username</h6>
            </div>  <!-- One profile -->
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
   
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
</body>
</html>