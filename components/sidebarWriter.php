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

    // Followers
    $stmtFollowers = $conn->prepare("
        SELECT u.userID, u.userName, u.profileImg
        FROM followers f
        JOIN users u ON f.followerID = u.userID
        WHERE f.userID = ?
        ORDER BY f.created_at DESC
        LIMIT 2
    ");
    $stmtFollowers->bind_param("i", $_SESSION['userID']);
    $stmtFollowers->execute();
    $resultFollowers = $stmtFollowers->get_result();

    // Token gifts
    $stmtTokens = $conn->prepare("
        SELECT u.userID, u.userName, u.profileImg, tg.amount
        FROM tokengifts tg
        JOIN users u ON tg.giftedFrom = u.userID
        WHERE tg.giftedTo = ?
        ORDER BY tg.created_at DESC
        LIMIT 2
    ");
    $stmtTokens->bind_param("i", $_SESSION['userID']);
    $stmtTokens->execute();
    $resultTokens = $stmtTokens->get_result();

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
                <h4 class="WhiteTextBig lato-bold">Your followers</h4>
            </div>  <!-- menu content -->

        <div>

                    <div>
    <?php while ($f = $resultFollowers->fetch_assoc()): ?>
                <div class="d-flex col-11 marginTop">
                    <div class="ImageContainer marginRight">
                        <img src="../uploads/<?php echo htmlspecialchars($f['profileImg']); ?>" class="profileImg">
                    </div>
                    <a href="./profile.php?userID=<?php echo $f['userID']; ?>">
                        <h5 class="lato-regular WhiteTextLink smallMarginTop">@<?php echo htmlspecialchars($f['userName']); ?></h5>
                    </a>
                </div>
            <?php endwhile; ?>
    </div>

            <button type="button" class="secondary-Button marginTop" data-bs-toggle="modal" data-bs-target="#followersModal">Show all</button>

    </div>

            </div>  <!-- menu item top -->

        <!-- second section start -->
            <div class="CTATextCard marginTop">
            <div class="d-flex col-11 marginTop">
                 <img src="../Assets/Icons/giftIcon.png" class="iconStyle smallMarginRight">
                 <h4 class="WhiteTextBig lato-bold">Gifted tokens</h4>
            </div>  <!-- menu content -->

        <div>

                 <div>
        <?php while ($t = $resultTokens->fetch_assoc()): ?>
                <div class="d-flex col-11 marginTop">
                    <img src="../Assets/Icons/Sparkles.png" class="iconStyle smallMarginRight">
                    <p class="lato-regular smallMarginRight"><?php echo htmlspecialchars($t['amount']); ?></p>
                    <div class="ImageContainer marginRight">
                        <img src="../uploads/<?php echo htmlspecialchars($t['profileImg']); ?>" class="profileImg">
                    </div>
                    <a href="./profile.php?userID=<?php echo $t['userID']; ?>">
                        <h5 class="lato-regular WhiteTextLink smallMarginTop">@<?php echo htmlspecialchars($t['userName']); ?></h5>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>

            <button type="button" class="secondary-Button marginTop" data-bs-toggle="modal" data-bs-target="#tokensModal">Show all</button>
        </div>

            </div>  <!-- menu item bottom -->

            <!-- Modal followers -->
<div class="modal fade" id="followersModal" tabindex="-1" aria-labelledby="followersLabel" aria-hidden="true" data-bs-theme="dark">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 lato-bold" id="followersLabel">
          <h4 class="WhiteTextBig lato-bold">Your Followers</h4>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="lato-regular">These are all of the accounts following you:</p>

        <?php
        $stmtAllFollowers = $conn->prepare("
            SELECT u.userID, u.userName, u.profileImg
            FROM followers f
            JOIN users u ON f.followerID = u.userID
            WHERE f.userID = ?
            ORDER BY f.created_at DESC
        ");
        if (!$stmtAllFollowers) {
            die("Prepare failed: " . $conn->error);
        }
        $stmtAllFollowers->bind_param("i", $_SESSION['userID']);
        $stmtAllFollowers->execute();
        $resultAllFollowers = $stmtAllFollowers->get_result();

        while ($f = $resultAllFollowers->fetch_assoc()) {
            echo '<div class="d-flex col-11 marginTop">';
            echo '<div class="ImageContainer marginRight">';
            echo '<img src="../uploads/' . htmlspecialchars($f['profileImg']) . '" class="profileImg">';
            echo '</div>';
            echo '<a href="./profile.php?userID=' . urlencode($f['userID']) . '">';
            echo '<h5 class="lato-regular WhiteTextLink smallMarginTop">@' . htmlspecialchars($f['userName']) . '</h5>';
            echo '</a>';
            echo '</div>';
        }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal gifted tokens -->
<div class="modal fade" id="tokensModal" tabindex="-1" aria-labelledby="tokensLabel" aria-hidden="true" data-bs-theme="dark">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 lato-bold" id="tokensLabel">
          <h4 class="WhiteTextBig lato-bold">Gifted Tokens</h4>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="lato-regular">These are all of the tokens gifted to you:</p>

        <?php 
        $stmtAllTokens = $conn->prepare("
            SELECT u.userID, u.userName, u.profileImg, tg.amount
            FROM tokengifts tg
            JOIN users u ON tg.giftedFrom = u.userID
            WHERE tg.giftedTo = ?
            ORDER BY tg.created_at DESC
        ");
        if (!$stmtAllTokens) {
            die("Prepare failed: " . $conn->error);
        }
        $stmtAllTokens->bind_param("i", $_SESSION['userID']);
        $stmtAllTokens->execute();
        $resultAllTokens = $stmtAllTokens->get_result();

        while ($t = $resultAllTokens->fetch_assoc()) {
            echo '<div class="d-flex col-11 marginTop">';
            echo '<img src="../Assets/Icons/Sparkles.png" class="iconStyle smallMarginRight">';
            echo '<p class="lato-regular smallMarginRight">' . htmlspecialchars($t['amount']) . '</p>';
            echo '<div class="ImageContainer marginRight">';
            echo '<img src="../uploads/' . htmlspecialchars($t['profileImg']) . '" class="profileImg">';
            echo '</div>';
            echo '<a href="./profile.php?userID=' . urlencode($t['userID']) . '">';
            echo '<h5 class="lato-regular WhiteTextLink smallMarginTop">@' . htmlspecialchars($t['userName']) . '</h5>';
            echo '</a>';
            echo '</div>';
        }
        ?>
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