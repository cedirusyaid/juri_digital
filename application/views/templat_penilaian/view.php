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
              <li class="breadcrumb-item active">Details</li>
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
                <h3 class="card-title">Template Details: <?php echo $template['nama_templat']; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-file-alt mr-1"></i> Template Name</strong>
                <p class="text-muted">
                  <?php echo $template['nama_templat']; ?>
                </p>
                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Description</strong>
                <p class="text-muted">
                  <?php echo $template['deskripsi']; ?>
                </p>
                <hr>

                <h4><i class="fas fa-layer-group mr-1"></i> Criteria Categories
                    <a href="<?php echo base_url('templat_penilaian/kategori_create/' . $template['id']); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Add New Category</a>
                </h4>
                <?php if (!empty($kategori_kriteria)): ?>
                    <?php foreach ($kategori_kriteria as $kategori): ?>
                        <div class="card card-secondary collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo $kategori['nama']; ?> (Bobot: <?php echo $kategori['bobot']; ?>)</h3>
                                <div class="card-tools">
                                    <a href="<?php echo base_url('templat_penilaian/kategori_edit/' . $template['id'] . '/' . $kategori['id']); ?>" class="btn btn-tool" title="Edit Category"><i class="fas fa-edit"></i></a>
                                    <a href="<?php echo base_url('templat_penilaian/kategori_delete/' . $template['id'] . '/' . $kategori['id']); ?>" class="btn btn-tool" title="Delete Category" onclick="return confirm('Are you sure you want to delete this category and all its indicators/sub-indicators?')"><i class="fas fa-trash"></i></a>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5><i class="fas fa-list-ol mr-1"></i> Indicators
                                    <a href="<?php echo base_url('templat_penilaian/indikator_create/' . $template['id'] . '/' . $kategori['id']); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Add New Indicator</a>
                                </h5>
                                <?php if (!empty($kategori['indikator_kriteria'])): ?>
                                    <?php foreach ($kategori['indikator_kriteria'] as $indikator): ?>
                                        <div class="card card-info collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title"><?php echo $indikator['nama']; ?> (Bobot: <?php echo $indikator['bobot']; ?>)</h3>
                                                <div class="card-tools">
                                                    <a href="<?php echo base_url('templat_penilaian/indikator_edit/' . $template['id'] . '/' . $kategori['id'] . '/' . $indikator['id']); ?>" class="btn btn-tool" title="Edit Indicator"><i class="fas fa-edit"></i></a>
                                                    <a href="<?php echo base_url('templat_penilaian/indikator_delete/' . $template['id'] . '/' . $kategori['id'] . '/' . $indikator['id']); ?>" class="btn btn-tool" title="Delete Indicator" onclick="return confirm('Are you sure you want to delete this indicator and all its sub-indicators?')"><i class="fas fa-trash"></i></a>
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h6><i class="fas fa-tasks mr-1"></i> Sub-Indicators
                                                    <a href="<?php echo base_url('templat_penilaian/sub_indikator_create/' . $template['id'] . '/' . $kategori['id'] . '/' . $indikator['id']); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Add New Sub-Indicator</a>
                                                </h6>
                                                <?php if (!empty($indikator['sub_indikator_kriteria'])): ?>
                                                    <ul class="list-group">
                                                        <?php foreach ($indikator['sub_indikator_kriteria'] as $sub_indikator): ?>
                                                            <li class="list-group-item">
                                                                <?php echo $sub_indikator['nama']; ?> (Order: <?php echo $sub_indikator['urutan_tampil']; ?>)
                                                                <div class="float-right">
                                                                    <a href="<?php echo base_url('templat_penilaian/sub_indikator_edit/' . $template['id'] . '/' . $kategori['id'] . '/' . $indikator['id'] . '/' . $sub_indikator['id']); ?>" class="btn btn-warning btn-xs" title="Edit Sub-Indicator"><i class="fas fa-edit"></i></a>
                                                                    <a href="<?php echo base_url('templat_penilaian/sub_indikator_delete/' . $template['id'] . '/' . $kategori['id'] . '/' . $indikator['id'] . '/' . $sub_indikator['id']); ?>" class="btn btn-danger btn-xs" title="Delete Sub-Indicator" onclick="return confirm('Are you sure you want to delete this sub-indicator?')"><i class="fas fa-trash"></i></a>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php else: ?>
                                                    <p class="text-muted">No sub-indicators defined.</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-muted">No indicators defined for this category.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">No criteria categories defined for this template.</p>
                <?php endif; ?>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <a href="<?php echo base_url('skema_entri/index/' . $template['id']); ?>" class="btn btn-info">Manage Entry Schema</a>
                <a href="<?php echo base_url('templat_penilaian'); ?>" class="btn btn-secondary">Back to List</a>
                <a href="<?php echo base_url('templat_penilaian/edit/' . $template['id']); ?>" class="btn btn-warning">Edit Template</a>
                <a href="<?php echo base_url('templat_penilaian/delete/' . $template['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this template?')">Delete Template</a>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->