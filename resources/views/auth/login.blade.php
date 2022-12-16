
<x-guest-layout>
    <div class="container-fluid" id="loginPage" >
        <div class="center">
            <h2 class="mb-3">LOGIN</h2>
            <p class="mb-2">登入您的後台管理帳號</p>
            <form method="post" action="{{route('login')}}" class="loginForm form">
                @csrf
                <div class="mb-4">
                    <input type="text" name="username" placeholder="請輸入帳號..." class="form-control text-light " id="email" aria-describedby="emailHelp"  autofocus>
                </div>
                <div class="mb-4">
                    <input type="password" name="password" placeholder="請輸入密碼..." class="form-control text-light " id="password">
                </div>
                <x-jet-validation-errors class="mb-4 text-danger" />
                <button type="submit" class="btn btn-light bg-light mt-3 loginBtn">LOGIN</button>
            </form>
            <a href="/register" class="gotoregister">沒有帳號嗎?前往註冊</a>
        </div>
    </div>
</x-guest-layout>



