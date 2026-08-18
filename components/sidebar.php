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

    // Get followed accounts
    $stmtFollowed = $conn->prepare("
        SELECT u.userID, u.userName, u.profileImg
        FROM followers f
        JOIN users u ON f.userID = u.userID 
        WHERE f.followerID = ?
        ORDER BY f.created_at DESC
        LIMIT 2
    ");
    $stmtFollowed->bind_param("i", $_SESSION['userID']);
    $stmtFollowed->execute();
    $resultFollowed = $stmtFollowed->get_result();

    // Get stories saved by the logged-in user
    $stmtSaved = $conn->prepare("
    SELECT st.StoryID, st.title, u.userName, u.profileImg
    FROM savedstories ss
    JOIN story st ON ss.storyID = st.StoryID
    JOIN users u ON st.userID = u.userID
    WHERE ss.userID = ?
    ORDER BY ss.created_at DESC
    LIMIT 2
    ");
    if (!$stmtSaved) {
        die("Prepare failed: " . $conn->error);
    }
    $stmtSaved->bind_param("i", $_SESSION['userID']);
    $stmtSaved->execute();
    $resultSaved = $stmtSaved->get_result();

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

                    <div>
    <?php while ($f = $resultFollowed->fetch_assoc()): ?>
        <div class="d-flex col-11 marginTop">
            <div class="ImageContainer marginRight">
                <img src="../uploads/<?php echo htmlspecialchars($f['profileImg']); ?>" class="profileImg">
            </div>
            <a href="./profile.php?userID=<?php echo $f['userID']; ?>">
                <h5 class="lato-regular WhiteTextLink smallMarginTop">@<?php echo htmlspecialchars($f['userName']); ?></h5>
            </a>
        </div>  <!-- One profile -->
    <?php endwhile; ?>
    </div>

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

                 <div>
        <?php while ($s = $resultSaved->fetch_assoc()): ?>
            <div class="d-flex col-11 marginTop">
                <div class="ImageContainer marginRight">
                    <img src="../uploads/<?php echo htmlspecialchars($s['profileImg']); ?>" class="profileImg">
                </div>
                <a href="./individualStory.php?storyID=<?php echo $s['StoryID']; ?>">
                    <h5 class="lato-regular WhiteTextLink smallMarginTop marginRight">
                        <?php echo htmlspecialchars($s['title']); ?>
                    </h5>
                </a>
                <h6 class="DarkBlueText lato-regular mediumTop">
                    @<?php echo htmlspecialchars($s['userName']); ?>
                </h6>
            </div>  <!-- One saved story -->
        <?php endwhile; ?>
        </div>

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

           <?php
        $stmtAllFollowed = $conn->prepare("
            SELECT u.userID, u.userName, u.profileImg
            FROM followers f
            JOIN users u ON f.userID = u.userID
            WHERE f.followerID = ?
            ORDER BY f.created_at DESC
        ");
        if (!$stmtAllFollowed) {
            die("Prepare failed: " . $conn->error);
        }
        $stmtAllFollowed->bind_param("i", $_SESSION['userID']);
        $stmtAllFollowed->execute();
        $resultAllFollowed = $stmtAllFollowed->get_result();

        while ($f = $resultAllFollowed->fetch_assoc()) {
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

          <?php 
        $stmtAllSaved = $conn->prepare("
            SELECT st.StoryID, st.title, u.userID, u.userName, u.profileImg
            FROM savedstories ss
            JOIN story st ON ss.storyID = st.StoryID
            JOIN users u ON st.userID = u.userID
            WHERE ss.userID = ?
            ORDER BY ss.created_at DESC
        ");
        if (!$stmtAllSaved) {
            die("Prepare failed: " . $conn->error);
        }
        $stmtAllSaved->bind_param("i", $_SESSION['userID']);
        $stmtAllSaved->execute();
        $resultAllSaved = $stmtAllSaved->get_result();

        while ($s = $resultAllSaved->fetch_assoc()) {
            echo '<div class="d-flex col-11 marginTop">';
            echo '<div class="ImageContainer marginRight">';
            echo '<img src="../uploads/' . htmlspecialchars($s['profileImg']) . '" class="profileImg">';
            echo '</div>';
            echo '<a class="marginRight" href="./individualStory.php?storyID=' . urlencode($s['StoryID']) . '">';
            echo '<h5 class="lato-regular WhiteTextLink smallMarginTop marginRight">' . htmlspecialchars($s['title']) . '</h5>';
            echo '</a>';
            echo '<a href="./profile.php?userID=' . urlencode($s['userID']) . '">';
            echo '<h6 class="LightBlueText lato-regular mediumTop">@' . htmlspecialchars($s['userName']) . '</h6>';
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