<div id="home-componet" class="app" wire:ignore>
    @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>管理者列表</h1>
        @if(request()->session()->has('status')) <b class="text-success" style="margin:20px 0;"> {{request()->session()->get('status')}} </b> @endif
        <div class="nav">
          {{-- @if(Auth::user()->highest_auth === 1)
          <div class="float-left">
            <a href="/subaccount" class="btn btn-success ">子帳號管理</a>
          </div>
          @endif --}}
            {{-- <div class="form-group ">
                <label for="">每頁顯示</label>
                <select name="" id="" class="form-control">
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div> --}}
            {{--  <div class="form-group " >
                <label for="">搜尋代理</label>
                <input type="text" class="form-control searchInput" placeholder="搜尋代理..." >
            </div>--}}

           <div class="form-group flex items-center" >
              <input type="text" class="form-control searchInput " placeholder="搜尋帳號..." wire:model="searchText" />
              <button class="btn btn-primary ml-2" id="searchBtn" wire:click="searchFn">搜尋</button>
          </div> 
        </div>
        <table class="table">
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
              {{-- <th scope="col">會員分紅設定</th> --}}
              <th scope="col">註冊日期</th>
              @if(Auth::user()->is_create_member)
              <th scope="col">新增下線</th>
              @endif
              <th scope="col">設定</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td scope="col">#</td>
              <td scope="col">SMT</td>
              <td scope="col">{{$me['level']}}</td>
              <td scope="col"><span class="account-btn" id="{{$me['id']}}">{{$me['username']}}</span></td>
              {{-- <td scope="col"><span class="account-btn" wire:click='viewDownline({{$me['id']}})'>{{$me['username']}}</span></td> --}}
              <td scope="col">{{$me['name']}}</td>
              <td scope="col">{{$me['downline']}}</td>
              <td scope="col">{{$me['member_num']}}</td>
              <td scope="col">   @if($me['status'] == 1) <button class="btn closeStatusBtn" disabled value="{{$me['id']}}">啟用</button> @else <button class="btn openStatusBtn" value="{{$me['id']}}">關閉</button> @endif </td>
              <td scope="col">{{$me['last_login_date']}}</td>
              {{-- <td scope="col">{{$me['dividends']}}</td> --}}
              <td scope="col">{{$me['register_date']}}</td>
              @if(Auth::user()->is_create_member)
              <td scope="col"><a href="/createProxy/{{$me['id']}}" class="btn btn-success">新增下線</a></td>
              @endif
              <td scope="col"><a href="/setProxy/{{$me['id']}}" class="btn btn-success">設定</a></td>
            </tr>
          </tbody>
        </table>
        
          <div id="searchList">
            
          </div>
          <div id="downlineList">
           
          </div>
          
    </div>


    <script>


    </script>
</div>
