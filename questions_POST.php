<?php
$host = "107.180.1.16:3306";
$username = "sprc2023team2";
$password = "sprc2023team2";
$dbname = "sprc2023team2";

$conn = mysqli_connect($host, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$post_title = $_POST['post-title'];
$post_content = $_POST['post-content'];
$post_author = $_POST['post-author'];

$sql = "INSERT INTO discussion_questions (post_title, post_content, post_author) VALUES ('$post_title', '$post_content', '$post_author')";

if (mysqli_query($conn, $sql)) {
    echo "New post created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

include('html/disscussion_board.php')
?>