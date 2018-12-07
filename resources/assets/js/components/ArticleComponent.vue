<template>
    <div class="container">
        <div class="jumbotron">
            <h2 class="display-4">{{articles.titre}}</h2>
            <p class="lead">L'incident s'est passer le {{articles.date |moment("dddd, Do MMMM YYYY")}} à {{articles.lieu}}, {{articles.commune}} </p>
        </div>
        <froalaView v-model="articles.description"></froalaView>
        <div class="jumbotron">
            <h2 class="display-5">{{articles.titre}}</h2>
            <hr class="my-4">
            <div class="ini">
                <p>Ecrit par {{articles.auteur}}</p>
                <img :src="articles.image" class="img-fluid auteur rounded" alt="Responsive image">
                <form>
                    <div class="form-group">
                        <label for="mail"> Votre adresse email</label>
                        <input type="email" class="form-control" id="mail" aria-describedby="emailHelp" placeholder="johndoe@exemple.com">
                        <small id="emailHelp" class="form-text text-muted">Votre email ne serait jamais publier.</small>
                    </div>
                    <div class="form-group">
                        <label for="comment">Vos commentaires :</label>
                        <textarea class="form-control" id="comment" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Commenter</button>
                </form>
            </div>

        </div>
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
<style>
    .container{
        margin: 20px 40px;
    }
    .auteur{
        vertical-align: top;
        width: 25%;
        height: 25%;
        margin-right:  12%;
    }
    .ini>form{
        display: inline-block;
        width: 50%;
    }

</style>