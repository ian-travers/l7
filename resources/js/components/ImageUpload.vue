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
        <div class="hint text-center" v-text="hint"></div>
        <div v-if="image" class="text-center">
            <button type="button" class="btn btn-light btn-sm border" v-text="remove" @click="removeImage"></button>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['field_caption', 'button_caption', 'remove', 'hint'],

        data() {
            return {
                image: ''
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
                }
            },

            removeImage() {
                document.getElementById('image-upload').value= null;
                this.image = '';
            }
        }
    }
</script>
