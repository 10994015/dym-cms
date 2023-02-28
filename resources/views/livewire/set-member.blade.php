<div id="setMember" class="app" wire:ignore>
    @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>編輯會員</h1>
       
        <table class="table table-striped table-bordered">
            <tbody>
              <tr>
                <th>分站</th>
                <td><input type="text" class="form-control" disabled wire:model="substation" /></td>
              </tr>
              <tr>
                <th>代理</th>
                <td ><input type="text" class="form-control float-left mt-1 mr-2" list="toplineList" id="topline" disabled wire:model="topline_name" />@if(Auth::user()->highest_auth) <button class="btn btn-primary" id="updateTopline" >編輯</button>  @endif</td>
              </tr>
              <datalist id="toplineList">
                @foreach ($toplines as $topline)
                <option value="{{$topline->username}}"></option>
                @endforeach
              </datalist>
              <tr>
                <th>帳號</th>
                <td><input type="text" class="form-control" disabled wire:model="username" /></td>
              </tr>
              <tr>
                <th>名稱</th>
                <td><input type="text" class="form-control" value="ggininder" wire:model="name" /></td>
              </tr>
              <tr>
                <th></th>
                <td><a href="/changeMemberPassword/{{$member_id}}" class="btn btn-primary">密碼修改</a></td>
              </tr>
              <tr>
                <th>手機</th>
                <td><input type="text" class="form-control" wire:model="phone" /></td>
              </tr>
              <tr>
                <th>手機驗證</th>
                <td>
                    <select name="" id="" wire:model="phone_verification">
                        <option value="0">未驗證</option>
                        <option value="1">已驗證</option>
                    </select>
                </td>
              </tr>
              <tr>
                <th>備註</th>
                <td><textarea name="" class="form-control" rows="2" wire:model="remark"></textarea></td>
              </tr>
              <tr>
                <th>點數鎖定</th>
                <td>
                    <input type="radio" class="mr-1" value="0" name="money-lock" wire:model="point_lock" id="unlock"><label class="mr-3" for="unlock">不鎖定</label>
                    <input type="radio" class="mr-1" value="1" name="money-lock" wire:model="point_lock" id="lock"><label for="lock">鎖定</label>
                </td>
              </tr>
              <tr>
                <th>託售資料</th>
                <td>
                    <a href="/consignment/{{$member_id}}" class="btn btn-danger">查看</a>
                </td>
              </tr>
              <tr>
                <th>推薦人</th>
                <td>
                    <input type="text" class="form-control" wire:model="recommender" />
                </td>
              </tr>
              <tr>
                <td colspan="2">
                    <a href="javascript:;" onclick="window.history.back()" class="btn btn-primary float-right">返回</a>
                    <button class="btn btn-primary float-right mr-3" wire:click="changeMemberInfo">確認</button>
                </td>
              </tr>
            </tbody>
          </table>
    </div>
    @if(Auth::user()->highest_auth)
    <script>
       const updateTopline = document.getElementById('updateTopline');
        const topline = document.getElementById('topline');
        updateTopline.addEventListener('click', e=>{
            if(confirm('確定修改??')){
                topline.disabled = false;
            }
        })
    </script>
    @endif
    <script>
       
        window.addEventListener("successFn", ()=>{
            alert("編輯成功!!")
        });
        window.addEventListener("errorFn", ()=>{
            alert("編輯失敗!查無此代理帳號")
        })
    </script>
</div>
