<template>
    <form v-if="has_avatar" method="post">
        <button
            type="button"
            class="btn btn-light btn-sm border"
            v-text="button_caption"
            @click="submitForm"
        ></button>
    </form>
</template>

<script>
    export default {
        props: {
            has_avatar: Boolean,
            button_caption: String,
            form_accent: String,
            form_question: String,
        },

        methods: {
            submitForm() {
                iziToast.question({
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: this.form_accent,
                    message: this.form_question,
                    position: 'center',
                    buttons: [
                        ['<button>Yes</button>', function (instance, toast) {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'buttonYes');
                        }],
                        ['<button>No</button>', function (instance, toast) {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'buttonNo');
                        }, true],
                    ],
                    onClosing: function(instance, toast, closedBy){
                        if (closedBy === 'buttonYes') {
                            axios.post('/settings/profile/no-avatar')
                                .then( () => {
                                    window.location.replace(location.pathname);
                                });
                        }
                    },
                });
            }
        }
    }
</script>

<style scoped>

</style>
