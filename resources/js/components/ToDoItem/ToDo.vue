<template >
    <div class="ToDo">
        <img :src="item.img.path" alt="" class="ToDoIcon">
        <div>
            <h5>{{ item.name }}</h5>
            <p>{{ taskname }}</p>
        </div>
        <img src="../../../static/img/three-dots.png" alt="" class="ToDoEdit">
    </div>
</template>
<script>
export default {
    props: ['item'],
     mounted(){
 
    },
    computed: {
        taskname() {
            if (this.item.tasks.length == 0) {
                return 'Нет задач'
            } if (this.item.tasks.length == 1) {
                return this.item.tasks.length + ' задача'
            } if (this.item.tasks.length >= 2 && this.item.task < 5) {
                return this.item.tasks.length + ' задачи'
            }
          return this.item.tasks.length  + ' задач'
        }
    }
}

</script>
<style lang="scss" scoped>
.ToDo {
    position: relative;
    display: flex;
    height: 100px;
    justify-content: start;
    gap: 25px;
    background: white;
    border-radius: 20px;
    padding: 15px;
    box-shadow: #0064741c 0 0 30px;
    align-items: center;

    &Icon {
        height: calc(100% - 30px);
        padding: 15px;
    }


    &Edit {
        position: absolute;
        height: 20px;
        right: 0;
        top: 0;
        padding: 15px;
        cursor: pointer;
    }
}
</style>
