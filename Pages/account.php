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

    <?php include "../components/navbarAccount.php";?>

        <div class="backTransparent">
        <h1 class="lato-bold TextCenter DarkBlueText marginBottomBig">Your account</h1>

        <h5 class="lato-regular TextCenter WhiteTextBig marginTop"><strong>Username:</strong> Sloth456Friend</h5>

        <h5 class="lato-regular TextCenter WhiteTextBig marginTop"><strong>Email:</strong> Sloth456Friend@gmail.com</h5>

        <h5 class="lato-regular TextCenter WhiteTextBig marginTop"><strong>Account type:</strong> Writer</h5>

        <div class="d-flex col-lg justify-content-center marginTop">
            <button class="d-flex row-7 tertiaryButton marginRight lato-bold ">   
                <img src="../Assets/Icons/edit.png" class="marginRight IconSize">
                <p class="mediumTop lato-bold textWidth MarginLeft">Edit</p>
            </button>
        </div>

        <div class="d-flex marginTop">
             <button type="button" class="secondary-Button d-flex row-12 buttonHeight lato-regular marginRight">
                Log Out
        </button>
        <button type="button" class="btn btn-danger">Delete Account</button>
        </div>
        

    </div>
   
    <?php include "../components/footerAccount.php";?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</body>
</html>