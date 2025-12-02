<form action="{{ route('logout') }}" method="post" class="logout-form">
    @csrf
    <button type="submit" class="logout-link">logout</button>
</form>
