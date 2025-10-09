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

                <strong><i class="fas fa-info-circle mr-1"></i> Detail Karya</strong>
                <dl class="row">
                  <?php if (is_array($detail_karya_decoded) && !empty($detail_karya_decoded)): ?>
                    <?php foreach ($detail_karya_decoded as $key => $value): ?>
                      <dt class="col-sm-4"><?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $key))); ?></dt>
                      <dd class="col-sm-8">
                        <?php 
                          if (filter_var($value, FILTER_VALIDATE_URL)) {
                            echo '<a href="' . htmlspecialchars($value) . '" target="_blank">' . htmlspecialchars($value) . '</a>';
                          } else {
                            echo htmlspecialchars($value);
                          }
                        ?>
                      </dd>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <dd class="col-sm-12">No details provided.</dd>
                  <?php endif; ?>
                </dl>

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



          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->