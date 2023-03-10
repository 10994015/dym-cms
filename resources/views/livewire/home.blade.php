<div id="home" wire:ignore>
    <header id="header">
        <a href="/">SMT後臺管理系統</a>
        <form action="{{route('logout')}}" method="post">
            @csrf
            <button type="submit">登出</button>
        </form>
    </header>
    <div class="nav">
        <div>
            <button id="memberManage" wire:click="memberManageFn()" class=" @if(request()->server()['REQUEST_URI']=="/") focus @endif ">會員管理</button>
            <button id="proxyManage" wire:click="proxyManageFn()" class="@if(request()->server()['REQUEST_URI']=="/proxy") focus @endif">代理管理</button>
        </div>
        <div>
            <a href="/createProxy?rn={{Auth::user()->register_number}}">新增代理</a>
        </div>
    </div>
    <div class="content">
        <div class="user-list">
            <div class="searchDiv">
                <input type="text" class="form-control search" placeholder="搜尋..." wire:model="searchText">
                <button class="btn btn-dark" wire:click="searchFn">搜尋</button>
            </div>
            <div class="item">
                <p class="user-item own" wire:click="viewUserInfo({{Auth::user()->id}})" style="font-weight:900">
                    {{Auth::user()->username}}-{{Auth::user()->name}}({{Auth::user()->phone}})
                </p>
            </div>
            @foreach ($users as $user)
            <div class="item">
                <p class="user-item" wire:click="viewUserInfo({{$user->id}})">
                    @if (DB::table('users')->where([['toponline', $user->id]])->count() > 0)
                        <i class="fa-solid fa-caret-right"></i>
                    @else
                        &nbsp;&nbsp;&nbsp;
                    @endif
                    {{-- 【{{DB::table('users')->where('id', $user->toponline)->first()->name}}】 --}}
                    {{$user->username}}-{{$user->name}}({{$user->phone}})
                </p>
                @foreach (DB::table('users')->where('toponline', $user->id)->get() as $down)
                <div class="down-line">
                    <p wire:click="viewUserInfo({{$down->id}})">{{$down->username}}-{{$down->name}}({{$down->phone}})</p>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
        <div class="user-info">
            <div>帳號: <input type="text" class="" disabled wire:model="account"></div>
            <div>姓名: <input type="text" class="info" disabled wire:model="name"></div>
            <div>手機: <input type="text" class="info" disabled wire:model="phone"></div>
            <div>餘額: <input type="text" class="info" disabled wire:model="money"></div>
            <div>網址: <input type="text" class="" disabled wire:model="url" id="url"></div>
            <div>上線: <input type="text" class="" disabled wire:model="topline"></div>
            <div class="operate">
                <div id="qrcode"></div>
                <div class="btn">
                    <button id="unlock">解鎖編輯</button>
                    <button id="cancel">取消</button>
                    <button id="lock" wire:click="updateUserInfo">更新鎖上</button>
                </div>
            </div>
            
        </div>
    </div>
    
</div>
