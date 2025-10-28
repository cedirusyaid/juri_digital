    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Hasil Penilaian Kompetisi <small><?php echo $kompetisi['nama']; ?></small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo site_url('kompetisi'); ?>">Kompetisi</a></li>
              <li class="breadcrumb-item active">Hasil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Ringkasan Hasil</h3>
                <div class="box-tools pull-right">
                  <a href="<?php echo site_url('kompetisi/download_results/' . $kompetisi['id']); ?>" class="btn btn-primary btn-sm">Download Hasil (CSV)</a>
                  <a href="<?php echo site_url('kompetisi/download_results_pdf/' . $kompetisi['id']); ?>" class="btn btn-danger btn-sm">Download Hasil (PDF)</a>
                </div>
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

                <h4>Progres Penilaian</h4>
                <?php if (!empty($progress)): ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Karya</th>
                                <th>Juri Menilai</th>
                                <th>Status Penilaian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($progress as $p): ?>
                                <tr>
                                    <td><?php echo $p['nama_karya']; ?></td>
                                    <td><?php echo $p['total_juri_menilai']; ?></td>
                                    <td><?php echo $p['juri_status']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Belum ada progres penilaian untuk kompetisi ini.</p>
                <?php endif; ?>

                <h4 class="mt-4">Peringkat Entri Lomba</h4>
                <?php if (!empty($summary)): ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Peringkat</th>
                                <th>Nama Karya</th>
                                <th>Rata-rata Skor</th>
                                <th>Jumlah Juri Menilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $rank = 1; foreach ($summary as $s): ?>
                                <tr>
                                    <td><?php echo $rank++; ?></td>
                                    <td><?php echo $s['nama_karya']; ?></td>
                                    <td><?php echo number_format($s['rata_rata_skor'], 2); ?></td>
                                    <td><?php echo $s['jumlah_juri_menilai']; ?></td>
                                    <td>
                                        <a href="<?php echo site_url('kompetisi/entry_results/' . $kompetisi['id'] . '/' . $s['entri_id']); ?>" class="btn btn-info btn-sm">Lihat Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Belum ada hasil penilaian untuk kompetisi ini.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
