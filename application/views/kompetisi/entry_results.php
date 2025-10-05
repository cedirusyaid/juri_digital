<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Hasil Penilaian Entri <small>Kompetisi: <?php echo $kompetisi['nama']; ?> | Entri: <?php echo $entri['nama_karya']; ?></small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo site_url('kompetisi'); ?>">Kompetisi</a></li>
              <li class="breadcrumb-item"><a href="<?php echo site_url('kompetisi/results/' . $kompetisi['id']); ?>">Hasil</a></li>
              <li class="breadcrumb-item active">Detail Entri</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Detail Penilaian untuk Entri: <?php echo $entri['nama_karya']; ?></h3>
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

                <?php if (!empty($detailed_assessments)): ?>
                    <?php foreach ($detailed_assessments as $assessment_by_judge): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Juri: <?php echo $assessment_by_judge['nama_juri']; ?> (Status: <?php echo ucfirst($assessment_by_judge['status']); ?>)
                                    <?php if ($assessment_by_judge['dikirim_pada']): ?>
                                        <small>Dikirim pada: <?php echo $assessment_by_judge['dikirim_pada']; ?></small>
                                    <?php endif; ?>
                                </h4>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kategori</th>
                                            <th>Indikator</th>
                                            <th>Sub Indikator</th>
                                            <th>Skor</th>
                                            <th>Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($assessment_by_judge['detail_kriteria'] as $detail): ?>
                                            <tr>
                                                <td><?php echo $detail['kategori_nama']; ?></td>
                                                <td><?php echo $detail['indikator_nama']; ?></td>
                                                <td><?php echo $detail['sub_indikator_nama']; ?></td>
                                                <td><?php echo $detail['skor']; ?></td>
                                                <td><?php echo $detail['catatan']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Belum ada penilaian detail untuk entri ini.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>