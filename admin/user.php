<?php

include("auth.php");
include("../config/db.php");
include("includes/header.php");
echo "DB Loaded";
exit();

$users = mysqli_query($conn,
"SELECT * FROM users ORDER BY user_id DESC");

?>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            User Management
        </h2>

        <span class="badge bg-primary fs-6">
            Total Users:
            <?php echo mysqli_num_rows($users); ?>
        </span>

    </div>

    <div class="card shadow border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">

                        <tr>
                            <th>ID</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php
                    mysqli_data_seek($users, 0);

                    while($user = mysqli_fetch_assoc($users))
                    {
                    ?>

                    <tr>

                        <td>
                            <?php echo $user['user_id']; ?>
                        </td>

                        <td>

                            <?php
                            $img = !empty($user['profile_image'])
                            ? "../assets/images/users/" . $user['profile_image']
                            : "../assets/images/default-user.png";
                            ?>

                            <img
                                src="<?php echo $img; ?>"
                                width="50"
                                height="50"
                                class="rounded-circle border"
                                style="object-fit:cover;">

                        </td>

                        <td>
                            <?php echo $user['name']; ?>
                        </td>

                        <td>
                            <?php echo $user['email']; ?>
                        </td>

                        <td>
                            <?php echo $user['phone'] ?? '-'; ?>
                        </td>

                        <td>

                            <?php if(($user['role'] ?? 'user') == 'admin') { ?>

                                <span class="badge bg-danger">
                                    Admin
                                </span>

                            <?php } else { ?>

                                <span class="badge bg-success">
                                    User
                                </span>

                            <?php } ?>

                        </td>

                        <td>

                            <a href="view_user.php?id=<?php echo $user['user_id']; ?>"
                               class="btn btn-sm btn-primary">
                                View
                            </a>

                            <?php if(($user['role'] ?? 'user') != 'admin') { ?>

                            <a href="delete_user.php?id=<?php echo $user['user_id']; ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Delete this user?')">
                                Delete
                            </a>

                            <?php } ?>

                        </td>

                    </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php include("includes/footer.php"); ?>