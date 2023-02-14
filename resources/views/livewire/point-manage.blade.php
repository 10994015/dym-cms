<div id="poing-manage" class="app">
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
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">id</th>
                  <th scope="col">分站</th>
                  {{-- <th scope="col">代理</th> --}}
                  <th scope="col">帳號</th>
                  <th scope="col">姓名</th>
                  <th scope="col">點數</th>
                  <th scope="col">累計儲值</th>
                  <th scope="col">遊戲內點數</th>
                  <th scope="col">儲值紀錄</th>
                  <th scope="col">管理</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($users as $user)
                  <tr>
                     <td>{{$user->id}}</td>
                     <td>DYM</td>
                     {{-- <td>{{ DB::table('users')->where('id', $user->toponline)->first()->username }}</td> --}}
                     <td><span class="text-primary">{{$user->username}}</span></td>
                     <td>{{$user->name}}</td>
                     <td> <span class="fw-bold @if($user->money>0) text-success @else text-black-50 @endif">{{$user->money}}</span></td>
                     <td><span class="fw-bold @if($user->total_money>0) text-success @else text-black-50 @endif">{{$user->total_money}}</span></td>
                     <td>-</td>
                     <td><a href="/storeRecord/{{$user->id}}" class="btn btn-primary">儲值紀錄</a></td>
                     <td><a href="/setUserPoint/{{$user->id}}" class="btn btn-success">管理</a></td>
                  </tr>
                  @endforeach
                
              </tbody>
            </table>
            {{$users->links()}}
      </div>
  </div>
  @push('scripts')
      <script>
          pointChildIsOpen = true;
          pointChild.style.height = "90px";
          pointDownIcon.style.transform = "rotate(180deg)";
      </script>
  @endpush