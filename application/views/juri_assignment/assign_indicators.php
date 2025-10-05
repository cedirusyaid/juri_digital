<style>
    .checkbox label {
        word-wrap: break-word;
        overflow-wrap: break-word;
        margin-bottom: 5px; /* Add some vertical spacing */
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Penugasan Juri ke Indikator <small>Kompetisi: <?php echo $kompetisi['nama']; ?></small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo site_url('juri_assignment'); ?>">Penugasan Juri</a></li>
              <li class="breadcrumb-item active">Tugaskan Indikator</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tugaskan Juri ke Indikator Kriteria</h3>
            </div>
            <div class="box-body">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Error!</h4>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <?php echo form_open('juri_assignment/save_indicator_assignment'); ?>
                <input type="hidden" name="kompetisi_id" value="<?php echo $kompetisi['id']; ?>">

                <?php if (!empty($categories_with_indicators)): ?>
                    <?php foreach ($categories_with_indicators as $category): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Kategori: <?php echo $category['nama']; ?> (Bobot: <?php echo $category['bobot']; ?>)
                                </h4>
                            </div>
                            <div class="panel-body">
                                <?php if (!empty($category['indikator'])): ?>
                                    <?php foreach ($category['indikator'] as $indicator): ?>
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">
                                                    Indikator: <?php echo $indicator['nama']; ?> (Bobot: <?php echo $indicator['bobot']; ?>)
                                                </h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label>Pilih Juri untuk Indikator ini:</label>
                                                    <div class="row">
                                                        <?php if (!empty($judges)): ?>
                                                            <?php foreach ($judges as $judge): ?>
                                                                <div class="col-md-4"> <!-- Changed from col-md-3 to col-md-4 -->
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" name="indicator_assignments[<?php echo $judge['id']; ?>][]" value="<?php echo $indicator['id']; ?>"
                                                                                <?php
                                                                                // Check if this judge is already assigned to this indicator
                                                                                $is_assigned = in_array($indicator['id'], $judge['assigned_indicators']);
                                                                                echo $is_assigned ? 'checked' : '';
                                                                                ?>
                                                                            >
                                                                            <?php echo $judge['nama']; ?>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <div class="col-md-12">
                                                                <p>Tidak ada juri yang terdaftar.</p>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>Tidak ada indikator untuk kategori ini.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <button type="submit" class="btn btn-primary">Simpan Penugasan Indikator</button>
                <?php else: ?>
                    <p>Tidak ada kategori atau indikator untuk kompetisi ini.</p>
                <?php endif; ?>

                <?php echo form_close(); ?>
            </div>
        </div>
    </section>
</div>