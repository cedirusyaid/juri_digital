<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Form Penilaian </h1><h2><small>Kompetisi: <?php echo $assessment_data['kompetisi']['nama']; ?></small></h2>
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
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title text-white">
                    <i class="fas fa-file-alt mr-2"></i>
                    Entri Lomba: <?php echo $assessment_data['entri']['nama_karya']; ?>
                </h3>
            </div>
            <div class="card-body">
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

                <?php echo form_open('penilaian/save_assessment', ['id' => 'assessment-form']); ?>
                <input type="hidden" name="kompetisi_id" value="<?php echo $assessment_data['kompetisi']['id']; ?>">
                <input type="hidden" name="entri_lomba_id" value="<?php echo $assessment_data['entri']['id']; ?>">

                <?php if (isset($assessment_ended) && $assessment_ended === TRUE): ?>
                    <div class="alert alert-warning">
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Peringatan</h5>
                        <p class="mb-0">Periode penilaian untuk kompetisi ini telah berakhir. Anda tidak dapat lagi mengubah atau mengirimkan penilaian.</p>
                    </div>
                <?php endif; ?>

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
                                                                        <!-- <i class="fas fa-star text-warning mr-2"></i> -->
                                                                        <?php echo $sub_indikator['nama']; ?>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <!-- Dropdown dengan Icon -->
                                                                    <select name="assessment_details[<?php echo $sub_indikator['id']; ?>][skor]" 
                                                                            class="form-control score-select select2" 
                                                                            data-target="<?php echo $sub_indikator['id']; ?>"
                                                                            style="width: 100%;"
                                                                            <?php echo (isset($assessment_ended) && $assessment_ended === TRUE) ? 'disabled' : ''; ?>>
                                                                        <option value="0">Pilih Skor</option>
                                                                        <option value="20" <?php echo (isset($sub_indikator['skor']) && $sub_indikator['skor'] == '20') ? 'selected' : ''; ?>>⭐ </option>
                                                                        <option value="40" <?php echo (isset($sub_indikator['skor']) && $sub_indikator['skor'] == '40') ? 'selected' : ''; ?>>⭐⭐ </option>
                                                                        <option value="60" <?php echo (isset($sub_indikator['skor']) && $sub_indikator['skor'] == '60') ? 'selected' : ''; ?>>⭐⭐⭐ </option>
                                                                        <option value="80" <?php echo (isset($sub_indikator['skor']) && $sub_indikator['skor'] == '80') ? 'selected' : ''; ?>>⭐⭐⭐⭐ </option>
                                                                        <option value="100" <?php echo (isset($sub_indikator['skor']) && $sub_indikator['skor'] == '100') ? 'selected' : ''; ?>>⭐⭐⭐⭐⭐ </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- Score Display dengan Progress Bar -->
                                                            <div class="row mt-2">
                                                                <div class="col-md-8">
                                                                    <textarea name="assessment_details[<?php echo $sub_indikator['id']; ?>][catatan]" 
                                                                            class="form-control" 
                                                                            rows="2" 
                                                                            placeholder="📝 Berikan catatan penilaian (opsional)" 
                                                                            <?php echo (isset($assessment_ended) && $assessment_ended === TRUE) ? 'disabled' : ''; ?>><?php echo isset($sub_indikator['catatan']) ? trim($sub_indikator['catatan']) : ''; ?></textarea>
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
                    
                    <!-- Action Buttons -->
                    <div class="card-footer text-center bg-light mt-4">
                        <button type="submit" name="status" value="draft" class="btn btn-lg btn-warning mr-3" <?php echo (isset($assessment_ended) && $assessment_ended === TRUE) ? 'disabled' : ''; ?>>
                            <i class="fas fa-save mr-2"></i>Simpan sebagai Draft
                        </button>
                        <button type="submit" name="status" value="terkirim" class="btn btn-lg btn-success" <?php echo (isset($assessment_ended) && $assessment_ended === TRUE) ? 'disabled' : ''; ?>>
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Penilaian
                        </button>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning text-center">
                        <h4><i class="icon fas fa-exclamation-triangle mr-2"></i>Informasi</h4>
                        <p class="mb-0">Tidak ada kriteria penilaian yang tersedia untuk kompetisi ini.</p>
                    </div>
                <?php endif; ?>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    // Initialize Select2 jika ada
    if ($.fn.select2) {
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Skor',
            allowClear: false
        });
    }

    // Function to update score display and progress bar
    function updateScoreDisplay(subIndikatorId, score) {
        $('#current_score_' + subIndikatorId).text(score);
        $('#progress_' + subIndikatorId).css('width', score + '%').attr('aria-valuenow', score);
        
        // Update label dan badge color
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
        
        // Update progress bar color
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

        // Update Score Display background color
        var scoreDisplay = $('#score_display_' + subIndikatorId);
        scoreDisplay.removeClass('bg-secondary bg-white');
        if (score == 0) {
            scoreDisplay.addClass('bg-secondary');
        } else {
            scoreDisplay.addClass('bg-white');
        }
    }

    // Function to set initial display
    function setInitialDisplay() {
        console.log('=== SETTING INITIAL DISPLAY ===');
        
        $('.score-select').each(function() {
            var selectedValue = $(this).val();
            var subIndikatorId = $(this).data('target');
            
            console.log('Sub Indikator ' + subIndikatorId + ': initial value = ' + selectedValue);
            updateScoreDisplay(subIndikatorId, selectedValue);
        });
        
        console.log('=== INITIAL DISPLAY SET ===');
    }

    // Call on page load
    setInitialDisplay();

    // Handle score selection change
    $('.score-select').on('change', function() {
        var selectedScore = $(this).val();
        var subIndikatorId = $(this).data('target');
        
        console.log('Score changed for sub_indikator ' + subIndikatorId + ': ' + selectedScore);
        
        // Update display
        updateScoreDisplay(subIndikatorId, selectedScore);
        
        // Remove invalid styling if any
        $(this).removeClass('is-invalid');
        $(this).closest('.assessment-item').removeClass('border-danger');
    });

    // Validate before form submission
    $('#assessment-form').on('submit', function(e) {
        var allScoresValid = true;
        var emptyScores = [];
        
        $('.score-select').each(function() {
            var subIndikatorId = $(this).data('target');
            var scoreValue = $(this).val();
            
            if (!scoreValue || scoreValue === '0') {
                emptyScores.push('Kriteria ' + subIndikatorId);
                allScoresValid = false;
                
                // Highlight the invalid field
                $(this).addClass('is-invalid');
                $(this).closest('.assessment-item').addClass('border-danger');
                
                // Scroll to first invalid field
                if (emptyScores.length === 1) {
                    $('html, body').animate({
                        scrollTop: $(this).offset().top - 100
                    }, 500);
                }
            } else {
                $(this).removeClass('is-invalid');
                $(this).closest('.assessment-item').removeClass('border-danger');
            }
        });
        
        if (!allScoresValid) {
            var message = '⚠️ Peringatan: ' + emptyScores.length + ' kriteria belum dinilai.\n\n';
            message += 'Kriteria yang belum dinilai:\n' + emptyScores.join('\n');
            message += '\n\nSilakan pilih skor untuk semua kriteria sebelum mengirim.';
            
            alert(message);
            e.preventDefault();
            return false;
        }
        
        console.log('✅ All scores valid, submitting form...');
        return true;
    });
});
</script>

<style>
.assessment-item {
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.assessment-item:hover {
    border-color: #007bff;
    background: #ffffff !important;
}

.assessment-item.border-danger {
    border-color: #dc3545 !important;
    background: #ffe6e6 !important;
}

.score-display {
    transition: all 0.3s ease;
}

.progress-bar {
    transition: width 0.5s ease;
}

.is-invalid {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
}

/* Style untuk Select2 yang konsisten */
.select2-container--bootstrap4 .select2-selection--single {
    height: calc(2.25rem + 2px) !important;
    padding: 0.375rem 0.75rem;
}

.select2-container--bootstrap4 .select2-selection--single .select2-selection__arrow {
    height: calc(2.25rem + 2px) !important;
}

/* Style untuk score display dengan background secondary */
.bg-secondary {
    background-color: #6c757d !important;
    color: white;
}

.bg-secondary .badge {
    background-color: #495057 !important;
    color: white;
}
</style>