<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Manage blog categories</h4>
                    </div>

                    <div class="col-md-6 p-0">
                        <button
                            class="btn btn-dark btn-sm m-0 float-right"
                            @click.prevent="adding = !adding"
                        >
                            <i class="fa fa-plus"></i> Add category
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form @submit.prevent="addCategory()" v-if="adding">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Add a blog category</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label
                                    for="name"
                                    class="col-form-label col-md-3"
                                >
                                    Name: *
                                </label>
                                <div class="col-md-9">
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        v-model="name"
                                        required
                                        class="form-control form-control-sm"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="subcategory"
                                    v-model="subcategory"
                                />
                                <label
                                    class="form-check-label"
                                    for="subcategory"
                                >
                                    Add as a subcategory
                                </label>
                            </div>
                        </div>

                        <div class="col-md-5" v-if="subcategory">
                            <div class="form-group row">
                                <label
                                    class="col-form-label col-md-5"
                                    for="blog_category_id"
                                >
                                    Select Main category
                                </label>
                                <div class="col-md-7">
                                    <select
                                        class="form-control form-control-sm"
                                        name="blog_category_id"
                                        id="blog_category_id"
                                        v-model="blog_category_id"
                                    >
                                        <option value="">None</option>
                                        <option
                                            v-for="(category, c) in parents"
                                            :key="c"
                                            :value="category.id"
                                        >
                                            {{ category.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description: </label>
                                <textarea
                                    class="form-control"
                                    name="description"
                                    id="description"
                                    v-model="description"
                                    rows="2"
                                ></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button
                                class="btn btn-light btn-sm"
                                @click.prevent="adding = !adding"
                            >
                                Cancel
                            </button>

                            <button
                                type="submit"
                                class="btn btn-dark btn-sm float-right"
                            >
                                Add category
                            </button>
                        </div>
                    </div>
                </form>

                <form @submit.prevent="updateCategory()" v-if="editing">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Add a blog category</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label
                                    for="name"
                                    class="col-form-label col-md-3"
                                >
                                    Name: *
                                </label>
                                <div class="col-md-9">
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        v-model="category.name"
                                        required
                                        class="form-control form-control-sm"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    v-model="subcategory"
                                />
                                <label
                                    class="form-check-label"
                                    for="subcategory"
                                >
                                    Add as a subcategory
                                </label>
                            </div>
                        </div>

                        <div class="col-md-5" v-if="subcategory">
                            <div class="form-group row">
                                <label
                                    class="col-form-label col-md-5"
                                    for="blog_category_id"
                                >
                                    Select Main category
                                </label>
                                <div class="col-md-7">
                                    <select
                                        class="form-control form-control-sm"
                                        name="blog_category_id"
                                        id="blog_category_id"
                                        v-model="category.blog_category_id"
                                    >
                                        <option value="">None</option>
                                        <option
                                            v-for="(category, c) in parents"
                                            :key="c"
                                            :value="category.id"
                                        >
                                            {{ category.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description: </label>
                                <textarea
                                    class="form-control"
                                    name="description"
                                    id="description"
                                    v-model="category.description"
                                    rows="2"
                                ></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button
                                class="btn btn-light btn-sm"
                                @click.prevent="cancelEdit()"
                            >
                                Cancel
                            </button>

                            <button
                                type="submit"
                                class="btn btn-dark btn-sm float-right"
                            >
                                Update category
                            </button>
                        </div>
                    </div>
                </form>

                <table
                    class="table table-borderless table-secondary table-striped table-sm mb-0"
                    v-if="!adding && !editing"
                >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Parent Category</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="(category, c) in categories.data" :key="c">
                            <td>{{ c + categories.from }}.</td>
                            <td>{{ category.name }}</td>
                            <td>
                                {{
                                    category.category
                                        ? category.category.name
                                        : "N/A"
                                }}
                            </td>
                            <td>{{ category.description }}</td>
                            <td>
                                <button
                                    class="btn btn-grey m-1 p-1"
                                    @click.prevent="startEditing(category)"
                                >
                                    Edit
                                </button>

                                <button
                                    class="btn btn-danger m-1 p-1"
                                    @click="deleteCat(category)"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            adding: false,
            editing: false,
            subcategory: false,
            categories: {},
            category: {},
            name: "",
            description: "",
            blog_category_id: ""
        };
    },

    mounted() {
        this.getData();
    },

    computed: {
        parents() {
            if (
                this.categories === undefined &&
                this.categories.data === undefined
            ) {
                return {};
            }

            return this.categories.data.filter(category => {
                if (category.blog_category_id === null) {
                    return category;
                }
            });
        }
    },

    methods: {
        getData() {
            axios.get("/admin/blog-categories").then(r => {
                this.categories = r.data.categories;
            });
        },

        addCategory() {
            axios
                .post("/admin/blog-categories", {
                    name: this.name,
                    blog_category_id: this.blog_category_id,
                    description: this.description
                })
                .then(r => {
                    toastr.success(
                        "success",
                        "Successfully added blog categories."
                    );
                    this.getData();
                    this.adding = false;
                    this.name = "";
                    this.description = "";
                    this.blog_category_id = "";
                });
        },

        startEditing(category) {
            this.category = category;
            this.editing = true;

            if (this.category.blog_category_id === null) {
                this.subcategory = false;
            } else {
                this.subcategory = true;
            }
        },

        cancelEdit() {
            this.category = {};
            this.editing = false;
            this.subcategory = false;
        },

        updateCategory() {
            if (this.subcategory) {
                var blog_category_id = this.category.blog_category_id;
            } else {
                var blog_category_id = null;
            }

            axios
                .patch("/admin/blog-categories/" + this.category.id, {
                    name: this.category.name,
                    blog_category_id,
                    description: this.category.description
                })
                .then(r => {
                    toastr.success(
                        "success",
                        "Successfully updated blog category."
                    );
                    this.getData();
                    this.cancelEdit();
                });
        },

        deleteCat(category) {
            Swal.fire({
                title: `Delete ${category.name}?`,
                icon: "error",
                showCancelButton: true,
                confirmButtonColor: "#38c172",
                cancelButtonColor: "#d33",
                confirmButtonText: "Delete"
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .delete("/admin/blog-categories/" + category.id)
                        .then(r => {
                            this.getData();
                            Swal.fire(
                                "Success",
                                "Category successfully deleted.",
                                "success"
                            );
                        });
                }
            });
        }
    }
};
</script>
