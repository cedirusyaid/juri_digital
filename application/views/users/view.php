<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo $title; ?></h1>
      </div>
      <div class="col-sm-6">
        <div class="btn-group float-sm-right">
            <a href="<?php echo base_url('users'); ?>" class="btn btn-secondary">Kembali ke Daftar</a>
            <a href="<?php echo base_url('users/edit/' . $user['id']); ?>" class="btn btn-warning">Ubah Pengguna</a>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Detail Pengguna: <?php echo $user['nama']; ?></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fas fa-user mr-1"></i> Nama</strong>
            <p class="text-muted">
              <?php echo $user['nama']; ?>
            </p>
            <hr>

            <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
            <p class="text-muted">
              <?php echo $user['email']; ?>
            </p>
            <hr>

            <strong><i class="fas fa-user-tag mr-1"></i> Peran</strong>
            <p class="text-muted">
                <?php 
                if (!empty($user_roles)):
                    foreach ($user_roles as $role):?>
                        <span class="badge badge-info"><?php echo $role['role_name']; ?></span>
                 <?php 
                    endforeach;
                else:
                    echo 'Tidak ada peran yang ditugaskan.';
                endif; ?>
            </p>
            <hr>

            <strong><i class="far fa-clock mr-1"></i> Dibuat pada</strong>
            <p class="text-muted">
              <?php echo $user['dibuat_pada']; ?>
            </p>
            <hr>

            <strong><i class="fas fa-edit mr-1"></i> Terakhir Diperbarui</strong>
            <p class="text-muted">
              <?php echo $user['diperbarui_pada']; ?>
            </p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
