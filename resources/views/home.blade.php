@extends('layouts.app')

@section('content')
<div class="hero">
    <h1>Selamat Datang di RSHP</h1>
</div>


<script>
function openLogin() {
    document.getElementById('loginModal').style.display = 'flex';
}
function closeLogin() {
    document.getElementById('loginModal').style.display = 'none';
}
</script>
@endsection
