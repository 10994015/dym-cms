<div class="app" id="ip-record">
    @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>IP紀錄</h1>
        <div class="nav mb-3">
            <button class="btn btn-success" onclick="window.history.back()">回前頁</button>
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
                    <th scope="col">{{$item->username}}</th>
                    <th scope="col">{{$item->login_time}}</th>
                    <th scope="col">{{$item->login_ip}}</th>
                </tr>
                @endforeach
              
            </tbody>
          </table>
    </div>
</div>