<div id="setProxy" class="app" wire:ignore>
    @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>編輯會員</h1>
        <table class="table table-striped table-bordered">
            <tbody>
              <tr>
                <th>分站</th>
                <td><input type="text" class="form-control" disabled wire:model="substation" /></td>
              </tr>
              <tr>
                <th>上線</th>
                <td><input type="text" class="form-control" disabled wire:model="topline_name"  /></td>
              </tr>
              <tr>
                <th>推廣網址</th>
                <td><input type="text" class="form-control url" disabled wire:model="url"  /></td>
              </tr>
              <tr>
                <th>帳號</th>
                <td><input type="text" class="form-control" disabled wire:model="username"  /></td>
              </tr>
              <tr>
                <th>名稱</th>
                <td><input type="text" class="form-control"  wire:model="name"  /></td>
              </tr>
              <tr>
                <th>可否新增會員</th>
                <td>
                  <label for="isCreateMember">
                    <input type="checkbox" id="isCreateMember" class="form-control mr-2"  wire:model="isCreateMember" />是
                  </label>
                </td>
              </tr>
              <tr>
                <th></th>
                <td><a href="/changeProxyPassword/{{$proxy_id}}" class="btn btn-primary">密碼修改</a></td>
              </tr>
              {{-- @if(Auth::user()->highest_auth === 1)
              <tr>
                <th></th>
                <td><button type="button" class="btn btn-danger bg-danger float-right" id="deleteProxyBtn" >刪除代理</button></td>
              </tr>
              @endif --}}
              <tr>
                <td colspan="2">
                    <button onclick="window.history.back()" class="btn btn-primary float-right">返回</button>
                    <button class="btn btn-primary float-right mr-3" wire:click="changeProxyInfo">確認</button>
                </td>
              </tr>
            </tbody>
          </table>
    </div>


    <script>
        // const updateTopline = document.getElementById('updateTopline');
        // const topline = document.getElementById('topline');
        // updateTopline.addEventListener('click', e=>{
        //     if(confirm('確定修改??')){
        //         topline.disabled = false;
        //     }
        // })
        window.addEventListener("successFn", ()=>{
            alert("編輯成功!!")
        })
        window.addEventListener("deleteSuccessFn", ()=>{
            alert("刪除成功!!");
            window.location.href = '/';
        })
        // const deleteProxyBtn = document.getElementById('deleteProxyBtn');
        // deleteProxyBtn.addEventListener('click', ()=>{
        //   if(confirm('確定要刪除嗎?刪除後就無法復原')){
        //     if(confirm('再次確認')){
        //       window.Livewire.emit('deleteProxy');
        //     }
        //   }
        // });
    </script>
</div>
