<div id="home-componet" class="app">
  @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>管理者列表</h1>
        <div class="nav">
            <div class="form-group">
                <label for="">每頁顯示</label>
                <select name="" id="" class="form-control" wire:model="pageNumber">
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
            <div class="form-group ml-5">
                <label for="">搜尋</label>
                <input type="text" class="form-control searchInput" placeholder="搜尋..." wire:model="searchText">
            </div>

            <div class="from-group" style="margin-left:50px">
              <label for=""></label>
              <a href="/createMember"  class="btn btn-success block">新增會員</a>
            </div>
        </div>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">分站</th>
                <th scope="col">代理</th>
                <th scope="col">帳號</th>
                <th scope="col">姓名</th>
                <th scope="col">點數</th>
                <th scope="col">累計儲值</th>
                <th scope="col">遊戲內點數</th>
                <th scope="col">手機</th>
                <th scope="col">上次登入時間</th>
                <th scope="col">登入IP</th>
                <th scope="col">推薦人</th>
                <th scope="col">狀態</th>
                <th scope="col">註冊日期</th>
                <th scope="col">設定</th>
                {{-- <th scope="col">點數操作</th> --}}
              </tr>
            </thead>
            <tbody>
                @foreach ($downs as $down)
                <tr>
                    <td scope="col">{{$down['id']}}</td>
                    <td scope="col">SVT</td>
                    <td scope="col">{{ DB::table('users')->where('id', $down['toponline'])->first()->username }}</td>
                    <td scope="col"><a href="/loginRecord/{{$down->id}}" class="account-btn bg-transparent" >{{$down['username']}}</a></td>
                    <td scope="col">{{$down['name']}}</td>
                    <td scope="col">{{$down['money']}}</td>
                    <td scope="col">{{$down['total_money']}}</td>
                    <td scope="col">{{$down['game_money']}}</td>
                    <td scope="col">{{$down['phone']}}</td>
                    <td scope="col">{{$down['last_login_time']}}</td>
                    <td scope="col">{{$down['last_login_ip']}}</td>
                    <td scope="col">@if($down['recommender'] == NULL) - @else {{$down['recommender']}} @endif</td>
                    <td scope="col"> @if($down['status'] == 1) <button class="btn text-light closeStatusBtn"  value="{{$down->id}}">啟用</button> @else <button class="btn text-light openStatusBtn" value="{{$down->id}}">關閉</button> @endif</td>
                    <td scope="col">{{$down['created_at']}}</td>
                    <td scope="col"><a href="/setMember/{{$down->id}}" type="button" class="btn btn-success">設定</a></td>
                    {{-- <td scope="col"></td> --}}
                  </tr>
                @endforeach
              
            </tbody>
          </table>

          {{ $downs->links() }}
    </div>
</div>
