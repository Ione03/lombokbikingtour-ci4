<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item - Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <a class="navbar-brand" href="<?= base_url('admin') ?>">Lombok Biking Tour Admin</a>
        <a href="<?= base_url('admin') ?>" class="btn btn-outline-light btn-sm"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
    </nav>

    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Edit Item: <?= $item['kd_teks'] ?></h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/update/' . $item['kd_teks']) ?>" method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="teks">Title / Main Text</label>
                        <input type="text" class="form-control" id="teks" name="teks" value="<?= htmlspecialchars($item['teks']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="other_teks">Description / Value / Video URL (Other Teks)</label>
                        <textarea class="form-control" id="other_teks" name="other_teks" rows="5"><?= htmlspecialchars($item['other_teks']) ?></textarea>
                        <small class="form-text text-muted">Use this for descriptions, secondary text, or extended content.</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" <?= $item['status'] == 1 ? 'selected' : '' ?>>1 (Active/Normal)</option>
                                    <option value="0" <?= $item['status'] == 0 ? 'selected' : '' ?>>0 (Hidden)</option>
                                    <option value="5" <?= $item['status'] == 5 ? 'selected' : '' ?>>5 (Package/Featured)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="group_data">Group Data</label>
                                <input type="number" class="form-control" id="group_data" name="group_data" value="<?= $item['group_data'] ?>">
                                <small class="form-text text-muted">0=All, 1=Adventure, 2=Half Day, etc.</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Current Image</label><br>
                        <?php if ($item['img']): ?>
                            <img src="<?= base_url('assets/themes/images/' . $item['img']) ?>" class="img-thumbnail mb-2" style="max-height: 200px;">
                            <input type="hidden" name="old_img" value="<?= $item['img'] ?>">
                        <?php else: ?>
                            <p class="text-muted">No image uploaded.</p>
                        <?php endif; ?>
                        
                        <div class="custom-file mt-2">
                            <input type="file" class="custom-file-input" id="img" name="img">
                            <label class="custom-file-label" for="img">Choose new image...</label>
                        </div>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-save"></i> Save Changes</button>
                    <a href="<?= base_url('admin') ?>" class="btn btn-secondary btn-lg">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // File input label change
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
</body>
</html>
