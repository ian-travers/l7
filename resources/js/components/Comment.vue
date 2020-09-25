<template>
    <div class="comment-item border border-info mb-1 px-3 py-1" :data-id="comment.id">
        <div class="d-flex">
            <div class="author-avatar py-3 mr-3">
                <img
                    v-if="author.hasAvatar"
                    :src="avatarSrc"
                    class="rounded-circle"
                    width="50"
                    height="50"
                    alt=""
                >
                <div v-else style="width: 50px"></div>
            </div>
            <div class="text-info w-100">
                <div class="d-flex justify-content-between">
                    <div>
                        <strong v-text="author.nickname"></strong>
                        <span
                            class="text-muted"
                            v-text="comment.created_at"
                        ></span>
                        <like-dislike
                            v-if="signedIn"
                            :model="comment"
                            uri-suffix="comments"
                        ></like-dislike>
                    </div>
                    <div v-if="signedIn">
                        <div
                            v-if="canUpdate"
                            class="comment-actions dropdown navbar-dark"
                        >
                            <span class="fas fa-ellipsis-v" type="button" data-toggle="dropdown"></span>
                            <div class="dropdown-menu dropdown-menu-right bg-nfsu-cup border border-light">
                                <div class="navbar-nav">
                                    <button class="dropdown-item dropdown-nfsu nav-link-nfsu"
                                            @click="editing = true">{{ edit }}
                                    </button>
                                    <button class="dropdown-item dropdown-nfsu nav-link-nfsu"
                                            @click="remove">{{ del }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div
                            v-else
                            class="comment-reply"
                        >
                            <span class="fas fa-reply"></span>
                            <span v-text="reply"></span>
                        </div>
                    </div>
                </div>
                <div class="py-1">
                    <div v-if="editing" class="form-group">
                        <textarea v-model="comment.body" class="form-control bg-dark text-info mb-2" rows="3"
                                  required></textarea>
                        <button type="button" class="btn btn-sm btn-primary mr-1"
                                @click="updateComment">{{ update }}
                        </button>
                        <button type="button" class="btn btn-sm btn-secondary"
                                @click="editing = false">{{ cancel }}
                        </button>
                    </div>
                    <div v-else v-text="comment.body"></div>
                </div>
            </div>
        </div>
        <div class="reply-block"></div>
        <div v-for="child in data.children">
            <comment
                :data="child"
                :reply="reply"
                :edit="edit"
                :update="update"
                :cancel="cancel"
                :del="del"
            ></comment>
        </div>
    </div>
</template>
<script>
    import LikeDislike from "./LikeDislike";

    export default {
        name: 'comment',

        props: ['data', 'reply', 'edit', 'update', 'cancel', 'del'],

        components: {LikeDislike},

        data() {
            return {
                editing: false,
                comment: this.data.comment,
                author: this.data.comment.author,
            };
        },

        computed: {
            avatarSrc() {
                return `/storage/${this.author.avatar_path}`;
            },

            signedIn() {
                return window.App.signedIn;
            },

            canUpdate() {
                return this.author.id == window.App.user.id;
            }
        },

        methods: {
            updateComment() {
                axios.patch('/comments/' + this.comment.id, {
                    body: this.comment.body
                })
                    .then(response => {
                        iziToast.success({
                            title: response.data.status,
                            message: response.data.message,
                        });
                    });

                this.editing = false;
            },

            remove() {
                if (confirm()) {
                    axios.delete('/comments/' + this.comment.id)
                        .then((response) => {
                            this.$emit('deleted', this.comment.id);
                            $(this.$el).fadeOut(500, () => {
                                iziToast.success({
                                    title: response.data.status,
                                    message: response.data.message,
                                })
                            });
                        })
                        .catch((error) => {
                            iziToast.warning({
                                title: error.response.data.status,
                                message: error.response.data.message,
                            });
                        });
                }
            }
        }
    }
</script>
