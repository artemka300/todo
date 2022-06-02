<template >
    <div class="root">
        <div>
            <input type="checkbox" @click="onChech" :checked="item.done" name="a">
            <h5 :class="done">{{ item.name }}</h5>
        </div>
        <div>
            <p>
                {{ textTime }} закончится срок выполнения
            </p>

        </div>
    </div>
</template>
<script>
import moment from 'moment';
export default {

    props: ['item'],
    methods: {
        onChech() {
            this.item.done = !this.item.done
        }
    },
    computed: {
        textTime() {
            return moment(this.item.end_date).lang("ru").from(new Date())
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

.root {
    animation-iteration-count: 1;
    animation: transformScale 0.2s;

    @keyframes transformScale {
        from {
            transform: scale(0.3);
        }

        to {
            transform: scale(1);
        }
    }

    display: flex;
    flex-direction: column;


    div {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.5rem;

        p {
            font-size: 0.9rem;
            padding: 5px 5px 5px 25px;
        }
    }

    input {
        width: 0.8em;
        height: 0.8em;
    }
}
</style>
