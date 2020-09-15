<script>
    export default {
        props: ['attributes', 'success_title', 'success_edit_message', 'success_delete_message'],

        data() {
            return {
                editing: false,
                body: this.attributes.body,
            };
        },

        methods: {
            update() {
                axios.patch('/comments/' + this.attributes.id, {
                    body: this.body
                });

                this.editing = false;

                iziToast.success({
                    title: this.success_title,
                    message: this.success_edit_message,
                });
            },

            remove() {
                axios.delete('/comments/' + this.attributes.id)
                    .then((response) => {
                        $(this.$el).fadeOut(600, () => {
                            iziToast.success({
                                title: response.data.status,
                                message: response.data.message,
                            })
                        })
                    })
                    .catch((error) => {
                        iziToast.warning({
                            title: error.response.data.status,
                            message: error.response.data.message,
                        })
                    });
            }
        }
    }
</script>
