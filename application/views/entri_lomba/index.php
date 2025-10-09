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
              <li class="breadcrumb-item"><a href="<?php echo base_url('kompetisi'); ?>">Kompetisi</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('kompetisi/view/' . $kompetisi['id']); ?>"><?php echo $kompetisi['nama']; ?></a></li>
              <li class="breadcrumb-item active">Entri</li>
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
                <h3 class="card-title">Daftar Entri untuk <?php echo $kompetisi['nama']; ?></h3>
                <div class="card-tools">
                  <a href="<?php echo base_url('entri_lomba/create/' . $kompetisi['id']); ?>" class="btn btn-primary btn-sm" title="Tambah Entri Baru"><i class="fas fa-plus"></i></a>
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
                    <th>Nama Karya</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if (!empty($entries)): ?>
                      <?php foreach ($entries as $entry): ?>
                      <tr>
                        <td><?php echo $entry['id']; ?></td>
                        <td><?php echo $entry['nama_karya']; ?></td>
                        <td><?php echo $entry['deskripsi']; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url('entri_lomba/view/' . $kompetisi['id'] . '/' . $entry['id']); ?>" class="btn btn-info btn-sm" title="Info"><i class="fas fa-info-circle"></i></a>
                            <a href="<?php echo base_url('entri_lomba/edit/' . $kompetisi['id'] . '/' . $entry['id']); ?>" class="btn btn-warning btn-sm" title="Ubah"><i class="fas fa-edit"></i></a>
                            <a href="<?php echo base_url('entri_lomba/manage_juri/' . $kompetisi['id'] . '/' . $entry['id']); ?>" class="btn btn-primary btn-sm" title="Kelola Juri"><i class="fas fa-users"></i></a>
                            <a href="<?php echo base_url('entri_lomba/delete/' . $kompetisi['id'] . '/' . $entry['id']); ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus entri ini?')"><i class="fas fa-trash"></i></a>
                          </div>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <tr>
                          <td colspan="4">Tidak ada entri yang ditemukan untuk kompetisi ini.</td>
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