<?php
require_once '../config.php';

if (!isset($_SESSION['userID'])) {
    header("Location: ../pages/login.php");
    exit();
}

$giftedFrom = $_SESSION['userID'];
$giftedTo   = intval($_POST['giftedTo']);
$storyID    = intval($_POST['storyID']);
$amount     = $_POST['amount'];

// Check sender has enough tokens
$stmt = $conn->prepare("SELECT tokens FROM users WHERE userID = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $giftedFrom);
$stmt->execute();
$senderTokens = $stmt->get_result()->fetch_assoc()['tokens'];

if ($senderTokens < intval($amount)) {
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=not_enough_tokens");
    exit();
}

// Remove from sender
$stmt = $conn->prepare("UPDATE users SET tokens = tokens - ? WHERE userID = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("ii", $amount, $giftedFrom);
$stmt->execute();

// Add to recipient
$stmt = $conn->prepare("UPDATE users SET tokens = tokens + ? WHERE userID = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("ii", $amount, $giftedTo);
$stmt->execute();

// Add log of gift to database
$stmt = $conn->prepare("INSERT INTO tokengifts (giftedTo, giftedFrom, amount, created_at) VALUES (?, ?, ?, NOW())");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("iis", $giftedTo, $giftedFrom, $amount);
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

// Refresh current page
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>
