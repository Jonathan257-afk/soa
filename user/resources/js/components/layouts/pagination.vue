<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li :class="classPagination(value - 1)" v-for="value in countPage" :key="value"><a class="page-link"
                    style="cursor: pointer;" @click="getResults(value)">{{ value }}</a></li>
        </ul>
    </nav>
</template>

<script>
import axios from 'axios';
import helper from '../../helper';
export default {
    data() {
        return {
            countPage: {},
            class: {},
        };
    },
    props: [
        "element", "url"
    ],
    watch: {
        element: function (value) {
            this.countPage = {};
            this.class = {};

            for (var i = 1; i <= value.last_page; i++) {
                this.countPage[(i - 1)] = i;
                if (value.current_page == i)
                    this.class[(i - 1)] = "page-item active";
                else
                    this.class[(i - 1)] = "page-item";
            }
        }

    },
    methods: {
        classPagination(key) {
            return this.class[key];
        },
        getResults(page = 1) {
            axios.post(this.url, {
                page: page
            })
                .then((response) => {
                    helper.isConnected(response);
                    this.$emit('change-page', response.data.data);
                });
        },
    },
    mounted() {
    }
}
</script>
