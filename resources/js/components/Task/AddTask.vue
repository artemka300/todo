<template>

    <div class="AddTask" :class="clossTaskAdd">
        <img src="../../../static/img/close.png" class="close" @click="onShowTask(false)" alt="">
        <div class="AddTaskSetting">
            <div class="">
                <p>Счастливого дня</p>
                <h2>Создать Задачу</h2>
            </div>
        </div>
        <div class=" AddTaskAdd">
            <h4 class="c-red">{{ boolAPICreate.text }}</h4>
            <div class="AddTaskAdddiv">
                <input type=" text" class="br-orange " v-model="name" placeholder="Введите описание задачи">
            </div>
            <div class="AddTaskAddDate">
                <h5>Дата выполнения:</h5>
                <div>
                    <input class="br-orange" type="time" v-model="time" name="sdfdfdsf" id="sdfddfd" ref="timetask">
                    <input class="br-orange" v-model="date" ref="datatask" type="date" name="sadasda" id="asdasds">
                </div>


            </div>

        </div>
        <button class="bc-grean" v-if="boolAPICreate.on" @click="onCreatePlaneAPI">Создать</button>
    </div>
</template>
<script>
import DateFormat from 'date-and-time';
export default {
    props: ['showAddTask', 'onShowTask'],
    mounted() {
        this.$refs.datatask.min = DateFormat.format(this.dataNow, 'YYYY-MM-DD')
        this.date = DateFormat.format(this.dataNow, 'YYYY-MM-DD')
        this.time = DateFormat.format(this.dataNow, 'HH:mm')
    },
    computed: {
        clossTaskAdd() {
            if (this.showAddTask) {
                return 'b0'
            }
            return 'bf'
        },
        boolAPICreate() {
            if (this.name.length == 0) {
                return { text: "", on: false }
            }
            if (this.name.length < 10) {
                return { text: "Введите больше букв!", on: false }
            }
            return { text: "", on: true }
        }
    },
    watch: {
        time: {
            handler(val) {
                if (this.date == DateFormat.format(this.dataNow, 'YYYY-MM-DD')) {
                    if (DateFormat.format(this.dataNow, 'HH:mm') >= val) {
                        this.time = DateFormat.format(this.dataNow, 'HH:mm')
                    }
                }
            },
            deep: true
        }
    },
    methods: {
        onCreatePlaneAPI() {
            const form = new FormData()
            form.append('name', this.name)
            form.append('datenow', DateFormat.format(this.dataNow, 'YYYY-MM-DD HH:mm'))
            form.append('setdate', this.date + ' ' + this.time)
            form.append('idplan', this.$route.params.id)
            fetch('/api/create-task', {
                method: 'POST',
                body: form
            }).then(r => {
                if (r.status == 204) {
                    this.name = ''
                    this.$store.dispatch('getPlans');
                    this.onShowTask(false)
                }

            })
        }
    },
    data() {
        return {
            imageSelected: false,
            name: '',
            dataNow: new Date(),
            date: '',
            time: ''
        }
    },
}
</script>
<style lang="scss" scoped>
.b0 {
    bottom: 0;
}

.bf {
    bottom: -100%;
}

.close {
    position: absolute;
    right: 0;
    top: 0;
    height: 25px;
    padding: 10px;
}

.AddTask {
    position: fixed;
    margin: 0 15%;
    width: calc(100% - 20px - 30%);

    @media (max-width: 500px) {
        margin: 0;
        width: calc(100% - 20px);
    }

    background: white;
    display: flex;
    flex-direction: column;
    left: 0;
    transition: cubic-bezier(0.445, 0.05, 0.55, 0.95) .4s;
    z-index: 4;
    padding: 10px;
    border-radius: 10px;
    box-shadow: rgba(0, 0, 0, 0.1) 0 0 20px;

    button {
        color: white;
    }

    &Add {
        padding: 10px;
        display: flex;
        gap: 20px;
        flex-direction: column;
        align-items: flex-start;

        &div {
            display: flex;
            gap: 15px;
            width: 100%;

            input {
                width: 100%;
            }
        }

        &Date {
            h5 {
                font-size: 1rem;
            }


            display: flex;
            gap: 10px;
            flex-direction: column;

            div {
                display: flex;
                gap: 15px;
            }

        }

        img {
            padding: 15px;
            height: 50px;
            width: 50px;
            border: gold dashed 3px;
            border-radius: 100%;
            object-fit: contain;
            cursor: pointer;
        }
    }

    &Setting {
        display: flex;
        height: 50px;
        gap: 15px;
        padding: 5px;

    }
}
</style>





