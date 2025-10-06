@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar User</h1>
    <a href="{{ route('admin.users.create') }}">Tambah User</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th><th>Nama</th><th>Email</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $u)
            <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $u->id) }}">Edit</a>

                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4">Belum ada user</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
