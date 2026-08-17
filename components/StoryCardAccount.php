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

    <article class="cardBackground mediumTop">
        <div class="d-flex row-3">
                <div class="ImageContainerSmall tinyMarginRight">
                <img src="../Assets/profile.jpg" class="profileImg">
                </div>
                <p class="lato-regular DarkBlueText">Username</p>
                
    <!-- Only writers have this button on their profile page -->
            <!-- <div class="BigMarginLeft" data-tooltip="You can only edit a story once.">
                <button class="d-flex row-2 secondary-Button lato-bold">   
                <img src="../Assets/Icons/edit.png" class="marginRight IconSize">Edit
            </button>
            </div> -->
        </div>

        <h4 class="lato-bold DarkBlueText">Story Name</h4>

        <div class="d-flex row-3">
                <button class="genreLabel lato-regular tinyMarginRight"> Genre </button>
                <button class="genreLabel lato-regular tinyMarginRight"> Genre </button>
                <button class="genreLabel lato-regular "> Genre </button>
        </div>

        <p class="lato-regular smallMarginTop"> Story text. Should we talk about the rainy season and storm Desmond? Building on floodplains should not be allowed. Wear insect repellent and never work alone. Before you start your systematic sampling, ask permission if needed.</p>

        <div class="d-flex row">
            <div class="col-9">
            <button class="d-flex row-2 tertiaryButton">   
                <img src="../Assets/Icons/LikeEmpty.png" class="marginRight IconSize">
                <p class="mediumTop lato-bold">12</p>
            </button>
            </div>
            <div class="d-flex col-lg ">
            <button class="d-flex row-2 tertiaryButton marginRight lato-bold">   
                <img src="../Assets/Icons/SaveEmpty.png" class="marginRight IconSize">
                <p class="mediumTop lato-bold textWidth">Save</p>
            </button>
            <div>
                <div class="col">
            <button class="d-flex row-2 tertiaryButton" data-bs-toggle="modal" data-bs-target="#giftModal">   
                <img src="../Assets/Icons/GiftEmpty.png" class="marginRight IconSize">
                <p class="mediumTop lato-bold textWidth">Gift</p>
            </button>
            <div>
        </div>

</article>   <!-- end of card -->
  
<!-- Modal -->
<div class="modal fade" id="giftModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 lato-bold" id="exampleModalLabel">Gift tokens</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="lato-regular">If you love this story you can gift tokens to the writer to show your appreciation</p>
    <form>
        <input type="radio" class="btn-check" name="options" id="5" autocomplete="off" checked>
            <label class="secondary-Button btn smallMarginRight" for="5">
                <img src="../Assets/Icons/sparkles.png" class="marginRight IconSize">5
            </label>

            <input type="radio" class="btn-check" name="options" id="10" autocomplete="off">
            <label class="secondary-Button btn smallMarginRight" for="10">
                <img src="../Assets/Icons/sparkles.png" class="marginRight IconSize">10
            </label>

            <input type="radio" class="btn-check" name="options" id="15" autocomplete="off">
            <label class="secondary-Button btn smallMarginRight" for="15">
                <img src="../Assets/Icons/sparkles.png" class="marginRight IconSize">15
            </label>

            <input type="radio" class="btn-check" name="options" id="20" autocomplete="off">
            <label class="secondary-Button btn" for="20">
                <img src="../Assets/Icons/sparkles.png" class="marginRight IconSize">20
            </label>
            <br>

        <input type="submit" class="primary-Button mediumTop lato-bold" value="Send gift" name="Submit">
        </form>
            
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