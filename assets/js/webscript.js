$(document).ready(function() { 
    $("#adminProfile").click(function() {
        $("#settingsMenu").slideToggle("fast"); 
    });
    
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar, #content').toggleClass('active');
        //$('.collapse.in').toggleClass('in');
    });
    
    $("#loginForm").click(function (e) {
        if ($(e.target).is('#loginForm')) {
            $('#loginForm').fadeOut(100);
        }
    });
});

function popoutLogin() {
    document.getElementById('loginForm').style.display='block'
}

function modalPop(y){
    if (y==1){
        document.getElementById("changePassForm").style.display = "block";
    }
    else {
        document.getElementById("changePassForm").style.display = "none";
    }
    
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