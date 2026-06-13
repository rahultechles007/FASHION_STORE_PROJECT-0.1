<?php

session_start();
include("config/db.php");
include("includes/header.php");


$message = "";
$messageType = "";

if(isset($_POST['login']))
{
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Find user by email
    $query = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE email='$email'"
    );

    if(mysqli_num_rows($query) == 1)
    {
        $user = mysqli_fetch_assoc($query);

        // Verify password
        if(password_verify($password, $user['password']))
        {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            header("Location: landing.php");
            exit();
        }
        else
        {
            $message = "Invalid password.";
            $messageType = "danger";
        }
    }
    else
    {
        $message = "Account not found.";
        $messageType = "danger";
    }
}

include("includes/header.php");

?>

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