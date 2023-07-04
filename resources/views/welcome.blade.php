<!DOCTYPE html>
<html>
<head>
    <title>Tampilan Utama</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Menetapkan ukuran dan posisi tampilan utama */
        body {
            margin: 0;
            overflow: hidden;
        }
        
        /* Menetapkan latar belakang bergerak */
        #background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-repeat: repeat;
            background-size: cover;
            transition: background 1s ease-in-out;
        }
        
        /* Menetapkan tampilan jam */
        #clock {
            position: fixed;
            top: 20px;
            right: 20px;
            font-size: 48px;
            color: #ffffff;
        }

        /* Animasi tombol login */
        .btn-login {
            transition: transform 0.3s ease-in-out;
        }

        .btn-login:hover {
            transform: scale(1.1);
        }

        /* Efek transparansi pada form login */
        .card-login {
            opacity: 0.9;
        }

        /* Gaya latar belakang siang */
        .background-day {
            background-image: url('img/pemandangan.jpg');
        }

        /* Gaya latar belakang malam */
        .background-night {
            background-image: url('img/pemandanganmalam.jpg');
        }
    </style>
</head>
<body>
    <div id="background"></div>
    
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card card-login">
                    <div class="card-header text-center">{{ __('Login') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            
    
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-login">
                                        {{ __('Login') }}
                                    </button>
    
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-4">
                <div id="clock">
                    <!-- Menampilkan jam menggunakan JavaScript -->
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Skrip JavaScript untuk jam
        function updateClock() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();
            
            // Format waktu menjadi HH:MM:SS
            var timeString = hours.toString().padStart(2, '0') + ':' +
                minutes.toString().padStart(2, '0') + ':' +
                seconds.toString().padStart(2, '0');
            
            // Menampilkan waktu pada elemen dengan id "clock"
            document.getElementById('clock').textContent = timeString;

            // Mengatur latar belakang berdasarkan waktu
            var background = document.getElementById('background');
            if (hours >= 6 && hours < 18) {
                background.classList.remove('background-night');
                background.classList.add('background-day');
            } else {
                background.classList.remove('background-day');
                background.classList.add('background-night');
            }
            
            // Memperbarui jam setiap detik
            setTimeout(updateClock, 1000);
        }
        
        // Memanggil fungsi updateClock saat halaman dimuat
        window.onload = updateClock;
    </script>
</body>
</html>
