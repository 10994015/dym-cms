/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/script.js ***!
  \********************************/
var userItem = document.getElementsByClassName('user-item');
var url = document.getElementById('url');
var unlock = document.getElementById('unlock');
var lock = document.getElementById('lock');
var cancel = document.getElementById('cancel');
var info = document.getElementsByClassName('info');
var viewDownline = function viewDownline(e) {
  if (e.target.parentNode.querySelector('.down-line') != undefined) {
    if (e.target.parentNode.querySelector('.down-line').style.height == "auto") {
      e.target.parentNode.querySelector('.down-line').style.height = "0";
      e.target.querySelector('i').classList.remove('fa-caret-down');
    } else {
      e.target.parentNode.querySelector('.down-line').style.height = "auto";
      e.target.querySelector('i').classList.add('fa-caret-down');
    }
  }
};
for (var i = 0; i < userItem.length; i++) {
  userItem[i].addEventListener('click', viewDownline);
}
var changeQRcode = function changeQRcode() {
  $('#qrcode').html('');
  if (url.value != "無") {
    $('#qrcode').qrcode({
      width: 120,
      height: 120,
      text: url.value
    });
  }
};
changeQRcode();
window.addEventListener('viewUserInfo', function (e) {
  changeQRcode();
});
unlock.addEventListener('click', function () {
  unlock.style.display = "none";
  lock.style.display = "block";
  cancel.style.display = "block";
  for (var _i = 0; _i < info.length; _i++) {
    info[_i].disabled = false;
    info[_i].classList.add('open');
  }
});
lock.addEventListener('click', function () {
  lock.style.display = "none";
  unlock.style.display = "block";
  cancel.style.display = "none";
  for (var _i2 = 0; _i2 < info.length; _i2++) {
    info[_i2].disabled = true;
    info[_i2].classList.remove('open');
  }
  Swal.fire('更改成功！', '', 'success');
});
cancel.addEventListener('click', function () {
  lock.style.display = "none";
  unlock.style.display = "block";
  cancel.style.display = "none";
  for (var _i3 = 0; _i3 < info.length; _i3++) {
    info[_i3].disabled = true;
    info[_i3].classList.remove('open');
  }
});
/******/ })()
;