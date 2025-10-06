@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <h4>Tambah Role</h4>
    <form action="{{ route('admin.roles.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label">Nama Role</label>
        <input type="text" name="nama_role" class="form-control" required>
      </div>
      <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">Batal</a>
    </form>
  </div>
</div>
@endsection
