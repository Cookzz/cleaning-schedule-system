$(document).ready(function() {
    //testing code
    $("#nav2").click(function() {
        $("#menu").slideToggle("fast"); 
    });
    
    $("#n-nav2").click(function() {
        $("#anothermenu").slideToggle("fast"); 
    });
    
    $(".loginBtn").on("click", popoutLogin);
    
    $(".loginForm").submit(function(){
        $(".loginBtn").off("click", popoutLogin);
    });
    
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar, #content').toggleClass('active');
        //$('.collapse.in').toggleClass('in');
    });
});

var modal = document.getElementById('loginForm');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function popoutLogin() {
    document.getElementById('loginForm').style.display='block'
}

function signLogin(x) {
    if (x == 1) {
        document.getElementById("loginForm").style.display = "none";
        document.getElementById("forgotForm").style.display = "inline";
    }
    else {
        document.getElementById("loginForm").style.display = "inline";
        document.getElementById("forgotForm").style.display = "none";
    }
}