<?php
require_once '../config.php';

if (!isset($_SESSION['userID'])) {
    header("Location: ../Pages/logIn.php");
    exit();
}

if (isset($_POST['storyID'])) {
    $storyID = intval($_POST['storyID']);
    $userID = $_SESSION['userID'];

    // Only delete if the story belongs to the user
    $stmt = $conn->prepare("DELETE FROM story WHERE StoryID = ? AND userID = ?");
    $stmt->bind_param("ii", $storyID, $userID);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../Pages/profileWriter.php?deleted=1");
        exit();
    } else {
        echo "Error: Story could not be deleted or does not belong to you.";
    }
} else {
    echo "No story ID provided.";
}
?>
