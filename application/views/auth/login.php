<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url(); ?>"><b>Juri Digital</b>Admin</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <?php if ($this->session->flashdata('error_message')): ?>
          <div class="alert alert-danger" role="alert">
              <?php echo $this->session->flashdata('error_message'); ?>
          </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('success_message')): ?>
          <div class="alert alert-success" role="alert">
              <?php echo $this->session->flashdata('success_message'); ?>
          </div>
      <?php endif; ?>

      <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>

      <?php echo form_open('auth/process_login'); ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username or Email" name="username" value="<?php echo set_value('username'); ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      <?php echo form_close(); ?>

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="<?php echo base_url('auth/register'); ?>" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->