<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSHP UNAIR</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- ===== NAVBAR ===== -->
    <header class="navbar">
        <div class="logo">
            <img src="{{ asset('images/logo-rshp.png') }}" alt="RSHP Logo">
            <span>RSHP UNAIR</span>
        </div>
        <ul class="menu">
            <li><a href="http://127.0.0.1:8000/admin">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Review</a></li>
            <li><a href="#">Contact</a></li>
            @auth
        <li style="display:flex; align-items:center; gap:.75rem;">
            <!-- tampilkan nama (opsional) -->
            <span style="font-weight:600;">{{ Auth::user()->name }}</span>

            <!-- logout form: POST ke route('logout') -->
            <form action="{{ route('logout') }}" method="POST" style="display:inline; margin:0;">
                @csrf
                <button type="submit" class="btn-login" style="padding:.4rem .9rem; border-radius:12px;">
                    Logout
                </button>
            </form>
        </li>
    @else
        <li>
            <!-- tombol buka modal login (JS) atau fallback ke homepage -->
            <a href="#" id="loginBtn" class="btn-login" onclick="openLoginModal(event)">Login</a>
        </li>
    @endauth
            </li>
        </ul>

    </header>
    <!-- ===== CONTENT ===== -->
    <main>
        @yield('content')
    </main>
    <!-- Modal Login -->
    <div id="loginModal" class="modal" style="display: none">
        <div class="modal-content">
            <span class="close" id="closeLogin">&times;</span>
            <h2>Login</h2>
            @include('auth.formLogin')

            <p>Belum punya akun? <a href="{{ route('register.show') }}" id="registerLink">Register</a></p>
        </div>
    </div>
    <!-- Modal Register -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeRegister">&times;</span>
            <h2>Register</h2>
            <form>
                <input type="text" placeholder="Nama" required>
                <input type="email" placeholder="Email" required>
                <input type="password" placeholder="Password" required>
                <input type="password" placeholder="Konfirmasi Password" required>
                <button type="submit">Register</button>
            </form>
            <p>Sudah punya akun? <a href="#" id="loginLink">Login</a></p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const loginBtn = document.getElementById("loginBtn");
            const loginModal = document.getElementById("loginModal");
            const closeLogin = document.getElementById("closeLogin");

            const registerModal = document.getElementById("registerModal");
            const closeRegister = document.getElementById("closeRegister");

            const registerLink = document.getElementById("registerLink");
            const loginLink = document.getElementById("loginLink");

            // Buka modal login
            loginBtn.addEventListener("click", (e) => {
                e.preventDefault();
                loginModal.style.display = "flex";
            });

            // Tutup modal login
            closeLogin.addEventListener("click", () => {
                loginModal.style.display = "none";
            });

            // Buka modal register dari login
            registerLink.addEventListener("click", (e) => {
                e.preventDefault();
                loginModal.style.display = "none";
                registerModal.style.display = "flex";
            });

            // Tutup modal register
            closeRegister.addEventListener("click", () => {
                registerModal.style.display = "none";
            });

            // Buka modal login dari register
            loginLink.addEventListener("click", (e) => {
                e.preventDefault();
                registerModal.style.display = "none";
                loginModal.style.display = "flex";
            });

            // Klik di luar modal -> close
            window.addEventListener("click", (event) => {
                if (event.target === loginModal) {
                    loginModal.style.display = "none";
                }
                if (event.target === registerModal) {
                    registerModal.style.display = "none";
                }
            });
        });
    </script>

</body>

</html>
