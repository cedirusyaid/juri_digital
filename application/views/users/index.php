    <div class="container">
        <h1>Manajemen Pengguna</h1>

        <?php if ($this->session->flashdata('success_message')):
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
            echo $this->session->flashdata('success_message');
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        endif; ?>
        <?php if ($this->session->flashdata('error_message')):
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo $this->session->flashdata('error_message');
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        endif; ?>

        <a href="<?php echo base_url('users/create'); ?>" class="btn btn-primary mb-3">Tambah Pengguna</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['nama'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td>
                        <a href="<?php echo base_url('users/view/' . $user['id']); ?>" class="btn btn-sm btn-info">Info</a>
                        <a href="<?php echo base_url('users/edit/' . $user['id']); ?>" class="btn btn-sm btn-warning">Ubah</a>
                        <?php
                        $is_admin = false;
                        foreach ($user['roles'] as $role) {
                            if (in_array($role['role_name'], ['Admin', 'Admin Super'])) {
                                $is_admin = true;
                                break;
                            }
                        }
                        $disabled = $user['has_juri_assignments'] || $is_admin;
                        $title = $disabled ? 'Tidak dapat menghapus pengguna dengan peran admin atau tugas juri' : 'Hapus pengguna';
                        ?>
                        <a href="<?php echo base_url('users/delete/' . $user['id']); ?>" class="btn btn-sm btn-danger <?php echo $disabled ? 'disabled' : '' ?>" title="<?php echo $title; ?>" onclick="return <?php echo $disabled ? 'false' : 'confirm(\'Apakah Anda yakin ingin menghapus pengguna ini?\')' ?>;">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
