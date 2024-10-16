<template>
    <div class="data-list">
        <div class="card mb-2" v-for="item in items">
            <QuestionListItem :item="item" />
        </div>
        <div class="card mb-2" v-if="items.length === 0">
            <div class="card-body">
                <p>Нет данных</p>
            </div>
        </div>
    </div>
</template>


<script>
import {isString} from "lodash";
import QuestionListItem from "./QuestionListItem.vue";

export default {
    name: "QuestionList",
    components: {QuestionListItem},
    methods: {isString},
    props: {
        items: Array
    }
}
</script>

<style scoped>

</style>
