<?php

session_start();
include("config/db.php");
include("includes/header.php");


$message = "";
$messageType = "";

/* Handle Registration */
if(isset($_POST['register']))
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if passwords match
    if($password != $confirmPassword)
    {
        $message = "Passwords do not match.";
        $messageType = "danger";
    }
    else
    {
        // Check if email already exists
        $checkEmail = mysqli_query(
            $conn,
            "SELECT * FROM users WHERE email='$email'"
        );

        if(mysqli_num_rows($checkEmail) > 0)
        {
            $message = "Email already registered.";
            $messageType = "warning";
        }
        else
        {
            // Secure password hashing
            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $insertUser = mysqli_query(
                $conn,
                "INSERT INTO users(name,email,password)
                VALUES('$name','$email','$hashedPassword')"
            );

            if($insertUser)
            {
                $message = "Registration Successful!";
                $messageType = "success";
            }
            else
            {
                $message = "Something went wrong.";
                $messageType = "danger";
            }
        }
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
                        Create Account
                    </h2>

                    <?php if(!empty($message)){ ?>

                        <div class="alert alert-<?php echo $messageType; ?>">
                            <?php echo $message; ?>
                        </div>

                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label">
                                Full Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                required>
                        </div>

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

                        <div class="mb-3">
                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                Confirm Password
                            </label>

                            <input
                                type="password"
                                name="confirm_password"
                                class="form-control"
                                required>
                        </div>

                        <button
                            type="submit"
                            name="register"
                            class="btn btn-gold w-100">

                            Register
                        </button>

                    </form>

                    <p class="text-center mt-3">

                        Already have an account?

                        <a href="login.php">
                            Login
                        </a>

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>