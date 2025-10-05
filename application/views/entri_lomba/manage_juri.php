<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?php echo $title; ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('kompetisi/view/' . $kompetisi['id']); ?>">Competition Details</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('entri_lomba/index/' . $kompetisi['id']); ?>">Entries</a></li>
                    <li class="breadcrumb-item active">Manage Judges</li>
                </ol>
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
                        <h3 class="card-title">Assign Judges to Entry: <?php echo $entry['nama_karya']; ?> (Competition: <?php echo $kompetisi['nama']; ?>)</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php echo form_open('entri_lomba/manage_juri/' . $kompetisi['id'] . '/' . $entry['id']); ?>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('success_message')): ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                <?php echo $this->session->flashdata('success_message'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('error_message')): ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                <?php echo $this->session->flashdata('error_message'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label>Available Judges</label>
                            <?php if (!empty($all_judges)): ?>
                                <?php foreach ($all_judges as $judge): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="judges[]" value="<?php echo $judge['id']; ?>"
                                            <?php echo in_array($judge['id'], $assigned_judge_ids) ? 'checked' : ''; ?>>
                                        <label class="form-check-label"><?php echo $judge['nama']; ?></label>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted">No judges found. Please create users with the 'Juri' role first.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="<?php echo base_url('entri_lomba/index/' . $kompetisi['id']); ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->