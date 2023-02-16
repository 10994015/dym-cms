<div class="app" id="createMember">
    @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>新增會員</h1>
        <table class="table table-striped table-bordered">
            <form action="/chk_create_member" method="post">
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
                    <th>手機</th>
                    <td><input type="text"  name="phone" placeholder="請輸入手機..." class="form-control" id="phone" value="{{old('phone')}}" ></td>
                </tr>
                <tr>
                    <th>代理</th>
                    <td>
                        <select name="proxy" id="proxy" class="form-control">
                            <option value="{{Auth::id()}}" selected>{{Auth::user()->username}}</option>
                            @foreach ($toplines as $topline)
                            <option value="{{$topline->id}}">{{$topline->username}}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text"  name="proxy" list="toplineList" placeholder="請輸入代理帳號..." class="form-control" id="proxy" value="{{old('proxy')}}" > --}}
                    </td>
                    <datalist id="toplineList">
                        @foreach ($toplines as $topline)
                        <option value="{{$topline->username}}"></option>
                        @endforeach
                    </datalist>
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
                        <button type="button" id="pre-btn" class="btn btn-primary float-right ml-3">返回</button>
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