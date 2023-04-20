$(".sidebar .grandul .client-btn").click(function () {
    $(".sidebar .grandul .souscli").toggleClass("show");
    $(".sidebar .grandul .toggle1").toggleClass("rotate1");
});
$(".sidebar .grandul .compte-btn").click(function () {
    $(".sidebar .grandul .souscpt").toggleClass("show2");
    $(".sidebar .grandul .toggle2").toggleClass("rotate2"); 
});
$(".sidebar .grandul .transaction-btn").click(function () {
    $(".sidebar .grandul .soustrans").toggleClass("show4");
    $(".sidebar .grandul .toggle4").toggleClass("rotate4"); 
});
$(".navbare .navbar .content .dropdown").click(function () {
    $(".navbare .navbar .content .elmts").toggleClass("show3");
    $(".navbare .navbar .content .toggle").toggleClass("rotate3");
});

// gestion du menu
$('#menu_icon').click(function () {
    $('#menu_icon').css('display', 'none');
    $('#menu_icon1').css('display', 'block');
    $("#sidebar").addClass("augmenter");
    $('.sidebar a').css('color', '#02501c');
    $("#navbare").addClass("ajout");
    $("#centre").addClass("ajout1");
    console.log('oui');
}); 

$("#menu_icon1").click(function () {
    $("#sidebar").removeClass("augmenter");
    $("#navbare").removeClass("ajout");
    $("#centre").removeClass("ajout1");
    $('.sidebar a').css('color', '');
    $(".sidebar .grandul .souscli").removeClass("show");
    $(".sidebar .grandul .souscpt").removeClass("show2");
    $(".sidebar .grandul .soustrans").removeClass("show4");
    $(".navbare .navbar .content .elmts").removeClass("show3");
    $(".sidebar .grandul .toggle1").removeClass("rotate1");
    $(".sidebar .grandul .toggle2").removeClass("rotate2");
    $(".sidebar .grandul .toggle4").removeClass("rotate4");
    $(".navbare .navbar .content .toggle").removeClass("rotate3");
    $('#menu_icon1').css('display','');
    $('#menu_icon').css('display', 'block');
    console.log("oui");
});
