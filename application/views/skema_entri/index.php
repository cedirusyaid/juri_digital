<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo $title; ?></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('templat_penilaian'); ?>">Templat Penilaian</a></li>
          <li class="breadcrumb-item active">Kelola Skema</li>
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
            <h3 class="card-title">Field untuk <?php echo $template['nama_templat']; ?></h3>
            <div class="card-tools">
              <a href="<?php echo base_url('skema_entri/create/' . $id_templat_penilaian); ?>" class="btn btn-primary btn-sm">Tambah Field Baru</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?php if ($this->session->flashdata('success_message')):
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $this->session->flashdata('success_message'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif;
            ?>
            <?php if ($this->session->flashdata('error_message')):
            ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $this->session->flashdata('error_message'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif;
            ?>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Urutan</th>
                <th>Label</th>
                <th>Nama (Kunci)</th>
                <th>Tipe</th>
                <th>Wajib Diisi</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($skema_entri as $field): ?>
              <tr>
                <td><?php echo $field['urutan']; ?></td>
                <td><?php echo $field['label_field']; ?></td>
                <td><?php echo $field['nama_field']; ?></td>
                <td><?php echo $field['tipe_field']; ?></td>
                <td><?php echo $field['wajib_diisi'] ? 'Ya' : 'Tidak'; ?></td>
                <td>
                  <a href="<?php echo base_url('skema_entri/edit/' . $field['id']); ?>" class="btn btn-warning btn-xs">Ubah</a>
                  <a href="<?php echo base_url('skema_entri/delete/' . $field['id']); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin ingin menghapus field ini?')">Hapus</a>
                </td>
              </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a href="<?php echo base_url('templat_penilaian/view/' . $id_templat_penilaian); ?>" class="btn btn-secondary">Kembali ke Templat</a>
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
