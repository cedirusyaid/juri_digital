<div class="register-box">
  <div class="register-logo">
    <a href="<?php echo base_url(); ?>"><b>Juri Digital</b>Admin</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Daftar keanggotaan baru</p>

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

      <?php echo form_open('auth/register'); ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" value="<?php echo set_value('nama'); ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo set_value('email'); ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Kata Sandi" name="kata_sandi" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Ketik ulang kata sandi" name="konfirmasi_kata_sandi" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
              <label for="agreeTerms">
               Saya setuju dengan <a href="#">ketentuan</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          </div>
          <!-- /.col -->
        </div>
      <?php echo form_close(); ?>

      <a href="<?php echo base_url('auth/login'); ?>" class="text-center">Saya sudah punya keanggotaan</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->