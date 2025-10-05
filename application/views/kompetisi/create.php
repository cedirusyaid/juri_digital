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
              <li class="breadcrumb-item active">Create</li>
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
                <h3 class="card-title">Create New Competition</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open('kompetisi/create'); ?>
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
                    <label for="nama">Competition Name</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo set_value('nama'); ?>" placeholder="Enter competition name" required>
                  </div>
                  <div class="form-group">
                    <label for="deskripsi">Description</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Enter description"><?php echo set_value('deskripsi'); ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="tanggal_mulai">Start Date</label>
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="<?php echo set_value('tanggal_mulai'); ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="tanggal_selesai">End Date</label>
                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="<?php echo set_value('tanggal_selesai'); ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="id_templat_penilaian">Evaluation Template</label>
                    <select class="form-control" id="id_templat_penilaian" name="id_templat_penilaian">
                      <option value="">-- Select Template --</option>
                      <?php foreach ($templates as $template): ?>
                        <option value="<?php echo $template['id']; ?>" <?php echo set_select('id_templat_penilaian', $template['id']); ?>><?php echo $template['nama_templat']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="<?php echo base_url('kompetisi'); ?>" class="btn btn-secondary">Cancel</a>
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