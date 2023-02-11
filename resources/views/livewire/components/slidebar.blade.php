<div class="slidebar">
    @if(Auth::user()->issub === 0)
    <ul>
        <a href="/">儀錶板管理</a>
        <a href="/proxy">代理管理</a>
        @if(Auth::user()->highest_auth) <a href="/subaccount">子帳號管理</a> @endif
        <a href="/member">會員管理</a>
        <a href="/pointManage">上下分管理</a>
        <a href="/gameManage">投注紀錄</a>
        <a href="/reportManage">營運報表</a>
    </ul>
    @elseif(Auth::user()->issub === 1)
    <ul>
        <a href="/">儀錶板管理</a>
        @if(DB::table('subaccount')->where('user_id', Auth::id())->first()->proxy === 1) <a href="/proxy">代理管理</a> @endif
        @if(DB::table('subaccount')->where('user_id', Auth::id())->first()->member === 1)<a href="/member">會員管理</a> @endif
        @if(DB::table('subaccount')->where('user_id', Auth::id())->first()->store === 1)<a href="/pointManage">上下分管理</a> @endif
        @if(DB::table('subaccount')->where('user_id', Auth::id())->first()->bet_record === 1)<a href="/gameManage">投注紀錄</a> @endif
        @if(DB::table('subaccount')->where('user_id', Auth::id())->first()->report === 1)<a href="/reportManage">營運報表</a> @endif
    </ul>
    @endif
</div>