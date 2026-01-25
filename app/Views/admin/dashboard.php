<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Lombok Biking Tour</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <a class="navbar-brand" href="#">Lombok Biking Tour Admin</a>
        <div>
            <a href="<?= base_url() ?>" class="btn btn-outline-light btn-sm mr-2" target="_blank">View Site</a>
            <a href="<?= base_url('admin/logout') ?>" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container-fluid">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-table mr-2"></i>Content Management</h5>
                <div>
                    <a href="<?= base_url('admin/status/1') ?>" class="btn btn-sm btn-light <?= $current_status == 1 ? 'active font-weight-bold' : '' ?>">Active (1)</a>
                    <a href="<?= base_url('admin/status/0') ?>" class="btn btn-sm btn-light <?= $current_status === '0' ? 'active font-weight-bold' : '' ?>">Hidden (0)</a>
                    <a href="<?= base_url('admin/status/5') ?>" class="btn btn-sm btn-light <?= $current_status == 5 ? 'active font-weight-bold' : '' ?>">Packages (5)</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Title (Teks)</th>
                                <th>Description / Value (Other Teks)</th>
                                <th>Status</th>
                                <th>Group</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= $item['kd_teks'] ?></td>
                                <td><?= strip_tags(substr($item['teks'], 0, 50)) ?>...</td>
                                <td><?= strip_tags(substr($item['other_teks'], 0, 50)) ?>...</td>
                                <td><span class="badge badge-<?= $item['status'] == 5 ? 'success' : 'secondary' ?>"><?= $item['status'] ?></span></td>
                                <td><?= $item['group_data'] ?></td>
                                <td>
                                    <?php if ($item['img']): ?>
                                        <img src="<?= base_url('assets/themes/images/' . $item['img']) ?>" height="40">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/edit/' . $item['kd_teks']) ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
