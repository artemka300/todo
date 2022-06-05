<template>
    <AddImg v-if="showAddImg" :onShowImg='onShowImg' />
    <div class="AddPlan" :class="clossplan">
        <img src="../../../static/img/close.png" class="close" @click="onShowAddPlan(false)" alt="">
        <div class="AddPlanSetting">
            <div class="">
                <p>Счастливого дня</p>
                <h2>Создать категорию</h2>
            </div>
        </div>
        <div class=" AddPlanAdd">
            <div> <img :src="Img" alt="" @click="this.onShowImg(true)">
                <h5>{{ textImg }}</h5>
            </div>
            <div>
                <input type=" text" class="br-orange " v-model="name" placeholder="Введите название">
            </div>
        </div>
        <button class="bc-grean" @click="onCreatePlaneAPI" v-if="imageSelected">Создать</button>
    </div>
</template>
<script>
import imgDefault from '../../../static/img/check-list.png'
import AddImg from './AddImg.vue'
import { authFetch } from '../../api'
export default {
    props: ['onShowAddPlan', 'showAddPlan'],
    components: {
        AddImg
    },
    computed: {
        clossplan() {
            if (this.showAddPlan) {
                return 'b0'
            }
            return 'bf'
        },
        textImg() {
            if (!this.imageSelected) {
                return 'Выберите изображение'
            }
            return 'Изображение выбрано'
        },
        Img() {
            const obj = this.$store.getters.setImgId;
            if (obj != null) {
                this.imageSelected = true
                return obj.path
            }
            this.imageSelected = false
            return imgDefault
        }
    },

    methods: {
        onShowImg(bool) {
            this.showAddImg = bool;
        },
        onCreatePlaneAPI() {
            const form = new FormData()
            form.append('name', this.name)
            form.append('imgid', this.$store.getters.getIdImg)
            authFetch('/api/create-plan','POST', form).then(r => {
                if (r.status == 204) {
                    this.onShowAddPlan(false)
                    this.$store.dispatch('getPlans');
                }

            })
        }
    },
    data() {
        return {
            showAddImg: false,
            imageSelected: false,
            name: ''
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

.AddPlan {
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
        margin-top: 30px;
        padding: 10px;
        display: flex;
        gap: 20px;
        flex-direction: column;
        align-items: flex-start;

        div {
            display: flex;
            gap: 15px;
            align-items: center;
            width: 100%;

            input {
                width: 100%;
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





