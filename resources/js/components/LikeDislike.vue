<template>
    <div class="d-inline">
        <div class="d-inline ml-4">
            <button :class="likeClasses" @click="toggleLike">
                <span class="lead fas fa-thumbs-up"></span>
            </button>
            <span v-text="likesCount"></span>
        </div>
        <div class="d-inline ml-4">
            <button :class="dislikeClasses" @click="toggleDislike">
                <span class="lead fas fa-thumbs-down"></span>
            </button>
            <span v-text="dislikesCount"></span>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['comment'],

        data() {
            return {
                likesCount: this.comment.likes_count,
                dislikesCount: this.comment.dislikes_count,
                isLiked: this.comment.isLiked,
                isDisliked: this.comment.isDisliked,
            }
        },

        computed: {
            likeClasses() {
                return ['btn', 'bg-transparent', this.isLiked ? 'text-success' : 'text-info']
            },

            dislikeClasses() {
                return ['btn', 'bg-transparent', this.isDisliked ? 'text-success' : 'text-info']
            },

            endpointSuffix() {
                return '/comments/' + this.comment.id;
            }
        },

        methods: {
            toggleLike() {
                this.isLiked ? this.unlike() : this.like();
            },

            toggleDislike() {
                this.isDisliked ? this.undislike() : this.dislike();
            },

            like() {
                axios.post(this.endpointSuffix + '/like');

                this.isLiked = true;
                this.likesCount++;

                if (this.isDisliked) {
                    this.isDisliked = false;
                    this.dislikesCount--;
                }
            },

            unlike() {
                axios.post(this.endpointSuffix + '/unlike');

                this.isLiked = false;
                this.likesCount--;
            },

            dislike() {
                axios.post(this.endpointSuffix + '/dislike');

                this.isDisliked = true;
                this.dislikesCount++;

                if (this.isLiked) {
                    this.isLiked = false;
                    this.likesCount--;
                }
            },

            undislike() {
                axios.post(this.endpointSuffix + '/undislike');

                this.isDisliked = false;
                this.dislikesCount--;
            }
        }
    }
</script>
