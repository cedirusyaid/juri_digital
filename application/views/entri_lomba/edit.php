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
              <li class="breadcrumb-item active">Ubah Entri</li>
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
                <h3 class="card-title">Ubah Entri: <?php echo $entry['nama_karya']; ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open('entri_lomba/edit/' . $kompetisi['id'] . '/' . $entry['id']); ?>
                <div class="card-body">
                  <?php if ($this->session->flashdata('success_message')):
                  ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <?php echo $this->session->flashdata('success_message'); ?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                  <?php endif; ?>
                  <?php if ($this->session->flashdata('error_message')):
                  ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <?php echo $this->session->flashdata('error_message'); ?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                  <?php endif; ?>
                  <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>

                  <div class="form-group">
                    <label for="nama_karya">Nama Karya</label>
                    <input type="text" class="form-control" id="nama_karya" name="nama_karya" value="<?php echo set_value('nama_karya', $entry['nama_karya']); ?>" placeholder="Masukkan nama karya" required>
                  </div>
                  <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi"><?php echo set_value('deskripsi', $entry['deskripsi']); ?></textarea>
                  </div>

                  <hr>
                  <h5>Detail Karya</h5>
                  <?php if (!empty($skema_entri)): ?>
                    <?php foreach ($skema_entri as $field): ?>
                      <div class="form-group">
                        <label for="<?php echo $field['nama_field']; ?>">
                          <?php echo $field['label_field']; ?>
                          <?php if ($field['wajib_diisi']): ?>
                            <span class="text-danger">*</span>
                          <?php endif; ?>
                        </label>
                        <?php 
                          // Get the existing value for this field from the decoded JSON
                          $existing_value = isset($detail_karya_decoded[$field['nama_field']]) ? $detail_karya_decoded[$field['nama_field']] : '';
                          $input_value = set_value($field['nama_field'], $existing_value);

                          $input_attributes = [
                              'class' => 'form-control',
                              'id'    => $field['nama_field'],
                              'name'  => $field['nama_field'],
                              'placeholder' => 'Enter ' . $field['label_field'],
                          ];
                          if ($field['wajib_diisi']) {
                              $input_attributes['required'] = 'required';
                          }
                        ?>
                        <?php if ($field['tipe_field'] == 'textarea'): ?>
                          <textarea <?php echo implode(' ', array_map(function($key, $val){ return $key . '="' . htmlspecialchars($val) . '"'; }, array_keys($input_attributes), $input_attributes)); ?> rows="3"><?php echo $input_value; ?></textarea>
                        <?php else: ?>
                          <input type="<?php echo $field['tipe_field']; ?>" <?php echo implode(' ', array_map(function($key, $val){ return $key . '="' . htmlspecialchars($val) . '"'; }, array_keys($input_attributes), $input_attributes)); ?> value="<?php echo $input_value; ?>">
                        <?php endif; ?>
                      </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <p class="text-muted">Tidak ada detail entri khusus yang diperlukan untuk templat kompetisi ini.</p>
                  <?php endif; ?>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Perbarui</button>
                  <a href="<?php echo base_url('kompetisi/view/' . $kompetisi['id']); ?>" class="btn btn-secondary">Batal</a>
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