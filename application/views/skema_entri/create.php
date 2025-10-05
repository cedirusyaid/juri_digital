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
          <li class="breadcrumb-item"><a href="<?php echo base_url('templat_penilaian'); ?>">Assessment Templates</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('skema_entri/index/' . $id_templat_penilaian); ?>">Manage Schema</a></li>
          <li class="breadcrumb-item active">Add Field</li>
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
            <h3 class="card-title">Add New Field to `<?php echo $template['nama_templat']; ?>`</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <?php echo form_open('skema_entri/create/' . $id_templat_penilaian); ?>
            <div class="card-body">
              <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
              
              <div class="form-group">
                <label for="label_field">Field Label</label>
                <input type="text" class="form-control" id="label_field" name="label_field" value="<?php echo set_value('label_field'); ?>" placeholder="e.g., URL Website" required>
              </div>

              <div class="form-group">
                <label for="nama_field">Field Name (Key)</label>
                <input type="text" class="form-control" id="nama_field" name="nama_field" value="<?php echo set_value('nama_field'); ?>" placeholder="e.g., url_website (no spaces, lowercase)" required>
                <small class="form-text text-muted">This is the technical name used in the JSON data. Use lowercase letters and underscores only.</small>
              </div>

              <div class="form-group">
                <label for="tipe_field">Field Type</label>
                <select class="form-control" id="tipe_field" name="tipe_field">
                  <option value="text" <?php echo set_select('tipe_field', 'text', TRUE); ?>>Text</option>
                  <option value="textarea" <?php echo set_select('tipe_field', 'textarea'); ?>>Textarea</option>
                  <option value="url" <?php echo set_select('tipe_field', 'url'); ?>>URL</option>
                  <option value="number" <?php echo set_select('tipe_field', 'number'); ?>>Number</option>
                </select>
              </div>

              <div class="form-group">
                <label for="urutan">Order</label>
                <input type="number" class="form-control" id="urutan" name="urutan" value="<?php echo set_value('urutan', 0); ?>" required>
              </div>

              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="wajib_diisi" name="wajib_diisi" value="1" <?php echo set_checkbox('wajib_diisi', '1', TRUE); ?>>
                <label class="form-check-label" for="wajib_diisi">Required</label>
              </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="<?php echo base_url('skema_entri/index/' . $id_templat_penilaian); ?>" class="btn btn-secondary">Cancel</a>
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
