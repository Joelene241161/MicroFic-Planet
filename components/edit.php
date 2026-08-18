<?php
require_once '../config.php';
session_start();

if (!isset($_SESSION['userID'])) {
    header("Location: ../pages/login.php");
    exit();
}

$storyID = intval($_POST['storyID']);
$userID = $_SESSION['userID'];

// Check edit history
$stmt = $conn->prepare("SELECT edited FROM story WHERE StoryID = ? AND userID = ?");
$stmt->bind_param("ii", $storyID, $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $row = $result->fetch_assoc()) {
    if ($row['edited'] == 0) {
        // Allow edit, set to 1 (edited)
        $stmt = $conn->prepare("UPDATE story SET edited = 1 WHERE StoryID = ? AND userID = ?");
        $stmt->bind_param("ii", $storyID, $userID);
        $stmt->execute();

        header("Location: ../pages/editStory.php?storyID=$storyID");
        exit();
    } else {
        // Already edited, block action
        header("Location: ../pages/profile.php?error=already_edited");
        exit();
    }
} else {
    // No story found for this user
    header("Location: ../pages/profile.php?error=story_not_found");
    exit();
}
?>