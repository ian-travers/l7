<script>
    import Comments from "./Comments";
    import LikeDislike from "./LikeDislike";

    export default {
        props: ['initialCommentsCount'],

        components: {Comments, LikeDislike},

        data() {
            return {
                commentsCount: this.initialCommentsCount,
            }
        },
    }
</script>
