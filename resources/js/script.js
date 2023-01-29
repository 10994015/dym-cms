// const userItem = document.getElementsByClassName('user-item');
// const url = document.getElementById('url');
// const unlock = document.getElementById('unlock');
// const lock = document.getElementById('lock');
// const cancel = document.getElementById('cancel');
// const info = document.getElementsByClassName('info');
// const viewDownline = e=>{
//     if(e.target.parentNode.querySelector('.down-line') != undefined){
//         if(e.target.parentNode.querySelector('.down-line').style.height == "auto"){
//             e.target.parentNode.querySelector('.down-line').style.height = "0";
//             e.target.querySelector('i').classList.remove('fa-caret-down');
//         }else{
//             e.target.parentNode.querySelector('.down-line').style.height = "auto";
//             e.target.querySelector('i').classList.add('fa-caret-down');
//         }
//     }
// }

// for(let i=0;i<userItem.length;i++){
//     userItem[i].addEventListener('click', viewDownline);
// }
// const changeQRcode =  ()=>{
//     $('#qrcode').html('');
//     if(url.value != "無"){
//         $('#qrcode').qrcode({
//             width: 120,
//             height: 120,
//             text: url.value
//         });
//     }
// }
// changeQRcode();
// window.addEventListener('viewUserInfo', e=>{
//     changeQRcode();
// })
// unlock.addEventListener('click', ()=>{
//     unlock.style.display = "none"
//     lock.style.display = "block"
//     cancel.style.display = "block"
//     for(let i=0;i<info.length;i++){
//         info[i].disabled = false;
//         info[i].classList.add('open');
//     }
// })
// lock.addEventListener('click', ()=>{
//     lock.style.display = "none"
//     unlock.style.display = "block"
//     cancel.style.display = "none"
//     for(let i=0;i<info.length;i++){
//         info[i].disabled = true;
//         info[i].classList.remove('open');
//     }
//     Swal.fire(
//         '更改成功！',
//         '',
//         'success'
//       )
// })
// cancel.addEventListener('click', ()=>{
//     lock.style.display = "none"
//     unlock.style.display = "block"
//     cancel.style.display = "none"
//     for(let i=0;i<info.length;i++){
//         info[i].disabled = true;
//         info[i].classList.remove('open');
//     }
// })
// window.Livewire.emit('calcMoney', winMoney);
const downlineList = document.getElementById('downlineList');
const accountBtn = document.getElementsByClassName('account-btn');

const viewDownline = (e)=>{
  window.Livewire.emit('viewDownline', Number(e.target.id));
}


const closeStatusBtn = document.getElementsByClassName('closeStatusBtn');
const openStatusBtn = document.getElementsByClassName('openStatusBtn');
const openStatusFn = (e)=>{
 
  if(confirm('確定開啟??')){

    for(let i=0;i<document.getElementsByClassName('closeStatusBtn').length;i++){
      closeStatusBtn[i].removeEventListener('click', closeStatusFn);
    }
    for(let i=0;i<document.getElementsByClassName('openStatusBtn').length;i++){
      openStatusBtn[i].removeEventListener('click', openStatusFn);
    }

    window.Livewire.emit('openStatus', Number(e.target.value));
    e.target.classList.remove('openStatusBtn');
    e.target.classList.add('closeStatusBtn');
    e.target.innerText = "啟用";


    for(let i=0;i<document.getElementsByClassName('closeStatusBtn').length;i++){
      closeStatusBtn[i].addEventListener('click', closeStatusFn);
    }
    for(let i=0;i<document.getElementsByClassName('openStatusBtn').length;i++){
      openStatusBtn[i].addEventListener('click', openStatusFn);
    }
  } 
 
 
}
const closeStatusFn = e=>{
  
  if(confirm('確定關閉??')){

    for(let i=0;i<document.getElementsByClassName('closeStatusBtn').length;i++){
      closeStatusBtn[i].removeEventListener('click', closeStatusFn);
    }
    for(let i=0;i<document.getElementsByClassName('openStatusBtn').length;i++){
      openStatusBtn[i].removeEventListener('click', openStatusFn);
    }

    window.Livewire.emit('closeStatus', Number(e.target.value));
    e.target.classList.remove('closeStatusBtn');
    e.target.classList.add('openStatusBtn');
    e.target.innerText = "關閉";

    for(let i=0;i<document.getElementsByClassName('closeStatusBtn').length;i++){
      closeStatusBtn[i].addEventListener('click', closeStatusFn);
    }
    for(let i=0;i<document.getElementsByClassName('openStatusBtn').length;i++){
      openStatusBtn[i].addEventListener('click', openStatusFn);
    }
  } 
 
}


for(let i=0;i<closeStatusBtn.length;i++){
  closeStatusBtn[i].addEventListener('click', closeStatusFn);
}
for(let i=0;i<openStatusBtn.length;i++){
  openStatusBtn[i].addEventListener('click', openStatusFn);
}
for(let i=0;i<accountBtn.length;i++){
  accountBtn[i].addEventListener('click', viewDownline);
}
let html = "";
window.addEventListener('viewDownlineFn', e=>{
    console.log(e.detail.data);
    

    let data = e.detail.data;
    html += `<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">分站</th>
        <th scope="col">級別</th>
        <th scope="col">帳號</th>
        <th scope="col">名稱</th>
        <th scope="col">下線</th>
        <th scope="col">會員人數</th>
        <th scope="col">狀態</th>
        <th scope="col">最後登入日期</th>
        <th scope="col">會員分紅設定</th>
        <th scope="col">註冊日期</th>
        <th scope="col">新增下線</th>
        <th scope="col">設定</th>
      </tr>
    </thead>
    <tbody>`;
    data.forEach(e => {
      let statusBtn = (e.status === 1) ? `<button class="btn closeStatusBtn" value="${e.id}">啟用</button>` : `<button class="btn openStatusBtn" value="${e.id}">關閉</button>`;
        html += `<tr>
        <td scope="col">#</td>
        <td scope="col">${e.sub}</td>
        <td scope="col">${e.level}</td>
        <td scope="col"><span class="account-btn" id="${e.id}">${e.username}</span></td>
        <td scope="col">${e.name}</td>
        <td scope="col">${e.downline}</td>
        <td scope="col">${e.member_num}</td>
        <td scope="col"> ${statusBtn} </td>
        <td scope="col">${e.last_login_date}</td>
        <td scope="col">${e.dividends}</td>
        <td scope="col">${e.register_date}</td>
        <td scope="col"><a href="/createProxy" class="btn btn-success">新增下線</a></td>
        <td scope="col"><button type="button" class="btn btn-success">設定</button></td>
      </tr>`;
    });

    html += ` </tbody>
    </table>`;

    downlineList.innerHTML = html;

    for(let i=0;i<accountBtn.length;i++){
      accountBtn[i].addEventListener('click', viewDownline);
    }
    for(let i=0;i<document.getElementsByClassName('closeStatusBtn').length;i++){
      closeStatusBtn[i].addEventListener('click', closeStatusFn);
    }
    for(let i=0;i<document.getElementsByClassName('openStatusBtn').length;i++){
      openStatusBtn[i].addEventListener('click', openStatusFn);
    }
})