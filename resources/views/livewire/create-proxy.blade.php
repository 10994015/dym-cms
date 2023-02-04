<div class="app" id="createProxy">
    @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>新增會員</h1>
        <table class="table table-striped table-bordered">
            <form action="/createProxySet" method="post">
                @csrf
                <tbody>
                <tr>
                    <th>帳號</th>
                    <td><input type="text"  name="username" placeholder="請輸入帳號..." class="form-control" value="{{old('username')}}"  id="username" ></td>
                </tr>
                <tr>
                    <th>名稱</th>
                    <td><input type="text" name="name" placeholder="請輸入名稱..." class="form-control" id="name" value="{{old('name')}}" ></td>
                </tr>
                <tr>
                    <th>會員密碼</th>
                    <td><input type="password" name="password" class="form-control"></td>
                </tr>
                <tr>
                    <th>確認密碼</th>
                    <td><input type="password" name="password_confirmation" class="form-control"></td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="hidden" name="proxy_id" value="{{request()->id}}">
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