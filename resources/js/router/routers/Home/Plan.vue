<template>
    <div class="PlanToDo">
        <AddPlan :showAddPlan="showAddPlan" :onShowAddPlan="onShowAddPlan" />
        <h2>Категория задач</h2>
        <img src="../../../../static/img/plus.png" v-if="!showAddPlan" alt="" class="PlanToDo_AddPlan"
            @click="onShowAddPlan(true)">
        <div class="PlanToDoItems">
            <ToDoToDay />
            <ToDo v-for="item in getToDo" :item="item" :key="item.id" />
        </div>
    </div>
</template>
<script>
import ToDoToDay from '../../../components/ToDoItem/ToDoToDay.vue'
import ToDo from '../../../components/ToDoItem/ToDo.vue'
import AddPlan from '../../../components/ToDoItem/AddPlan.vue'
export default {
    components: {
        ToDo, AddPlan, ToDoToDay
    },
    data() {
        return {
            showAddPlan: false,

        }
    },
    methods: {
        onShowAddPlan(bool) {
            this.showAddPlan = bool;
        }
    },
    computed: {
        getToDo() {
            return this.$store.getters.setToDo
        }
    },


}
</script>
<style lang="scss">
.Plan {
    &ToDo {

        display: flex;
        flex-direction: column;
        padding-top: 30px;
        position: relative;

        &_AddPlan {
            position: fixed;
            padding: 30px;
            height: 60px;
            z-index: 2;
            right: 0;
            bottom: 0;
        }

        &Items {
            display: flex;
            flex-direction: column;
            padding-top: 10px;
            gap: 15px;
        }
    }
}
</style>
