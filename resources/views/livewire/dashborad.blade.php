<div id="dashboard" class="app" wire:ignore>
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
        <canvas id="myChart" width="400" height="100" class="mt-5"></canvas>
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
