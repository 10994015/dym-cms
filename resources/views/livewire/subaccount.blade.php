<div class="app" id="subaccount">
    @include('livewire.components.slidebar')
   <div class="main-content">
        <h1>子帳號管理</h1>
        <div class="nav">
            <div class="form-group">
                <label for="">每頁顯示</label>
                <select name="" id="" class="form-control" wire:model="pageNumber">
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
            <div class="form-group">
                <a href="/createSubaccount" class="btn btn-success">新增子帳號</a>
            </div>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">分站</th>
                <th scope="col">級別</th>
                <th scope="col">帳號</th>
                <th scope="col">名稱</th>
                <th scope="col">狀態</th>
                <th scope="col">最後登入日期</th>
                <th scope="col">建立日期</th>
                <th scope="col">新增下線</th>
                <th scope="col">設定</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td scope="col">#</td>
                    <td scope="col">SMT</td>
                    <td scope="col">子帳號</td>
                    <td scope="col"><span class="account-btn">{{$user['username']}}</span></td>
                    {{-- <td scope="col"><span class="account-btn" wire:click='viewDownline({{$me['id']}})'>{{$me['username']}}</span></td> --}}
                    <td scope="col">{{$user['name']}}</td>
                    <td scope="col">   @if($user['status'] == 1) <button class="btn closeStatusBtn" value="{{$user['id']}}">啟用</button> @else <button class="btn openStatusBtn" value="{{$user['id']}}">關閉</button> @endif </td>
                    <td scope="col">{{$user['last_login_time']}}</td>
                    <td scope="col">{{$user['created_at']}}</td>
                    <td scope="col"><a href="/createSubProxy/{{$user['id']}}" class="btn btn-success">新增下線</a></td>
                    <td scope="col"><a href="/setSubaccount/{{$user['id']}}" class="btn btn-success">設定</a></td>
                  </tr>
                @endforeach
              
            </tbody>
          </table>
   </div>

  
</div>