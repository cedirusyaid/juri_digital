<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Selamat Datang di Aplikasi Juri Digital</h6>
        </div>
        <div class="card-body">
            <p>"Juri Digital" adalah platform penjurian berbasis web yang dirancang sebagai solusi universal untuk mengelola berbagai jenis kompetisi secara efisien, akurat, dan transparan. Aplikasi ini berevolusi dari platform khusus website menjadi sebuah sistem fleksibel yang dapat mengakomodasi lomba desain grafis, aplikasi mobile, business plan, karya tulis, dan kompetisi lainnya.</p>
        </div>
    </div>

    <div class="row">

        <!-- Card Total Kompetisi -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Kompetisi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_kompetisi; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-trophy fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Total Entri Lomba -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Entri Lomba</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_entri_lomba; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Total Juri -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Juri</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_juri; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-gavel fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Total Pengguna -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Pengguna</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_users; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
