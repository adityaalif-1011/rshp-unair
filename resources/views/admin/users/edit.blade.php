@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container">

    <div class="page-header">
        <h1>Edit User: {{ $user->name }}</h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            Batal & Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Formulir Data Pengguna</h3>
        </div>
        <div class="card-body">
            
            @if ($errors->any())
              <div class="alert alert-danger" style="background-color: #FEE2E2; color: #B91C1C; border-left-color: var(--danger-color);">
                <strong>Whoops!</strong> Ada beberapa masalah dengan inputanmu.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
              </div>
            @endif

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <small style="color: var(--text-muted); margin-top: 4px; display: block;">Kosongkan jika tidak ingin mengganti password.</small>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <div style="margin-top: 30px; display: flex; gap: 10px;">
                    <button type="submit" class="btn btn-primary" style="width: auto;">Update User</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary" style="width: auto;">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection