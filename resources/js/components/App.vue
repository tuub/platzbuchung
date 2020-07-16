<template>
    <div>
        <Header></Header>
        <b-container fluid class="mt-3 mx-auto">
            <!--Container-->
            <b-row>
                <b-col>
                    <transition name="page" mode="out-in">
                        <router-view></router-view>
                    </transition>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
    import Header from "./Header";

    export default {
        name: "App",
        components: {
            Header
        },
        data() {
            return {}
        },

        watch:{
            $route (to, from){
                // clear alert on location change
                //store.dispatch('ALERT_CLEAR');
                //console.log(to);
            }
        },
        mounted() {
            //console.log(this.loading);
        }
    }
</script>

<style scoped>

</style>
