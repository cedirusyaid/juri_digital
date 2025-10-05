<div class="container">
    <h1><?php echo $title; ?></h1>
    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?php echo form_open('users/create'); ?>
        <div class="mb-3">
            <label for="nama" class="form-label">Name</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo set_value('nama'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="kata_sandi" class="form-label">Password</label>
            <input type="password" class="form-control" id="kata_sandi" name="kata_sandi" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="<?php echo base_url('users'); ?>" class="btn btn-secondary">Back to Users</a>
    <?php echo form_close(); ?>
</div>
