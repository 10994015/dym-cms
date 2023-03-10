<div class="slidebar" id='slidebar'>
    @if(Auth::user()->issub === 0)
    <div class="menu" id="slidbarMenu"><i class="fas fa-bars"></i></div>
    <ul>
        <a href="/">首頁</a>
        <a href="/proxy">代理管理</a>
        @if(Auth::user()->highest_auth) <a href="/subaccount">子帳號管理</a> @endif
        <a href="/member">會員管理</a>
        <a href="javascript:;" id="point">上下分管理<i class="fa-solid fa-chevron-down ml-2" id="point-down-icon"></i></a>
        <ul class="child-link" id="point-child">
            <a href="/storageValue" >上分管理</a>
            <a href="/nextPointManage">下分管理</a>
        </ul>
        <a href="/gameManage">投注紀錄</a>
        <a href="/reportManage">營運報表</a>
    </ul>
    @elseif(Auth::user()->issub === 1)
    <ul>
        <a href="/">儀錶板管理</a>
        @if(DB::table('subaccount')->where('user_id', Auth::id())->first()->proxy === 1) <a href="/proxy">代理管理</a> @endif
        @if(DB::table('subaccount')->where('user_id', Auth::id())->first()->member === 1)<a href="/member">會員管理</a> @endif
        @if(DB::table('subaccount')->where('user_id', Auth::id())->first()->store === 1)
        <a href="javascript:;" id="point">上下分管理<i class="fa-solid fa-chevron-down ml-2" id="point-down-icon"></i></a>
        <ul class="child-link" id="point-child">
            <a href="/storageValue" >上分管理</a>
            <a href="/nextPointManage">下分管理</a>
        </ul>
         @endif
        @if(DB::table('subaccount')->where('user_id', Auth::id())->first()->bet_record === 1)<a href="/gameManage">投注紀錄</a> @endif
        @if(DB::table('subaccount')->where('user_id', Auth::id())->first()->report === 1)<a href="/reportManage">營運報表</a> @endif
    </ul>
    @endif

    <script>
        const point = document.getElementById('point');
        const pointDownIcon = document.getElementById('point-down-icon');
        const pointChild = document.getElementById('point-child');
       
        let pointChildIsOpen = false;
        point.addEventListener('click', ()=>{
            pointChildIsOpen = !pointChildIsOpen;
            if(pointChildIsOpen){
                pointChild.style.height = "90px";
                pointDownIcon.style.transform = "rotate(180deg)";
            }else{
                pointChild.style.height = "0px";
                pointDownIcon.style.transform = "rotate(0deg)";
            }
        })
        const slidbarMenu = document.getElementById('slidbarMenu');
        const slidebar = document.getElementById('slidebar');
        let slidebarOpen = true;
        slidbarMenu.addEventListener('click', ()=>{
            slidebarOpen = !slidebarOpen;
            if(slidebarOpen){
                slidebar.style.width = "200px"
                slidebar.style.minWidth = "200px"
                slidbarMenu.style.opacity = '.5'
            }else{
                slidebar.style.width = "0"
                slidebar.style.minWidth = "0"
                slidbarMenu.style.opacity = '1'

            }
        })
    </script>
</div>