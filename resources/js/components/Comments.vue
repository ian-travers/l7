<template>
    <div>
        <div v-for="(commentView, index) in items">
            <comment
                :data="commentView"
                :reply="reply"
                :edit="edit"
                :update="update"
                :cancel="cancel"
                :del="del"
                @deleted="remove(index)"
            ></comment>
        </div>
    </div>
</template>

<script>
    import Comment from "./Comment";

    export default {
        props: ['data', 'reply', 'edit', 'update', 'cancel', 'del'],

        components: {Comment},

        data() {
            return {
                items: this.data,
            }
        },

        methods: {
            remove(index) {
                this.items.splice(index, 1);
                this.$emit('removed')
            }
        },
    }
</script>
