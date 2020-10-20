<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="m-0 p-0">Manage member accounts</h3>
                            </div>
                            <div class="col-md-6 p-0">
                                <div
                                    class="btn-group float-right m-0"
                                    role="group"
                                    aria-label="Basic example"
                                >
                                    <button
                                        type="button"
                                        class="btn btn-white btn-sm"
                                        @click.prevent="
                                            getData(members.prev_page_url)
                                        "
                                    >
                                        <i class="fa fa-chevron-left"></i> Prev
                                    </button>

                                    <button
                                        type="button"
                                        class="btn btn-white btn-sm"
                                        @click.prevent="
                                            getData(members.next_page_url)
                                        "
                                    >
                                        Next <i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>

                                <label class="mt-2 mx-2 float-right">
                                    Showing {{ members.from }} to
                                    {{ members.to }} of
                                    {{ members.total }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <table
                            class="table table-borderless table-striped table-sm"
                        >
                            <thead class="bg-grey">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    v-for="(member, m) in members.data"
                                    :key="m"
                                >
                                    <td>{{ members.from + m }}.</td>
                                    <td>
                                        {{ member.name }}
                                    </td>
                                    <td>
                                        {{ member.email }}
                                    </td>
                                    <td>
                                        <button class="btn btn-dark m-1 p-1">
                                            Make admin
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            members: {}
        };
    },

    created() {
        this.getData();
    },

    methods: {
        getData(link = null) {
            if (link === null) {
                link = "/admin/users";
            }

            axios.get(link).then(r => {
                this.members = r.data.members;
            });
        }
    }
};
</script>
