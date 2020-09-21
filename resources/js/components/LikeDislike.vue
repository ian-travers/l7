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
        props: ['model', 'uri-suffix'],

        data() {
            return {
                likesCount: this.model.likes_count,
                dislikesCount: this.model.dislikes_count,
                isLiked: this.model.isLiked,
                isDisliked: this.model.isDisliked,
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
                return `/${this.uriSuffix}/${this.model.id}`;
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
                axios.post(this.endpointSuffix + '/like')
                    .then(response => {
                        iziToast.info({
                            title: response.data.status,
                            message: response.data.message,
                        });
                    });

                this.isLiked = true;
                this.likesCount++;

                if (this.isDisliked) {
                    this.isDisliked = false;
                    this.dislikesCount--;
                }
            },

            unlike() {
                axios.post(this.endpointSuffix + '/unlike')
                    .then(response => {
                        iziToast.info({
                            title: response.data.status,
                            message: response.data.message,
                        });
                    });

                this.isLiked = false;
                this.likesCount--;
            },

            dislike() {
                axios.post(this.endpointSuffix + '/dislike')
                    .then(response => {
                        iziToast.info({
                            title: response.data.status,
                            message: response.data.message,
                        });
                    });

                this.isDisliked = true;
                this.dislikesCount++;

                if (this.isLiked) {
                    this.isLiked = false;
                    this.likesCount--;
                }
            },

            undislike() {
                axios.post(this.endpointSuffix + '/undislike')
                    .then(response => {
                        iziToast.info({
                            title: response.data.status,
                            message: response.data.message,
                        });
                    });

                this.isDisliked = false;
                this.dislikesCount--;
            }
        }
    }
</script>
