<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $title; ?></h1>
                    <small>Kompetisi: <?php echo $kompetisi['nama']; ?> | Entri: <?php echo $entry['nama_karya']; ?></small>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo site_url('kompetisi'); ?>">Kompetisi</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo site_url('kompetisi/results/' . $kompetisi['id']); ?>">Hasil</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo site_url('kompetisi/entry_results/' . $kompetisi['id'] . '/' . $entry['id']); ?>">Detail Entri</a></li>
                        <li class="breadcrumb-item active">Analisa AI</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-robot"></i> Prompt untuk Analisis AI</h3>
                        </div>
                        <div class="card-body">
                            <p>Salin teks di bawah ini dan gunakan pada model AI generatif pilihan Anda (misalnya Gemini, ChatGPT) untuk mendapatkan analisis mendalam tentang kekuatan, kelemahan, dan saran perbaikan untuk entri ini.</p>
                            <textarea class="form-control" rows="15" readonly><?php echo $analysis_prompt; ?></textarea>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" onclick="copyToClipboard()"><i class="fas fa-copy"></i> Salin Prompt</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-lightbulb"></i> Hasil Analisis AI</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted"><i>Tempelkan hasil analisis dari model AI di sini untuk referensi di masa mendatang. Fitur untuk menyimpan analisis secara otomatis akan dikembangkan selanjutnya.</i></p>
                            <textarea class="form-control" rows="20" placeholder="Tempelkan hasil analisis AI di sini..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function copyToClipboard() {
    const textarea = document.querySelector('textarea[readonly]');
    textarea.select();
    document.execCommand('copy');
    alert('Prompt berhasil disalin ke clipboard!');
}
</script>
