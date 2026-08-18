<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    <?php include "../components/navbarAccount.php";
    ?>

        <?php
        require_once '../config.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title   = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $genres  = $_POST['options'] ?? [];
    $genre   = implode(",", $genres);
    $userID  = $_SESSION['userID'];

    $errors = [];
    if (empty($title)) $errors[] = "Title is required";
    if (empty($content)) $errors[] = "Story content is required";
    if (empty($genres)) $errors[] = "At least one genre is required";

    if (empty($errors)) {
        // Check user has enough tokens
        $stmtCheck = $conn->prepare("SELECT tokens FROM users WHERE userID = ?");
        $stmtCheck->bind_param("i", $userID);
        $stmtCheck->execute();
        $userTokens = $stmtCheck->get_result()->fetch_assoc()['tokens'];

        if ($userTokens < 40) {
            $errors[] = "Not enough tokens to post a story.";
        } else {
            // Insert story
            $stmt = $conn->prepare("INSERT INTO story (userID, title, content, genre) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $userID, $title, $content, $genre);
            if ($stmt->execute()) {
                // Deduct 40 tokens
                $stmtUpdate = $conn->prepare("UPDATE users SET tokens = tokens - 40 WHERE userID = ?");
                $stmtUpdate->bind_param("i", $userID);
                $stmtUpdate->execute();

                // Show modal
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var myModal = new bootstrap.Modal(document.getElementById('postModal'));
                            myModal.show();
                        });
                      </script>";
            }
        }
    }
}

?>

    <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $err) echo "• " . htmlspecialchars($err) . "<br>"; ?>
            </div>
        <?php endif; ?>

        <div class="backCreateStory">
        <h1 class="lato-bold TextCenter DarkBlueText">Write a story</h1>

        <form class="formCreateStory" method="POST" action="" enctype="multipart/form-data">
        <label for="title" class="mediumTop WhiteTextBig lato-regular">Title:</label><br>
        <input type="text" id="title" name="title" class="marginTop1" placeholder="Give your story a title..." required value="<?php echo htmlspecialchars($_POST['title'] ?? '') ?>">
        <br>
        
        <label for="content" class="smallMarginTop WhiteTextBig lato-regular">Body text:</label><br>
        <textarea name="content" class="lato-regular marginTop1" maxlength="800" required ><?php echo htmlspecialchars($_POST['content'] ?? '')?></textarea><br>

        <label for="options" class="smallMarginTop WhiteTextBig lato-regular">Add genre tags:</label><br>

<!-- START genre select buttons -->

        <input type="checkbox" class="btn-check" id="adventure" autocomplete="off" value="adventure" name="options[]">
        <label class="btn btn-outline-light marginTop1" for="adventure">Adventure</label>

        <input type="checkbox" class="btn-check" id="dystopian" autocomplete="off" value="dystopian" name="options[]">
        <label class="btn btn-outline-light marginTop1" for="dystopian">Dystopian</label>

        <input type="checkbox" class="btn-check" id="fantasy" autocomplete="off" value="fantasy" name="options[]">
        <label class="btn btn-outline-light marginTop1" for="fantasy">Fantasy</label>

        <input type="checkbox" class="btn-check" id="history" autocomplete="off" value="history" name="options[]">
        <label class="btn btn-outline-light marginTop1" for="history">History</label>

        <input type="checkbox" class="btn-check" id="horror" autocomplete="off" value="horror" name="options[]">
        <label class="btn btn-outline-light marginTop1" for="horror">Horror</label>

        <input type="checkbox" class="btn-check" id="mystery" autocomplete="off" value="mystery" name="options[]">
        <label class="btn btn-outline-light marginTop1" for="mystery">Mystery</label>

        <input type="checkbox" class="btn-check" id="poetry" autocomplete="off" value="poetry" name="options[]">
        <label class="btn btn-outline-light marginTop1" for="poetry">Poetry</label>

        <input type="checkbox" class="btn-check" id="romance" autocomplete="off" value="romance" name="options[]">
        <label class="btn btn-outline-light marginTop1" for="romance">Romance</label>

        <input type="checkbox" class="btn-check" id="sci-fi" autocomplete="off" value="scifi" name="options[]">
        <label class="btn btn-outline-light marginTop1" for="sci-fi">Sci-fi</label>

        <input type="checkbox" class="btn-check" id="thriller" autocomplete="off" value="thriller" name="options[]">
        <label class="btn btn-outline-light marginTop1" for="thriller">Thriller</label>
        <br>

<!-- END genre select buttons -->

    <div>
        <input type="submit" class="primary-Button mediumTop lato-bold" value="Post story ( -40 Tokens )" name="Submit">
    </div>

        </form>

        <p class="lato-regular WhiteTextBig TextCenter mediumTop">*Posting a story spends 40 tokens. Your story will then undergo an approval process.</p>

    </div>

    <?php include "../components/footerAccount.php";?>

    <!-- Modal -->
<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 lato-bold" id="exampleModalLabel">Your story has been posted and is pending approval.</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5 class="lato-regular">Check back in 1 to 3 days</h5>
        <p class="lato-regular">Read our terms of service to get insight on our approval process.</p>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <a href="../Pages/discover.php">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Go back home</button>
        </a>
      </div>
    </div>
  </div>
</div>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</body>
</html>