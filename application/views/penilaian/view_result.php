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
              <li class="breadcrumb-item"><a href="<?php echo base_url('penilaian'); ?>">My Assessments</a></li>
              <li class="breadcrumb-item active">Result</li>
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
                <h3 class="card-title">Assessment Result for: <?php echo $entry['nama_karya']; ?> (Competition: <?php echo $kompetisi['nama']; ?>)</h3>
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

                <strong><i class="fas fa-clipboard-check mr-1"></i> Assessment Status</strong>
                <p class="text-muted">
                    <?php
                        $status_class = '';
                        if ($assessment['status'] == 'draft') {
                            $status_class = 'badge-warning';
                        } elseif ($assessment['status'] == 'terkirim') {
                            $status_class = 'badge-success';
                        }
                    ?>
                    <span class="badge <?php echo $status_class; ?>"><?php echo ucfirst($assessment['status']); ?></span>
                </p>
                <hr>

                <h4>Evaluation Criteria (Template: <?php echo $template['nama_templat']; ?>)</h4>
                <?php if (!empty($kategori_kriteria)): ?>
                    <?php foreach ($kategori_kriteria as $kategori): ?>
                        <div class="card card-secondary collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo $kategori['nama']; ?> (Bobot: <?php echo $kategori['bobot']; ?>)</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($kategori['indikator_kriteria'])): ?>
                                    <?php foreach ($kategori['indikator_kriteria'] as $indikator): ?>
                                        <div class="card card-info collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title"><?php echo $indikator['nama']; ?> (Bobot: <?php echo $indikator['bobot']; ?>)</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <?php if (!empty($indikator['sub_indikator_kriteria'])): ?>
                                                    <?php foreach ($indikator['sub_indikator_kriteria'] as $sub_indikator): ?>
                                                        <div class="form-group">
                                                            <label><?php echo $sub_indikator['nama']; ?> (Order: <?php echo $sub_indikator['urutan_tampil']; ?>)</label>
                                                            <p class="text-muted">Score: <strong><?php echo $sub_indikator['skor']; ?></strong></p>
                                                            <p class="text-muted">Comment: <em><?php echo $sub_indikator['catatan']; ?></em></p>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <p class="text-muted">No sub-indicators defined for this indicator.</p>
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
                <a href="<?php echo base_url('penilaian'); ?>" class="btn btn-secondary">Back to My Assessments</a>
                <?php if ($assessment['status'] == 'draft'): ?>
                    <a href="<?php echo base_url('penilaian/assess/' . $kompetisi['id'] . '/' . $entry['id']); ?>" class="btn btn-primary">Edit Assessment</a>
                <?php endif; ?>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->