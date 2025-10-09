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
              <li class="breadcrumb-item"><a href="<?php echo base_url('templat_penilaian/kategori_index/' . $template['id']); ?>">Kategori</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('templat_penilaian/indikator_index/' . $template['id'] . '/' . $kategori['id']); ?>">Indikator</a></li>
              <li class="breadcrumb-item active">Sub-Indikator</li>
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
                <h3 class="card-title">Sub-Indikator untuk <?php echo $indikator['nama']; ?></h3>
                <div class="card-tools">
                  <a href="<?php echo base_url('templat_penilaian/sub_indikator_create/' . $template['id'] . '/' . $kategori['id'] . '/' . $indikator['id']); ?>" class="btn btn-primary btn-sm" title="Tambah Sub-Indikator Baru"><i class="fas fa-plus"></i></a>
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
                    <th>Nama Sub-Indikator</th>
                    <th>Urutan Tampilan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if (!empty($sub_indikator_kriteria)): ?>
                      <?php foreach ($sub_indikator_kriteria as $sub_indikator): ?>
                      <tr>
                        <td><?php echo $sub_indikator['id']; ?></td>
                        <td><?php echo $sub_indikator['nama']; ?></td>
                        <td><?php echo $sub_indikator['urutan_tampil']; ?></td>
                        <td>
                          <a href="<?php echo base_url('templat_penilaian/sub_indikator_edit/' . $template['id'] . '/' . $kategori['id'] . '/' . $indikator['id'] . '/' . $sub_indikator['id']); ?>" class="btn btn-warning btn-sm" title="Ubah"><i class="fas fa-edit"></i></a>
                          <a href="<?php echo base_url('templat_penilaian/sub_indikator_delete/' . $template['id'] . '/' . $kategori['id'] . '/' . $indikator['id'] . '/' . $sub_indikator['id']); ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus sub-indikator ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <tr>
                          <td colspan="4">Tidak ada sub-indikator yang ditemukan untuk indikator ini.</td>
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