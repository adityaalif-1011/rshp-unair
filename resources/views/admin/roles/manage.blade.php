@extends('layouts.app')

@section('title', 'Manage Roles')

@section('content')
<div class="max-w-7xl mx-auto mt-10 px-4">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Role — Assign ke User</h2>
        <a href="{{ route('admin.roles.index') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 transition">Kembali ke Roles</a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 rounded text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Assign Role -->
    <div class="mb-8 bg-white rounded-xl shadow-lg border border-gray-200 p-6">
        <form action="{{ route('admin.roles.assign') }}" method="POST" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            @csrf
            <div class="md:col-span-5">
                <label class="block mb-2 font-semibold text-gray-700">Pilih User</label>
                <select name="user_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->id }} — {{ $u->name }} ({{ $u->email }})</option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-4">
                <label class="block mb-2 font-semibold text-gray-700">Pilih Role</label>
                <select name="role_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">-- Pilih Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->idrole }}">{{ $role->nama_role }}</option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-3">
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg shadow transition">Assign Role</button>
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase border-b border-gray-300">ID User</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase border-b border-gray-300">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase border-b border-gray-300">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase border-b border-gray-300">Role(s)</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase border-b border-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100 border-b border-gray-200">
                        <td class="px-6 py-3 text-sm text-gray-700">{{ $u->id }}</td>
                        <td class="px-6 py-3 text-sm text-gray-700">{{ $u->name }}</td>
                        <td class="px-6 py-3 text-sm text-gray-700">{{ $u->email }}</td>
                        <td class="px-6 py-3 text-sm text-gray-700">
                            @if($u->roles->isEmpty())
                                <span class="text-gray-400 italic">— belum ada role —</span>
                            @else
                                @foreach($u->roles as $role)
                                    <span class="inline-block px-2 py-1 text-xs rounded-lg font-medium {{ $role->id % 2 == 0 ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }} mr-1 mb-1 border border-gray-300">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            @endif
                        </td>
                        <td class="px-6 py-3 text-sm">
                            @if($u->roles->isNotEmpty())
                                <div class="flex flex-wrap gap-2">
                                    @foreach($u->roles as $role)
                                        <form action="{{ route('admin.roles.assign.remove', ['user' => $u->id, 'role' => $role->id]) }}" method="POST" onsubmit="return confirm('Hapus role {{ $role->name }} dari {{ $u->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="px-2 py-1 text-xs bg-red-500 hover:bg-red-600 text-white rounded-lg shadow border border-red-600 transition">Hapus {{ $role->name }}</button>
                                        </form>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-gray-400 italic">Tidak ada aksi</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
