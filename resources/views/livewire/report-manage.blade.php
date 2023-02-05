<div class="app" id="report-manage">
    @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>遊戲統計</h1>
        <div class="nav mb-3">
            <div class="search">
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
            <button class="btn btn-success" id="downloadExcel">下載報表</button>
        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">會員帳號</th>
                <th scope="col">下注金額</th>
                <th scope="col">總碼量</th>
                <th scope="col">總輸贏</th>
                <th scope="col">對戰抽水總額</th>
                <th scope="col">下注時間</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($betList as $bet)
                    <tr>
                        <td>{{$bet->user->username}}</th>
                        <td>{{$bet->money}}</td>
                        <td>{{$bet->chips}}</td>
                        <td><span class="fw-bold @if($bet->result>$bet->money) text-success  @else text-danger @endif">{{$bet->result}}</span></td>
                        <td>0</td>
                        <td>{{$bet->created_at}}</td>
                    </tr>
                @endforeach
                
            </tbody>
          </table>
    </div>

    <script>
        const downloadExcel = document.getElementById('downloadExcel');
        
        downloadExcel.addEventListener('click',()=>{
            var table2excel = new Table2Excel();
            table2excel.export(document.querySelectorAll("table"));
        })
    </script>
</div>