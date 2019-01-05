<template>
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Account</div>
                    <div class="card-body">
                        <div class="mb-2">{{user.id}}</div>
                        <div v-if="name" class="mb-2"> {{user.name}}<a @click="name=false"> Edit</a></div>
                        <div v-else class="mb-2"> <input type="text" v-model="user.name" /><button @click="confirmName()">Confirmer</button></div>
                        <div v-if="email" class="mb-2"> {{user.email}}<a @click="email=false"> Edit</a></div>
                        <div v-else class="mb-2"> <input type="text" v-model="user.email" /><button @click="confirmEmail()">Confirmer</button></div>
                    </div>
                </div>
                <button class="btn btn-primary btn-block btn-lg mt-4" @click="save()">Sauvegarder</button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                user:[],
                name:true,
                email:true
            }
        },
        mounted(){
            axios.get('/api/user').then((response)=>{
                this.user=response.data
            }).catch(()=>{
                console.log('error')
            })
        },
        methods:{
            confirmEmail(){
                this.email=true
            },
            confirmName(){
                this.name=true
            },
            save(){
                axios.patch('api/account/update', {
                    name:this.user.name,
                    email:this.user.email
                })
                    .then(()=>{
                        console.log('Success')
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