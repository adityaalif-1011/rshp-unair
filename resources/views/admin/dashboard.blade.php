@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, {{ auth()->user()->name ?? 'Guest' }}</p>

    <a href="{{ route('admin.users') }}">Kelola Users</a>
</div>
@endsection
