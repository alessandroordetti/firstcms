<a class="btn border mb-4" data-toggle="modal" data-target="#file-manager-modal" href="">Carica File</a>

<div class="modal fade" id="file-manager-modal" tabindex="-1" role="dialog" aria-labelledby="file-manager-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="file-manager-modal-label">File Manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="mb-3" id="file-manager-form" method="POST" enctype="multipart/form-data" action="{{ route('file-management-upload') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="file">Upload File</label>
                        <input type="file" class="form-control-file" id="file" name="file">
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>

                <a href="{{ route('file-management-get-files') }}">Fetch</a>

                <form id="new-folder-form">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="folder-name">New Folder Name</label>
                        <input type="text" class="form-control" id="folder-name" name="folder-name">
                    </div>
                    <button type="submit" class="btn btn-primary">Create Folder</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    <!-- CSS files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- JavaScript files -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</script>