<template>

</template>
<script>
    export default {
        props: ['content'],

        created() {
            if (this.content) {
                iziToast.success({
                    title: 'Success',
                    message: this.content,
                })
            }
        }
    }
</script>
