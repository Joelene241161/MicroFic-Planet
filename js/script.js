var LoggedIn = false;
var guest = document.getElementById("notLoggedIn");
var user = document.getElementById("LoggedIn");

if (LoggedIn == false) {
    guest.style.display = "block";
} else {
    user.style.display = "block";
}

console.log(LoggedIn);

