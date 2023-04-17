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
    <nav class="navbar navbar-expand-md fixed-top navbar-dark">
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
            <a onclick="logOut()" class="nav-link">Log Out</a>
        </div>
        </div>
		</div>
		</div>
    </nav>

<header>
		<h1 class="page-title">My Profile</h1>
		<h7 class="page-subtitle">"To be yourself in a world that is constantly trying to make you something else is the greatest accomplishment." ― Ralph Waldo Emerson</h7>
</header>

<main>
    <div class="container">
        <section id="profileCard">
        <div class="row">
        <div id="info" class="card profile">
        <div class="card-body">
        <div class="card-text">
            <i id="profile" class="bi bi-person-circle"></i>
            <p id="name">Brendan Quinn</p>
            <p id="role">Mentor</p> 
        </div>
        </div>
        </div>
        <br>
        <div id="about" class="card profile">
        <div class="card-body">
            <p class="card-text">
        <table class="aboutMe">
        <tr>
            <td>Email</td>
            <td>:</td>
            <td>jrivera@gmail.com</td>
        </tr>
        <tr>
            <td>Position </td>
            <td>:</td>
            <td>Web Developer</td>
        </tr>
        <tr>
            <td>Career Goals</td>
            <td>:</td>
            <td>Promotion</td>
            </tr>
        <tr>
            <td>Alma Mater</td>
            <td>:</td>
            <td>Arizona State University</td>
        </tr>
        <tr>
            <td>Posts</td>
            <td>:</td>
            <td>0</td>
        </tr>
        <tr>
            <td>Replies</td>
            <td>:</td>
            <td>3</td>
        </tr>
        <tr>
            <td>Likes</td>
            <td>:</td>
            <td>1724</td>
        </tr>
        </table>
        </p>

    </div>
    </div>
    </div>
    </section>
</div>
</main>
</body>
</html>