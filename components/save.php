<?php
require_once '../config.php';
session_start();

if (!isset($_SESSION['userID'])) {
    header("Location: ../pages/login.php");
    exit();
}

$storyID = intval($_POST['storyID']);
$userID = $_SESSION['userID'];

// Check if already saved
$stmt = $conn->prepare("SELECT savedID FROM savedstories WHERE userID = ? AND storyID = ?");
$stmt->bind_param("ii", $userID, $storyID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // removes it if it already exists
    $stmt = $conn->prepare("DELETE FROM savedstories WHERE userID = ? AND storyID = ?");
    $stmt->bind_param("ii", $userID, $storyID);
    $stmt->execute();

    // remove 5 tokens
    $stmt = $conn->prepare("UPDATE users SET tokens = tokens - 5 WHERE userID = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
} else {
    // add saved story
    $stmt = $conn->prepare("INSERT INTO savedstories (userID, storyID, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ii", $userID, $storyID);
    $stmt->execute();

    // add tokens
    $stmt = $conn->prepare("UPDATE users SET tokens = tokens + 5 WHERE userID = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
}

// redirects so that the new value shows
header("Location: ../pages/profile.php");
exit();
