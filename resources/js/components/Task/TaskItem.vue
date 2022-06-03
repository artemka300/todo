<template >
    <div class="root">
        <input type="checkbox" :checked="item.done" @click="onDoneAPI()" :disabled="textTime.disabled" ref="checked"
            name="a">
        <div>
            <h5 :class="done">{{ item.name }}</h5>
            <p :class="textTime.class">
                {{ textTime.text }}
            </p>

        </div>
    </div>
</template>
<script>
import moment from 'moment';
export default {

    props: ['item'],
    methods: {
        onDoneAPI() {
            this.onChech()
            const form = new FormData()
            form.append('id', this.item.id)
            form.append('done', this.item.done)
            form.append('del', this.item.del)
            fetch('/api/update-task', {
                method: 'POST',
                body: form
            }).then(r => {
                if (r.status == 204) {
                    this.$store.dispatch('getPlans');
                    console.log("юхуууу")
                }

            })
        },

        onChech() {
            if (this.item.done == true) {
                this.item.done = true
                this.$refs.checked.checked = true
            }
            else {
                this.item.done = !this.item.done
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

.outstanding {
    font-weight: 700;
    color: red;
}

.root {

    animation-iteration-count: 1;
    animation: transformScale 0.2s;
    padding: 5px;
    border-radius: 10px;

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

        p {
            font-size: 0.9rem;
        }
    }


}
</style>
