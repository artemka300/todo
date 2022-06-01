<template>
      <div class="PlanToDo">
            <h2>Заметки</h2>
            <div class="PlanToDoItems">
                <ToDo v-for="item in getToDo" :item="item" :key="item.id" />
            </div>
        </div>
</template>
<script>
import ToDo from '../../../components/ToDoItem/ToDo.vue'
export default {
 components: {
        ToDo
    },
    computed:{
        getToDo(){
            return  this.$store.getters.setToDo
        }
    },
   

}
</script>
<style lang="scss">
.Plan{
&ToDo{
    padding-top: 30px;
    &Items{
        display: flex;
        flex-direction: column;
        padding-top: 10px;
        gap: 15px;
    }
}
}

</style>
