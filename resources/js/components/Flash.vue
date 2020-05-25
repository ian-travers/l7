<template>

</template>
<script>
    export default {
        props: ['content'],

        created() {
            if (this.content) {
                const data = JSON.parse(this.content);

                switch (data.type) {
                    case 'success':
                        iziToast.success({
                            title: data.title,
                            message: data.message,
                        });
                        break;

                    case 'info':
                        iziToast.info({
                            title: data.title,
                            message: data.message,
                        });
                        break;

                    case 'warning':
                        iziToast.warning({
                            title: data.title,
                            message: data.message,
                        });
                        break;

                    case 'error':
                        iziToast.error({
                            title: data.title,
                            message: data.message,
                        });
                        break;

                    default:
                        iziToast.info({
                            title: data.title,
                            message: data.message,
                        });
                }


            }
        },
    }
</script>
