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
$(".sidebar .grandul .beneficiaire-btn").click(function () {
    $(".sidebar .grandul .sousul").toggleClass("show5");
    $(".sidebar .grandul .toggle5").toggleClass("rotate5");
});
$(".navbare .navbar .content .dropdown").click(function () {
    $(".navbare .navbar .content .elmts").toggleClass("show3");
    $(".navbare .navbar .content .toggle").toggleClass("rotate3");
});
$(".sidebar .grandul .paramt-btn").click(function () {
    $(".sidebar .grandul .paramt").toggleClass("show6");
    $(".sidebar .grandul .toggle6").toggleClass("rotate6");
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
    $(".sidebar .grandul .sousul").removeClass("show5");
    $(".sidebar .grandul .paramt").removeClass("show6");
    $(".navbare .navbar .content .elmts").removeClass("show3");
    $(".sidebar .grandul .toggle1").removeClass("rotate1");
    $(".sidebar .grandul .toggle2").removeClass("rotate2");
    $(".sidebar .grandul .toggle4").removeClass("rotate4");
    $(".sidebar .grandul .toggle5").removeClass("rotate5");
    $(".sidebar .grandul .toggle6").removeClass("rotate6");
    $(".navbare .navbar .content .toggle").removeClass("rotate3");
    $('#menu_icon1').css('display','');
    $('#menu_icon').css('display', 'block');
    console.log("oui");
});

// document.getElementById("telephone").addEventListener("keydown", function(e) {
// const txt = this.value;
// // prevent more than 12 characters, ignore the spacebar, allow the backspace
// if ((txt.length == 12 || e.which == 32) & e.which !== 8) e.preventDefault();
// // add spaces after 3 & 7 characters, allow the backspace
// if ((txt.length == 3 || txt.length == 7) && e.which !== 8)
//     this.value = this.value + " ";
// });
// // when the form is submitted, remove the spaces
// document.forms[0].addEventListener("submit", e => {
// e.preventDefault();
// const phone = e.target.elements["phone"];
// phone.value = phone.value.replaceAll(" ", "");
// console.log(phone.value);
// //e.submit();
// });

const phone = document.getElementById("telephone");
phone.addEventListener("keyup", function(e) {
  let txt = this.value.replace(/\D/g, '');
  let newtxt = '';
  //now copy the number inserting a space where needed
  for (let i = 0; i < Math.min(txt.length, 9); i++) {
    newtxt += txt[i];
    if ((i == 2) || (i == 5)) {
      newtxt += ' ';
    }
  }
  if (newtxt[newtxt.length - 1] == ' ') newtxt = newtxt.substring(0, newtxt.length - 1);
  this.value = newtxt;
});
// // when the form is submitted, remove the spaces
// document.forms[0].addEventListener("submit", e => {
//     // e.preventDefault();
//     const phone = e.target.elements["telephone"];
//     phone.value = phone.value.replaceAll(" ", "");
//     console.log(phone.value);
//     //e.submit();
// });
