function logOut() {
	if (confirm("Are you sure you want to log out?") == true) {
		window.location.href = "../logout.php";
	} else {}
}