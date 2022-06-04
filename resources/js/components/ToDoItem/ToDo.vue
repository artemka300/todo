<template >
    <Popup   :id="item.id" :delPlan="delPlan" v-if="del" />
    <div class="ToDo" @mouseleave="MenuBool = false" @click="UrlTask()">
        <img :src="item.img.path" alt="" class="ToDoIcon">
        <div>
            <div class="ToDoEditIput" v-if="edit">
                <input type="text" v-model="name">
                <button class="bc-grean c-white" @click="editNameAPI">Сохранить</button>
            </div>

            <h5 v-if="!edit">{{ name }}</h5>
            <p>{{ taskname }}</p>

        </div>
        <img src="../../../static/img/three-dots.png" @click.stop="clickMenu()" alt="" class="ToDoEdit"
            :class="{ 'd-none': MenuBool }">
        <div :class="{ ToDoEditmenu: MenuBool, 'd-none': !MenuBool }">
            <p @click.stop="clickMenu()">Закрыть</p>
            <p @click.stop="edit = true; clickMenu()">Редактировать</p>
            <p @click.stop="delPlan(); clickMenu()">Удалить</p>
        </div>
    </div>
</template>
<script>
import Popup from './PopupDelPlan.vue'
export default {
    components: {
        Popup
    },
    props: ['item'],
    mounted() {

    },
    data() {
        return {
            MenuBool: false,
            edit: false,
            name: this.item.name,
            del: false,
        }
    },
    methods: {
        delPlan() {
            this.del = !this.del
        },
        UrlTask() {
            if (!this.edit) {
                this.$router.push('/task/' + this.item.id)
            }
        },
        editNameAPI() {
            const form = new FormData()
            form.append('id', this.item.id)
            form.append('name', this.name)
            fetch('/api/edit-name-plan', {
                method: 'POST',
                body: form
            })
                .then(r => {
                    if (r.status == 204) {
                        this.$store.dispatch('getPlans');
                        this.edit = false
                    }
                })
        },
        clickMenu() {
            this.MenuBool = !this.MenuBool
        }
    }
    ,
    computed: {
        taskname() {
            if (this.item.tasks.length == 0) {
                return 'Нет задач'
            } if (this.item.tasks.length == 1) {
                return this.item.tasks.length + ' задача'
            } if (this.item.tasks.length >= 2 && this.item.tasks.length < 5) {
                return this.item.tasks.length + ' задачи'
            }
            return this.item.tasks.length + ' задач'
        }
    }
}

</script>
<style lang="scss" scoped>
.d-none {
    visibility: hidden;
    position: absolute;
}

.ToDo {
    list-style: none;
    position: relative;
    cursor: pointer;
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

    &EditIput {
        display: flex;
        gap: 10px;

        @media (max-width: 750px) {
            flex-direction: column;
        }
    }

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

        @media (max-width: 450px) {
            position: absolute;
            height: 15px;
            right: 0;
            top: 6px;
            padding: 7px;
            cursor: pointer;
        }



        &menu {
            position: absolute;
            right: 0;
            top: 0;
            overflow: hidden;
            border-radius: 5px;
            box-shadow: rgba(0, 0, 0, 0.1) 0 0 20px;

            p {
                width: 100%;
                padding: 5px;
                background: rgb(255, 255, 255);
                font-weight: 400;
                transition: cubic-bezier(0.39, 0.575, 0.565, 1) 0.1s;

                @media (max-width: 500px) {
                    font-size: 1rem;
                    padding: 10px 5px;
                }

                &:nth-child(2) {
                    background: #205cc9;
                    color: white;
                }

                &:nth-child(3) {
                    background: #f33333;
                    color: white;
                }

                &:hover {
                    opacity: 0.7;
                }
            }
        }



    }
}
</style>
