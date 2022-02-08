<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <title>Login</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
            body {
                font-family: 'Poppins', sans-serif;
                margin: 0;
                padding: 0;
                min-height: 80vh;
                display: flex;
            }

            .container {
                display: flex;
                justify-content: center;
                margin: auto;
            }

            .wadah {
                border: 5px;
                border-radius: 8px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                padding: 20px;
                height: 380px;
                width: 330px;
            }

            h2 {
                font-size: 28px;
                text-align: center;
                margin: 8px;
                padding-bottom: 10px;
            }

        </style>
    </head>
    <body>
    <div class="container">
        <div class="wadah">
            <?php
                if(! empty($_COOKIE['login'])) {
                    $_SESSION['login'] = true;
                    header("location:tampil.php");
                }
            ?>

            <h2>LOGIN</h2>
            <form method="post" action="login-proses.php">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" class="text-area">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" class="text-area">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ingat saya?</label>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary button">Login</button>
                </div>

            </form>
        </div>
    </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>
</html>