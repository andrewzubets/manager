<template>
    <div class="card-header">
        <span style="color: gray;"> {{ moment(item.created_at).format('D.M.Y HH:mm') }}</span>
    </div>
    <div class="card-body">

        <h5 v-if="isString(item['title'])" class="card-title">{{ item.title }}</h5>
        <h6 v-if="isString(item['secondary'])" class="card-subtitle text-body-secondary">{{ item.secondary }}</h6>

    </div>
    <div class="card-footer d-flex justify-content-end">
        <RouterLink
            v-if="isString(item['edit_href'])"
            :to="item['edit_href']"
            class="btn btn-outline-success action">
            Редактировать
        </RouterLink>
        <RouterLink
            v-if="isString(item['delete_href'])"
            :to="item['delete_href']"
            class="btn btn-outline-danger action">
            Удалить
        </RouterLink>
    </div>
</template>

<script>
import {isString} from "lodash";
import moment from "moment";

export default {
    name: "QuestionListItem",
    methods: {isString, moment},
    props: {
        item: {
            type: Object
        }
    }
}
</script>

<style scoped>

</style>
