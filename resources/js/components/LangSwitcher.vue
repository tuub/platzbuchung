<template>
    <div class="locale-changer">
        <select name="language" v-model="$root.$i18n.locale" @change="refresh()">
            <option v-for="(lang, i) in langs" :key="`Lang${i}`" :value="lang">{{ lang }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        name: 'LangSwitcher',
        data () {
            return {
                langs: ['de', 'en']
            }
        },
        methods: {
            refresh: function() {
                console.log('switch lang');
            }
        }
    }
</script>

<style scoped>

</style>
