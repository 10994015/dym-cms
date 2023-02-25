<div id="withdrawInfo" class="app">
    @include('livewire.components.slidebar')
    <div class="main-content">
        <h1>詳細交易</h1>
        @if(session()->has('success'))
            <div class="alert alert-success"> {{session('success')}} </div>
        @endif
        <table class="table table-striped table-bordered">
            <tbody>
              <tr>
                <th>分站</th>
                <td><input type="text" class="form-control" disabled wire:model="platform" /></td>
              </tr>
              <tr>
                <th>訂單編號</th>
                <td><input type="text" class="form-control" disabled wire:model="order_number" /></td>
              </tr>
              <tr>
                <th>轉出金額</th>
                <td><input type="text" class="form-control" disabled wire:model="money" /></td>
              </tr>
              <tr>
                <th>貨幣別</th>
                <td><input type="text" class="form-control" disabled wire:model="currency" /></td>
              </tr>
              <tr>
                <th>狀態</th>
                <td>
                    <select name="" wire:model="status" class="form-control">
                        <option value="-2">取消</option>
                        <option value="-1">交易失敗</option>
                        <option value="0">待審核</option>
                        <option value="1">交易成功</option>
                    </select>
                </td>
              </tr>
              <tr>
                <th>與上次儲值使用的點數相差</th>
                <td>
                    <span class="@if($totalBet -$money>=0) text-success @else text-danger @endif" >{{$totalBet -$money }}</span>
                        @if($totalBet -$money>=0)
                        <span class="text-success">(符合出金資格)<span>
                        @else
                        <span class="text-danger">(不符合出金資格)<span>
                        @endif
                    
                </td>
              </tr>
              <tr>
                <th>警告文字</th>
                <td><input type="text" class="form-control"  wire:model="warning" /></td>
              </tr>
              <tr>
                <th>補充說明</th>
                <td>
                    <textarea wire:model="comment" class="form-control" cols="30" rows="10"></textarea>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                    <a href="javascript:;" onclick="window.history.back()" class="btn btn-primary float-right">返回</a>
                    <button class="btn btn-primary float-right mr-3" wire:click="updateWithdraw">確認</button>
                </td>
              </tr>
            </tbody>
          </table>
    </div>
</div>
