<template  >
    <div class="AddImg">
        <div class="AddImgS">
            <h5>Выберите изображения</h5>
            <div class="AddImgSItems">
                <img :src="item.path" alt="" v-for="item in getImgs" @click="onSetImg(item.id)" :key="item.id">
            </div>

        </div>

    </div>
</template>
<script>
export default {
    props: ['onShowImg'],
    methods: {
        onSetImg(id) {
            this.$store.commit('setIdimg', id)
            this.onShowImg(false)
        }
    },
    computed: {

        getImgs() {
            return this.$store.getters.setImgs
        }
    },
}
</script>
<style lang="scss" scoped>
.AddImg {
    position: fixed;
    width: 100vw;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    left: 0;
    z-index: 55;
    top: 0;
    background-color: rgba(0, 0, 0, 0.4);

    &S {
        h5 {
            width: 100%;
            padding: 20px 10px;
        }

        padding: 10px;

        &Items {
            overflow-y: scroll;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            height: 500px;
            padding: 10px;
            align-content: flex-start;

            &::-webkit-scrollbar {
                width: 8px;
                /* ширина scrollbar */
            }

            &::-webkit-scrollbar-track {
                background: rgba(0, 0, 0, 0.1);
                border-radius: 20px;
                /* цвет дорожки */
            }

            &::-webkit-scrollbar-thumb {
                background-color: blue;
                /* цвет плашки */
                border-radius: 20px;
                /* закругления плашки */
                border: 3px solid transparent;
                ;
                /* padding вокруг плашки */
            }

            justify-content: space-between;

            img {
                height: 50px;
                width: 50px;
                border: gold dashed 3px;
                border-radius: 100%;
                object-fit: contain;
                cursor: pointer;
                padding: 10px;
            }
        }

        width: 90%;

        background-color: white;
        justify-content: center;
        border-radius: 10px;


    }
}
</style>
