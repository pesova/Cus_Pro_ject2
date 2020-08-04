<div id="profilePhoto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="profilePhotoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profilePhotoLabel">Change Profile Picture</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body hash-candidate screen">
                    <form method="POST" action="{{ route('upload_image') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Upload image input-->
                        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                            <label for="upload" class="btn btn-light m-0 rounded-pill px-4">
                                <small class="text-uppercase font-weight-bold text-muted">Choose file</small>
                            </label>
                            <input id="upload" type="file" onchange="readURL(this);"
                                name="profile_picture" class="form-control border-0">
                        </div>
                        <div class="mt-4"><img id="imageResult" src="#" alt=""
                                class="img-fluid rounded shadow-sm mx-auto d-block">
                        </div>
                        <div class=" text-center mt-4">
                            <button class="btn btn-primary" id='financeButton' type="submit">
                                <i class="fa fa-fw fa-lg fa-check-circle"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->