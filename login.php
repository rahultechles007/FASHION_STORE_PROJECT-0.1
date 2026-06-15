<?php

session_start();
include("config/db.php");

if(isset($_POST['login']))
{
    $email = mysqli_real_escape_string(
        $conn,
        $_POST['email']
    );

    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM users
         WHERE email='$email'"
    );

    if(mysqli_num_rows($query) > 0)
    {
        $user = mysqli_fetch_assoc($query);

        if(password_verify($password, $user['password']))
        {
            $_SESSION['user_id'] =
            $user['user_id'];

            $_SESSION['user_name'] =
            $user['name'];

            $_SESSION['role'] =
            $user['role'];

            if($user['role'] == 'admin')
            {
                header(
                "Location: admin/dashboard.php"
                );
            }
            else
            {
                header(
                "Location: landing.php"
                );
            }

            exit();
        }
        else
        {
            $error = "Invalid Password";
        }
    }
    else
    {
        $error = "User Not Found";
    }
}
include("includes/header.php");
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-5 col-md-7">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body p-4">

                    <h2 class="text-center mb-4">
                        Welcome Back
                    </h2>

                    <?php if(!empty($message)){ ?>

                        <div class="alert alert-<?php echo $messageType; ?>">
                            <?php echo $message; ?>
                        </div>

                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Email Address
                            </label>

                            <input
                                type="email"
                                name="email"
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

                    <p class="text-center mt-3">

                        Don't have an account?

                        <a href="register.php">
                            Register
                        </a>

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>