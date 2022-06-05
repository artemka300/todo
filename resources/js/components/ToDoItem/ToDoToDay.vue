<template >
    <div class="ToDo" @click="$router.push('/task/today')" v-if="this.$store.getters.setTaskToday.length != 0">
        <img src="../../../static/img/calendar.png" alt="" class="ToDoIcon">
        <h5 class="calendar">{{ dateTime }}</h5>
        <div>
            <h5>Задачи на сегодня</h5>
            <p>{{ taskname }} </p>
        </div>
        
    </div>
</template>
<script>
import DateFormat from 'date-and-time';
export default {
    mounted() {

    },
    computed: {
        dateTime() {
            return DateFormat.format(new Date(), 'DD')
        },
        taskname() {
            const count = this.$store.getters.setTaskToday.length
            if (count == 0) {
                return 'Нет задач'
            } if (count == 1) {
                return count + ' задача'
            } if (count >= 2 && count < 5) {
                return count + ' задачи'
            }
            return count + ' задач'
        }
    }
}

</script>
<style lang="scss" scoped>
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

.ToDo {
    cursor: pointer;
    position: relative;
    display: flex;
    height: 100px;
    justify-content: start;
    gap: 25px;
    background: white;
    border-radius: 20px;
    padding: 15px;
    box-shadow: #0064741c 0 0 30px;
    align-items: center;
    animation-iteration-count: 1;
    animation: transformScale 0.3s;

    @keyframes transformScale {
        from {
            transform: scale(0.1);
        }

        to {
            transform: scale(1);
        }
    }


    &Icon {
        height: calc(100% - 30px);
        padding: 15px;
    }


    &Edit {
        position: absolute;
        height: 20px;
        right: 0;
        top: 0;
        padding: 15px;
        cursor: pointer;
    }
}
</style>
