<div class="app" id="login-record">
    @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>登入紀錄</h1>
        <div class="nav mb-3">
          <button onclick="window.history.back()" class="btn btn-success">回前頁</button>
        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">帳號</th>
                <th scope="col">登入時間</th>
                <th scope="col">登入IP</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($list as $item)
                <tr>
                    <td scope="col">{{$item->username}}</td>
                    <td scope="col">{{$item->login_time}}</td>
                    @if(DB::table('login_record')->where([['login_ip', $item->login_ip], ['username', '<>', $item->username]])->count() > 0)
                    <td scope="col"><a href="/ipRecord/{{$item->login_ip}}" class="text-danger">{{$item->login_ip}}</a></td>
                    @else
                    <td scope="col">{{$item->login_ip}}</td>
                    @endif
                </tr>
                @endforeach
              
            </tbody>
          </table>
    </div>
</div>