<div class="container">
    <h1><?php echo $title; ?></h1>

    <?php if ($this->session->flashdata('success_message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('success_message'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    
    <?php if ($this->session->flashdata('error_message')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('error_message'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>

    <?php echo form_open('users/edit/' . $user['id']); ?>
        <div class="mb-3">
            <label for="nama" class="form-label">Name</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo set_value('nama', $user['nama']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email', $user['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="kata_sandi" class="form-label">New Password (leave blank to keep current password)</label>
            <input type="password" class="form-control" id="kata_sandi" name="kata_sandi">
            <div class="form-text">Minimal 6 karakter. Kosongkan jika tidak ingin mengubah password.</div>
        </div>

        <?php
        // Placeholder untuk pengecekan role admin super
        $is_logged_in_admin_super = TRUE; // Ganti dengan pengecekan session yang sesungguhnya

        if ($is_logged_in_admin_super && !empty($all_roles)): ?>
            <div class="mb-3">
                <label class="form-label">User Roles</label>
                <?php foreach ($all_roles as $role): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="<?php echo $role['id']; ?>" id="role_<?php echo $role['id']; ?>"
                            <?php if (in_array($role['id'], $user_current_roles)) echo 'checked'; ?>>
                        <label class="form-check-label" for="role_<?php echo $role['id']; ?>">
                            <?php echo $role['nama']; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="<?php echo base_url('users'); ?>" class="btn btn-secondary">Back to Users</a>
    <?php echo form_close(); ?>
</div>