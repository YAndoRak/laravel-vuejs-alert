<template>
    <div>
        <div class="container mt-4" v-if="success">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Felecitation!</h4>
                <p>Votre message a ete bien envoyer.</p>
                <hr>
                <p class="mb-0">Merci pour votre participation, pour retourner a la page d'acceuil <a href="acceuil">Cliquer ici</a></p>
            </div>
        </div>

        <div class="formulaire" v-else>
            <h2 class="text-center">Signaler</h2>

            <div class="form-group">
                <label for="titre">Sujet de votre declaration :</label>
                <input type="text" class="form-control" name="titre" placeholder="ex: mot de passe wifi trop facile" required v-model="titre">
            </div>
            <div class="form-group">
                <label for="lieu">Lieu de l'incident : </label>
                <select class="browser-default custom-select mb-2" name="lieu" v-model="lieu">
                    <option value="" disabled>Choisissez une ville</option>
                    <option>Tana</option>
                    <option>Majunga</option>
                    <option>Tamatave</option>
                    <option>Diego</option>
                </select>
            </div>
            <div class="form-group">
                <label for="commune">La commune où l'incident s'est produite :</label>
                <input type="text" class="form-control" name="commune" placeholder="ex: Antanimena" required v-model="commune">
            </div>
            <!--Ici commence date -->
            <label>Date de decouverte de l'incident :</label>
            <div class="input-group mb-3" >
                <select class="custom-select" v-model="jour">
                    <option disabled value="">Jour</option>
                    <option v-for="day in 31">{{day}}</option>
                </select>
                <select class="custom-select" v-model="mois">
                    <option disabled value="">Mois</option>
                    <option value="01">Janvier</option>
                    <option value="02">Fevrier</option>
                    <option value="03">Mars</option>
                    <option value="04">Avril</option>
                    <option value="05">Mai</option>
                    <option value="06">Juin</option>
                    <option value="07">Juin</option>
                    <option value="08">Aout</option>
                    <option value="09">Septembre</option>
                    <option value="10">Octobre</option>
                    <option value="11">Novembre</option>
                    <option value="12">Decembre</option>
                </select>

                <div class="input-group-prepend">
                    <span class="input-group-text">Annee</span>
                </div>
                <input type="text" class="form-control" placeholder="ex: 2018" v-model="annee">


            </div>


            <!-- Fin date -->

            <div class="form-group">
                <label for="description">Description :</label>
                <froala :tag="'textarea'" :config="config" v-model="description"></froala>

            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox mt-2">
                    <input type="checkbox" class="custom-control-input" id="public" name="public" value="1" checked v-model="online">
                    <label class="custom-control-label" for="public">Mettre en public ?</label>
                </div>
            </div>

            <button class="btn btn-primary btn-block btn-lg" @click="envoyer">Je veux soumettre</button>

        </div>

    </div>
</template>

<script>
    export default {
        data(){
            return {
                config: {
                    placeholderText:"Veuillez decrir ici les details de l'incident",
                    height: 150,
                    events: {
                        'froalaEditor.initialized': function () {
                            console.log('initialized')
                        }
                    }
                },
                titre:"",
                lieu:"",
                commune:"",
                date:"",
                description:"",
                annee:"",
                jour:'',
                mois:'',
                day:'',
                online:1,
                success:false

            }
        },
        methods:{
            envoyer(){
                axios.post('/form', {
                    titre:this.titre,
                    lieu:this.lieu,
                    commune:this.commune,
                    date:this.jour+this.mois+this.annee,
                    description:this.description,
                    online:this.online
                }).then((response)=>{
                    this.success=true;
                    console.log('success')
                }).catch(()=>{
                    console.log('error')
                })
            }
        }
    }
</script>
