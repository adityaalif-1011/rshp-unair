<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //Daftar Role 
    public function index()
    {
        $roles = Role::orderBy('nama_role')->get();
        return view('admin.roles.index', compact('roles'));
    }

    //Form tambah role.
    public function create()
    {
        return view('admin.roles.create');
    }

    //Simpan role baru.
    public function store(Request $request)
    {
        $request->validate(['nama_role' => 'required|unique:role,nama_role']);
        Role::create(['nama_role' => $request->nama_role]);
        return redirect()->route('admin.roles.index')->with('success', 'Role berhasil ditambahkan.');
    }

    //Form edit role.
    public function edit($idrole)
    {
        $role = Role::where('idrole', $idrole)->firstOrFail();
        return view('admin.roles.edit', compact('role'));
    }

    //Update role.
    public function update(Request $request, $idrole)
    {
        $role = Role::where('idrole', $idrole)->firstOrFail();
        
        $request->validate([
            'nama_role' => 'required|unique:role,nama_role,' . $role->idrole . ',idrole',
        ]);

        $role->update(['nama_role' => $request->nama_role]);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role berhasil diupdate.');
    }

    //Hapus role.
    public function destroy($idrole)
    {
        $role = Role::where('idrole', $idrole)->firstOrFail();
        
        // hapus relasi dulu
        $role->users()->detach();

        // baru hapus role
        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role berhasil dihapus.');
    }

    //Halaman manage: assign role ke user.

    public function manage()
    {
        $users = User::with('roles')->orderBy('id')->get(); 
        $roles = Role::orderBy('nama_role')->get();

        return view('admin.roles.manage', compact('users', 'roles'));
    }

    /**
     * Assign role ke user (pivot).
     */
    public function assign(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', 
            'role_id' => 'required|exists:role,idrole', // role pakai 'idrole'
        ]);

        $user = User::findOrFail($request->user_id);

        // attach role ke user
        $user->roles()->syncWithoutDetaching([$request->role_id]);

        return redirect()->route('admin.roles.manage')
            ->with('success', 'Role berhasil ditambahkan ke user.');
    }

    /**
     * Hapus role dari user (pivot).
     */
    public function remove($userId, $roleId)
    {
        $user = User::findOrFail($userId); // users pakai 'id'
        $role = Role::where('idrole', $roleId)->firstOrFail(); // role pakai 'idrole'
        
        $user->roles()->detach($role->idrole);

        return redirect()->route('admin.roles.manage')
            ->with('success', 'Role berhasil dihapus dari user.');
    }
}