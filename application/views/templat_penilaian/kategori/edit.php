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
              <li class="breadcrumb-item active">Ubah Kategori</li>
            </ol>
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
                <h3 class="card-title">Ubah Kategori: <?php echo $kategori['nama']; ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open('templat_penilaian/kategori_edit/' . $template['id'] . '/' . $kategori['id']); ?>
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
                  <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>

                  <div class="form-group">
                    <label for="nama">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo set_value('nama', $kategori['nama']); ?>" placeholder="Masukkan nama kategori" required>
                  </div>
                  <div class="form-group">
                    <label for="bobot">Bobot</label>
                    <input type="number" step="0.01" class="form-control" id="bobot" name="bobot" value="<?php echo set_value('bobot', $kategori['bobot']); ?>" placeholder="Masukkan bobot (contoh: 0.5)" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Perbarui</button>
                  <a href="<?php echo base_url('templat_penilaian/view/' . $template['id']); ?>" class="btn btn-secondary">Batal</a>
                </div>
              <?php echo form_close(); ?>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->