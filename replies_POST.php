<?php
$host = "107.180.1.16:3306";
$username = "sprc2023team2";
$password = "sprc2023team2";
$dbname = "sprc2023team2";

$conn = mysqli_connect($host, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$post_ID = $_POST['question_id'];
$post_content = $_POST['content'];
$post_author = $_POST['author'];

$sql = "INSERT INTO discussion_replies (question_id, author, content) VALUES ('$post_ID', '$post_author', '$post_content')";

echo $sql;

if (mysqli_query($conn, $sql)) {
    echo "New post created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

include('html/disscussion_board.php')
?>