<template>

</template>
<script>
    export default {
        props: ['content'],

        created() {
            if (this.content) {
                const data = JSON.parse(this.content);

                iziToast.success({
                    title: data.title,
                    message: data.message,
                })
            }
        },
    }
</script>
