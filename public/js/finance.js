$(".sidebar .grandul .client-btn").click(function () {
    $(".sidebar .grandul .souscli").toggleClass("show");
    $(".sidebar .grandul .toggle1").toggleClass("rotate1");
});
$(".sidebar .grandul .compte-btn").click(function () {
    $(".sidebar .grandul .souscpt").toggleClass("show2");
    $(".sidebar .grandul .toggle2").toggleClass("rotate2");
});
$(".navbare .navbar .content .dropdown").click(function () {
    $(".navbare .navbar .content .elmts").toggleClass("show3");
    $(".navbare .navbar .content .toggle").toggleClass("rotate3");
    // alert('bomjoure');
});

// gestion du menu
// $('#menu_icon').click(function () {
//     $('#sidebar').toggleClass('hide');
//     $('#navbare').toggleClass('ajout');
//     $('#centre').toggleClass('ajout1');
//     console.log('oui');
// });
$("#sidebar").hover(function () {
    $("#sidebar").addClass("augmenter");
    $("#navbare").addClass("ajout");
    $("#centre").addClass("ajout1");
    console.log("oui");
});

$("#sidebar").mouseleave(function () {
    $("#sidebar").removeClass("augmenter");
    $("#navbare").removeClass("ajout");
    $("#centre").removeClass("ajout1");
    $(".sidebar .grandul .souscli").removeClass("show");
    $(".sidebar .grandul .souscpt").removeClass("show2");
    $(".navbare .navbar .content .elmts").removeClass("show3");
    $(".sidebar .grandul .toggle1").removeClass("rotate1");
    $(".sidebar .grandul .toggle2").removeClass("rotate2");
    $(".navbare .navbar .content .toggle").removeClass("rotate3");
    console.log("oui");
});
