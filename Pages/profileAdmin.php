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

    // Count amount of stories saved
    $stmtSaved = $conn->prepare("SELECT COUNT(*) AS savedCount FROM savedstories WHERE userID = ?");
    $stmtSaved->bind_param("i", $_SESSION['userID']);
    $stmtSaved->execute();
    $savedData = $stmtSaved->get_result()->fetch_assoc();
    $savedCount = $savedData['savedCount'];

    // Count how many accounts the user is following
    $stmtFollowing = $conn->prepare("SELECT COUNT(*) AS followingCount FROM followers WHERE followerID = ?");
    $stmtFollowing->bind_param("i", $_SESSION['userID']);
    $stmtFollowing->execute();
    $followingData = $stmtFollowing->get_result()->fetch_assoc();
    $followingCount = $followingData['followingCount'];

    // Get all pending stories
    $sql = "
        SELECT s.StoryID, s.title, s.content, s.genre, s.created_at,
            u.userID AS authorID, u.userName, u.profileImg,
            COUNT(l.likedID) AS likeCount
        FROM story s
        JOIN users u ON s.userID = u.userID
        LEFT JOIN likes l ON s.StoryID = l.storyID
        WHERE s.state = 'pending'
        GROUP BY s.StoryID
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>

    <section class="marginTop1 MarginLeft">

    <div class="d-flex row-3 mediumTop flex-wrap">
                 <div class="ImageContainer tinyMarginRight">
                 <img src="../uploads/<?php echo $user['profileImg'] ?>" 
             alt="Profile image" class="profileImg">
                 </div>
                <h2 class="lato-regular WhiteTextBig smallMarginRight">@<?php echo htmlspecialchars($user['userName']) ?></h2>
                <p class="LightBlueText lato-regular tinyMarginRight"><?php echo $followingCount; ?> Following</p>
                <p class="LightBlueText lato-regular"><?php echo $savedCount; ?> Saved stories</p>
                <h1 class="lato-bold WhiteTextBig MarginLeftBig">Posts pending approval</h1>
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
        <!-- <?php include "../components/selectGenre.php";?> -->
    
        <div class="CardGroup">
        
        <?php if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
            ?>
            
    <article class="cardBackground mediumTop">
        <div class="d-flex row-3">
                <div class="ImageContainerSmall tinyMarginRight">
                <img src="../uploads/<?php echo htmlspecialchars($row['profileImg']); ?>" class="profileImg">
                </div>
                <p class="lato-regular DarkBlueText"><?php echo htmlspecialchars($row['userName']); ?></p>
        </div>

        <h4 class="lato-bold DarkBlueText"><?php echo htmlspecialchars($row['title']); ?></h4>

        <div class="d-flex row-3">
                <div class="d-flex row-3">
    <?php 
    // separating strings in array
    $genres = explode(',', $row['genre']); 

    foreach ($genres as $genre) {
        $genre = trim($genre);
        echo '<button class="genreLabel lato-regular marginRight">'
             . htmlspecialchars($genre) .
             '</button>';
    }
    ?>
</div>
        </div>

        <p class="lato-regular smallMarginTop"><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>

        <div class="d-flex row">
            <div class="col-9">
            
           <form method="POST" action="../components/like.php">
    <input type="hidden" name="storyID" value="<?php echo $row['StoryID']; ?>">

    <?php
    // Checks if the story has already been liked by the logged in user
    $stmt = $conn->prepare("SELECT likedID FROM likes WHERE userID = ? AND storyID = ?");
    $stmt->bind_param("ii", $_SESSION['userID'], $row['StoryID']);
    $stmt->execute();
    $liked = $stmt->get_result()->num_rows > 0;
    ?>

    <input type="submit" class="btn-check" id="like-<?php echo $row['StoryID']; ?>" autocomplete="off">
    <label 
        class="d-inline-flex lato-bold paddingBottom <?php echo $liked ? 'outlinedButton' : 'tertiaryButton'; ?>" 
        for="like-<?php echo $row['StoryID']; ?>">
        <img src="../Assets/Icons/LikeEmpty.png" class="marginRight IconSize"> <?php echo $row['likeCount']; ?>
    </label>
</form>

            </div>
            <div class="d-flex col-lg ">

            <div class="d-flex col-lg ">
            <div class="d-flex col-lg">
                <!-- Approve -->
                <form method="POST" action="../components/approveStory.php" class="d-inline marginRight">
                    <input type="hidden" name="storyID" value="<?php echo $row['StoryID']; ?>">
                    <input type="hidden" name="action" value="approve">
                    <button type="submit" class="btn btn-success smallMarginRight">Approve</button>
                </form>

                <!-- Deny -->
                <form method="POST" action="../components/approveStory.php" class="d-inline">
                    <input type="hidden" name="storyID" value="<?php echo $row['StoryID']; ?>">
                    <input type="hidden" name="action" value="deny">
                    <button type="submit" class="btn btn-danger">Deny</button>
                </form>
            </div>

        </div>
        </div>

</article>   <!-- end of card -->
<?php
    }
} else {
    echo '<h2 class="lato-bold WhiteTextBig mediumTop">No more stories left to review.</h2>';
}
?>
        <div>

        </div>  <!-- right side -->
    </div>  <!-- entire row -->

 </section>


    <?php include "../components/footerAccount.php";?>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
</body>
</html>