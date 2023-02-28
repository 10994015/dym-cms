<div id="nextUserPoint" class="app" >
    @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>下分管理</h1>
        @if(session()->has('error'))
            <div class="alert alert-danger"> {{session('error')}} </div>
        @endif
        <table class="table table-striped table-bordered">
            <tbody>
              <tr>
                <th>帳號</th>
                <td><input type="text" class="form-control" disabled wire:model="username" /></td>
              </tr>
              <tr>
                <th>名稱</th>
                <td><input type="text" class="form-control" disabled value="" wire:model="name" /></td>
              </tr>
              <tr>
                <th>目前點數</th>
                <td><input type="text" class="form-control" disabled value="" wire:model="money" /></td>
              </tr>
              <tr>
                <th>選擇上下分</th>
                <td>
                    <select class="form-control" wire:model="store">
                        {{-- <option value="1">上分</option> --}}
                        <option value="-1">下分</option>
                    </select>
                </td>
              </tr>
              <tr>
                <th></th>
                <td>
                    <select class="form-control" wire:model="store_type">
                        <option value="1">違規下分</option>
                        <option value="2">出款下分</option>
                        <option value="3">活動下分</option>
                    </select>
                </td>
              </tr>
              <tr>
                <th>點數</th>
                <td>
                    <input type="number" class="form-control" placeholder="輸入點數..." wire:model="point">
                </td>
              </tr>
              <tr>
                <td colspan="2">
                    <button class="btn btn-primary float-right mr-3" onclick="window.history.back()" >返回</button>
                    <button class="btn btn-primary float-right mr-3" wire:click="storePoint">確認</button>
                </td>
              </tr>
            </tbody>
          </table>
    </div>


    <script>
        window.addEventListener("storeSuccessFn", ()=>{
            alert("更新成功!!");
            window.location.reload();
        });
        windaow.addEventListener("storeErrorFn", ()=>{
            alert("交易失敗！下分金額須超過0");
            window.location.reload();
        })
        windaow.addEventListener("storeError2Fn", ()=>{
            alert("交易失敗！會員餘額不足！");
            window.location.reload();
        })
    </script>
</div>
