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

<link rel="stylesheet" href="../css/main.css">

</head>   

<body class="backgroundImage">

    <?php include "../components/navbarGuest.php";?>

    <div class="backTransparent">
        <h1 class="lato-bold TextCenter DarkBlueText">Welcome to MicroFic Planet</h1>
        <h4 class="lato-regular TextCenter WhiteTextBig">Create an account to gain access to all of our amazing features.</h4>

        <form class="formSignUp" method="post">
        
        <label for="email" class="mediumTop WhiteTextBig lato-regular">Email:</label><br>
        <input type="email" id="email" name="email" placeholder="Email address" required><br>

        <label for="pwd" class="smallMarginTop WhiteTextBig lato-regular">Password:</label><br>
        <input type="password" id="pwd" name="pwd" required>
        <br>

        <label for="uname" class="smallMarginTop WhiteTextBig lato-regular">Username:</label><br>
        <input type="text" id="uname" placeholder="Username" required><br>

        <label for="options" class="smallMarginTop WhiteTextBig lato-regular">Choose a role:</label><br>

        <input type="radio" class="btn-check" name="options" id="reader" autocomplete="off" checked>
            <label class="secondary-Button btn" for="reader" data-tooltip="Can read stories, but can't post them.">Reader</label>

            <input type="radio" class="btn-check" name="options" id="writer" autocomplete="off">
            <label class="secondary-Button btn" for="writer" data-tooltip="Writers can post and read stories.">Writer</label>
            <br>

        <input type="submit" class="primary-Button mediumTop lato-bold" value="Create Account" name="Submit">
        </form>
         <?php
    
            if(isset($_POST['Submit'])) {
                echo'<script> window.location="discover.php"; </script> ';
                exit; 
            }
            ?>
        <a href="../Pages/logIn.php"><p class="lato-regular WhiteTextLink TextCenter marginTop1">I already have an account</p></a>

    </div>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</body>
</html>