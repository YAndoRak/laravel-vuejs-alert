<template>
    <div class="contenu">
        <div class="card-columns" v-if="plein">
            <div class="card" v-for="post in posts">
                <div class="card-content" >
                    <div class="card-header">
                        <h5>{{post.titre}}</h5>
                    </div>
                    <img class="card-img-top" :src="post.poster ? post.image : ''" alt="Card image cap" v-if="post.poster">
                    <div class="card-body">
                        <h5 class="card-title">{{post.titre}}</h5>
                    </div>
                    <div  class="card-footer border-info collapse">
                        <p class="card-text"></p>
                        <ul>
                            <li>Auteur : {{post.auteur}}</li>
                            <li>Date de publication : {{post.created_at}}</li>
                            <li>Derniere date de modification : {{post.updated_at}}</li>
                        </ul>
                        <a :href="'/post/'+post.id">En savoir plus</a>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-success">

                    <p class="card-text">
                        <small class="text-muted">
                            {{post.date |moment("dddd, Do MMMM YYYY")}}
                        </small>
                        <a :href="'/post/'+post.id">En savoir plus</a>
                        <a :href="'/post/edit/'+post.id">Editer ce post</a>
                    </p>
                    <button class="btn btn-primary btn-group-sm expand">Plus</button>
                </div>
            </div>
        </div>
        <div class="container mt-4" v-else>
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Desoler!</h4>
                <p>Aucune publication n'est disponible pour l'instant.</p>
                <hr>
                <p class="mb-0">Si vous avez une declaration a faire,<a href="form">Cliquer ici</a></p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return {
                posts:[],
                plein:false
            }
        },
        mounted(){
            axios.get('api').then((response)=>{
                $(function () {
                    let expand=true;
                    $('.expand').click(function () {
                        $(this).parent().parent().find('.collapse').collapse('toggle');
                        if (expand){
                            $(this).text('Fermer');
                            expand=false;
                        }
                        else{
                            $(this).text('Plus');
                            expand=true;
                        }
                    });
                });
                if(response.data!=''){
                    this.plein=true
                    this.posts=response.data
                }
                else{
                    this.plein=false
                }
            }).catch(()=>{
                console.log('error')
            })
        }
    }
</script>