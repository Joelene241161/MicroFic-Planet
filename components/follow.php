<?php
require_once '../config.php';

if (!isset($_SESSION['userID'])) {
    header("Location: ../Pages/login.php");
    exit();
}

$targetUserID = (int)$_POST['userID'];
$currentUserID = $_SESSION['userID'];

// Check if already following
$stmt = $conn->prepare("SELECT followID FROM followers WHERE userID = ? AND followerID = ?");
$stmt->bind_param("ii", $targetUserID, $currentUserID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Unfollow
    $stmtDel = $conn->prepare("DELETE FROM followers WHERE userID = ? AND followerID = ?");
    $stmtDel->bind_param("ii", $targetUserID, $currentUserID);
    $stmtDel->execute();
} else {
    // Follow
    $stmtIns = $conn->prepare("INSERT INTO followers (userID, followerID, created_at) VALUES (?, ?, NOW())");
    $stmtIns->bind_param("ii", $targetUserID, $currentUserID);
    $stmtIns->execute();
}

// Redirect back to profile
header("Location: ../Pages/profile.php?userID=" . $targetUserID);
exit();
?>
