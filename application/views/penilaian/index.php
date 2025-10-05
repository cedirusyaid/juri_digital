    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Penilaian Saya <small>Daftar Entri Lomba yang Ditugaskan</small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item active">Penilaian Saya</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Daftar Penilaian</h3>
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

                <?php if (!empty($kompetisi_list)): ?>
                    <?php foreach ($kompetisi_list as $kompetisi): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Kompetisi: <?php echo $kompetisi['nama']; ?></h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Karya</th>
                                            <th>Deskripsi</th>
                                            <th>Status Penilaian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($kompetisi['entries'])): ?>
                                            <?php foreach ($kompetisi['entries'] as $entry): ?>
                                                <tr>
                                                    <td><?php echo $entry['nama_karya']; ?></td>
                                                    <td><?php echo $entry['deskripsi']; ?></td>
                                                    <td>
                                                        <?php
                                                            $status_class = '';
                                                            if ($entry['assessment_status'] == 'terkirim') {
                                                                $status_class = 'label-success';
                                                            } elseif ($entry['assessment_status'] == 'draft') {
                                                                $status_class = 'label-warning';
                                                            } else {
                                                                $status_class = 'label-default';
                                                            }
                                                        ?>
                                                        <span class="label <?php echo $status_class; ?>">
                                                            <?php echo ucfirst($entry['assessment_status']); ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo site_url('penilaian/assess/' . $kompetisi['id'] . '/' . $entry['id']); ?>" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-edit"></i> Nilai
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada entri yang ditugaskan untuk kompetisi ini.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Tidak ada kompetisi atau entri yang ditugaskan kepada Anda.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
