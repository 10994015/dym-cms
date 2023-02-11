<div class="app" id="report-manage">
    @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>遊戲統計</h1>
        <div class="nav mb-3">
            <div class="search mb-2">
                <label for="">
                    <p class="mb-2 fs-6">時間區間</p>
                    <input type="date" class="form-control" wire:model="startTime" />
                </label>
                <label for="" class="mx-2"><p class="mb-2 fs-6">&nbsp;</p>-</label>
                <label for="">
                    <p class="mb-2 fs-6">&nbsp;</p>
                    <input type="date" class="form-control" wire:model="endTime" />
                </label>
            </div>
            <div class="mb-3">
                <label for="">
                    <p class="mb-2">投注金額</p>
                    <input type="number" class="form-control" wire:model="startMoney" />
                </label>
                <label for="" class="mx-2"><p class="mb-2 fs-6">&nbsp;</p>-</label>
                <label for="">
                    <p class="mb-2">&nbsp;</p>
                    <input type="number" class="form-control" wire:model="endMoney" />
                </label>
            </div>
            <div class="d-flex align-items-center mb-3">
                <label for="">
                    <input type="text" class="form-control" placeholder="期號" wire:model="betNumber" />
                </label>
                <select wire:model="game_type" class="ml-2">
                    <option value="">全部遊戲</option>
                    <option value="23">飛機競速</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="">
                    <input type="text" class="form-control account-input" placeholder="帳號" wire:model="account" />
                </label>
            </div>
            {{-- <div>
                <button class="btn btn-primary">搜尋</button>
            </div> --}}
        </div>
        <button class="btn btn-success float-right mb-3" id="downloadExcel">下載報表</button>
        <label class="mb-3">
            <p>每頁顯示</p>
            <select>
                <option value="">50</option>
                <option value="">100</option>
                <option value="">200</option>
            </select>
        </label>
        <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th scope="col">總投注量</th>
                <th scope="col">總輸贏金額</th>
              </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>{{$total_bet_money}}</td>
                        <td><span class="fw-bold @if($total_win_money > 0) text-success  @else text-danger @endif"> {{$total_win_money}}</span></td>
                    </tr>
                
            </tbody>
        </table>
        @php $utype = ["USR"=>"會員", "ADM"=>"代理"]; @endphp
        <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th scope="col">分站名稱</th>
                <th scope="col">級別</th>
                <th scope="col">會員帳號</th>
                <th scope="col">會員名稱</th>
                <th scope="col">下注金額</th>
                <th scope="col">總碼量</th>
                <th scope="col">總輸贏</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($betList as $bet)
                    <tr>
                        <td>DYM</th>
                        <td>{{$utype[$bet->user->utype]}}</th>
                        <td>{{$bet->user->username}}</th>
                        <td>{{$bet->user->name}}</th>
                        <td>{{$bet->money}}</td>
                        <td>{{$bet->money}}</td>
                        <td><span class="fw-bold @if($bet->result> 0 ) text-success  @else text-danger @endif">{{$bet->result}}</span></td>
                    </tr>
                @endforeach
                
            </tbody>
          </table>
          {{$betList->links()}}
    </div>

    <script>
        const downloadExcel = document.getElementById('downloadExcel');
        
        downloadExcel.addEventListener('click',()=>{
            var table2excel = new Table2Excel();
            table2excel.export(document.querySelectorAll("table"));
        })
    </script>
</div>