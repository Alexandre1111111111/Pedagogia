function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
  }
const ng = document.querySelector(".ng");
const input = document.getElementsByTagName("input");
const senha = document.querySelector("#senha");

if(document.querySelector(".ng")) {
  senha.style.marginBottom = "0";
}
else {
  senha.style.marginBottom = "6vh";
}

for (let i = 0; i < input.length; i++) {
  input[i].addEventListener("input", () => {
    ng.style.display = "none";
    senha.style.marginBottom = "6vh";
  })
}

