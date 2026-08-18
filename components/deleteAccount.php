<?php
require_once '../config.php';

$queries = [
    // Likes table
    "ALTER TABLE likes DROP FOREIGN KEY likes_ibfk_1",
    "ALTER TABLE likes ADD CONSTRAINT likes_ibfk_1 FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE",

    // Stories table
    "ALTER TABLE stories DROP FOREIGN KEY stories_ibfk_1",
    "ALTER TABLE stories ADD CONSTRAINT stories_ibfk_1 FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE",

    // Saved stories table
    "ALTER TABLE savedstories DROP FOREIGN KEY savedstories_ibfk_1",
    "ALTER TABLE savedstories ADD CONSTRAINT savedstories_ibfk_1 FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE",

    // Token gifts table
    "ALTER TABLE tokengifts DROP FOREIGN KEY tokengifts_ibfk_1, DROP FOREIGN KEY tokengifts_ibfk_2",
    "ALTER TABLE tokengifts ADD CONSTRAINT tokengifts_ibfk_1 FOREIGN KEY (giftedTo) REFERENCES users(userID) ON DELETE CASCADE",
    "ALTER TABLE tokengifts ADD CONSTRAINT tokengifts_ibfk_2 FOREIGN KEY (giftedFrom) REFERENCES users(userID) ON DELETE CASCADE",

    // Follows table
    "ALTER TABLE follows DROP FOREIGN KEY follows_ibfk_1, DROP FOREIGN KEY follows_ibfk_2",
    "ALTER TABLE follows ADD CONSTRAINT follows_ibfk_1 FOREIGN KEY (followerID) REFERENCES users(userID) ON DELETE CASCADE",
    "ALTER TABLE follows ADD CONSTRAINT follows_ibfk_2 FOREIGN KEY (followingID) REFERENCES users(userID) ON DELETE CASCADE"
];

foreach ($queries as $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "Executed: $sql<br>";
    } else {
        echo "Error running: $sql<br>" . $conn->error . "<br>";
    }
}

if (!isset($_SESSION['userID'])) {
    die("No user logged in.");
}

$userID = $_SESSION['userID'];
echo "Trying to delete userID: " . $userID . "<br>";

$stmt = $conn->prepare("DELETE FROM users WHERE userID = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();

if ($stmt->error) {
    echo "SQL Error: " . $stmt->error;
}

if ($stmt->affected_rows > 0) {
    echo "User deleted successfully.";
    session_destroy();
    header("Location: ../Pages/logIn.php");
    exit();
} else {
    echo "No rows deleted. Check if userID exists.";
}
?>
