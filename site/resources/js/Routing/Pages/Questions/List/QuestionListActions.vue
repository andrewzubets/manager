<template>
    <div class="data-list-actions">
        <RouterLink
            v-if="isObject(addRoute)"
            :to="addRoute?.href"
            class="btn btn-success add-list-add">
            {{ addRoute?.label }}
        </RouterLink>

        <div class="data-list-search">
            <input type="text" class="form-control" placeholder="Поиск по названию" v-model="name" />
            <button class="btn btn-primary mx-1" @click.prevent="onSearchClick">Найти</button>
        </div>
        <div class="data-list-sort">
            <div class="btn-group">
                <button class="btn btn-primary mx-1" :class="{'active': sortOrder === 'asc'}" @click="$emit('onSortOrderChange', 'asc')">По возрастанию</button>
                <button class="btn btn-primary mx-1" :class="{'active': sortOrder === 'desc'}" @click="$emit('onSortOrderChange', 'desc')">По убыванию</button>
            </div>
        </div>

    </div>
</template>

<script>
import {isObject} from "lodash";

export default {
    name: "QuestionListActions",
    methods: {
        isObject,
        onSearchClick () {
            this.$emit('onSearch', this.name);
        }
    },
    props: {
        addRoute: Object,
        searchStr: String,
        sortOrder: {
            type: String,
            default: 'asc'
        }
    },
    mounted() {
        this.name = this.searchStr;
    },
    data() {
        return {
           name: '',
        };
    },
}
</script>

<style scoped>

</style>
