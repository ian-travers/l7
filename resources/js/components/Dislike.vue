<template>
    <div class="d-inline ml-4">
        <button :class="classes" @click="toggle">
            <span class="lead fas fa-thumbs-down"></span>
        </button>
        <span v-text="count"></span>
    </div>
</template>

<script>
    export default {
        props: ['comment'],

        data() {
            return {
                count: this.comment.dislikes_count,
                active: this.comment.isDisliked,
            }
        },

        computed: {
            classes() {
                return ['btn', 'bg-transparent', this.active ? 'text-success' : 'text-info']
            },

            endpointSuffix() {
                return '/comments/' + this.comment.id;
            }
        },

        methods: {
            toggle() {
                this.active ? this.undislike() : this.dislike();
            },

            dislike() {
                axios.post(this.endpointSuffix + '/dislike');

                this.active = true;
                this.count++;
            },

            undislike() {
                axios.post(this.endpointSuffix + '/undislike');

                this.active = false;
                this.count--;
            }
        }
    }
</script>

