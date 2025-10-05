    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $title; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('kompetisi'); ?>">Competitions</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('kompetisi/view/' . $kompetisi['id']); ?>"><?php echo $kompetisi['nama']; ?></a></li>
              <li class="breadcrumb-item active">Entry Details</li>
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
                <h3 class="card-title">Entry Details: <?php echo $entry['nama_karya']; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-file-alt mr-1"></i> Entry Name</strong>
                <p class="text-muted">
                  <?php echo $entry['nama_karya']; ?>
                </p>
                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Description</strong>
                <p class="text-muted">
                  <?php echo $entry['deskripsi']; ?>
                </p>
                <hr>

                <strong><i class="fas fa-code mr-1"></i> Detail Karya (JSON)</strong>
                <p class="text-muted">
                  <pre><?php echo json_encode($detail_karya_decoded, JSON_PRETTY_PRINT); ?></pre>
                </p>
                <?php if (isset($detail_karya_decoded['url'])): ?>
                <hr>
                <strong><i class="fas fa-link mr-1"></i> URL</strong>
                <p class="text-muted">
                  <a href="<?php echo $detail_karya_decoded['url']; ?>" target="_blank"><?php echo $detail_karya_decoded['url']; ?></a>
                </p>
                <?php endif; ?>
                <?php if (isset($detail_karya_decoded['screenshot'])): ?>
                <hr>
                <strong><i class="fas fa-image mr-1"></i> Screenshot</strong>
                <p class="text-muted">
                  <img src="<?php echo $detail_karya_decoded['screenshot']; ?>" style="max-width: 100%; height: auto;">
                </p>
                <?php endif; ?>

                <hr>
                <strong><i class="far fa-clock mr-1"></i> Created At</strong>
                <p class="text-muted">
                  <?php echo $entry['dibuat_pada']; ?>
                </p>
                <hr>

                <strong><i class="fas fa-edit mr-1"></i> Last Updated</strong>
                <p class="text-muted">
                  <?php echo $entry['diperbarui_pada']; ?>
                </p>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <a href="<?php echo base_url('kompetisi/view/' . $kompetisi['id']); ?>" class="btn btn-secondary">Back to Competition</a>
                <a href="<?php echo base_url('entri_lomba/edit/' . $kompetisi['id'] . '/' . $entry['id']); ?>" class="btn btn-warning">Edit Entry</a>
                <a href="<?php echo base_url('entri_lomba/delete/' . $kompetisi['id'] . '/' . $entry['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this entry?')">Delete Entry</a>
              </div>
            </div>
            <!-- /.card -->

            <!-- Edit Detail Karya Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Edit Detail Karya</h3>
              </div>
              <!-- /.card-header -->
              <?php if (!empty($skema_entri)): ?>
                <!-- form start -->
                <?php echo form_open('entri_lomba/update_detail_karya/' . $entry['id']); ?>
                  <div class="card-body">
                    <?php foreach ($skema_entri as $field): ?>
                      <div class="form-group">
                        <label for="<?php echo $field['nama_field']; ?>">
                          <?php echo $field['label_field']; ?>
                          <?php if ($field['wajib_diisi']): ?>
                            <span class="text-danger">*</span>
                          <?php endif; ?>
                        </label>
                        <?php 
                          $current_value = isset($detail_karya_decoded[$field['nama_field']]) ? $detail_karya_decoded[$field['nama_field']] : '';
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
                          <textarea <?php echo implode(' ', array_map(function($key, $val){ return $key . '="' . htmlspecialchars($val) . '"'; }, array_keys($input_attributes), $input_attributes)); ?> rows="3"><?php echo htmlspecialchars($current_value); ?></textarea>
                        <?php else: ?>
                          <input type="<?php echo $field['tipe_field']; ?>" <?php echo implode(' ', array_map(function($key, $val){ return $key . '="' . htmlspecialchars($val) . '"'; }, array_keys($input_attributes), $input_attributes)); ?> value="<?php echo htmlspecialchars($current_value); ?>">
                        <?php endif; ?>
                      </div>
                    <?php endforeach; ?>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update Details</button>
                  </div>
                <?php echo form_close(); ?>
              <?php else: ?>
                <div class="card-body">
                  <p class="text-muted">No specific entry details are configured for this competition template.</p>
                </div>
              <?php endif; ?>
            </div>
            <!-- /.card -->

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->