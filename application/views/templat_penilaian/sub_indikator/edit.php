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
              <li class="breadcrumb-item"><a href="<?php echo base_url('templat_penilaian'); ?>">Evaluation Templates</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('templat_penilaian/view/' . $template['id']); ?>"><?php echo $template['nama_templat']; ?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('templat_penilaian/kategori_index/' . $template['id']); ?>">Categories</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('templat_penilaian/indikator_index/' . $template['id'] . '/' . $kategori['id']); ?>">Indicators</a></li>
              <li class="breadcrumb-item active">Edit Sub-Indicator</li>
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
                <h3 class="card-title">Edit Sub-Indicator: <?php echo $sub_indikator['nama']; ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open('templat_penilaian/sub_indikator_edit/' . $template['id'] . '/' . $kategori['id'] . '/' . $indikator['id'] . '/' . $sub_indikator['id']); ?>
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
                    <label for="nama">Sub-Indicator Name</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo set_value('nama', $sub_indikator['nama']); ?>" placeholder="Enter sub-indicator name" required>
                  </div>
                  <div class="form-group">
                    <label for="urutan_tampil">Display Order</label>
                    <input type="number" class="form-control" id="urutan_tampil" name="urutan_tampil" value="<?php echo set_value('urutan_tampil', $sub_indikator['urutan_tampil']); ?>" placeholder="Enter display order">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="<?php echo base_url('templat_penilaian/view/' . $template['id']); ?>" class="btn btn-secondary">Cancel</a>
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