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

 <section>
    <div class="d-flex flex-row-lg bodyMargin flex-wrap">

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

    // Get storyID from URL
    $storyID = isset($_GET['storyID']) ? (int)$_GET['storyID'] : 0;

    // Fetch the selected story
    $sql = "
        SELECT s.StoryID, s.title, s.content, s.genre, s.created_at,
               u.userID, u.userName, u.profileImg,
               COUNT(l.likedID) AS likeCount
        FROM story s
        JOIN users u ON s.userID = u.userID
        LEFT JOIN likes l ON s.StoryID = l.storyID
        WHERE s.state = 'approved' AND s.StoryID = ?
        GROUP BY s.StoryID
    ";

    $stmtStory = $conn->prepare($sql);
    $stmtStory->bind_param("i", $storyID);
    $stmtStory->execute();
    $result = $stmtStory->get_result();
    ?>

    <!-- Sidebar -->
    <?php include "../components/sidebar.php";?>

    </div> <!-- left side -->

    <div class="col-8 MarginLeft">
        <div class="CardGroup">
            <?php if ($result->num_rows > 0): 
                $row = $result->fetch_assoc(); ?>
                
                <article class="cardBackground mediumTop">
                    <div class="d-flex row-3">
                        <div class="ImageContainerSmall tinyMarginRight">
                            <img src="../uploads/<?php echo htmlspecialchars($row['profileImg']); ?>" class="profileImg">
                        </div>
                        <p class="lato-regular DarkBlueText">@<?php echo htmlspecialchars($row['userName']); ?></p>
                    </div>

                    <h4 class="lato-bold DarkBlueText"><?php echo htmlspecialchars($row['title']); ?></h4>

                    <div class="d-flex row-3">
                        <?php 
                        $genres = explode(',', $row['genre']); 
                        foreach ($genres as $genre) {
                            echo '<button class="genreLabel lato-regular marginRight">'
                                . htmlspecialchars(trim($genre)) .
                                '</button>';
                        }
                        ?>
                    </div>

                    <p class="lato-regular smallMarginTop"><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>

                    <div class="d-flex row">
                        <div class="col-9">
                            <!-- Like form -->
                            <form method="POST" action="../components/like.php">
                                <input type="hidden" name="storyID" value="<?php echo $row['StoryID']; ?>">
                                <?php
                                $stmtLike = $conn->prepare("SELECT likedID FROM likes WHERE userID = ? AND storyID = ?");
                                $stmtLike->bind_param("ii", $_SESSION['userID'], $row['StoryID']);
                                $stmtLike->execute();
                                $liked = $stmtLike->get_result()->num_rows > 0;
                                ?>
                                <input type="submit" class="btn-check" id="like-<?php echo $row['StoryID']; ?>" autocomplete="off">
                                <label class="d-inline-flex lato-bold paddingBottom <?php echo $liked ? 'outlinedButton' : 'tertiaryButton'; ?>" 
                                       for="like-<?php echo $row['StoryID']; ?>">
                                    <img src="../Assets/Icons/LikeEmpty.png" class="marginRight IconSize"> <?php echo $row['likeCount']; ?>
                                </label>
                            </form>
                        </div>

                        <div class="d-flex col-lg">
                            <!-- Save form -->
                            <form method="POST" action="../components/save.php">
                                <input type="hidden" name="storyID" value="<?php echo $row['StoryID']; ?>">
                                <?php
                                $stmtSave = $conn->prepare("SELECT savedID FROM savedstories WHERE userID = ? AND storyID = ?");
                                $stmtSave->bind_param("ii", $_SESSION['userID'], $row['StoryID']);
                                $stmtSave->execute();
                                $saved = $stmtSave->get_result()->num_rows > 0;
                                ?>
                                <input type="submit" class="btn-check" id="save-<?php echo $row['StoryID']; ?>" autocomplete="off">
                                <label class="d-inline-flex lato-bold paddingBottom <?php echo $saved ? 'outlinedButton' : 'tertiaryButton'; ?>" 
                                       for="save-<?php echo $row['StoryID']; ?>">
                                    <img src="../Assets/Icons/SaveEmpty.png" class="marginRight IconSize"><p>Save</p>
                                </label>
                            </form>

                            <!-- Gift button -->
                            <button class="giftBtn d-flex row-2 tertiaryButton"
                                    data-bs-toggle="modal"
                                    data-bs-target="#giftModal"
                                    data-story="<?php echo $row['StoryID']; ?>"
                                    data-user="<?php echo $row['userID']; ?>">
                                <img src="../Assets/Icons/GiftEmpty.png" class="marginRight IconSize">
                                <p class="mediumTop lato-bold textWidth">Gift</p>
                            </button>
                        </div>
                    </div>
                </article>

            <?php else: ?>
                <h1 class="lato-bold WhiteTextBig mediumTop">Story not found.</h1>
            <?php endif; ?>
        </div>
    </div> <!-- right side -->
</section>


    <?php include "../components/footerAccount.php";?>

    <!-- modal -->
<div class="modal fade" id="giftModal" tabindex="-1" aria-labelledby="giftLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 lato-bold" id="giftLabel">Gift tokens</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p class="lato-regular">If you love this story you can gift tokens to the writer to show your appreciation</p>
        <form method="POST" action="../components/gift.php">
          <input type="hidden" name="storyID" id="giftStoryID">
        <input type="hidden" name="giftedTo" id="giftUserID">


          <input type="radio" class="btn-check" name="amount" id="gift5" value="5" checked>
          <label class="secondary-Button btn smallMarginRight" for="gift5">
              <img src="../Assets/Icons/sparkles.png" class="marginRight IconSize">5
          </label>

          <input type="radio" class="btn-check" name="amount" id="gift10" value="10">
          <label class="secondary-Button btn smallMarginRight" for="gift10">
              <img src="../Assets/Icons/sparkles.png" class="marginRight IconSize">10
          </label>

          <input type="radio" class="btn-check" name="amount" id="gift15" value="15">
          <label class="secondary-Button btn smallMarginRight" for="gift15">
              <img src="../Assets/Icons/sparkles.png" class="marginRight IconSize">15
          </label>

          <input type="radio" class="btn-check" name="amount" id="gift20" value="20">
          <label class="secondary-Button btn" for="gift20">
              <img src="../Assets/Icons/sparkles.png" class="marginRight IconSize">20
          </label>
          <br>

          <input type="submit" class="primary-Button mediumTop lato-bold" value="Send gift">
        </form>
      </div>
    </div>
  </div>
</div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.giftBtn').forEach(btn => {
    btn.addEventListener('click', function() {
      console.log("Clicked gift button for story:", this.dataset.story, "user:", this.dataset.user);
      document.getElementById('giftStoryID').value = this.dataset.story;
      document.getElementById('giftUserID').value = this.dataset.user;
    });
  });

  const giftForm = document.querySelector('#giftModal form');
  if (giftForm) {
    giftForm.addEventListener('submit', function() {
      console.log("Submitting values:",
        document.getElementById('giftStoryID').value,
        document.getElementById('giftUserID').value
      );
    });
  }
});

    </script>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
</body>
</html>