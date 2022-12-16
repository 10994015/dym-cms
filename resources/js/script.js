const userItem = document.getElementsByClassName('user-item');
const url = document.getElementById('url');
const unlock = document.getElementById('unlock');
const lock = document.getElementById('lock');
const cancel = document.getElementById('cancel');
const info = document.getElementsByClassName('info');
const viewDownline = e=>{
    if(e.target.parentNode.querySelector('.down-line') != undefined){
        if(e.target.parentNode.querySelector('.down-line').style.height == "auto"){
            e.target.parentNode.querySelector('.down-line').style.height = "0";
            e.target.querySelector('i').classList.remove('fa-caret-down');
        }else{
            e.target.parentNode.querySelector('.down-line').style.height = "auto";
            e.target.querySelector('i').classList.add('fa-caret-down');
        }
    }
}

for(let i=0;i<userItem.length;i++){
    userItem[i].addEventListener('click', viewDownline);
}
const changeQRcode =  ()=>{
    $('#qrcode').html('');
    if(url.value != "無"){
        $('#qrcode').qrcode({
            width: 120,
            height: 120,
            text: url.value
        });
    }
   
}
changeQRcode();
window.addEventListener('viewUserInfo', e=>{
    changeQRcode();
})
unlock.addEventListener('click', ()=>{
    unlock.style.display = "none"
    lock.style.display = "block"
    cancel.style.display = "block"
    for(let i=0;i<info.length;i++){
        info[i].disabled = false;
        info[i].classList.add('open');
    }
})
lock.addEventListener('click', ()=>{
    lock.style.display = "none"
    unlock.style.display = "block"
    cancel.style.display = "none"
    for(let i=0;i<info.length;i++){
        info[i].disabled = true;
        info[i].classList.remove('open');
    }
    Swal.fire(
        '更改成功！',
        '',
        'success'
      )
})
cancel.addEventListener('click', ()=>{
    lock.style.display = "none"
    unlock.style.display = "block"
    cancel.style.display = "none"
    for(let i=0;i<info.length;i++){
        info[i].disabled = true;
        info[i].classList.remove('open');
    }
})