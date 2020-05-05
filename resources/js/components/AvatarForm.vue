<template>
    <div>
        <form method="post" enctype="multipart/form-data">
            <div id="imageForm" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">auth.select-image-for-avatar</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input id="imageFile" type="file" name="avatar" class="file"
                                   accept="image/*">
                            <div class="input-group my-3">
                                <input type="text" class="form-control" disabled
                                       placeholder="auth.upload-file" id="file">
                                <div class="input-group-append">
                                    <button type="button" class="browse btn btn-primary">
                                        misc.browse
                                    </button>
                                </div>
                            </div>
                            <img src="https://placehold.it/80x80" id="preview"
                                 class="img-thumbnail" alt="">
                        </div>
                        <div class="modal-footer d-block">
                            <div class="text-center">
                                <button
                                    id="ajaxSubmit"
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    auth.upload-avatar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            $(document).on("click", ".browse", function () {
                var file = $(this).parents().find(".file");
                file.trigger("click");
            });
            $('input[type="file"]').change(function (e) {
                var fileName = e.target.files[0].name;
                $("#file").val(fileName);

                var reader = new FileReader();
                reader.onload = function (e) {
                    // get loaded data and render thumbnail.
                    document.getElementById("preview").src = e.target.result;
                };
                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
            });
        }
    }
</script>

<style scoped>

</style>
