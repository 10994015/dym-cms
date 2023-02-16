<div class="app" id="store-record">
    @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>儲值紀錄</h1>
        <div class="nav mb-3">
            <button onclick="window.history.back()" class="btn btn-success" style="width:80px">回前頁</button>
        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">帳號</th>
                <th scope="col">上下分</th>
                <th scope="col">儲值金額</th>
                <th scope="col">上分類別</th>
                <th scope="col">操作人員</th>
                <th scope="col">操作時間</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($list as $item)
                <tr>
                    <td>{{DB::table('users')->where('id', $item->member_id)->first()->username}}</td>
                    <td>{{$item->store==1 ? "上分" : "下分"}}</td>
                    <td><span class="fw-bold  @if($item->store==1) text-success @elseif($item->store==-1) text-danger @endif">{{$item->money}}</span></td>
                    @if($item->store==1)
                    <td class="text-success"> @if($item->store_type==1) 車商上分 @elseif($item->store_type==2) 手動上分 @elseif($item->store_type==3) 活動上分 @endif</td>
                    @else
                    <td class="text-danger"> @if($item->store_type==4) 違規下分 @elseif($item->store_type==5) 出款下分 @elseif($item->store_type==6) 活動下分 @endif</td>
                    @endif
                    <td>{{DB::table('users')->where('id', $item->proxy_id)->first()->username}}</td>
                    <td>{{$item->created_at}}</td>
                </tr>
                @endforeach
              
            </tbody>
          </table>
    </div>
</div>