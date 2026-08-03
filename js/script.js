// var LoggedIn = false;
// var guest = document.getElementById("notLoggedIn");
// var user = document.getElementById("LoggedIn");

// if (LoggedIn == false) {
//     guest.style.display = "block";
// } else {
//     user.style.display = "block";
// }

// console.log(LoggedIn);

//Stops the form from reloading on submit
// Reference: https://dev.to/dangote/how-to-stop-page-reloads-in-javascript-with-eventpreventdefault-39l5

document.getElementById("noReloadForm").addEventListener("submit", (event) => {
  event.preventDefault(); // Magic line! Stops the reload.

  // Get the input value
  const inputValue = event.target.querySelector("input").value;

  // Display it on the page (no reload needed!)
  document.getElementById("demo").textContent = `Submitted: ${inputValue}`;

  console.log("Form submitted without reloading!");
});
