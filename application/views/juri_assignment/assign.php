    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Penugasan Juri <small>Kompetisi: <?php echo $kompetisi['nama']; ?></small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo site_url('juri_assignment'); ?>">Penugasan Juri</a></li>
              <li class="breadcrumb-item active">Tugaskan Entri</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tugaskan Juri ke Entri Lomba</h3>
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

                <?php echo form_open('juri_assignment/save_assignment'); ?>
                <input type="hidden" name="kompetisi_id" value="<?php echo $kompetisi['id']; ?>">

                <?php if (!empty($entries)): ?>
                    <?php foreach ($entries as $entry): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Entri: <?php echo $entry['nama_karya']; ?> (ID: <?php echo $entry['id']; ?>)
                                </h4>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Pilih Juri:</label>
                                    <div class="row">
                                        <?php if (!empty($judges)): ?>
                                            <?php foreach ($judges as $judge): ?>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="judge_assignments[<?php echo $entry['id']; ?>][]" value="<?php echo $judge['id']; ?>"
                                                                <?php
                                                                // Check if this judge is already assigned to this entry
                                                                $is_assigned = FALSE;
                                                                foreach ($entry['assigned_judges'] as $assigned_judge) {
                                                                    if ($assigned_judge['id'] == $judge['id']) {
                                                                        $is_assigned = TRUE;
                                                                        break;
                                                                    }
                                                                }
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
                    <button type="submit" class="btn btn-primary">Simpan Penugasan</button>
                <?php else: ?>
                    <p>Tidak ada entri lomba untuk kompetisi ini.</p>
                <?php endif; ?>

                <?php echo form_close(); ?>
            </div>
        </div>
    </section>
