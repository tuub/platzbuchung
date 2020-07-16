<template>
    <!-- https://loading.io/ -->
    <span>
        <img class="inline-block" v-bind:src="imageUrl" />
    </span>
</template>

<script>
    export default {
        name: "Spinner",
        props: ['size'],
        computed: {
            imageUrl () {
                return 'images/spinner_' + this.size + '.gif';
            },
        },
    }
</script>
