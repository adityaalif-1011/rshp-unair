@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <h4 class="mb-3">Daftar Role</h4>

    <div class="mb-3 d-flex justify-content-between">
      <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Tambah Role</a>
      {{-- 🔹 Tombol ke halaman manage role-user --}}
      <a href="{{ route('admin.roles.manage') }}" class="btn btn-outline-secondary">Kelola Role User</a>
    </div>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama Role</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($roles as $role)
          <tr>
            <td>{{ $role->idrole }}</td>
            <td>{{ $role->nama_role }}</td>
            <td>
              <a href="{{ route('admin.roles.edit', $role->idrole) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
              <form action="{{ route('admin.roles.destroy', $role->idrole) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus role ini?')">Hapus</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
