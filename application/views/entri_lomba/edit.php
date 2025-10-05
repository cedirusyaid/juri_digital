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
              <li class="breadcrumb-item"><a href="<?php echo base_url('kompetisi'); ">Competitions</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('kompetisi/view/' . $kompetisi['id']); ?>"><?php echo $kompetisi['nama']; ?></a></li>
              <li class="breadcrumb-item active">Edit Entry</li>
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
                <h3 class="card-title">Edit Entry: <?php echo $entry['nama_karya']; ?></h3>
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
                    <label for="nama_karya">Entry Name</label>
                    <input type="text" class="form-control" id="nama_karya" name="nama_karya" value="<?php echo set_value('nama_karya', $entry['nama_karya']); ?>" placeholder="Enter entry name" required>
                  </div>
                  <div class="form-group">
                    <label for="deskripsi">Description</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Enter description"><?php echo set_value('deskripsi', $entry['deskripsi']); ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="detail_karya_json">Detail Karya (JSON)</label>
                    <textarea class="form-control" id="detail_karya_json" name="detail_karya_json" rows="5" placeholder="Enter JSON details for the entry (e.g., {"url":"http://example.com"})"><?php echo set_value('detail_karya_json', $entry['detail_karya']); ?></textarea>
                    <small class="form-text text-muted">Example: {"url":"http://example.com", "file":"path/to/file.pdf"}</small>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="<?php echo base_url('kompetisi/view/' . $kompetisi['id']); ?>" class="btn btn-secondary">Cancel</a>
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