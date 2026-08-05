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

    <?php include "../components/navbarAccount.php";
    ?>

        <div class="backCreateStory">
        <h1 class="lato-bold TextCenter DarkBlueText">Write a story</h1>

        <form class="formCreateStory" method="post" id="noReloadForm">
        <label for="title" class="mediumTop WhiteTextBig lato-regular">Title:</label><br>
        <input type="text" id="title" name="title" class="marginTop1" placeholder="Give your story a title...">
        <br>
        
        <label for="email" class="smallMarginTop WhiteTextBig lato-regular">Body text:</label><br>
        <textarea name="body" class="lato-regular marginTop1">
        </textarea><br>

        <label for="tags" class="smallMarginTop WhiteTextBig lato-regular">Add genre tags:</label><br>

<!-- START genre select buttons -->

        <input type="checkbox" class="btn-check" id="adventure" autocomplete="off" value="adventure">
        <label class="btn btn-outline-light marginTop1" for="adventure">Adventure</label>

        <input type="checkbox" class="btn-check" id="dystopian" autocomplete="off" value="dystopian">
        <label class="btn btn-outline-light marginTop1" for="dystopian">Dystopian</label>

        <input type="checkbox" class="btn-check" id="fantasy" autocomplete="off" value="fantasy">
        <label class="btn btn-outline-light marginTop1" for="fantasy">Fantasy</label>

        <input type="checkbox" class="btn-check" id="history" autocomplete="off" value="history">
        <label class="btn btn-outline-light marginTop1" for="history">History</label>

        <input type="checkbox" class="btn-check" id="horror" autocomplete="off" value="horror">
        <label class="btn btn-outline-light marginTop1" for="horror">Horror</label>

        <input type="checkbox" class="btn-check" id="mystery" autocomplete="off" value="horror">
        <label class="btn btn-outline-light marginTop1" for="mystery">Mystery</label>

        <input type="checkbox" class="btn-check" id="poetry" autocomplete="off" value="horror">
        <label class="btn btn-outline-light marginTop1" for="poetry">Poetry</label>

        <input type="checkbox" class="btn-check" id="romance" autocomplete="off" value="horror">
        <label class="btn btn-outline-light marginTop1" for="romance">Romance</label>

        <input type="checkbox" class="btn-check" id="sci-fi" autocomplete="off" value="horror">
        <label class="btn btn-outline-light marginTop1" for="sci-fi">Sci-fi</label>

        <input type="checkbox" class="btn-check" id="thriller" autocomplete="off" value="horror">
        <label class="btn btn-outline-light marginTop1" for="thriller">Thriller</label>
        <br>

<!-- END genre select buttons -->

    <div>
        <input type="submit" class="primary-Button mediumTop lato-bold" value="Post story ( -40 Tokens )" name="Submit" onclick="alert('Your story has been posted and is pending approval. Check back in 1 to 3 days')">
    </div>

        </form>

        <p class="lato-regular WhiteTextBig TextCenter mediumTop">*Posting a story spends 40 tokens. Your story will then undergo an approval process.</p>

    </div>

    <?php include "../components/footerAccount.php";?>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</body>
</html>