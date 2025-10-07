@extends('layouts.app')

@section('title', 'Daftar User')

@section('content')
<div class="container">

    <div class="page-header">
        <h1>Daftar User</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            {{-- Ini adalah kode SVG untuk ikon tambah (+) --}}
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success" id="success-alert">
            <span>{{ session('success') }}</span>
            <button class="close-btn" onclick="document.getElementById('success-alert').style.display='none'">&times;</button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3>Manajemen Data Pengguna</h3>
        </div>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th class="actions">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td>
                                <div class="user-info">
                                    <div class="name">{{ $u->name }}</div>
                                    <div class="email">{{ $u->email }}</div>
                                </div>
                            </td>
                            <td class="actions">
                                <div class="action-links">
                                    <a href="{{ route('admin.users.edit', $u->id) }}">Edit</a>
                                    
                                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        {{-- Kita ubah button menjadi link agar stylenya bisa sama --}}
                                        <a href="#" class="delete" onclick="event.preventDefault(); this.closest('form').submit();">Hapus</a>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                Belum ada user.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection