function logOut() {
	if (confirm("Are you sure you want to log out?") == true) {
		location.href = "../html/home.php";
	} else {}
}


// Add event listeners for the like buttons
var likeBtns = document.getElementsByClassName('like-btn');
for (var i = 0; i < likeBtns.length; i++) {
    likeBtns[i].addEventListener('click', function() {
        this.style.color = 'yellow';
    });
}
