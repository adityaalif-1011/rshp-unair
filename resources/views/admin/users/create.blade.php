@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah User</h2>

    @if ($errors->any())
      <div style="color:#b00020;">
        <ul>@foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach</ul>
      </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div>
            <label>Nama</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <label>Email</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label>Password</label><br>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Konfirmasi Password</label><br>
            <input type="password" name="password_confirmation" required>
        </div>
        <div style="margin-top:8px;">
            <button type="submit">Simpan</button>
            <a href="{{ route('admin.users.index') }}">Batal</a>
        </div>
    </form>
</div>
@endsection
