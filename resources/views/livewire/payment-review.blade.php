<div id="payment-review">
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
            
        </div>
        <div class="form-group mt-4">
          <a href="/nextPointManage" class="btn btn-info ml-3">下分管理</a>
          <a href="/memberOutPoint" class="btn btn-success ml-3">單項會員下分</a>
          <a href="/paymentReview" class="btn btn-primary ml-3">出款審核</a>
        </div>
        <div class="outMoneyList">
            <table class="table table-bordered table-hover mt-5">
                <thead class="table-warning">
                  <tr>
                    <th scope="col">交易平台</th>
                    <th scope="col">訂單編號</th>
                    <th scope="col">會員帳號</th>
                    <th scope="col">幣別</th>
                    <th scope="col">轉出資金</th>
                    <th scope="col">操作時間</th>
                    <th scope="col">狀態</th>
                    <th scope="col">詳細</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($withdraws as $item)
                    <tr>
                        <th>{{$item->platform}}</th>
                        <th>{{$item->order_number}}</th>
                        <th>{{$item->username}}</th>
                        <td>-</td>
                        <td>{{$item->money}}</td>
                        <td>{{$item->created_at}}</td>
                        <td class="@if($item->status > 0) text-success @else text-danger @endif">@if($item->status==-2)取消@elseif($item->status==-1)交易失敗@elseif($item->status==0)待處理@elseif($item->status==1)交易成功@endif</td>
                        <td><a href="/withdrawInfo/{{$item->id}}" class="btn btn-danger" class="withInfo">詳細</a></td>
                      </tr>
                    @endforeach
                  
                </tbody>
              </table>
        </div>
          {{$withdraws->links()}}
    </div>
</div>
@push('scripts')
<script>
    pointChildIsOpen = true;
    pointChild.style.height = "90px";
    pointDownIcon.style.transform = "rotate(180deg)";
</script>
@endpush