<div id="storage-value" class="app">
    @include('livewire.components.slidebar')
      <div class="main-content">
          <h1>上分管理</h1>
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
            <a href="/storageValue" class="btn btn-info ml-3">上分管理</a>
            <a href="/pointManage" class="btn btn-success ml-3">單項會員上分</a>
          </div>
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">分站</th>
                  <th scope="col">帳號</th>
                  <th scope="col">姓名</th>
                  <th scope="col">訂單編號</th>
                  <th scope="col">代理</th>
                  <th scope="col">上分金額</th>
                  <th scope="col">上分類別</th>
                  <th scope="col">狀態</th>
                  <th scope="col">操作人員</th>
                  <th scope="col">操作時間</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($storePoint as $store)
                  
                  <tr>
                    <th scope="col">SMT</th>
                    <th scope="col" class="text-primary">{{$store->username}}</th>
                    <th scope="col">{{DB::table('users')->where('id', $store->member_id)->first()->name}}</th>
                    <th scope="col" class="fw-bold">{{$store->order_number}}</th>
                    <th scope="col">{{DB::table('users')->where('id', DB::table('users')->where('id', $store->member_id)->first()->toponline)->first()->username}}</th>
                    <th scope="col" class="text-danger">{{$store->money}}</th>
                    <th scope="col">@if($store->store_type==1)違規下分@elseif($store->store_type==2)出款下分@elseif($store->store_type==3)活動下分@endif</th>
                    <th scope="col"><span class="@if($store->status > 0) text-success @else text-danger @endif">@if($store->status==-2)取消@elseif($store->status==-1)交易失敗@elseif($store->status==0)待處理@elseif($store->status==1)交易成功@endif</span></th>
                    <th scope="col">{{DB::table('users')->where('id', $store->proxy_id)->first()->username}}</th>
                    <th scope="col">{{$store->created_at}}</th>
                  </tr>
                  @endforeach
                
              </tbody>
            </table>
            {{$storePoint->links()}}
      </div>
  </div>
  @push('scripts')
  <script>
      pointChildIsOpen = true;
      pointChild.style.height = "90px";
      pointDownIcon.style.transform = "rotate(180deg)";
  </script>
@endpush