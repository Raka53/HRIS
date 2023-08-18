<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body>
    
    <div class="login_form_container">
        <form class="login_form" method="POST" action="{{ route('login') }}">
            @csrf
          <h2>Login</h2>
          <div class="input_group">
            <i class="fa fa-user"></i>
            <input
              type="email"
              name="email"
              placeholder="Email"
              class="input_text"
              autocomplete="off"
              autofocus
            />
          </div>
          <div class="input_group">
            <i class="fa fa-unlock-alt"></i>
            <input
              type="password"
              name="password"
              placeholder="Password"
              class="input_text"
              autocomplete="off"
            />
          </div>
          <div class="button_group" id="login_button">
            <button>

              <a href="#" id="submit_button" class="submit_button">Login</a>
            </button>

          </div>
        </form>
    </div>
    
    <div class="row justify-content-end">
        <div class="col-md-4">
            <div id="clock">
                <!-- Menampilkan jam menggunakan JavaScript -->
            </div>
            <div id="date">
              <!-- Menampilkan tanggal menggunakan JavaScript -->
          </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="js/login.js"></script>
    <script>
        $(document).ready(function() {
          $('#submit_button').click(function(e) {
            e.preventDefault(); // Mencegah aksi default dari elemen <a>
            $('.login_form').submit(); // Melakukan submit pada formulir
          });
        });
      </script>
    
</body>
</html>
