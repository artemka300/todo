<template>
    <div class="Task" v-if="Object.keys(getPlan).length != 0">
        <AddTask :onShowTask="onShowTask"   :showAddTask="showAddTask" />
        <img v-if="!showAddTask" src="../../../../static/img/plus.png" alt=""  @click="onShowTask(true)" class="PlanToDo_AddPlan">
        <div class="TaskPlan">
            <img :src="getPlan.img.path" alt="">
            <div class="">
                <p>{{ taskname }}</p>
                <h2>{{ getPlan.name }}</h2>
            </div>
        </div>
        <div class="TaskItems">
            <Task v-for="item in getTask" :item="item" :key="item.id" />
        </div>
    </div>
</template>
<script>
import Task from '../../../components/Task/TaskItem.vue'
import AddTask from '../../../components/Task/AddTask.vue'
export default {
    components: {
        Task, AddTask
    },
    data() {
        return {
            showAddTask: false,
        }
    },
    methods: {
        onShowTask(bool) {
            this.showAddTask = bool;
        },
    },
    computed: {
        getTask() {
            return this.getPlan.tasks ?? []
        },
        getPlan() {
            return this.$store.getters.setTaskid(this.$route.params.id) ?? {}
        },
        taskname() {
            if (this.getTask.length == 0) {
                return 'Нет задач'
            } if (this.getTask.length == 1) {
                return this.getTask.length + ' задача'
            } if (this.getTask.length >= 2 && this.getTask.length < 5) {
                return this.getTask.length + ' задачи'
            }
            return this.getTask.length + ' задач'
        }
    },
}
</script>
<style lang="scss">
.Task {
    position: relative;
    padding: 10px;
    border-radius: 10px;
    margin-top: 30px;
    background-color: rgb(255 255 255);
    box-shadow: rgb(0 0 0 / 5%) 0 0 30px;

    &Plan {
        display: flex;
        height: 80px;
        gap: 15px;

        img {
            padding: 5px;
        }
    }

    &Items {
        padding-top: 30px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

}
</style>
