<?php
$host = "107.180.1.16:3306";
$username = "sprc2023team2";
$password = "sprc2023team2";
$dbname = "sprc2023team2";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT post_author, COUNT(*) AS total FROM (
    SELECT post_author FROM discussion_questions
    UNION ALL
    SELECT author FROM discussion_replies
) AS authors GROUP BY post_author HAVING total > 0 ORDER BY total DESC";

$result = mysqli_query($conn, $sql);

$rank_html = "";

if (mysqli_num_rows($result) > 0) {
    $rank_html .= "<table id='leaderboard'>";
    $rank_html .= "<tr><th style='text-align:center; font-size:auto;'>Rank</th><th></th><th style='text-align: center; font-size:auto;'>Author</th><th></th><th style='text-align: center; font-size:auto;'>Points</th></tr>";
    $rank = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $rank_html .= "<tr>";
        if ($rank == 1) {
            $rank_html .= "<td><i class='bi bi-1-circle-fill' style='color: gold;'></i></td>";
        } elseif ($rank == 2) {
            $rank_html .= "<td><i class='bi bi-2-circle-fill' style='color: silver;'></i></td>";
        } elseif ($rank == 3) {
            $rank_html .= "<td><i class='bi bi-3-circle-fill' style='color: orange;'></i></td>";
        } else {
            $rank_html .= "<td><i class='bi bi-" . $rank . "-circle-fill' style='color: black;'></i></td>";
        }
        $rank_html .= "<td><i class='bi bi-person-circle'></i></td><td>" . $row["post_author"] . "</td><td>";
		for ($i = 0; $i < floor($row["total"] / 1); $i++) {
			$rank_html .= "<i class='bi bi-heart-fill' style='color:#bf3a5e;'></i> ";
		}
        $rank_html .= "</td><td>" . $row["total"] . "</td></tr>";
        $rank++;
    }
    $rank_html .= "</table>";
} else {
    $rank_html .= "<p>No authors found</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="../style.css">

	<script type="text/javascript" src="../javascript.js"></script>

    <title>Mentor/Mentee Forum</title>
</head>

<body class="scroll-top" data-bs-spy="scroll" data-bs-target=".navbar">
	<nav class="navbar navbar-expand-md fixed-top navbar-dark" style="background-color: lightblue;">
		<div class="container">
		  <a class="navbar-brand" href="./profile.php"><i class="bi bi-person-circle"></i></a>
		  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<a href="./disscussion_board.php" class="nav-link">Discussion</a>
				<a href="./leaderboard.php" class="nav-link">Leaderboard</a>
				<a href="./prizes.php" class="nav-link">Prizes</a>
				<a href="#" onclick="logOut()" class="nav-link">Log Out</a>
			</div>
		  </div>
		</div>
	  </nav>

<header>
	<i class="bi bi-trophy-fill"></i><h1 class="page-title">Leaderboard</h1>
	<h7 class="page-subtitle">
		"A genuine leader is not a searcher for consensus but a molder of consensus." — Martin Luther King Jr.</h5>
</header>

<main>
<?php echo $rank_html; ?>
</main>
</body>
</html>