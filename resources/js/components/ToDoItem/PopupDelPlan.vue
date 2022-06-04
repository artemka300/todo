<template  >
    <div class="modal-wrapper" id="modal">
        <div class="modal-body  card">
            <div class="modal-header">
                <h2 class="heading">Удалить категорию задач?</h2>
            </div>
            <p>Вы удалите все задачи и категорию безвозвратно, вы действительно хотите этого?</p>
            <div class="modal-body-buttnos">
                <button class="bc-red c-white" @click="DelAPI()">Удалить</button>
                <button class="bc-grean c-white" @click="delPlan()">Отменить</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['id', 'delPlan'],
    methods: {
        DelAPI() {
            const form = new FormData()
            form.append('id', this.id)
            fetch('/api/delete-plan', {
                method: 'POST',
                body: form
            })
                .then(r => {
                    if (r.status == 204) {
                        this.$store.dispatch('getPlans');
                        delPlan();
                    }

                })
        }
    }
}
</script>
<style lang="scss" scoped>
.modal-wrapper {
    z-index: 6;
    color: #121943;
    box-sizing: inherit;
    margin: 0;
    padding: 0;
    border: 0;
    font: inherit;
    vertical-align: baseline;
    align-items: center;
    background: rgba(0, 0, 0, 0.7);
    bottom: 0;
    display: flex;
    justify-content: center;
    left: 0;
    position: fixed;
    right: 0;
    top: 0;
    transition: opacity 0.25s ease-in-out;
    opacity: 1;
    visibility: visible;
}

.modal-body {
    color: #121943;
    visibility: visible;
    box-sizing: inherit;
    border: 0;
    font: inherit;
    vertical-align: baseline;
    background: #fff;
    background-image: linear-gradient(48deg, #fff 0%, #e5efe9 100%);
    border-top-right-radius: 16px;
    border-bottom-left-radius: 16px;
    box-shadow: -20px 20px 35px 1px rgba(10, 49, 86, 0.18);
    display: flex;
    flex-direction: column;
    padding: 32px;
    margin: 40px;
    max-width: 500px;
    transform: translateY(-100px);
    transition: opacity 0.25s ease-in-out;
    width: 100%;
    z-index: 1;
    opacity: 1;

    &-buttnos {
        padding: 20px 0 0 0;
        display: flex;
        gap: 10px;
    }
}

.modal-header {
    color: #121943;
    visibility: visible;
    box-sizing: inherit;
    margin: 0;
    padding: 0;
    border: 0;
    font: inherit;
    vertical-align: baseline;
    align-items: baseline;
    display: flex;
    justify-content: space-between;


}
</style>

