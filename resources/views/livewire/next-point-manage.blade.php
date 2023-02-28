<div id="next-point-manage" class="app">
    @include('livewire.components.slidebar')
      <div class="main-content">
          <h1>管理者列表</h1>
          <div class="nav">
              <div class="form-group">
                  <label for="">每頁顯示</label>
                  <select class="form-control" wire:model="pageNumber">
                      <option value="15">15</option>
                      <option value="25">25</option>
                      <option value="50">50</option>
                  </select>
              </div>
              <div class="form-group ml-5">
                  <label for="">搜尋</label>
                  <input type="text" class="form-control searchInput" placeholder="搜尋..." wire:model="searchText">
              </div>
              
          </div>
          <div class="form-group mt-4">
            <a href="/nextPointManage" class="btn btn-info ml-3">下分管理</a>
            <a href="/memberOutPoint" class="btn btn-success ml-3">單項會員下分</a>
            <a href="/paymentReview" class="btn btn-primary ml-3">出款審核</a>
          </div>
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">分站</th>
                  <th scope="col">帳號</th>
                  <th scope="col">姓名</th>
                  <th scope="col">訂單編號</th>
                  <th scope="col">代理</th>
                  <th scope="col">下分金額</th>
                  <th scope="col">下分類別</th>
                  <th scope="col">狀態</th>
                  <th scope="col">操作人員</th>
                  <th scope="col">最後操作時間</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($withdraws as $withdraw)
                  
                  <tr>
                    <th scope="col">SMT</th>
                    <th scope="col" class="text-primary">{{$withdraw->username}}</th>
                    <th scope="col">{{DB::table('users')->where('id', $withdraw->user_id)->first()->name}}</th>
                    <th scope="col" class="fw-bold">{{$withdraw->order_number}}</th>
                    <th scope="col">{{DB::table('users')->where('id', DB::table('users')->where('id', $withdraw->user_id)->first()->toponline)->first()->username}}</th>
                    <th scope="col" class="text-danger">{{$withdraw->money}}</th>
                    <th scope="col">@if($withdraw->store_type==1)違規下分@elseif($withdraw->store_type==2)出款下分@elseif($withdraw->store_type==3)活動下分@endif</th>
                    <th scope="col"><span class="@if($withdraw->status > 0) text-success @else text-danger @endif">@if($withdraw->status==-2)取消@elseif($withdraw->status==-1)交易失敗@elseif($withdraw->status==0)待處理@elseif($withdraw->status==1)交易成功@endif</span></th>
                    <th scope="col">{{DB::table('users')->where('id', $withdraw->proxy_id)->first()->username}}</th>
                    <th scope="col">{{$withdraw->updated_at}}</th>
                  </tr>
                  @endforeach
                
              </tbody>
            </table>
            {{$withdraws->links()}}
      </div>
  </div>
 