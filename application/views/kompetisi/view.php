<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $title; ?></h1>
          </div>
          <div class="col-sm-6">
            <div class="btn-group float-sm-right">
              <a href="<?php echo base_url('kompetisi'); ?>" class="btn btn-secondary">Back to List</a>
              <a href="<?php echo base_url('kompetisi/edit/' . $kompetisi['id']); ?>" class="btn btn-warning">Edit Competition</a>
              <a href="<?php echo base_url('entri_lomba/index/' . $kompetisi['id']); ?>" class="btn btn-info">Manage Entries</a>
              <?php
              $disabled = $kompetisi['has_entries'];
              $title = $disabled ? 'Cannot delete competition with entries' : 'Delete competition';
              ?>
              <a href="<?php echo base_url('kompetisi/delete/' . $kompetisi['id']); ?>" class="btn btn-danger <?php echo $disabled ? 'disabled' : '' ?>" title="<?php echo $title; ?>" onclick="return <?php echo $disabled ? 'false' : 'confirm(\'Are you sure you want to delete this competition?\')' ?>;">Delete Competition</a>
            </div>
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
                <h3 class="card-title">Competition Details: <?php echo $kompetisi['nama']; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Competition Name</strong>
                <p class="text-muted">
                  <?php echo $kompetisi['nama']; ?>
                </p>
                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Description</strong>
                <p class="text-muted">
                  <?php echo $kompetisi['deskripsi']; ?>
                </p>
                <hr>

                <strong><i class="far fa-calendar-alt mr-1"></i> Start Date</strong>
                <p class="text-muted">
                  <?php echo $kompetisi['tanggal_mulai']; ?>
                </p>
                <hr>

                <strong><i class="far fa-calendar-alt mr-1"></i> End Date</strong>
                <p class="text-muted">
                  <?php echo $kompetisi['tanggal_selesai']; ?>
                </p>
                <hr>

                <strong><i class="fas fa-file-alt mr-1"></i> Evaluation Template</strong>
                <p class="text-muted">
                  <?php echo $template_name; ?>
                </p>
                <hr>

                <strong><i class="far fa-clock mr-1"></i> Created At</strong>
                <p class="text-muted">
                  <?php echo $kompetisi['dibuat_pada']; ?>
                </p>
                <hr>

                <strong><i class="fas fa-edit mr-1"></i> Last Updated</strong>
                <p class="text-muted">
                  <?php echo $kompetisi['diperbarui_pada']; ?>
                </p>
              </div>

            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->