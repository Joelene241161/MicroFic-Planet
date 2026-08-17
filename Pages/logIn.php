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

    <?php
    require_once '../config.php';

    // If already logged in, go to discover
    if (isset($_SESSION['userID'])) {
        header("Location: discover.php");
        exit();
    }

    // Handle login form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = trim($_POST['email']);
        $password = $_POST['passwordHash'];
        
        // Look up user by username
        $stmt = $conn->prepare("SELECT userID, email, passwordHash, profileImg FROM users WHERE userName = ? OR email = ?");
        $stmt->bind_param("ss", $email, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($user = $result->fetch_assoc()) {
            // Verify password
            if (password_verify($password, $user['passwordHash'])) {
                // Password matches — log them in
                $_SESSION['userID'] = $user['userID'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['profileImg'] = $user['profileImg'];
                header("Location: discover.php");
                exit();
            } else {
                $error = "Invalid username or password";
            }
        } else {
            $error = "Invalid username or password";
        }
    }
    ?>

    <?php if (isset($_SESSION['success'])): ?>
            <div class="success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="backTransparent">
        <h1 class="lato-bold TextCenter DarkBlueText">Welcome back</h1>
        <h4 class="lato-regular TextCenter WhiteTextBig">Enter your details to gain access to your account.</h4>

        <form class="formSignUp" method="POST" action="">
        
        <label for="email" class="mediumTop WhiteTextBig lato-regular">Email:</label><br>
        <input type="email" id="email" name="email" placeholder="Email address" required value="<?php echo htmlspecialchars($_POST['email'] ?? '') ?>"><br>

        <label for="passwordHash" class="smallMarginTop WhiteTextBig lato-regular">Password:</label><br>
        <input type="password" id="passwordHash" name="passwordHash" required>
        <br>

        <input type="submit" class="primary-Button mediumTop lato-bold" value="Log In" name="Submit">
        </form>

        <a href="../Pages/signUp.php"><p class="lato-regular WhiteTextLink TextCenter mediumTop">I don’t have an account</p></a>

    </div>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</body>
</html>