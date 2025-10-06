@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="dashboard-title">Dashboard Admin</h2>
    <div class="row g-3">

        <!-- Card User -->
        <div class="col-md-3">
            <div class="card shadow-sm dashboard-card h-100">
                <div class="card-body">
                    <h5 class="card-title">Manajemen User</h5>
                    <p class="card-text">Kelola akun pengguna sistem.</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm mt-auto">Kelola</a>
                </div>
            </div>
        </div>

        <!-- Card Role -->
        <div class="col-md-3">
            <div class="card shadow-sm dashboard-card h-100">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Role</h5>
                    <p class="card-text">Atur role seperti Admin, Dokter, Perawat, Resepsionis.</p>
                    <a href="{{route('admin.roles.manage')}}" class="btn btn-outline-secondary btn-sm mt-auto disabled">Kelola</a>
                </div>
            </div>
        </div>

        <!-- Card Jenis Hewan -->
        <div class="col-md-3">
            <div class="card shadow-sm dashboard-card h-100">
                <div class="card-body">
                    <h5 class="card-title">Jenis Hewan</h5>
                    <p class="card-text">Kelola kategori hewan (Kucing, Anjing, dll).</p>
                    <a href="#" class="btn btn-outline-secondary btn-sm mt-auto disabled">Kelola</a>
                </div>
            </div>
        </div>

        <!-- Card Ras Hewan -->
        <div class="col-md-3">
            <div class="card shadow-sm dashboard-card h-100">
                <div class="card-body">
                    <h5 class="card-title">Ras Hewan</h5>
                    <p class="card-text">Kelola ras berdasarkan jenis hewan.</p>
                    <a href="#" class="btn btn-outline-secondary btn-sm mt-auto disabled">Kelola</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
