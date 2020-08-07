<template>
    <div>
        <label v-text="field_caption"></label>
        <div class="text-center">
            <label for="image-upload" class="btn btn-light border" v-text="button_caption"></label>
        </div>
        <input id="image-upload" type="file" name="image" accept="image/*" @change="onChange">
        <div v-if="image" class="text-center">
            <img :src="image" class="img-fluid" alt="">
        </div>
        <div class="hint text-center mt-1 mb-3" v-text="hint"></div>
        <div v-if="image" class="text-center">
            <button type="button" class="btn btn-light btn-sm border" v-text="remove" @click="removeImage"></button>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['field_caption', 'button_caption', 'remove', 'hint', 'initial_image', 'post_id', 'caution', 'save_warning', 'remove_image_question'],

        data() {
            return {
                image: this.initial_image,
            }
        },

        methods: {
            onChange(e) {
                if (!e.target.files.length) return;

                let file = e.target.files[0];

                let reader = new FileReader();

                reader.readAsDataURL(file);

                reader.onload = e => {
                    this.image = e.target.result;
                    iziToast.warning({
                        title: this.caution,
                        message: this.save_warning,
                        position: 'center',
                    });
                }
            },

            removeImage() {
                if (confirm(this.remove_image_question)) {
                    document.getElementById('image-upload').value = null;
                    this.image = null;
                    axios.patch('/user/posts/' + this.post_id + '/no-image');
                }
            },
        }
    }
</script>
