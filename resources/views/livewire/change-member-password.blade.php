<div class="app" id="changeMemberPassword">
    @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>密碼修改</h1>
        <table class="table table-striped table-bordered ">
            <form action="/chk_change_password" method="post">
                @csrf
                <tbody>
                <tr>
                    <th>帳號</th>
                    <td><input type="text" name="username" class="form-control" disabled wire:model="username" /><input type="hidden" value="{{$member_id}}" name="member_id" /></td>
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
                        <button type="button" onclick="window.history.back()" id="pre-btn" class="btn btn-primary float-right ml-3">返回</button>
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
