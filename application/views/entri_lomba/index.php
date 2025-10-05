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
              <li class="breadcrumb-item"><a href="<?php echo base_url('kompetisi'); ?>">Competitions</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('kompetisi/view/' . $kompetisi['id']); ?>"><?php echo $kompetisi['nama']; ?></a></li>
              <li class="breadcrumb-item active">Entries</li>
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
                <h3 class="card-title">List of Entries for <?php echo $kompetisi['nama']; ?></h3>
                <div class="card-tools">
                  <a href="<?php echo base_url('entri_lomba/create/' . $kompetisi['id']); ?>" class="btn btn-primary btn-sm">Add New Entry</a>
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
                    <th>Entry Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if (!empty($entries)): ?>
                      <?php foreach ($entries as $entry): ?>
                      <tr>
                        <td><?php echo $entry['id']; ?></td>
                        <td><?php echo $entry['nama_karya']; ?></td>
                        <td><?php echo $entry['deskripsi']; ?></td>
                        <td>
                          <a href="<?php echo base_url('entri_lomba/view/' . $kompetisi['id'] . '/' . $entry['id']); ?>" class="btn btn-info btn-sm">View</a>
                          <a href="<?php echo base_url('entri_lomba/edit/' . $kompetisi['id'] . '/' . $entry['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                          <a href="<?php echo base_url('entri_lomba/manage_juri/' . $kompetisi['id'] . '/' . $entry['id']); ?>" class="btn btn-primary btn-sm">Manage Judges</a>
                          <a href="<?php echo base_url('entri_lomba/delete/' . $kompetisi['id'] . '/' . $entry['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <tr>
                          <td colspan="4">No entries found for this competition.</td>
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