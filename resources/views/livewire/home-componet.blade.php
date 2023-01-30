<div id="home-componet" wire:ignore>
    <div class="slidebar">
        <ul>
            <a href="/">代理管理</a>
            <a href="/member">會員管理</a>
        </ul>
    </div>
    <div class="main-content">
        <h1>管理者列表</h1>
        @if(request()->session()->has('status')) <b class="text-success" style="margin:20px 0;"> {{request()->session()->get('status')}} </b> @endif
        <div class="nav">
            {{-- <div class="form-group ">
                <label for="">每頁顯示</label>
                <select name="" id="" class="form-control">
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div> --}}
            {{-- <div class="form-group " >
                <label for="">搜尋代理</label>
                <input type="text" class="form-control searchInput" placeholder="搜尋代理..." >
            </div>
            <div class="form-group " >
              <label for="">搜尋帳號</label>
              <input type="text" class="form-control searchInput" placeholder="搜尋帳號..." >
          </div> --}}
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
                <th scope="col">會員分紅設定</th>
                <th scope="col">註冊日期</th>
                <th scope="col">新增下線</th>
                <th scope="col">設定</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td scope="col">#</td>
                <td scope="col">DYM</td>
                <td scope="col">{{$me['level']}}</td>
                <td scope="col"><span class="account-btn" id="{{$me['id']}}">{{$me['username']}}</span></td>
                {{-- <td scope="col"><span class="account-btn" wire:click='viewDownline({{$me['id']}})'>{{$me['username']}}</span></td> --}}
                <td scope="col">{{$me['name']}}</td>
                <td scope="col">{{$me['downline']}}</td>
                <td scope="col">{{$me['member_num']}}</td>
                <td scope="col">   @if($me['status'] == 1) <button class="btn closeStatusBtn" value="{{$me['id']}}">啟用</button> @else <button class="btn openStatusBtn" value="{{$me['id']}}">關閉</button> @endif </td>
                <td scope="col">{{$me['last_login_date']}}</td>
                <td scope="col">{{$me['dividends']}}</td>
                <td scope="col">{{$me['register_date']}}</td>
                <td scope="col"><a href="/createProxy" class="btn btn-success">新增下線</a></td>
                <td scope="col"><button type="button" class="btn btn-success">設定</button></td>
              </tr>
            </tbody>
          </table>

          <div id="downlineList">
           
          </div>
          
    </div>
</div>
