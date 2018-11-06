<template>
    <div class="contenu">
        <h5>{{articles.titre}}</h5>
        <p>{{articles.id}}</p>
        <span v-html="articles.description"></span>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                articles:[]
            }
        },
        mounted(){

            axios.get('/api/post/'+this.$route.params.id).then((response)=>{
                if(response.data!=''){
                    this.articles=response.data
                }
                console.log('success')
            }).catch(()=>{
                console.log('error')
            })
        }
    }
</script>
