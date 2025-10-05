    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Penilaian <small>Kompetisi: <?php echo $assessment_data['kompetisi']['nama']; ?></small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo site_url('penilaian'); ?>">Penilaian Saya</a></li>
              <li class="breadcrumb-item active">Form Penilaian</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Entri Lomba: <?php echo $assessment_data['entri']['nama_karya']; ?></h3>
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

                <div class="callout callout-info">
                    <h4>Deskripsi Karya:</h4>
                    <p><?php echo $assessment_data['entri']['deskripsi']; ?></p>
                    <?php if (!empty($assessment_data['entri']['detail_karya'])): ?>
                        <?php $detail_karya = json_decode($assessment_data['entri']['detail_karya'], true); ?>
                        <?php if (!empty($detail_karya)): ?>
                            <h5>Detail Tambahan:</h5>
                            <ul>
                                <?php foreach ($detail_karya as $key => $value): ?>
                                    <li><strong><?php echo ucfirst(str_replace('_', ' ', $key)); ?>:</strong>
                                        <?php if (filter_var($value, FILTER_VALIDATE_URL)): ?>
                                            <a href="<?php echo $value; ?>" target="_blank"><?php echo $value; ?></a>
                                        <?php else: ?>
                                            <?php echo $value; ?>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <?php echo form_open('penilaian/save_assessment'); ?>
                <input type="hidden" name="kompetisi_id" value="<?php echo $assessment_data['kompetisi']['id']; ?>">
                <input type="hidden" name="entri_lomba_id" value="<?php echo $assessment_data['entri']['id']; ?>">

                <?php if (isset($assessment_ended) && $assessment_ended === TRUE): ?>
                    <div class="alert alert-warning">
                        <p><strong>Peringatan:</strong> Periode penilaian untuk kompetisi ini telah berakhir. Anda tidak dapat lagi mengubah atau mengirimkan penilaian.</p>
                    </div>
                <?php endif; ?>

                <?php if (!empty($assessment_data['kriteria'])): ?>
                    <?php foreach ($assessment_data['kriteria'] as $kategori): ?>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title">Kategori: <?php echo $kategori['nama']; ?> (Bobot: <?php echo $kategori['bobot']; ?>)</h4>
                            </div>
                            <div class="panel-body">
                                <?php if (!empty($kategori['indikator'])): ?>
                                    <?php foreach ($kategori['indikator'] as $indikator): ?>
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Indikator: <?php echo $indikator['nama']; ?> (Bobot: <?php echo $indikator['bobot']; ?>)</h5>
                                            </div>
                                            <div class="panel-body">
                                                <?php if (!empty($indikator['sub_indikator'])): ?>
                                                    <?php foreach ($indikator['sub_indikator'] as $sub_indikator): ?>
                                                        <div class="form-group">
                                                            <label><?php echo $sub_indikator['nama']; ?></label>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <input type="number" name="assessment_details[<?php echo $sub_indikator['id']; ?>][skor]" class="form-control" min="0" max="100" value="<?php echo isset($sub_indikator['skor']) ? $sub_indikator['skor'] : ''; ?>" placeholder="Skor (0-100)" required <?php echo (isset($assessment_ended) && $assessment_ended === TRUE) ? 'disabled' : ''; ?>>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <textarea name="assessment_details[<?php echo $sub_indikator['id']; ?>][catatan]" class="form-control" rows="1" placeholder="Catatan" <?php echo (isset($assessment_ended) && $assessment_ended === TRUE) ? 'disabled' : ''; ?>><?php echo isset($sub_indikator['catatan']) ? $sub_indikator['catatan'] : ''; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <p>Tidak ada sub-indikator untuk indikator ini.</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>Tidak ada indikator untuk kategori ini.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <button type="submit" name="status" value="draft" class="btn btn-default" <?php echo (isset($assessment_ended) && $assessment_ended === TRUE) ? 'disabled' : ''; ?>>Simpan sebagai Draft</button>
                    <button type="submit" name="status" value="terkirim" class="btn btn-success" <?php echo (isset($assessment_ended) && $assessment_ended === TRUE) ? 'disabled' : ''; ?>>Kirim Penilaian</button>
                <?php else: ?>
                    <p>Tidak ada kriteria penilaian yang tersedia untuk kompetisi ini.</p>
                <?php endif; ?>

                <?php echo form_close(); ?>
            </div>
        </div>
    </section>
