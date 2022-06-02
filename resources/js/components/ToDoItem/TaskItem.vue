<template >
    <div class="root">
        <input type="checkbox" @click="onChech" :checked="item.done" name="a">
        <p :class="done">{{ item.name }}</p>
    </div>
</template>
<script>
export default {
    props: ['item'],
    methods: {
        onChech() {
            this.item.done = !this.item.done
        }
    },
    computed: {
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
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1.5rem;

    input {
        width: 0.8em;
        height: 0.8em;
    }
}
</style>
