<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Lombok Biking Tour</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        /* Fix for CKEditor in Bootstrap Modal */
        .modal {
            overflow-y: auto;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <a class="navbar-brand" href="#">Lombok Biking Tour Admin</a>
        <div>
            <a href="https://www.histats.com/viewstats/?act=2&sid=5005008" class="btn btn-outline-light btn-sm mr-2" target="_blank">Website Visitor</a>
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
                <div class="d-flex align-items-center">
                    <div class="btn-group mr-2">
                        <a href="<?= base_url('admin/status/0') ?>" class="btn btn-sm btn-light <?= $current_status === '0' ? 'active font-weight-bold' : '' ?>">Basic Information</a>
                        <a href="<?= base_url('admin/status/1') ?>" class="btn btn-sm btn-light <?= $current_status == 1 ? 'active font-weight-bold' : '' ?>">Gallery</a>                        
                        <a href="<?= base_url('admin/status/5') ?>" class="btn btn-sm btn-light <?= $current_status == 5 ? 'active font-weight-bold' : '' ?>">Packages</a>
                        <a href="<?= base_url('admin/status/6') ?>" class="btn btn-sm btn-light <?= $current_status == 6 ? 'active font-weight-bold' : '' ?>">Pages</a>
                    </div>
                    <?php if ($current_status == 5): ?>
                        <button type="button" class="btn btn-sm btn-success btn-add-package"><i class="fas fa-plus"></i> Add Package</button>
                    <?php elseif ($current_status == 1): ?>
                        <button type="button" class="btn btn-sm btn-success btn-add-gallery"><i class="fas fa-plus"></i> Add Create New Gallery</button>
                    <?php elseif ($current_status == 6): ?>
                        <button type="button" class="btn btn-sm btn-success btn-add-page"><i class="fas fa-plus"></i> Add New Page</button>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <?php 
                                    $newOrder = ($order === 'asc') ? 'desc' : 'asc';
                                    $icon = function($col) use ($sort, $order) {
                                        if ($sort === $col) {
                                            return $order === 'asc' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>';
                                        }
                                        return '<i class="fas fa-sort text-muted"></i>';
                                    };
                                    
                                    $groupMap = [
                                        1 => 'Adventure Tour',
                                        2 => 'Half Day Biking Tour',
                                        3 => 'Full Day Biking Tour',
                                        4 => 'Long Route Bike',
                                        5 => 'Mountain Biking Tour',
                                        6 => 'Slope Rinjani Biking',
                                        7 => 'Combining Tour'
                                    ];
                                ?>
                                <th><a href="?sort=kd_teks&order=<?= $newOrder ?>" class="text-dark d-block">ID <?= $icon('kd_teks') ?></a></th>
                                <th><a href="?sort=teks&order=<?= $newOrder ?>" class="text-dark d-block">Title (Teks) <?= $icon('teks') ?></a></th>
                                <th><a href="?sort=other_teks&order=<?= $newOrder ?>" class="text-dark d-block">Description (Other) <?= $icon('other_teks') ?></a></th>
                                <?php if ($current_status != 1 && $current_status != 5): ?>
                                <th>Status</th>
                                <?php endif; ?>
                                <?php if ($current_status != 1): ?>
                                <th>Group</th>
                                <?php endif; ?>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= $item['kd_teks'] ?></td>
                                <td><?= strip_tags($item['teks']) ?></td>
                                <td><?= strip_tags(substr($item['other_teks'], 0, 50)) ?>...</td>
                                <?php if ($current_status != 1 && $current_status != 5): ?>
                                <td><span class="badge badge-<?= $item['status'] == 5 ? 'success' : 'secondary' ?>"><?= $item['status'] ?></span></td>
                                <?php endif; ?>
                                <?php if ($current_status != 1): ?>
                                <td><?= $groupMap[$item['group_data']] ?? $item['group_data'] ?></td>
                                <?php endif; ?>
                                <td>
                                    <?php if ($item['img']): ?>
                                        <img src="<?= base_url('assets/themes/images/' . $item['img']) ?>" height="40">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm mb-1 btn-edit-package" data-item='<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>'><i class="fas fa-edit"></i></button>
                                    <?php if ($item['status'] == 5 || $item['status'] == 1 || $item['status'] == 6): ?> <!-- Allow delete for packages, gallery, and pages -->
                                    <a href="<?= base_url('admin/delete/' . $item['kd_teks']) ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- CRUD Modal -->
    <div class="modal fade" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="crudModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <form id="crudForm" method="post" enctype="multipart/form-data">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="crudModalLabel">Manage Package</h5>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <!-- ID Input (Only for Create) -->
                <div class="form-group" id="group-kd_teks">
                    <label for="kd_teks">ID (Unique Code)</label>
                    <input type="text" class="form-control" id="kd_teks" name="kd_teks" placeholder="Auto-generated if empty or enter custom ID (e.g. PKG001)">
                </div>
                
                <div class="form-group">
                    <label for="teks">Title / Main Text</label>
                    <input type="text" class="form-control" id="teks" name="teks" required>
                </div>

                <div class="form-group">
                    <label for="other_teks">Description / Value / Video URL (Other Teks)</label>
                    <textarea class="form-control" id="other_teks" name="other_teks" rows="5"></textarea>
                    <small class="form-text text-muted">Use this for descriptions, secondary text, or extended content.</small>
                </div>

                <div class="row" id="row-status-group">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1">1 (Active/Normal)</option>
                                <option value="0">0 (Hidden)</option>
                                <option value="5">5 (Package/Featured)</option>
                                <option value="6">6 (Page/Information)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="group_data">Group Data</label>
                            <select class="form-control" id="group_data" name="group_data">
                                <?php foreach ($groupMap as $key => $value): ?>
                                    <option value="<?= $key ?>"><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="form-text text-muted">Select the tour category.</small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <div id="current-img-container" class="mb-2 d-none">
                        <img id="current-img" src="" class="img-thumbnail" style="max-height: 150px;">
                        <input type="hidden" id="old_img" name="old_img">
                        <br><small class="text-muted">Current image</small>
                    </div>
                    
                    <div class="custom-file mt-2">
                        <input type="file" class="custom-file-input" id="img" name="img">
                        <label class="custom-file-label" for="img">Choose new image... (Leave empty to keep current)</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fix for CKEditor inside Bootstrap Modal behaving weirdly with focus
            $.fn.modal.Constructor.prototype._enforceFocus = function() {};

            // Initialize CKEditor 5
            let editorInstance;
            ClassicEditor
                .create(document.querySelector('#other_teks'))
                .then(editor => {
                    editorInstance = editor;
                })
                .catch(error => {
                    console.error(error);
                });

            // File input label change
            $('body').on('change', '.custom-file-input', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });

            // Add Gallery Button
            $('.btn-add-gallery').click(function() {
                $('#crudModalLabel').text('Create New Gallery');
                $('#crudForm').attr('action', '<?= base_url('admin/store') ?>');
                $('#crudForm')[0].reset();
                $('#group-kd_teks').show(); // Show ID input
                
                // Default values for Gallery
                $('#status').val('1');
                $('#group_data').val('1');
                
                // Hide Status/Group fields
                $('#row-status-group').hide();
                
                // Image reset
                $('#current-img-container').addClass('d-none');
                $('#old_img').val('');
                $('.custom-file-label').html('Choose new image...');
                
                // Clear CKEditor 5
                if (editorInstance) {
                    editorInstance.setData('');
                }

                $('#crudModal').modal('show');
            });

            // Add Package Button
            $('.btn-add-package').click(function() {
                $('#crudModalLabel').text('Create New Package');
                $('#crudForm').attr('action', '<?= base_url('admin/store') ?>');
                $('#crudForm')[0].reset();
                $('#group-kd_teks').show(); // Show ID input
                
                // Default values for Package
                $('#status').val('5');
                $('#group_data').val('1');
                
                // Show Status/Group fields
                $('#row-status-group').show();
                
                // Image reset
                $('#current-img-container').addClass('d-none');
                $('#old_img').val('');
                $('.custom-file-label').html('Choose new image...');
                
                // Clear CKEditor 5
                if (editorInstance) {
                    editorInstance.setData('');
                }

                $('#crudModal').modal('show');
            });

            // Add Page Button
            $('.btn-add-page').click(function() {
                $('#crudModalLabel').text('Create New Page');
                $('#crudForm').attr('action', '<?= base_url('admin/store') ?>');
                $('#crudForm')[0].reset();
                $('#group-kd_teks').show(); // Show ID input
                
                // Default values for Page
                $('#status').val('6');
                $('#group_data').val('1');
                
                // Hide Status/Group fields for Simplicity or Show? 
                // Pages usually don't need group_data, but status is fixed to 6.
                // We'll hide them to keep it clean, as user is in "Pages" tab.
                $('#row-status-group').hide();
                
                // Image reset (Pages might have an image header? Optional)
                $('#current-img-container').addClass('d-none');
                $('#old_img').val('');
                $('.custom-file-label').html('Choose new image... (Optional Header)');
                
                // Clear CKEditor 5
                if (editorInstance) {
                    editorInstance.setData('');
                }

                $('#crudModal').modal('show');
            });

            // Edit Button
            $('.btn-edit-package').click(function() {
                var item = $(this).data('item');
                // Ensure newlines work in textareas if JSON encoded differently, but standard val() handles it
                
                $('#crudModalLabel').text('Edit Item: ' + item.kd_teks);
                $('#crudForm').attr('action', '<?= base_url('admin/update/') ?>' + item.kd_teks);
                
                // Populate fields
                $('#kd_teks').val(item.kd_teks); 
                $('#group-kd_teks').hide(); // Hide ID input
                $('#teks').val(item.teks);
                $('#other_teks').val(item.other_teks);
                $('#status').val(item.status);
                $('#group_data').val(item.group_data);
                
                // Show/Hide Status/Group based on item status
                if (item.status == 1) {
                    $('#row-status-group').hide();
                } else {
                    $('#row-status-group').show();
                }
                
                // Image logic
                if (item.img && item.img != "") {
                    $('#current-img').attr('src', '<?= base_url('assets/themes/images/') ?>' + item.img);
                    $('#old_img').val(item.img);
                    $('#current-img-container').removeClass('d-none');
                } else {
                    $('#current-img-container').addClass('d-none');
                    $('#old_img').val('');
                }
                $('.custom-file-label').html('Choose new image... (Leave empty to keep current)');
                
                // Set CKEditor 5 data
                if (editorInstance) {
                    editorInstance.setData(item.other_teks);
                }

                $('#crudModal').modal('show');
            });
        });
    </script>
</body>
</html>
