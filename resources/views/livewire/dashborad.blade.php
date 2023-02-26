<div id="dashboard" class="app" >
    @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>註冊總攬</h1>
        <nav class="d-flex justify-conetent-center align-items-center mt-5">
            <div class="box d-flex justify-content-between align-items-center mr-5 p-5">
                <i class="fa-solid fa-user"></i>
                <div>
                    <h3>{{$today}}</h3>
                    <p>今日註冊人數</p>
                </div>
            </div>
            <div class="box d-flex justify-content-between align-items-center p-5 bg-success">
                <i class="fa-solid fa-chart-simple"></i>
                <div>
                    <h3>{{$total}}</h3>
                    <p>總註冊人數</p>
                </div>
            </div>
        </nav>
        <canvas id="myChart" height="100" class="mt-5"></canvas>
        @if(Auth::user()->highest_auth == 1)
        <div class="outMoneyList">
            <table class="table table-bordered table-hover mt-5">
                <thead class="table-warning">
                  <tr>
                    <th scope="col">交易平台</th>
                    <th scope="col">訂單編號</th>
                    <th scope="col">幣別</th>
                    <th scope="col">轉出資金</th>
                    <th scope="col">操作時間</th>
                    <th scope="col">狀態</th>
                    <th scope="col">詳細</th>
                  </tr>
                </thead>
                <tbody>
                    @php $status = ['-2'=>'取消','-1'=>'交易失敗', '0'=>'待審核', '1'=>'交易成功']; @endphp
                    @foreach ($withdraw as $item)
                    <tr>
                        <th>{{$item->platform}}</th>
                        <th>{{$item->order_number}}</th>
                        <td>-</td>
                        <td>{{$item->money}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$status[$item->status]}}</td>
                        <td><a href="/withdrawInfo/{{$item->id}}" class="btn btn-danger">詳細</a></td>
                      </tr>
                    @endforeach
                  
                </tbody>
              </table>
              {{$withdraw->links()}}
        </div>
        @endif
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        
        document.addEventListener("livewire:load", () => {
            var dateArr = @this.dateArr ;
            var register_number = @this.register_number ;
            console.log(dateArr);
            console.log(register_number);
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dateArr ,
                    datasets: [{
                    label: '# 人數',
                    data: register_number ,
                    borderWidth: 2
                    }]
                },
                options: {
                    plugins: {
                        subtitle: {
                            display: true,
                            text: '近十天註冊狀況'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }) ;



        window.onload = ()=>{

       }
      </script>
</div>
