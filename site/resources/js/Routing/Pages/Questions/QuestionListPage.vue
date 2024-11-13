<template>
    <h1>Вопросы</h1>
    <Breadcrumbs :items="breadcrumbs" />
    <Preloader v-if="is_loading" />
    <QuestionListActions
        v-if="!is_loading"
        :add-route="{
            href: '/questions/new',
            label: 'Добавить вопрос'
        }"
        @onSearch="onSearch"
        @onSortOrderChange="onSortOrderChange"
        :search-str="searchStrComputed"
        :sort-order="sortOrder"
    />
    <Pagination v-if="!is_loading" :pagination="pagination" @onPageClick="onPageClick" />
    <QuestionList v-if="!is_loading" :items="items" />
</template>
<script>
import Breadcrumbs from "@components/Breadcrumbs.vue";
import Preloader from "@components/Preloader.vue";
import {axiosQuestionList, getQuestionListUriParams, getQuestionsBreadcrumbs} from "@api/questions";
import Pagination from "@components/Pagination/Pagination.vue";
import {store} from "@store/store";
import QuestionList from "./List/QuestionList.vue";
import QuestionListActions from "./List/QuestionListActions.vue";

export default {
    name: "QuestionListPage",
    components: {QuestionListActions, QuestionList, Pagination, Preloader, Breadcrumbs},
    data: () => ({
       items: [],
        page: 1,
        pagination: {
            has_pages: false,
        },
        searchStr: '',
        sortOrder: 'asc',
        is_loading: true,
        breadcrumbs: getQuestionsBreadcrumbs()
    }),
    methods: {
        async loadList() {
            this.is_loading = true;
            await axiosQuestionList(
                this.page,
                this.searchStr,
                this.sortOrder,
                (r) => {
                    this.is_loading = false;
                    this.items = r.items;
                    this.pagination = r.pagination;
                });
        },
        onPageClick(page){
            store.flushNotifications();
            this.page = page;
            this.updateUriState();
            this.loadList();
        },
        onSearch(queryStr) {
            this.searchStr = queryStr;
            this.page = 1;
            this.updateUriState();
            this.loadList();
        },
        onSortOrderChange(sortOrder) {
           this.sortOrder = sortOrder;
           this.updateUriState();
           this.loadList();
        },
        updateUriState() {
            let uri = document.location.origin + document.location.pathname;
            uri+= getQuestionListUriParams({
                page: this.page,
                searchStr: this.searchStr,
                sortOrder: this.sortOrder
            });
            window.history.pushState(null, null, uri );
        }
    },
    computed: {
        searchStrComputed(){
            return this.searchStr;
        }
    },
    mounted() {
        const query = this.$route.query;
        this.page = query.page ?? 1;
        this.searchStr = query.name ?? '';
        this.sortOrder = query.sortOrder ?? 'asc';
        this.loadList();
    }
}
</script>

<style scoped>

</style>
