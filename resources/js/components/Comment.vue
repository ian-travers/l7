<script>
    export default {
        props: ['attributes', 'success_title', 'success_message'],

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
                    message: this.success_message,
                });
            },
        }
    }
</script>
