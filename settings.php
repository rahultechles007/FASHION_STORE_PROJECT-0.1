<?php
session_start();
include("config/db.php");
include("includes/header.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}
?>

<div class="container py-5">

    <div class="row">

        <div class="col-lg-3 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h5 class="fw-bold">
                        Settings
                    </h5>

                    <div class="list-group">

                        <a href="#account"
                           class="list-group-item list-group-item-action">
                           Account
                        </a>

                        <a href="#appearance"
                           class="list-group-item list-group-item-action">
                           Appearance
                        </a>

                        <a href="#notifications"
                           class="list-group-item list-group-item-action">
                           Notifications
                        </a>

                        <a href="#security"
                           class="list-group-item list-group-item-action">
                           Security
                        </a>

                        <a href="#privacy"
                           class="list-group-item list-group-item-action">
                           Privacy
                        </a>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-9">
            
            <div class="card shadow-sm border-0 mb-4" id="account">

                <div class="card-body">

                    <h4 class="fw-bold mb-3">
                        Account Settings
                    </h4>

                    <a href="edit_profile.php"
                       class="btn btn-outline-primary">
                       Edit Profile
                    </a>

                    <a href="change_password.php"
                       class="btn btn-outline-danger">
                       Change Password
                    </a>

                </div>

            </div>
             
            <div class="card shadow-sm border-0 mb-4">
    <div class="card-body">

        <h4 class="fw-bold mb-3">
            Appearance Settings
        </h4>

        <div class="form-check form-switch">

            <input
                class="form-check-input"
                type="checkbox"
                id="darkModeToggle">

            <label class="form-check-label">
                Enable Dark Mode
            </label>

        </div>

    </div>
</div>
            <!-- NOTIFICATIONS -->
            <div class="card shadow-sm border-0 mb-4" id="notifications">

                <div class="card-body">

                    <h4 class="fw-bold mb-3">
                        Notifications
                    </h4>

                    <div class="form-check">
                        <input class="form-check-input"
                               type="checkbox" checked>
                        <label>Email Notifications</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input"
                               type="checkbox" checked>
                        <label>Order Updates</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input"
                               type="checkbox">
                        <label>Promotional Offers</label>
                    </div>

                </div>

            </div>

            <!-- SECURITY -->
            <div class="card shadow-sm border-0 mb-4" id="security">

                <div class="card-body">

                    <h4 class="fw-bold mb-3">
                        Security
                    </h4>

                    <a href="change_password.php"
                       class="btn btn-warning">
                       Change Password
                    </a>

                    <a href="logout.php"
                       class="btn btn-danger">
                       Logout
                    </a>

                </div>

            </div>

            <!-- PRIVACY -->
            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h4 class="fw-bold mb-3">
                        Privacy
                    </h4>

                    <button class="btn btn-outline-danger">
                        Delete Account
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>