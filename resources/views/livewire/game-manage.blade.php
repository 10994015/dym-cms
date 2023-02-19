<div class="app" id="game-manage">
    @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>遊戲統計</h1>
        <div class="nav mb-3">
            <div class="search mb-2">
                <label for="">
                    <p class="mb-2 ">時間區間</p>
                    <input type="date" class="form-control" wire:model="startTime" />
                </label>
                <label for="" class="mx-2"><p class="mb-2">&nbsp;</p>-</label>
                <label for="">
                    <p class="mb-2 ">&nbsp;</p>
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
            <select wire:model="pageNumber">
                <option value="">50</option>
                <option value="">100</option>
                <option value="">200</option>
            </select>
        </label>
        <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th scope="col">平台</th>
                <th scope="col">遊戲</th>
                <th scope="col">注單編號</th>
                <th scope="col">下注時間</th>
                <th scope="col">資訊</th>
                <th scope="col">期號</th>
                <th scope="col">會員帳號</th>
                <th scope="col">會員姓名</th>
                <th scope="col">投注量</th>
                <th scope="col">狀態</th>
                {{-- <th scope="col">輸贏金額</th> --}}
              </tr>
            </thead>
            <tbody>
                @foreach ($betList as $bet)
                    @php $data = json_decode($bet->bet_info) @endphp
                <tr>
                    <td>DYM</td>
                    <td>{{$data[0]}}</td>
                    <td>{{$bet->bet_number}}{{$bet->id}}</td>
                    <td>{{$bet->created_at}}</td>
                    <td>
                        <p>
                            DYM No:{{$data[3]}} {{$data[0]}} <br />
                            @if(count($data[1][2]) > 0 )
                                {{$data[1][0]}} 賠率: <span class="text-danger">{{$data[1][1]}}</span> <br />
                                @foreach($data[1][2] as $e)
                                    {{$e}} <br />
                                @endforeach
                            @endif
                            @if(count($data[2][2]) > 0 )
                                {{$data[2][0]}} 賠率:{{$data[2][1]}} <br />
                                @foreach($data[2][2] as $e)
                                    {{$e}} <br />
                                @endforeach
                            @endif
                            結果: <span class="text-primary">{{$data[4]}}</span>
                        </p>
                    </td>
                    <td style="color:#0052bd">{{$bet->bet_number}}</td>
                    <td style="color:#0052bd">{{$bet->user->username}}</td>
                    <td>{{$bet->user->name}}</td>
                    <td>{{$bet->money}}</td>
                    <td>
                        @if(DB::table('users')->where('id', $bet->user_id)->first()->status)
                        <button class="btn  closeStatusBtn" value="{{$bet->user_id}}">啟用</button>
                        @else
                        <button class="btn  openStatusBtn" value="{{$bet->user_id}}">關閉</button>
                        @endif
                    </td>
                    {{-- <td> @if(($bet->result-$bet->money >= 0 )) <span class="text-success"> {{$bet->result-$bet->money}}</span> @else <span class="text-danger">  {{$bet->result-$bet->money}}</span> @endif  </td> --}}
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

        const toggleStatus = ()=>{
            alert('確定要切換嗎?')
        };
    </script>
</div>