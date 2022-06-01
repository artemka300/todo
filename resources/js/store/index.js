import { createStore } from 'vuex'

// Create a new store instance.
const store = createStore({
    state() {
        return {
            todo: []
        }
    },
    mutations: {
        updatetodo(state, todo) {
            state.todo = todo
        }
    },
    getters: {
        setToDo(state) {
            return state.todo
        },
        setTaskid:(state)=>id=>{
            return state.todo.filter(item=>{
              return  item.id==id
            })[0]
        }
    },
    actions: {
        async  getPlans(context) {
            fetch('/api/get-plan').then(r => r.json()).then(r => {
                 context.commit('updatetodo', r.data)
            })

        }
    }
})
export default store
