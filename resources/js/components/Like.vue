<template>
    <div class="d-inline ml-4">
        <button :class="classes" @click="toggle">
            <span class="lead fas fa-thumbs-up"></span>
        </button>
        <span v-text="count"></span>
    </div>
</template>

<script>
    export default {
        props: ['comment'],

        data() {
            return {
                count: this.comment.likes_count,
                active: this.comment.isLiked,
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
                this.active ? this.unlike() : this.like();
            },

            like() {
                axios.post(this.endpointSuffix + '/like');

                this.active = true;
                this.count++;
            },

            unlike() {
                axios.post(this.endpointSuffix + '/unlike');

                this.active = false;
                this.count--;
            }
        }
    }
</script>

