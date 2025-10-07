@extends('layouts.app')

@section('title', 'Manage Roles')

@section('content')
<div class="container">

    <div class="page-header">
        <h1>Manajemen Role User</h1>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary" style="width: auto;">Kembali</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success" id="success-alert">
            <span>{{ session('success') }}</span>
            <button class="close-btn" onclick="document.getElementById('success-alert').style.display='none'">&times;</button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3>Assign Role ke User</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.roles.assign') }}" method="POST" class="form-grid">
                @csrf
                <div class="form-group">
                    <label for="user_id">Pilih User</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}">{{ $u->id }} — {{ $u->name }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="role_id">Pilih Role</label>
                    <select name="role_id" id="role_id" class="form-control">
                        <option value="">-- Pilih Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->idrole }}">{{ $role->nama_role }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Assign Role</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Daftar User dan Role</h3>
        </div>
        <div class="table-wrapper">
            @php
                $badgeColors = ['badge-blue', 'badge-green', 'badge-yellow', 'badge-purple'];
            @endphp
            <table class="data-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role(s)</th>
                        <th class="actions">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="name">{{ $user->name }}</div>
                                    <div class="email">{{ $user->email }}</div>
                                </div>
                            </td>
                            <td>
                                @forelse($user->roles as $role)
                                    <span class="badge {{ $badgeColors[$loop->index % count($badgeColors)] }}">
                                        {{ $role->name }}
                                    </span>
                                @empty
                                    <span style="color: var(--text-muted); font-style: italic;">— Belum ada role —</span>
                                @endforelse
                            </td>
                            <td class="actions">
                                @foreach($user->roles as $role)
                                    <form action="{{ route('admin.roles.assign.remove', ['user' => $user->id, 'role' => $role->id]) }}" method="POST" onsubmit="return confirm('Hapus role \'{{ $role->name }}\' dari \'{{ $user->name }}\'?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon btn-danger" title="Hapus role {{ $role->name }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.124-2.033-2.124H8.033c-1.12 0-2.033.944-2.033 2.124v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                        </button>
                                    </form>
                                @endforeach
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                Tidak ada data pengguna.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection