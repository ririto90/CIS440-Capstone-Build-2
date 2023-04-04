<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	  <!-- CSS file -->
	  <link rel="stylesheet" type="text/css" href="../style.css">
	  <!-- Javascript -->
	  <script type="text/javascript" src="../javascript.js"></script>
    <title>Mentor/Mentee Forum</title>
</head>
  <body>
    <header>
		  <h1 style="font-size: 500%;">Create An Account</h1>
	  </header>
    <main class="account">
        <form>
            <div class="container">
                <h1>Sign Up</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>
                <div id="inputs" style="text-align:center; font-size:large;">
                  <label for="name"><b>Username: </b></label>
                  <input type="text" placeholder="Enter Username" name="name" required>
                  <br>
                  <label for="email"><b>Email: </b></label>
                  <input type="text" placeholder="Enter Email" name="email" required>
                  <br>
                  <label for="psw"><b>Password: </b></label>
                  <input type="password" placeholder="Enter Password" name="psw" required>
                  <br>
                <div id="buttons">
                  <br>
                  <a href="./home.html"><button type="button" class="cancelbtn">Cancel</button></a>
                  <a href="./disscussion_board.html"><button type="submit" class="signupbtn">Sign Up</button></a>
                </div>
                </div>
            </div>
        </form>
    </main>
  </body>
</html>