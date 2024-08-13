<template>
<div class="data-list">
    <div class="card mb-2" v-for="item in items">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="card-title">{{ item.name }}</h5>
                    <h6 class="card-subtitle text-body-secondary">{{ item.category }}</h6>
                </div>
                <div class="col-md-4">
                    <div class="actions">
                        <RouterLink
                            v-if="isString(item['edit_href'])"
                            :to="item['edit_href']"
                            class="btn btn-outline-success action">
                            Edit
                        </RouterLink>
                        <RouterLink
                            v-if="isString(item['delete_href'])"
                            :to="item['delete_href']"
                            class="btn btn-outline-danger action">
                            Delete
                        </RouterLink>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <Pagination />
</template>

<script>
import Pagination from "../Pagination/Pagination.vue";
import {isString} from "lodash";
export default {
    name: "DataList",
    methods: {isString},
    components: {Pagination},
    props: {
      items: Array
    },
    data() {
        return {
            // items: [
            //     {
            //         id: 1,
            //         name: 'Question 1',
            //         category: 'Category 1',
            //         edit_href: '/questions/edit/1',
            //         delete_href: '/questions/delete/1'
            //     },

        }
    }
}
</script>

<style scoped>

</style>
