<template>
    <div class="container">
        <h5>{{articles.titre}}</h5>
        <p>{{articles.id}}</p>
        <froalaView v-model="articles.description"></froalaView>
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
