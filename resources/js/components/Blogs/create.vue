<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Add an article</h4>
            </div>

            <div class="card-body">
                <form @submit.prevent="addArticle()">
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <div class="input-group dropbox landscape">
                                    <span class="input-group-btn">
                                        <a
                                            data-input="thumbnail"
                                            @click="$refs.fileInput.click()"
                                            data-preview="holder"
                                            class="input-file"
                                        >
                                            <i class="fa fa-picture-o"></i>
                                            Choose
                                        </a>
                                    </span>
                                    <img id="holder" src="" />
                                    <input
                                        id="thumbnail"
                                        style="display: none !important"
                                        type="file"
                                        accept="image/*"
                                        name="image"
                                        ref="fileInput"
                                        @change="onFileSelected"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name: *</label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control"
                                    required
                                />
                            </div>

                            <div class="form-group">
                                <label for="blog_category_id"
                                    >Select category: *</label
                                >
                                <select
                                    class="form-control"
                                    name="blog_category_id"
                                    id="blog_category_id"
                                >
                                    <option value="">None</option>
                                    <option
                                        v-for="(category, c) in categories"
                                        :key="c"
                                        :value="category.id"
                                    >
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea
                                    class="form-control"
                                    name="body"
                                    id="body"
                                    rows="25"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: {},
            selectedImage: ""
        };
    },

    mounted() {
        this.getData();

        tinymce.init({
            selector: "textarea"
        });
    },

    methods: {
        getData() {
            axios.get("/blogs/create").then(r => {
                this.categories = r.data.categories;
            });
        },

        onFileSelected(event) {
            this.selectedImage = event.target.files[0];

            const fd = new FormData();
            fd.append("image", this.selectedImage);

            this.$axios.post("/profile", fd).then(r => {
                this.$toast.success("Successfully updated profile image.");
                setTimeout(() => {
                    window.location.reload();
                }, 200);
            });
        }
    }
};
</script>
