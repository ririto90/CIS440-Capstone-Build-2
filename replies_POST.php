<?php
$host = "107.180.1.16:3306";
$username = "sprc2023team2";
$password = "sprc2023team2";
$dbname = "sprc2023team2";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['question_id']) && isset($_POST['content']) && isset($_POST['author'])) {
  $question_id = $_POST['question_id'];
  $content = $_POST['content'];
  $author = $_POST['author'];


  $stmt = $conn->prepare("INSERT INTO discussion_replies (question_id, author, content) VALUES (?, ?, ?)");

 
  $stmt->bind_param("iss", $question_id, $author, $content);

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
