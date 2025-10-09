<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $title; ?></h1>
          </div>
          <div class="col-sm-6">
            <div class="btn-group float-sm-right">
              <a href="<?php echo base_url('skema_entri/index/' . $template['id']); ?>" class="btn btn-info">Kelola Skema Entri</a>
              <a href="<?php echo base_url('templat_penilaian'); ?>" class="btn btn-secondary">Kembali ke Daftar</a>
              <a href="<?php echo base_url('templat_penilaian/edit/' . $template['id']); ?>" class="btn btn-warning">Ubah Templat</a>
              <?php
              $disabled = $template['is_in_use'];
              $title = $disabled ? 'Tidak dapat menghapus templat yang sedang digunakan oleh kompetisi' : 'Hapus templat';
              ?>
              <a href="<?php echo base_url('templat_penilaian/delete/' . $template['id']); ?>" class="btn btn-danger <?php echo $disabled ? 'disabled' : '' ?>" title="<?php echo $title; ?>" onclick="return <?php echo $disabled ? 'false' : 'confirm(\'Apakah Anda yakin ingin menghapus templat ini?\')' ?>;">Hapus Templat</a>
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
                <h3 class="card-title">Detail Templat: <?php echo $template['nama_templat']; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-file-alt mr-1"></i> Nama Templat</strong>
                <p class="text-muted">
                  <?php echo $template['nama_templat']; ?>
                </p>
                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Deskripsi</strong>
                <p class="text-muted">
                  <?php echo $template['deskripsi']; ?>
                </p>
                <hr>

                <h4><i class="fas fa-layer-group mr-1"></i> Kategori Kriteria
                    <a href="<?php echo base_url('templat_penilaian/kategori_create/' . $template['id']); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Tambah Kategori Baru</a>
                </h4>
                <?php if (!empty($kategori_kriteria)): ?>
                    <?php foreach ($kategori_kriteria as $kategori): ?>
                        <div class="card card-secondary collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo $kategori['nama']; ?> (Bobot: <?php echo $kategori['bobot']; ?>)</h3>
                                <div class="card-tools">
                                    <a href="<?php echo base_url('templat_penilaian/kategori_edit/' . $template['id'] . '/' . $kategori['id']); ?>" class="btn btn-tool" title="Ubah Kategori"><i class="fas fa-edit"></i></a>
                                    <a href="<?php echo base_url('templat_penilaian/kategori_delete/' . $template['id'] . '/' . $kategori['id']); ?>" class="btn btn-tool" title="Hapus Kategori" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini dan semua indikator/sub-indikatornya?')"><i class="fas fa-trash"></i></a>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5><i class="fas fa-list-ol mr-1"></i> Indikator
                                    <a href="<?php echo base_url('templat_penilaian/indikator_create/' . $template['id'] . '/' . $kategori['id']); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Tambah Indikator Baru</a>
                                </h5>
                                <?php if (!empty($kategori['indikator_kriteria'])): ?>
                                    <?php foreach ($kategori['indikator_kriteria'] as $indikator): ?>
                                        <div class="card card-info collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title"><?php echo $indikator['nama']; ?> (Bobot: <?php echo $indikator['bobot']; ?>)</h3>
                                                <div class="card-tools">
                                                    <a href="<?php echo base_url('templat_penilaian/indikator_edit/' . $template['id'] . '/' . $kategori['id'] . '/' . $indikator['id']); ?>" class="btn btn-tool" title="Ubah Indikator"><i class="fas fa-edit"></i></a>
                                                    <a href="<?php echo base_url('templat_penilaian/indikator_delete/' . $template['id'] . '/' . $kategori['id'] . '/' . $indikator['id']); ?>" class="btn btn-tool" title="Hapus Indikator" onclick="return confirm('Apakah Anda yakin ingin menghapus indikator ini dan semua sub-indikatornya?')"><i class="fas fa-trash"></i></a>
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h6><i class="fas fa-tasks mr-1"></i> Sub-Indikator
                                                    <a href="<?php echo base_url('templat_penilaian/sub_indikator_create/' . $template['id'] . '/' . $kategori['id'] . '/' . $indikator['id']); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Tambah Sub-Indikator Baru</a>
                                                </h6>
                                                <?php if (!empty($indikator['sub_indikator_kriteria'])): ?>
                                                    <ul class="list-group">
                                                        <?php foreach ($indikator['sub_indikator_kriteria'] as $sub_indikator): ?>
                                                            <li class="list-group-item">
                                                                <?php echo $sub_indikator['nama']; ?> (Urutan: <?php echo $sub_indikator['urutan_tampil']; ?>)
                                                                <div class="float-right">
                                                                    <a href="<?php echo base_url('templat_penilaian/sub_indikator_edit/' . $template['id'] . '/' . $kategori['id'] . '/' . $indikator['id'] . '/' . $sub_indikator['id']); ?>" class="btn btn-warning btn-xs" title="Ubah Sub-Indikator"><i class="fas fa-edit"></i></a>
                                                                    <a href="<?php echo base_url('templat_penilaian/sub_indikator_delete/' . $template['id'] . '/' . $kategori['id'] . '/' . $indikator['id'] . '/' . $sub_indikator['id']); ?>" class="btn btn-danger btn-xs" title="Hapus Sub-Indikator" onclick="return confirm('Apakah Anda yakin ingin menghapus sub-indikator ini?')"><i class="fas fa-trash"></i></a>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php else: ?>
                                                    <p class="text-muted">Tidak ada sub-indikator yang ditentukan.</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-muted">Tidak ada indikator yang ditentukan untuk kategori ini.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">Tidak ada kategori kriteria yang ditentukan untuk templat ini.</p>
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