$('.sidebar .grandul .client-btn').click(function () {
    $('.sidebar .grandul .souscli').toggleClass("show");
    $('.sidebar .grandul .toggle1').toggleClass("rotate1");
});
$('.sidebar .grandul .compte-btn').click(function () {
    $('.sidebar .grandul .souscpt').toggleClass("show2");
    $('.sidebar .grandul .toggle2').toggleClass("rotate2");
});
$('.navbare .navbar .content .dropdown').click(function () {
    $('.navbare .navbar .content .elmts').toggleClass("show3");
    $('.navbare .navbar .content .toggle').toggleClass("rotate3");
    // alert('bomjoure');
});

// gestion du menu
$('#menu_icon').click(function () {
    $('#sidebar').toggleClass('hide')
    console.log('oui');
});