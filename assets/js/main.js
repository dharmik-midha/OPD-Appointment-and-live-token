let login = document.getElementById("login");
let login_modal = document.getElementById("modal_container");
let close_login_btn = document.getElementById("cancelbtn");
let sign_up_btn = document.getElementById("signup");
let header = document.getElementById("header");
let sign_up_form=document.getElementById("sign_up");
let instructions_btn = document.getElementById("inst");

$(window).on('load', function() { // makes sure the whole site is loaded 
    $('#status').fadeOut(); // will first fade out the loading animation 
    $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
    $('body').delay(350).css({'overflow':'visible'});
  })

instructions_btn.addEventListener("click", function(){
    
})




// Hiding header data 
sign_up_btn.addEventListener("click", function(){
    document.getElementById("left_png").className = "left_png";
    header.style.backgroundImage="url('assets/images/bg2.png')";
    // document.getElementById("main_left_section").style.display="none";
    // document.getElementById("main_right_section").innerHTML=sign_up_form;
    sign_up_form.style.display = "block";
    });

// To open Login Modal 
login.addEventListener("click", function(){
    login_modal.style.display = "flex";
});
// To close Login Modal 
close_login_btn.addEventListener("click", function(){
    login_modal.style.display = "none";
});