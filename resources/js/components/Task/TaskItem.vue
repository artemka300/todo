<template >
    <div class="root">
        <input type="checkbox" :checked="item.done" @click="doneTask()" :disabled="textTime.disabled" ref="checked"
            name="a">
        <div>
            <h5 :class="done">{{ item.name }}</h5>
            <p :class="textTime.class">
                {{ textTime.text }}
            </p>
        </div>
        <img class="remove" @click="deleteTask()" v-if="item.del != true" src="../../../static/img/remove.png" alt="">
    </div>
</template>
<script>
import moment from 'moment';
import { authFetch } from '../../api'
export default {

    props: ['item'],
    methods: {
        deleteTask() {
            this.item.del = true
            this.onDoneAPI()
        },
        doneTask() {
            this.onChech()
            this.onDoneAPI()
        },
        onDoneAPI() {
            const form = new FormData()
            form.append('id', this.item.id)
            form.append('done', this.item.done)
            form.append('del', this.item.del)
            authFetch('/api/update-task', 'POST', form).then(r => {
                if (r.status == 204) {
                    this.$store.dispatch('getPlans');
                }

            })
        },

        onChech() {
            if (this.item.done == true) {
                this.item.done = true
                this.$refs.checked.checked = true
            }
            else if (this.item.del == false) {
                this.item.done = !this.item.done
            }
            else if (this.item.del == false && this.item.done == true) {
                this.$refs.checked.checked = false
            }
            else {
                this.$refs.checked.checked = false
            }
        }
    },
    computed: {
        textTime() {
            if (this.item.done == true) {
                return { text: 'Задача выполнена', class: 'done', disabled: false }
            }
            if (new Date() < new Date(this.item.end_date)) {
                return { text: moment(this.item.end_date).lang("ru").from(new Date()) + ' закончится срок выполнения', class: "", disabled: false }
            }
            return { text: 'Срок выполнения просрочен', class: 'outstanding', disabled: true }
        },
        done() {
            if (this.item.done == true) {
                return 't-d'
            }
            return ' '
        }
    }
}
</script>
<style lang="scss" scoped>
.t-d {
    text-decoration: line-through;
}

.done {
    font-weight: 700;
    color: #00cd5c;
}

.remove {
    position: absolute;
    height: 30px;
    right: 0;
    transform: translateY(-50%);
    top: 50%;
    padding: 15px;
    cursor: pointer;

    @media (max-width: 500px) {
        padding: 5px;
        height: 25px;
    }
}

.outstanding {
    font-weight: 700;
    color: red;
}

.root {
    position: relative;
    animation-iteration-count: 1;
    animation: transformScale 0.2s;
    padding: 5px;

    border-bottom: solid 1px grey;

    @keyframes transformScale {
        from {
            transform: scale(0.3);
        }

        to {
            transform: scale(1);
        }
    }

    display: flex;
    align-items: flex-start;
    gap: 10px;

    input {
        width: 1.3rem;
        height: 1.3rem;
        margin-top: 12px;

        @media (max-width: 500px) {
            margin-top: 8px;
        }
    }

    div {
        font-size: 1.5rem;

        @media (max-width: 500px) {
            font-size: 1.3rem;
        }

        p {
            font-size: 0.9rem;
        }
    }


}
</style>
