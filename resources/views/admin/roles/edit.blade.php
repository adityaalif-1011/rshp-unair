@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <h4>Edit Role</h4>
    <form action="{{ route('admin.roles.update', $role->idrole) }}" method="POST">
      @csrf @method('PUT')
      <div class="mb-3">
        <label class="form-label">Nama Role</label>
        <input type="text" name="nama_role" value="{{ $role->nama_role }}" class="form-control" required>
      </div>
      <button class="btn btn-primary">Update</button>
      <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">Batal</a>
    </form>
  </div>
</div>
@endsection
