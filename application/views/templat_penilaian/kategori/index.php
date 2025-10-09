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
              <li class="breadcrumb-item"><a href="<?php echo base_url('templat_penilaian/view/' . $template['id']); ?>"><?php echo $template['nama_templat']; ?></a></li>
              <li class="breadcrumb-item active">Kategori</li>
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
                <h3 class="card-title">Kategori untuk <?php echo $template['nama_templat']; ?></h3>
                <div class="card-tools">
                  <a href="<?php echo base_url('templat_penilaian/kategori_create/' . $template['id']); ?>" class="btn btn-primary btn-sm">Tambah Kategori Baru</a>
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
                    <th>Nama Kategori</th>
                    <th>Bobot</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if (!empty($kategori_kriteria)): ?>
                      <?php foreach ($kategori_kriteria as $kategori): ?>
                      <tr>
                        <td><?php echo $kategori['id']; ?></td>
                        <td><?php echo $kategori['nama']; ?></td>
                        <td><?php echo $kategori['bobot']; ?></td>
                        <td>
                          <a href="<?php echo base_url('templat_penilaian/kategori_edit/' . $template['id'] . '/' . $kategori['id']); ?>" class="btn btn-warning btn-sm">Ubah</a>
                          <a href="<?php echo base_url('templat_penilaian/kategori_delete/' . $template['id'] . '/' . $kategori['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <tr>
                          <td colspan="4">Tidak ada kategori yang ditemukan untuk templat ini.</td>
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