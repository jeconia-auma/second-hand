const signin = document.getElementById("login");
signin.addEventListener('click', changeurl);

function changeurl(){
    window.location.replace('login.php');
}