<div>
    <form action="{{route('logout')}}" method="post">
        @csrf
        <button type="submit">logout</button>
    </form>
</div>
