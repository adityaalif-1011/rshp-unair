@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User</h2>

    @if ($errors->any())
      <div style="color:#b00020;">
        <ul>@foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach</ul>
      </div>
    @endif

<form action="{{ route('admin.roles.update', $role->idrole) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Nama</label><br>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <div>
            <label>Email</label><br>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <div>
            <label>Password (kosongkan jika tidak ingin ganti)</label><br>
            <input type="password" name="password">
        </div>
        <div>
            <label>Konfirmasi Password</label><br>
            <input type="password" name="password_confirmation">
        </div>

        <div style="margin-top:8px;">
            <button type="submit">Update</button>
            <a href="{{ route('admin.users.index') }}">Batal</a>
        </div>
    </form>
</div>
@endsection
