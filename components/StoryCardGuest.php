<?php
    require_once 'config.php';

 // selected genre from URL
$genreFilter = isset($_GET['genre']) ? $_GET['genre'] : '';

$sql = "
    SELECT s.StoryID, s.title, s.content, s.genre, s.created_at,
           u.userName, u.profileImg,
           COUNT(l.likedID) AS likeCount
    FROM story s
    JOIN users u ON s.userID = u.userID
    LEFT JOIN likes l ON s.StoryID = l.storyID
    WHERE s.state = 'approved'
";

// Add filter if genre is selected
if (!empty($genreFilter)) {
    $sql .= " WHERE s.genre LIKE '%" . $conn->real_escape_string($genreFilter) . "%'";
}

$sql .= " GROUP BY s.StoryID";

$result = $conn->query($sql);

    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
            ?>
            
    <article class="cardBackground mediumTop">
        <div class="d-flex row-3">
                <div class="ImageContainerSmall tinyMarginRight">
                <img src="uploads/<?php echo htmlspecialchars($row['profileImg']); ?>" class="profileImg">
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
            <button class="d-flex row-2 tertiaryButton">   
                <img src="./Assets/Icons/LikeEmpty.png" class="marginRight IconSize">
                <p class="mediumTop lato-bold"><?php echo $row['likeCount']; ?></p>
            </button>
            </div>
            <div class="d-flex col-lg ">
            <button class="d-flex row-2 tertiaryButton marginRight lato-bold">   
                <img src="./Assets/Icons/SaveEmpty.png" class="marginRight IconSize">
                <p class="mediumTop lato-bold textWidth">Save</p>
            </button>
            <div>
                <div class="col">
            <button class="d-flex row-2 tertiaryButton" data-bs-toggle="modal" data-bs-target="#giftModal">   
                <img src="./Assets/Icons/GiftEmpty.png" class="marginRight IconSize">
                <p class="mediumTop lato-bold textWidth">Gift</p>
            </button>
            </div>
        </div>

</article>   <!-- end of card -->
<?php
    }
} else {
    echo '<h1 class="lato-bold WhiteTextBig mediumTop">No results match your search, try a different genre.</h1>';
}
?>