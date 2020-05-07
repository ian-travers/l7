<template>
    <div>
        <form method="post" enctype="multipart/form-data">
            <div id="imageForm" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" v-text="header_title"></h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input
                                id="imageFile"
                                type="file"
                                name="avatar"
                                class="file"
                                accept="image/*"
                                @change="onChangeFile"
                            >
                            <div class="input-group my-3">
                                <input type="text" class="form-control" disabled
                                       :placeholder="placeholder" id="file">
                                <div class="input-group-append">
                                    <button
                                        type="button"
                                        class="browse btn btn-primary"
                                        @click="browse"
                                        v-text="browse_caption"
                                    ></button>
                                </div>
                            </div>
                            <img :src="avatar" id="preview" class="img-thumbnail" alt="">
                        </div>
                        <div class="modal-footer d-block">
                            <div class="text-center">
                                <button
                                    type="button"
                                    class="btn btn-primary"
                                    @click="persist"
                                    v-text="upload_caption"
                                ></button>
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
        props: ['placeholder', 'browse_caption', 'header_title', 'upload_caption', 'no_img_warning_title', 'no_img_warning_message'],

        data() {
            return {
                avatar: 'https://placehold.it/80x80',
                file: null,
            }
        },

        methods: {
            browse() {
                let file = $(document).find('.file');
                file.trigger('click');
            },

            onChangeFile(e) {
                this.file = e.target.files[0];
                $("#file").val(this.file.name);

                let reader = new FileReader();
                reader.readAsDataURL(this.file);

                reader.onload = e => {
                    this.avatar = e.target.result;
                };
            },

            persist() {
                if (this.file) {
                    let data = new FormData();

                    data.append('avatar', this.file);

                    axios.post('/settings/profile/avatar', data)
                        .then(response => {
                            window.location.replace(response.data.reload);
                        });

                } else {
                    iziToast.warning({
                        title: this.no_img_warning_title,
                        message: this.no_img_warning_message
                    });
                }
            }
        },
    }
</script>
