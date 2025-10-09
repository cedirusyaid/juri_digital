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
          <li class="breadcrumb-item"><a href="<?php echo base_url('skema_entri/index/' . $field['id_templat_penilaian']); ?>">Kelola Skema</a></li>
          <li class="breadcrumb-item active">Ubah Field</li>
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
            <h3 class="card-title">Ubah Field</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <?php echo form_open('skema_entri/edit/' . $field['id']); ?>
            <div class="card-body">
              <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
              
              <div class="form-group">
                <label for="label_field">Label Field</label>
                <input type="text" class="form-control" id="label_field" name="label_field" value="<?php echo set_value('label_field', $field['label_field']); ?>" placeholder="contoh: URL Website" required>
              </div>

              <div class="form-group">
                <label for="nama_field">Nama Field (Kunci)</label>
                <input type="text" class="form-control" id="nama_field" name="nama_field" value="<?php echo set_value('nama_field', $field['nama_field']); ?>" placeholder="contoh: url_website (tanpa spasi, huruf kecil)" required>
                <small class="form-text text-muted">Ini adalah nama teknis yang digunakan dalam data JSON. Gunakan huruf kecil dan garis bawah saja.</small>
              </div>

              <div class="form-group">
                <label for="tipe_field">Tipe Field</label>
                <select class="form-control" id="tipe_field" name="tipe_field">
                  <option value="text" <?php echo set_select('tipe_field', 'text', $field['tipe_field'] == 'text'); ?>>Teks</option>
                  <option value="textarea" <?php echo set_select('tipe_field', 'textarea', $field['tipe_field'] == 'textarea'); ?>>Textarea</option>
                  <option value="url" <?php echo set_select('tipe_field', 'url', $field['tipe_field'] == 'url'); ?>>URL</option>
                  <option value="number" <?php echo set_select('tipe_field', 'number', $field['tipe_field'] == 'number'); ?>>Angka</option>
                </select>
              </div>

              <div class="form-group">
                <label for="urutan">Urutan</label>
                <input type="number" class="form-control" id="urutan" name="urutan" value="<?php echo set_value('urutan', $field['urutan']); ?>" required>
              </div>

              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="wajib_diisi" name="wajib_diisi" value="1" <?php echo set_checkbox('wajib_diisi', '1', $field['wajib_diisi']); ?>>
                <label class="form-check-label" for="wajib_diisi">Wajib Diisi</label>
              </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Kirim</button>
              <a href="<?php echo base_url('skema_entri/index/' . $field['id_templat_penilaian']); ?>" class="btn btn-secondary">Batal</a>
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
