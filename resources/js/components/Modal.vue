<template>
   <b>boooo</b>
</template>

<script>
    export default {
        mounted() {
            window.Echo.channel('test')
            .listen('NewArticleEvent', ({article}) =>{
                alert(`Добавлена статья ${article['name']}`);
            })

        }
    }
</script>