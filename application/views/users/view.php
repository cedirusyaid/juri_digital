<div class="container">
    <h1><?php echo $title; ?></h1>

    <div class="card">
        <div class="card-header">
            User ID: <?php echo $user['id']; ?>
        </div>
        <div class="card-body">
            <h5 class="card-title">Name: <?php echo $user['nama']; ?></h5>
            <p class="card-text">Email: <?php echo $user['email']; ?></p>
            <p class="card-text">Roles:
                <?php 
                if (!empty($user_roles)):
                    foreach ($user_roles as $role):?>
                        <span class="badge badge-info"><?php echo $role['role_name']; ?></span>
                 <?php 
                    endforeach;
                else:
                    echo 'No roles assigned.';
                endif; ?>
            </p>
            <p class="card-text">Created At: <?php echo $user['dibuat_pada']; ?></p>
            <p class="card-text">Last Updated: <?php echo $user['diperbarui_pada']; ?></p>
            <a href="<?php echo base_url('users'); ?>" class="btn btn-primary">Back to Users</a>
            <a href="<?php echo base_url('users/edit/' . $user['id']); ?>" class="btn btn-warning">Edit User</a>
        </div>
    </div>
</div>