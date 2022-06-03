<template>
    <div class="Home cnt">
        <div class="HomeCircle bc-orange "></div>
        <div class="HomeUser">
            <div class="HomeUserText">
                <h5>Hello Artem</h5>
                <p :class="setTaskCountText.class">{{ setTaskCountText.text }}</p>
            </div>
            <img src="../../../static/img/user-boy.png" alt="">
        </div>
        <router-view></router-view>
    </div>
</template>
<script>

export default {
    computed: {
        setTaskCountText() {
            const count = this.$store.getters.setTaskToday.length
            if (count == 0) {
                return { text: 'Сегодня у вас нет задачи', class: 'done' }
            }
            if (count == 1) {
                return { text: 'Сегодня у вас 1 задача', class: 'outstanding' }
            }
            if (count >= 2 && count < 5) {
                return { text: `Сегодня у вас ${count} задачи`, class: 'outstanding' }
            }
            return { text: `Сегодня у вас ${count} задач`, class: 'outstanding' }
        },
    }
}
</script>
<style lang="scss" scoped>
.done {
    font-weight: 700;
    color: #00cd5c;
}

.outstanding {
    font-weight: 700;
    color: rgb(32, 32, 32);
}

.Home {
    position: relative;
    z-index: 1;

    &Circle {
        position: absolute;
        width: 100vw;
        height: 100vw;
        border-radius: 100%;
        top: -80vw;
        left: 0;
        z-index: -1;
        opacity: 0.5;
        transform: translateX(50%);

        @media (max-width: 500px) {
            top: -50vw;
            width: 120vw;
        }
    }

    &User {
        display: flex;
        height: 80px;
        align-items: flex-start;
        justify-content: space-between;
        background: rgba(255, 255, 255, 0.5);
        padding: 10px;
        border-radius: 10px;
        box-shadow: #00000013 0 0 30px;

        @media (max-width: 500px) {
            height: 65px;
        }



        &Text {
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 7px;
            height: 100%;
        }

        img {
            height: calc(100% - 20px);
            padding: 10px;
            background: white;
            border-radius: 100%;

        }
    }
}
</style>

