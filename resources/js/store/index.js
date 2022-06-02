import { createStore } from 'vuex'

// Create a new store instance.
const store = createStore({
    state() {
        return {
            todo: [],
            imgs: [],
            idImg: null
        }
    },
    mutations: {
        updatetodo(state, todo) {
            state.todo = todo
        },
        setimgs(state, imgs) {
            state.imgs = imgs
        },
        setIdimg(state, id) {
            state.idImg = id
        }
    },
    getters: {
        setToDo(state) {
            return state.todo
        },
        getIdImg(state) {
            return state.idImg
        },
        setImgs(state) {
            return state.imgs
        },
        setTaskid: (state) => id => {
            return state.todo.filter(item => {
                return item.id == id
            })[0]
        },
        setImgId: (state) => {
            return state.imgs.filter(item => {
                return item.id == state.idImg
            })[0] ?? null
        }
    },
    actions: {
        async getPlans(context) {
            fetch('/api/get-plan').then(r => r.json()).then(r => {
                context.commit('updatetodo', r.data)
            })

        },
        async getImg(context) {
            fetch('/api/get-img').then(r => r.json()).then(r => {
                context.commit('setimgs', r.data)
            })

        },
    }
})
export default store
