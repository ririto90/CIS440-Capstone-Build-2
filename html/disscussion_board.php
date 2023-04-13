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
$html = "";

if (mysqli_num_rows($result) > 0) {
    $html .= "<div>";
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= "<h3>" . $row["post_title"] . "</h3>";
        $html .= "<p>" . $row["post_content"] . "</p>";
        $html .= "<p>Author: " . $row["post_author"] . "</p>";
        $html .= "<p>Created at: " . $row["created_at"] . "</p>";
		$html .= "<button class='reply-btn' data-post-id='" . $row["id"] . "'>Reply</button>";
		$html .= "<div class='reply-form' data-post-id='" . $row["id"] . "' style='display:none;'>";
		$html .= "<form action='../server.php' method='post'>";
		$html .= "<input type='hidden' name='parent_post_id' value='" . $row["id"] . "'>";
		$html .= "<label for='post-content-" . $row["id"] . "'>Your Reply:</label>";
		$html .= "<textarea id='post-content-" . $row["id"] . "' name='post-content' rows='3' required></textarea>";
		$html .= "<label for='post-author-" . $row["id"] . "'>Your Name:</label>";
		$html .= "<input type='text' id='post-author-" . $row["id"] . "' name='post-author' required>";
		$html .= "<button type='submit'>Submit Reply</button>";
		$html .= "</form>";
		$html .= "</div>";
        $html .= "<hr>";

    }
    $html .= "</div>";
} else {
    $html .= "<p>No discussion posts found</p>";
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
    <title>Mentor/Mentee Forum</title>
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
		<h1>Mentor/Mentee Forum</h1>
		<h7 class="page-subtitle">“A mentor is someone who sees more talent and ability within you, than you see in yourself, and helps bring it out of you.” — Bob Proctor</h5>
	</header>
	<main>
		<div class="discussion-post-form">
		<?php echo "<div id='discussion-posts'>" . $html . "</div>"; ?>
		</div>
		<div class="discussion-post-form">
			<h2 class="form-title">Create a new discussion post</h2>
			<form action="../server.php" method="post">
			  <label for="post-title">Post Title:</label>
			  <input type="text" id="post-title" name="post-title" required>
			  
			  <label for="post-content">Post Content:</label>
			  <textarea id="post-content" name="post-content" rows="5" required></textarea>
			  
			  <label for="post-author">Your Name:</label>
			  <input type="text" id="post-author" name="post-author" required>
			  
			  <button type="submit">Submit Post</button>
			</form>
		  </div>
		<div class="question">
			<h2>How can I improve my public speaking skills?</h2>
			<p>I have a big presentation coming up and I'm nervous about speaking in front of a crowd. Any tips or advice?</p>
			<div class="rating">
				<label>Rate this question:</label>
				<input type="radio" name="rating" value="1"><label></label>
				<input type="radio" name="rating" value="2"><label></label>
				<input type="radio" name="rating" value="3"><label></label>
				<input type="radio" name="rating" value="4"><label></label>
				<input type="radio" name="rating" value="5"><label></label>
            </div>
        </div>
    </main>
<script>
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

