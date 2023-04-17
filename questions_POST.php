<?php
$host = "107.180.1.16:3306";
$username = "sprc2023team2";
$password = "sprc2023team2";
$dbname = "sprc2023team2";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['post-title']) && isset($_POST['post-content']) && isset($_POST['post-author'])) {
$post_title = $_POST['post-title'];
$post_content = $_POST['post-content'];
$post_author = $_POST['post-author'];

$stmt = $conn->prepare("INSERT INTO discussion_questions (post_title, post_content, post_author) VALUES (?, ?, ?)");

$stmt->bind_param("sss", $post_title, $post_content, $post_author);

if ($stmt->execute()) {
header("Location: ../html/disscussion_board.php");
} else {
echo "Error: " . $stmt->error;
}

$stmt->close();
} else {
  echo "Error: Missing required fields.";
}

mysqli_close($conn);

?>
