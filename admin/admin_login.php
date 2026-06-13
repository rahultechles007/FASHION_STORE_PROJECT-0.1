<?php

session_start();
include(__DIR__ . "/../config/db.php");


$message = "";

if(isset($_POST['login']))
{
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
    
        "SELECT * FROM admins
         WHERE username='$username'"
    );

    if(mysqli_num_rows($query) == 1)
    {
        $admin = mysqli_fetch_assoc($query);

        if(password_verify($password, $admin['password']))
        {
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['admin_username'] = $admin['username'];

            header("Location: dashboard.php");
            exit();
        }
        else
        {
            $message = "Invalid password.";
        }
    }
    else
    {
        $message = "Admin not found.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="../assets/css/style.css">

</head>

<body style="background:#F5F2EB;">

<div class="container vh-100">

    <div class="row h-100 justify-content-center align-items-center">

        <div class="col-lg-4 col-md-6">

            <div class="card border-0 shadow">

                <div class="card-body p-4">

                    <h2 class="text-center mb-4">
                        Admin Login
                    </h2>

                    <?php if(!empty($message)){ ?>

                        <div class="alert alert-danger">

                            <?php echo $message; ?>

                        </div>

                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Username
                            </label>

                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <button
                            type="submit"
                            name="login"
                            class="btn btn-gold w-100">

                            Login

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>