<template>

<router-view></router-view>
</template>

<script>
export default {
     mounted(){
       this.$store.dispatch('getPlans');
    },
};
</script>

