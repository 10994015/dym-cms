<div id="consignment" class="app" >
    @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>託售資料</h1>
        <table class="table table-striped table-bordered">
            <form wire:submit.prevent='uploadFile'>
                @if(session()->has('card-success'))
                    <div class="alert alert-success"> {{session('card-success')}} </div>
                @endif
            <tbody>
              <tr>
                <th>分站</th>
                <td><input type="text" class="form-control" disabled value="SVT" /></td>
              </tr>
              <tr>
                <th>會員帳號</th>
                <td><input type="text" class="form-control" disabled wire:model="username" /></td>
              </tr>
              <tr>
                <th>會員代理</th>
                <td><input type="text" class="form-control" disabled wire:model="topline_name" /></td>
              </tr>
              <tr>
                <th>身分證正面</th>
                <td>
                    @if($new_card_front)
                        <img src="{{$new_card_front->temporaryUrl()}}" alt="">
                    @else
                        <img src="/images/uploads/uploads/cretified/{{$card_front}}" alt="">
                    @endif
                    <label for="card_front">
                        <input type="file" class="form-control"  wire:model="new_card_front" id="card_front" />
                    </label>
                </td>
              </tr>
              <tr>
                <th>身分證反面</th>
                <td>
                    @if($new_card_back)
                    <img src="{{$new_card_back->temporaryUrl()}}" alt="">
                    @else
                    <img src="/images/uploads/uploads/cretified/{{$card_back}}" alt="">
                    @endif
                    <label for="card_back">
                        <input type="file" class="form-control"  wire:model="new_card_back" id="card_back" />
                    </label>
                </td>
              </tr>
              <tr>
                <th>身分證字號</th>
                <td><input type="text" class="form-control" wire:model="number_id" /></td>
              </tr>
              <tr>
                <th>存摺封面</th>
                <td>
                    @if($new_passbook_cover)
                    <img src="{{$new_passbook_cover->temporaryUrl()}}" alt="">
                    @else
                    <img src="/images/uploads/uploads/cretified/{{$passbook_cover}}" alt="">
                    @endif
                    <label for="passbook_cover">
                        <input type="file" class="form-control"  wire:model="new_passbook_cover" id="passbook_cover" />
                    </label>
                </td>
              </tr>
              <tr>
                <th>銀行名稱</th>
                <td><input type="text" class="form-control" wire:model="bank" /></td>
              </tr>
              <tr>
                <th>銀行分行</th>
                <td><input type="text" class="form-control" wire:model="bank_branches" /></td>
              </tr>
              <tr>
                <th>存摺戶名</th>
                <td><input type="text" class="form-control" wire:model="passbook_account_name" /></td>
              </tr>
              <tr>
                <th>存摺帳號</th>
                <td><input type="text" class="form-control" wire:model="passbook_account" /></td>
              </tr>
              <tr>
                <th>認證通過</th>
                <td>
                    <label for="dataAuth">
                        <input type="checkbox" class="form-control mr-2" id="dataAuth" wire:model="dataAuth" />通過
                    </label>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                    <a href="/member" class="btn btn-primary float-right">返回</a>
                    <button class="btn btn-primary float-right mr-3 bg-primary" type="submit">確認</button>
                </td>
              </tr>
            </tbody>
        </form>
          </table>
    </div>


    <script>
      
    </script>
</div>
