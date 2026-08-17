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

    <form class="d-flex row-3 lato-regular" method="GET" action="">
        <select name="genre" class="form-select secondary-Button col smallMarginRight" style="height:45px">
            <option selected value="" <?php if(empty($genreFilter)) echo "selected"; ?>>Genre</option>

            <option value="adventure" <?php if($genreFilter=="adventure") echo "selected"; ?>>Adventure</option>
            
            <option value="dystopian" <?php if($genreFilter=="dystopian") echo "selected"; ?>>Dystopian</option>

            <option value="fantasy" <?php if($genreFilter=="fantasy") echo "selected"; ?>>Fantasy</option>

            <option value="history" <?php if($genreFilter=="history") echo "selected"; ?>>History</option>

            <option value="horror" <?php if($genreFilter=="horror") echo "selected"; ?>>Horror</option>

            <option value="mystery" <?php if($genreFilter=="mystery") echo "selected"; ?>>Mystery</option>

            <option value="poetry" <?php if($genreFilter=="poetry") echo "selected"; ?>>Poetry</option>

            <option value="romance" <?php if($genreFilter=="romance") echo "selected"; ?>>Romance</option>
            
            <option value="scifi" <?php if($genreFilter=="scifi") echo "selected"; ?>>Sci-fi</option>

            <option value="thriller" <?php if($genreFilter=="thriller") echo "selected"; ?>>Thriller</option>

        </select>
        <button type="submit" class="primary-Button col-2 hugeMarginRight">Filter</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
</body>
</html>