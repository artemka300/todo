<template>
    <div class="Task" v-if="Object.keys(getPlan).length != 0">
        <AddTask :onShowTask="onShowTask" :showAddTask="showAddTask" />
        <img v-if="!showAddTask" src="../../../../static/img/plus.png" alt="" @click="onShowTask(true)"
            class="PlanToDo_AddPlan">
        <div class="TaskPlan">
            <img :src="getPlan.img.path" alt="" v-if="$route.params.id !='today'">
            <img src="../../../../static/img/calendar.png" v-else alt="" class="ToDoIcon">
            <div class="">
                <p>{{ taskname }}</p>
                <h2>{{ getPlan.name }}</h2>
            </div>
        </div>
        <div class="select-box">
            <select name="dfdfd" v-model="select">
                <option value="0">Все - {{ filtersCount(0).length }} </option>
                <option v-if="filtersCount(1).length !== 0" value="1">Текущие - {{ filtersCount(1).length }} </option>
                <option v-if="filtersCount(2).length !== 0" value="2">Выполненные - {{ filtersCount(2).length }}
                </option>
                <option v-if="filtersCount(3).length !== 0" value="3">Удаленные - {{ filtersCount(3).length }} </option>
            </select>
        </div>
        <div class="TaskItems">
            <Task v-for="item in filtersCount(select)" :item="item" :key="item.id" />
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
            select: 0
        }
    },
    methods: {
        onShowTask(bool) {
            this.showAddTask = bool;
        },
        filtersCount(id) {
            return this.getTask.filter(item => {
                if (id == 0) {
                    return item;
                }
                if (id == 1) {
                    return item.done == false && item.del == false;
                }
                if (id == 2) {
                    return item.done == true && item.del == false;
                }
                if (id == 3) {
                    return item.del == true;
                }
            })
        },
    },
    computed: {

        getTask() {
            return this.getPlan.tasks ?? []
        },

        getPlan() {
            if (this.$route.params.id == 'today') {
                return {
                    name: 'Задачи на сегодня',
                    tasks: this.$store.getters.setTaskToday
                }
            }
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
.calendar {
    position: absolute;
    z-index: 3;
    top: 40%;
    left: 49px;
    font-size: 2rem;
    color: white;
    font-family: Arial, Helvetica, sans-serif;
    -webkit-text-stroke: 2px black;
    text-align: center;
}

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

        display: flex;
        flex-direction: column;
        gap: 10px;
    }
}

.select-box {
    select {
        appearance: none;
        // Additional resets for further consistency
        background-color: transparent;
        border: none;
        padding: 0 1em 0 0;
        margin: 0;
        width: 100%;
        font-family: inherit;
        font-size: inherit;
        cursor: inherit;
        line-height: inherit;
        outline: none;
        width: 100%;

        border-radius: 0.25em;
        padding: 0.25em 0.5em;
        font-size: 1.25rem;
        cursor: pointer;
        line-height: 1.1;

    }


    min-width: 15ch;
    max-width: 25ch;
    border: 2px solid rebeccapurple;
    background-color: #fff;
    margin: 15px 0 5px 0;
    position: relative;
    border-radius: 5px;

    &::after {
        content: "";
        width: 0.8em;
        position: absolute;
        height: 0.5em;
        top: 40%;
        right: 10px;
        background-color: black;
        -webkit-clip-path: polygon(100% 0%, 0 0%, 50% 100%);
        clip-path: polygon(100% 0%, 0 0%, 50% 100%);
    }

    &:-ms-expand {
        display: none;
    }
}
</style>
