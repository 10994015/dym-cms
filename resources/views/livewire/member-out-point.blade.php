<div id="member-out-point" class="app">
    @include('livewire.components.slidebar')
      <div class="main-content">
          <h1>會員下分管理</h1>
          <div class="nav">
              <div class="form-group">
                  <label for="">每頁顯示</label>
                  <select name="" id="" class="form-control" wire:model="pageNumber">
                      <option value="15">15</option>
                      <option value="30">30</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
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
                  <th scope="col">代理</th>
                  <th scope="col">帳號</th>
                  <th scope="col">姓名</th>
                  <th scope="col">點數</th>
                  <th scope="col">總下分</th>
                  <th scope="col">下分管理</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>SMT</td>
                    <td>{{DB::table('users')->where('id', $user->toponline)->first()->username}}</td>
                    <td class="text-primary">{{$user->username}}</td>
                    <td>{{$user->name}}</td>
                    <td class="text-success">{{$user->money}}</td>
                    <td class="text-danger">{{DB::table('withdraw')->where([['user_id', $user->id], ['status', 1], ['paidout', 1]])->sum('money')}}</td>
                    <td><a href="/nextUserPoint/{{$user->id}}" class="btn btn-success">下分管理</a></td>
                  </tr>
                @endforeach
               
              </tbody>
            </table>
            {{$users->links()}}
      </div>
  </div>
  