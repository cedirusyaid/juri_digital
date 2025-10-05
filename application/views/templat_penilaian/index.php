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
              <li class="breadcrumb-item active"><?php echo $title; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of Evaluation Templates</h3>
                <div class="card-tools">
                  <a href="<?php echo base_url('templat_penilaian/create'); ?>" class="btn btn-primary btn-sm">Add New Template</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php if ($this->session->flashdata('success_message')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $this->session->flashdata('success_message'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error_message')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $this->session->flashdata('error_message'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Template Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if (!empty($templates)): ?>
                      <?php foreach ($templates as $template): ?>
                      <tr>
                        <td><?php echo $template['id']; ?></td>
                        <td><?php echo $template['nama_templat']; ?></td>
                        <td><?php echo $template['deskripsi']; ?></td>
                        <td>
                          <a href="<?php echo base_url('templat_penilaian/view/' . $template['id']); ?>" class="btn btn-info btn-sm">View</a>
                          <a href="<?php echo base_url('templat_penilaian/edit/' . $template['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                          <a href="<?php echo base_url('templat_penilaian/delete/' . $template['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this template?')">Delete</a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <tr>
                          <td colspan="4">No evaluation templates found.</td>
                      </tr>
                  <?php endif; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->