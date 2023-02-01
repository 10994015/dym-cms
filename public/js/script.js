/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/script.js ***!
  \********************************/
var downlineList = document.getElementById('downlineList');
var accountBtn = document.getElementsByClassName('account-btn');
var viewDownline = function viewDownline(e) {
  window.Livewire.emit('viewDownline', Number(e.target.id));
};
var closeStatusBtn = document.getElementsByClassName('closeStatusBtn');
var openStatusBtn = document.getElementsByClassName('openStatusBtn');
var openStatusFn = function openStatusFn(e) {
  if (confirm('確定開啟??')) {
    for (var i = 0; i < document.getElementsByClassName('closeStatusBtn').length; i++) {
      closeStatusBtn[i].removeEventListener('click', closeStatusFn);
    }
    for (var _i = 0; _i < document.getElementsByClassName('openStatusBtn').length; _i++) {
      openStatusBtn[_i].removeEventListener('click', openStatusFn);
    }
    window.Livewire.emit('openStatus', Number(e.target.value));
    e.target.classList.remove('openStatusBtn');
    e.target.classList.add('closeStatusBtn');
    e.target.innerText = "啟用";
    for (var _i2 = 0; _i2 < document.getElementsByClassName('closeStatusBtn').length; _i2++) {
      closeStatusBtn[_i2].addEventListener('click', closeStatusFn);
    }
    for (var _i3 = 0; _i3 < document.getElementsByClassName('openStatusBtn').length; _i3++) {
      openStatusBtn[_i3].addEventListener('click', openStatusFn);
    }
  }
};
var closeStatusFn = function closeStatusFn(e) {
  if (confirm('確定關閉??')) {
    for (var i = 0; i < document.getElementsByClassName('closeStatusBtn').length; i++) {
      closeStatusBtn[i].removeEventListener('click', closeStatusFn);
    }
    for (var _i4 = 0; _i4 < document.getElementsByClassName('openStatusBtn').length; _i4++) {
      openStatusBtn[_i4].removeEventListener('click', openStatusFn);
    }
    window.Livewire.emit('closeStatus', Number(e.target.value));
    e.target.classList.remove('closeStatusBtn');
    e.target.classList.add('openStatusBtn');
    e.target.innerText = "關閉";
    for (var _i5 = 0; _i5 < document.getElementsByClassName('closeStatusBtn').length; _i5++) {
      closeStatusBtn[_i5].addEventListener('click', closeStatusFn);
    }
    for (var _i6 = 0; _i6 < document.getElementsByClassName('openStatusBtn').length; _i6++) {
      openStatusBtn[_i6].addEventListener('click', openStatusFn);
    }
  }
};
for (var i = 0; i < closeStatusBtn.length; i++) {
  closeStatusBtn[i].addEventListener('click', closeStatusFn);
}
for (var _i7 = 0; _i7 < openStatusBtn.length; _i7++) {
  openStatusBtn[_i7].addEventListener('click', openStatusFn);
}
for (var _i8 = 0; _i8 < accountBtn.length; _i8++) {
  accountBtn[_i8].addEventListener('click', viewDownline);
}
var html = "";
window.addEventListener('viewDownlineFn', function (e) {
  var data = e.detail.data;
  html += "<table class=\"table\">\n    <thead>\n      <tr>\n        <th scope=\"col\">#</th>\n        <th scope=\"col\">\u5206\u7AD9</th>\n        <th scope=\"col\">\u7D1A\u5225</th>\n        <th scope=\"col\">\u5E33\u865F</th>\n        <th scope=\"col\">\u540D\u7A31</th>\n        <th scope=\"col\">\u4E0B\u7DDA</th>\n        <th scope=\"col\">\u6703\u54E1\u4EBA\u6578</th>\n        <th scope=\"col\">\u72C0\u614B</th>\n        <th scope=\"col\">\u6700\u5F8C\u767B\u5165\u65E5\u671F</th>\n        <th scope=\"col\">\u6703\u54E1\u5206\u7D05\u8A2D\u5B9A</th>\n        <th scope=\"col\">\u8A3B\u518A\u65E5\u671F</th>\n        <th scope=\"col\">\u65B0\u589E\u4E0B\u7DDA</th>\n        <th scope=\"col\">\u8A2D\u5B9A</th>\n      </tr>\n    </thead>\n    <tbody>";
  data.forEach(function (e) {
    var statusBtn = e.status === 1 ? "<button class=\"btn closeStatusBtn\" value=\"".concat(e.id, "\">\u555F\u7528</button>") : "<button class=\"btn openStatusBtn\" value=\"".concat(e.id, "\">\u95DC\u9589</button>");
    html += "<tr>\n        <td scope=\"col\">#</td>\n        <td scope=\"col\">".concat(e.sub, "</td>\n        <td scope=\"col\">").concat(e.level, "</td>\n        <td scope=\"col\"><span class=\"account-btn\" id=\"").concat(e.id, "\">").concat(e.username, "</span></td>\n        <td scope=\"col\">").concat(e.name, "</td>\n        <td scope=\"col\">").concat(e.downline, "</td>\n        <td scope=\"col\">").concat(e.member_num, "</td>\n        <td scope=\"col\"> ").concat(statusBtn, " </td>\n        <td scope=\"col\">").concat(e.last_login_date, "</td>\n        <td scope=\"col\">").concat(e.dividends, "</td>\n        <td scope=\"col\">").concat(e.register_date, "</td>\n        <td scope=\"col\"><a href=\"/createProxy\" class=\"btn btn-success\">\u65B0\u589E\u4E0B\u7DDA</a></td>\n        <td scope=\"col\"><a href=\"/setProxy/").concat(e.id, "\" class=\"btn btn-success\">\u8A2D\u5B9A</a></td>\n      </tr>");
  });
  html += " </tbody>\n    </table>";
  downlineList.innerHTML = html;
  for (var _i9 = 0; _i9 < accountBtn.length; _i9++) {
    accountBtn[_i9].addEventListener('click', viewDownline);
  }
  for (var _i10 = 0; _i10 < document.getElementsByClassName('closeStatusBtn').length; _i10++) {
    closeStatusBtn[_i10].addEventListener('click', closeStatusFn);
  }
  for (var _i11 = 0; _i11 < document.getElementsByClassName('openStatusBtn').length; _i11++) {
    openStatusBtn[_i11].addEventListener('click', openStatusFn);
  }
});
/******/ })()
;