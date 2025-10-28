<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Penilaian</h1>
                <h2><small>Kompetisi: <?php echo $assessment_data['kompetisi']['nama']; ?></small></h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo site_url('penilaian'); ?>">Penilaian Saya</a></li>
                    <li class="breadcrumb-item active">Detail Penilaian</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-secondary">
                <h3 class="card-title text-white">
                    <i class="fas fa-file-alt mr-2"></i>
                    Entri Lomba: <?php echo $assessment_data['entri']['nama_karya']; ?>
                </h3>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Periode Penilaian Telah Berakhir</h5>
                    <p class="mb-0">Waktu untuk kompetisi ini telah selesai. Halaman ini bersifat **read-only** dan skor tidak dapat diubah lagi.</p>
                </div>

                <!-- Informasi Karya -->
                <div class="callout callout-info">
                    <h4><i class="fas fa-info-circle mr-2"></i>Deskripsi Karya:</h4>
                    <p class="mb-3"><?php echo $assessment_data['entri']['deskripsi']; ?></p>
                    <?php if (!empty($assessment_data['entri']['detail_karya'])): ?>
                        <?php $detail_karya = json_decode($assessment_data['entri']['detail_karya'], true); ?>
                        <?php if (!empty($detail_karya)): ?>
                            <h5><i class="fas fa-list mr-2"></i>Detail Tambahan:</h5>
                            <ul class="mb-0">
                                <?php foreach ($detail_karya as $key => $value): ?>
                                    <li>
                                        <strong><?php echo ucfirst(str_replace('_', ' ', $key)); ?>:</strong>
                                        <?php if (filter_var($value, FILTER_VALIDATE_URL)): ?>
                                            <a href="<?php echo $value; ?>" target="_blank" class="text-primary">
                                                <i class="fas fa-external-link-alt ml-1"></i> <?php echo $value; ?>
                                            </a>
                                        <?php else: ?>
                                            <?php echo $value; ?>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <?php if (!empty($assessment_data['kriteria'])): ?>
                    <?php foreach ($assessment_data['kriteria'] as $kategori): ?>
                        <div class="card card-primary mt-4">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="fas fa-folder mr-2"></i>
                                    Kategori: <?php echo $kategori['nama']; ?> &nbsp
                                    <small class="float-right">Bobot: <?php echo $kategori['bobot']; ?></small>
                                </h4>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($kategori['indikator'])): ?>
                                    <?php foreach ($kategori['indikator'] as $indikator): ?>
                                        <div class="card card-info mt-3">
                                            <div class="card-header">
                                                <h5 class="card-title">
                                                    <i class="fas fa-list-alt mr-2"></i>
                                                    Indikator: <?php echo $indikator['nama']; ?>  &nbsp
                                                    <small class="float-right">Bobot: <?php echo $indikator['bobot']; ?></small>
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <?php if (!empty($indikator['sub_indikator'])): ?>
                                                    <?php foreach ($indikator['sub_indikator'] as $sub_indikator): ?>
                                                        <div class="form-group assessment-item p-3 border rounded mb-3" style="background: #f8f9fa;">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <label class="font-weight-bold text-dark mb-2">
                                                                        <?php echo $sub_indikator['nama']; ?>
                                                                    </label>
                                                                    <?php if (!empty($sub_indikator['catatan'])): ?>
                                                                        <div class="p-2 bg-light border rounded">
                                                                            <p class="mb-0"><strong><i class="fas fa-comment-dots"></i> Catatan:</strong> <?php echo $sub_indikator['catatan']; ?></p>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <p class="text-muted"><em>Tidak ada catatan.</em></p>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <?php
                                                                    $currentScore = isset($sub_indikator['skor']) ? $sub_indikator['skor'] : 0;
                                                                    $scoreDisplayClass = ($currentScore == 0) ? 'bg-secondary' : 'bg-white';
                                                                    ?>
                                                                    <div class="score-display text-center p-3 border rounded <?php echo $scoreDisplayClass; ?>" id="score_display_<?php echo $sub_indikator['id']; ?>">
                                                                        <div class="progress mb-2" style="height: 8px;">
                                                                            <div id="progress_<?php echo $sub_indikator['id']; ?>" 
                                                                                 class="progress-bar" 
                                                                                 role="progressbar" 
                                                                                 style="width: <?php echo $currentScore; ?>%;"
                                                                                 aria-valuenow="<?php echo $currentScore; ?>" 
                                                                                 aria-valuemin="0" 
                                                                                 aria-valuemax="100">
                                                                            </div>
                                                                        </div>
                                                                        <div class="score-label small">
                                                                            <span id="label_<?php echo $sub_indikator['id']; ?>" class="badge" style="font-size: 0.8em;">
                                                                                <?php
                                                                                if ($currentScore == 100) echo 'Sangat Baik';
                                                                                elseif ($currentScore == 80) echo 'Baik';
                                                                                elseif ($currentScore == 60) echo 'Cukup';
                                                                                elseif ($currentScore == 40) echo 'Kurang';
                                                                                elseif ($currentScore == 20) echo 'Sangat Kurang';
                                                                                else echo 'Belum dinilai';
                                                                                ?>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <div class="alert alert-warning">
                                                        <i class="icon fas fa-exclamation-triangle mr-2"></i>
                                                        Tidak ada sub-indikator untuk indikator ini.
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="alert alert-warning">
                                        <i class="icon fas fa-exclamation-triangle mr-2"></i>
                                        Tidak ada indikator untuk kategori ini.
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-warning text-center">
                        <h4><i class="icon fas fa-exclamation-triangle mr-2"></i>Informasi</h4>
                        <p class="mb-0">Tidak ada kriteria penilaian yang tersedia untuk kompetisi ini.</p>
                    </div>
                <?php endif; ?>
                
                <div class="card-footer text-center bg-light mt-4">
                    <a href="<?php echo site_url('penilaian'); ?>" class="btn btn-lg btn-primary">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Penilaian
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    // Function to update score display and progress bar
    function updateScoreDisplay(subIndikatorId, score) {
        $('#progress_' + subIndikatorId).css('width', score + '%').attr('aria-valuenow', score);
        
        var label = $('#label_' + subIndikatorId);
        var badgeClass = 'badge-secondary';
        var labelText = 'Belum dinilai';
        
        if (score == 100) {
            labelText = 'Sangat Baik';
            badgeClass = 'badge-success';
        } else if (score == 80) {
            labelText = 'Baik';
            badgeClass = 'badge-info';
        } else if (score == 60) {
            labelText = 'Cukup';
            badgeClass = 'badge-warning';
        } else if (score == 40) {
            labelText = 'Kurang';
            badgeClass = 'badge-warning';
        } else if (score == 20) {
            labelText = 'Sangat Kurang';
            badgeClass = 'badge-danger';
        }
        
        label.text(labelText).removeClass('badge-secondary badge-success badge-info badge-warning badge-danger').addClass(badgeClass);
        
        var progressBar = $('#progress_' + subIndikatorId);
        progressBar.removeClass('bg-success bg-info bg-warning bg-danger bg-secondary');
        
        if (score == 0) {
            progressBar.addClass('bg-secondary');
        } else if (score <= 40) {
            progressBar.addClass('bg-danger');
        } else if (score <= 60) {
            progressBar.addClass('bg-warning');
        } else if (score <= 80) {
            progressBar.addClass('bg-info');
        } else {
            progressBar.addClass('bg-success');
        }

        var scoreDisplay = $('#score_display_' + subIndikatorId);
        scoreDisplay.removeClass('bg-secondary bg-white');
        if (score == 0) {
            scoreDisplay.addClass('bg-secondary');
        } else {
            scoreDisplay.addClass('bg-white');
        }
    }

    // Set initial display for all score displays
    $('.score-display').each(function() {
        var subIndikatorId = this.id.replace('score_display_', '');
        var score = $('#progress_' + subIndikatorId).attr('aria-valuenow');
        updateScoreDisplay(subIndikatorId, score);
    });
});
</script>

<style>
.assessment-item {
    border: 1px solid #dee2e6;
}
.score-display {
    transition: all 0.3s ease;
}
.progress-bar {
    transition: width 0.5s ease;
}
.bg-secondary {
    background-color: #6c757d !important;
    color: white;
}
.bg-secondary .badge {
    background-color: #495057 !important;
    color: white;
}
</style>
