<template>
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-8">
                <div v-if="success" class="alert alert-success alert-dismissible fade show" role="alert">
                    Modification reussie.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="card card-default">
                    <div class="card-header">Account</div>
                    <div class="card-body">
                        <div class="mb-2">{{user.id}}</div>
                        <div v-if="name" class="mb-2"> {{getUser.name}}<a @click="name=false"> Edit</a></div>
                        <div v-else class="mb-2">
                            <input type="text" v-model.lazy="getUser.name" />
                            <button @click="confirmName()">Confirmer</button>
                        </div>
                        <div v-if="email" class="mb-2"> {{getUser.email}}<a @click="email=false"> Edit</a></div>
                        <div v-else class="mb-2">
                            <input type="text" v-model.lazy="getUser.email" />
                            <button @click="confirmEmail()">Confirmer</button>
                            <div v-if="alert" class="alert alert-warning mt-2" role="alert">
                                Attention, l'adresse email existe deja ou invalide
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-block btn-lg mt-4" @click="save()" v-bind:disabled="alert">Sauvegarder</button>
                <a class="btn btn-secondary btn-block btn-lg" href="/acceuil">Fermer</a>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                getUser:[],
                getCompare:'',
                user:{
                    name:'',
                    email:''
                },
                name:true,
                email:true,
                alert:false,
                success:false
            }
        },
        mounted(){
            axios.get('/api/user').then((response)=>{
                this.getUser=response.data
                this.getCompare=response.data.email
            }).catch(()=>{
                console.log('error')
            })
        },
        methods:{
            confirmEmail(){
                if (this.getCompare===this.getUser.email){
                    this.alert=true
                    this.user.email=''
                }else{
                    this.user.email=this.getUser.email
                    this.alert=false
                    this.email=true
                }
            },
            confirmName(){
                this.user.name=this.getUser.name
                this.name=true
            },
            save(){
                axios.patch('api/account/update', {
                    name:this.user.name,
                    email:this.user.email
                })
                    .then(()=>{
                        this.success=true
                    })
                    .catch(()=>{
                        console.log('Error')
                    })

            }
        }
    }

</script>
<style scoped>
    .container{
        width:100%;
    }
</style>