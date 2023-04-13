<?php
// Connect to the database
$host = "107.180.1.16:3306";
$username = "sprc2023team2";
$password = "sprc2023team2";
$dbname = "sprc2023team2";

$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select all discussion posts from the table
$sql = "SELECT * FROM discussion_questions ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

// Create an HTML variable to hold the discussion post data
$questions_html = "";

if (mysqli_num_rows($result) > 0) {
	$questions_html .= "<div>";
    while ($row = mysqli_fetch_assoc($result)) {
        $questions_html .= "<h3>" . $row["post_title"] . "</h3>";
        $questions_html .= "<p>" . $row["post_content"] . "</p>";
        $questions_html .= "<p>Author: " . $row["post_author"] . "</p>";
        $questions_html .= "<p>Created at: " . $row["created_at"] . "</p>";
		$questions_html .= "<button class='reply-btn btn' data-post-id='" . $row["id"] . "'>Reply</button>";
		$questions_html .= "<button class='like-btn btn' data-post-id='" . $row["id"] . "'><i class='fa fa-heart-o'></i></button>";
		$questions_html .= "<div class='reply-form' data-post-id='" . $row["id"] . "' style='display:none;'>";
		$questions_html .= "<form action='../replies_POST.php' method='post'>";
		$questions_html .= "<input type='hidden' name='questions_id' value='" . $row["id"] . "'>";
		$questions_html .= "<label for='post-content-" . $row["id"] . "'>Your Reply:</label>";
		$questions_html .= "<textarea id='post-content-" . $row["id"] . "' name='content' rows='3' required></textarea>";
		$questions_html .= "<label for='post-author-" . $row["id"] . "'>Your Name:</label>";
		$questions_html .= "<input type='text' id='post-author-" . $row["id"] . "' name='author' required>";
		$questions_html .= "<button type='submit' class='btn'>Submit Reply</button>";
		$questions_html .= "</form>";
		$questions_html .= "</div>";
        $questions_html .= "<hr>";

        // Select all replies for the current question
        $question_id = $row["id"];
        $replies_sql = "SELECT * FROM discussion_replies WHERE question_id = '$question_id' ORDER BY created_at DESC";
        $replies_result = mysqli_query($conn, $replies_sql);

        // Create an HTML variable to hold the reply data
        $replies_html = "";

        if (mysqli_num_rows($replies_result) > 0) {
            $replies_html .= "<div>";
            while ($reply_row = mysqli_fetch_assoc($replies_result)) {
                $replies_html .= "<p>" . $reply_row["content"] . "</p>";
                $replies_html .= "<p>Created at: " . $reply_row["created_at"] . "</p>";
            }
            $replies_html .= "</div>";
        } else {
            $replies_html .= "<p>No replies found</p>";
        }

        // Add the reply data to the question data
        
    }
} else {
    $questions_html .= "<p>No questions found</p>";
}

// Close the database connection
mysqli_close($conn);

// Output the HTML code for the discussion posts inside the existing HTML div
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap Icons -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<!-- CSS file -->
	<link rel="stylesheet" type="text/css" href="../style.css">
	<!-- Javascript -->
	<script type="text/javascript" src="../javascript.js"></script>
    <title>Disscussion Board</title>
</head>
<body>
	<nav class="navbar navbar-expand-md fixed-top navbar-dark" style="background-color: lightblue;">
		<div class="container">
		  <a class="navbar-brand" href="./profile.php"><i class="bi bi-person-circle"></i></a>
		  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<a href="./disscussion_board.php" class="nav-link">Discussion</a>
				<a href="./leaderboard.php" class="nav-link">Leaders</a>
				<a href="./prizes.php" class="nav-link">Prizes</a>
				<a onclick="logOut()" class="nav-link">Log Out</a>
			</div>
		  </div>
		</div>
	  </nav>
    <header>
		<h1>Disscusssion Board</h1>
		<h7 class="page-subtitle">“A mentor is someone who sees more talent and ability within you, than you see in yourself, and helps bring it out of you.” — Bob Proctor</h5>
	</header>
	<main>
		<div class="discussion-post-form">
		<?php echo "<div id='discussion-posts'>" . $questions_html . "</div>"; ?>
		</div>
		<div class="discussion-post-form">
			<h2 class="form-title">Create a new discussion post</h2>
			<form action="../questions_POST.php" method="post">
			  <label for="post-title">Post Title:</label>
			  <input type="text" id="post-title" name="post-title" required>
			  
			  <label for="post-content">Post Content:</label>
			  <textarea id="post-content" name="post-content" rows="5" required></textarea>
			  
			  <label for="post-author">Your Name:</label>
			  <input type="text" id="post-author" name="post-author" required>
			  
			  <button type="submit" class="btn">Submit Post</button>
			</form>
		  </div>
    </main>
<script>
	var likeBtns = document.getElementsByClassName('like-btn');
	for (var i = 0; i < likeBtns.length; i++) {
	likeBtns[i].addEventListener('click', function() {
		if (this.style.color === 'red') {
		this.style.color = '';
		} else {
		this.style.color = 'red';
		}
	});
	}

    const replyBtns = document.querySelectorAll('.reply-btn');
    replyBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const postId = btn.dataset.postId;
            const replyForm = document.querySelector(`.reply-form[data-post-id='${postId}']`);
            replyForm.style.display = (replyForm.style.display === 'none') ? 'block' : 'none';
        });
    });

	function submitPost() {
	// Get the input field values
	var username = document.getElementById("username").value;
	var message = document.getElementById("message").value;
	var replyTo = document.getElementById("replyTo").value;
	
	// Create a new post element
	var newPost = document.createElement("div");
	newPost.className = "post";
	
	// Create the post content
	var postContent = "<h2>" + username + "</h2><p>" + message + "</p>";
	
	// If this is a reply, add a "reply" class to the new post element
	if (replyTo) {
		newPost.className += " reply";
	}
	
	// Set the post content
	newPost.innerHTML = postContent;
	
	// If this is a reply, append the new post as a child of the original post's parent element
	if (replyTo) {
		var originalPost = document.getElementById(replyTo);
		originalPost.parentNode.insertBefore(newPost, originalPost.nextSibling);
	} else { // Otherwise, append the new post as a child of the post container
		var postContainer = document.getElementById("post-container");
		postContainer.appendChild(newPost);
	}
	
	// Clear the input fields
	document.getElementById("username").value = "";
	document.getElementById("message").value = "";
	document.getElementById("replyTo").value = "";
}

</script>
</body>
</html>

