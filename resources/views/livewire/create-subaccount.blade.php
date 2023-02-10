<div class="app" id="createSubaccount">
    @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>新增子帳號</h1>
        <table class="table table-striped table-bordered">
            <form action="/chk_create_subaccount" method="post">
                @csrf
                <tbody>
                <tr>
                    <th>帳號</th>
                    <td><input type="text"  name="username" placeholder="請輸入帳號..." class="form-control" value="{{old('username')}}" id="username" ></td>
                </tr>
                <tr>
                    <th>名稱</th>
                    <td><input type="text" name="name" placeholder="請輸入名稱..." class="form-control" id="name" value="{{old('name')}}" ></td>
                </tr>
                <tr>
                    <th>設定密碼</th>
                    <td><input type="password" name="password" class="form-control"></td>
                </tr>
                <tr>
                    <th>確認密碼</th>
                    <td><input type="password" name="password_confirmation" class="form-control"></td>
                </tr>
                <tr>
                    <th>選擇權限</th>
                    <td>
                        <label class="mr-3" for="proxy"> <input class="mr-1" type="checkbox" name="proxy" id="proxy"><span>代理管理</span> </label>
                        <label class="mr-3" for="member"> <input class="mr-1" type="checkbox" name="member" id="member"><span>會員管理</span> </label>
                        <label class="mr-3" for="store"> <input class="mr-1" type="checkbox" name="store" id="store"><span>上下分管理</span> </label>
                        <label class="mr-3" for="bet_record"> <input class="mr-1" type="checkbox" name="bet_record" id="bet_record"><span>投注紀錄</span> </label>
                        <label class="mr-3" for="report"> <input class="mr-1" type="checkbox" name="report" id="report"><span>營運報表</span> </label>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button type="button" id="pre-btn" class="btn btn-primary float-right ml-3" onclick="window.history.back()">返回</button>
                        <button type="submit" class="btn btn-primary float-right">確認</button>
                    </td>
                </tr>
                </tbody>
            </form>
          </table>

          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
 
    </div>
</div>