<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manajemen Kompetisi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
              <li class="breadcrumb-item active">Manajemen Kompetisi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Kompetisi</h3>
                <div class="card-tools">
                  <a href="<?php echo base_url('kompetisi/create'); ?>" class="btn btn-primary btn-sm">Tambah Kompetisi Baru</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
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

                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama Kompetisi</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if (!empty($kompetisi)): ?>
                      <?php foreach ($kompetisi as $item): ?>
                      <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo $item['nama']; ?></td>
                        <td><?php echo $item['tanggal_mulai']; ?></td>
                        <td><?php echo $item['tanggal_selesai']; ?></td>
                        <td>
                          <a href="<?php echo base_url('kompetisi/view/' . $item['id']); ?>" class="btn btn-info btn-sm">Lihat</a>
                          <a href="<?php echo base_url('kompetisi/edit/' . $item['id']); ?>" class="btn btn-warning btn-sm">Ubah</a>
                          <?php
                          $disabled = $item['has_entries'];
                          $title = $disabled ? 'Tidak dapat menghapus kompetisi yang sudah memiliki entri' : 'Hapus kompetisi';
                          ?>
                          <a href="<?php echo base_url('kompetisi/delete/' . $item['id']); ?>" class="btn btn-danger btn-sm <?php echo $disabled ? 'disabled' : '' ?>" title="<?php echo $title; ?>" onclick="return <?php echo $disabled ? 'false' : 'confirm(\'Apakah Anda yakin ingin menghapus kompetisi ini?\')' ?>;">Hapus</a>
                          <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === TRUE && isset($_SESSION['role_ids']) && isset($_SESSION['administrator_role_id']) && in_array($_SESSION['administrator_role_id'], $_SESSION['role_ids'])): ?>
                          <a href="<?php echo base_url('kompetisi/results/' . $item['id']); ?>" class="btn btn-success btn-sm">Lihat Hasil</a>
                          <?php endif; ?>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <tr>
                          <td colspan="5">Tidak ada kompetisi yang ditemukan.</td>
                      </tr>
                  <?php endif; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->