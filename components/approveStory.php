<?php
require_once '../config.php';

if (!isset($_SESSION['userID'])) {
    header("Location: ../pages/login.php");
    exit();
}

$storyID = intval($_POST['storyID']);
$action  = $_POST['action'];

if ($action === 'approve') {
    $newState = 'approved';
} elseif ($action === 'deny') {
    $newState = 'denied';
} else {
    die("Invalid action");
}

$stmt = $conn->prepare("UPDATE story SET state = ? WHERE StoryID = ?");
$stmt->bind_param("si", $newState, $storyID);
$stmt->execute();

header("Location: ../Pages/profileAdmin.php");
exit();
?>
