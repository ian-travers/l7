<script>
    import Like from "./Like";
    import Dislike from "./Dislike";

    export default {
        props: ['attributes'],

        components: {Like, Dislike},

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
                })
                    .then(response => {
                        iziToast.success({
                            title: response.data.status,
                            message: response.data.message,
                        });
                    });

                this.editing = false;
            },

            remove() {
                axios.delete('/comments/' + this.attributes.id)
                    .then((response) => {
                        $(this.$el).fadeOut(500, () => {
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
