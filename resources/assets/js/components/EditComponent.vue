<template>
    <div>
        <div class="container mt-4" v-if="success">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Felecitation!</h4>
                <p>Modification reussie.</p>
                <hr>
                <p class="mb-0">Merci pour votre participation, pour retourner a la page d'acceuil <a href="/acceuil">Cliquer ici</a></p>
            </div>
        </div>
        <div class="container mt-4" v-else-if="deleted">
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Success!</h4>
                <p>Suppression reussie.</p>
                <hr>
                <p class="mb-0">Merci pour votre participation, pour retourner a la page d'acceuil <a href="/acceuil">Cliquer ici</a></p>
            </div>
        </div>

        <div class="formulaire" v-else>
            <h2 class="text-center">Signaler</h2>

            <div class="form-group">
                <label for="titre">Sujet de votre declaration :</label>
                <input type="text" class="form-control" id="titre" name="titre" required v-model.lazy="articles.titre">
            </div>
            <div class="form-group">
                <label for="lieu">Lieu de l'incident : </label>
                <select class="browser-default custom-select mb-2" id="lieu" name="lieu" v-model.lazy="articles.lieu">
                    <option value="" disabled>Choisissez une ville</option>
                    <option>Tana</option>
                    <option>Majunga</option>
                    <option>Tamatave</option>
                    <option>Diego</option>
                </select>
            </div>
            <div class="form-group">
                <label for="commune">La commune où l'incident s'est produite :</label>
                <input type="text" class="form-control" id="commune" name="commune" required v-model.lazy="articles.commune">
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox mt-2">
                    <input type="checkbox" class="custom-control-input" id="poster" v-model="articles.poster" checked value="true">
                    <label class="custom-control-label" for="poster"> Ajouter un poster :</label>
                </div>
                <div class="custom-control custom-checkbox mt-2">
                    <picture-input v-if="articles.poster"
                                   ref="pictureInput"
                                   @change="onChange"
                                   width="300"
                                   height="90"
                                   accept="image/jpeg,image/png, image/jpg"
                                   size="10"
                                   buttonClass="btn"
                                   :customStrings="{upload: '<h1>uploading</h1>',drag: 'Choisir une image'}">
                    </picture-input>
                </div>
            </div>
            <!--Ici commence date -->
            <label>Date de decouverte de l'incident :</label>
            <div class="input-group mb-3" >
                <datepicker
                        :bootstrap-styling="true"
                        :calendarButton="true"
                        placeholder="ex: 17 Nov 2018"
                        calendar-button-icon="fa fa-calendar"
                        v-model="articles.date">
                </datepicker>
            </div>

            <!-- Fin date -->

            <div class="form-group">
                <label for="description">Description :</label>
                <froala :tag="'textarea'" :config="config" id="description" v-model.lazy="articles.description"></froala>

            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox mt-2">
                    <input type="checkbox" class="custom-control-input" id="public" name="public" value="1" checked v-model.lazy="articles.online">
                    <label class="custom-control-label" for="public">Mettre en public ?</label>
                </div>
            </div>

            <button class="btn btn-primary btn-block btn-lg" @click="envoyer">Je veux editer</button>
            <button class="btn btn-danger btn-block btn-lg" @click="supprimer" v-if="user.id===articles.user_id">Je veux supprimer le post</button>
        </div>

    </div>
</template>
<script>
    import Datepicker from 'vuejs-datepicker';
    import PictureInput from 'vue-picture-input';
    export default {
        components: {
            Datepicker,
            PictureInput
        },
        data(){
            return {
                config: {
                    events: {
                        'froalaEditor.image.beforeRemove': function () {
                            axios.post('/api/edit/deleteImage', {
                                src:document.querySelector('img').getAttribute('src'),
                                type:'images/'
                            })
                        }
                    },
                    height: 150,
                    toolbarSticky: false,
                    enter: $.FroalaEditor.ENTER_DIV,
                    tabSpaces: 4,
                    //En tete
                    requestHeaders: {
                        ['X-Requested-With']: 'XMLHttpRequest',
                        ['X-CSRF-TOKEN']:document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

                    },
                    requestWithCredentials: true,
                    imageUploadURL: '/api/upload_image',
                    imageUploadParam: 'file',
                    imageUploadMethod: 'post',

                    // Set the video upload URL.
                    videoUploadURL: '/api/upload_video',
                    // Set request type.
                    videoUploadMethod: 'POST',
                    // Set max video size to 50MB.
                    videoMaxSize: 50 * 1024 * 1024,

                    // Set the file upload URL.
                    fileUploadURL: '/api/upload_file',

                    // Set request type.
                    fileUploadMethod: 'POST',

                    // Set max file size to 20MB.
                    fileMaxSize: 20 * 1024 * 1024,

                    // Allow to upload any file.
                    fileAllowedTypes: ['*'],

                    quickInsertButtons: ['embedly', 'table', 'ul', 'ol', 'hr'],
                    imageAllowedTypes: ['jpeg', 'jpg', 'png', 'bmp'],
                    videoAllowedTypes: ['webm', 'mp4', 'ogg'],
                    imageInsertButtons:['imageBack', '|', 'imageUpload', 'imageByURL'],
                    toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript',
                        'superscript', '|', 'fontFamily', 'fontSize', 'color', 'inlineStyle',
                        'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL','formatUL', '-',
                        'insertTable', '|', 'undo', 'redo', 'insertHR', 'emoticons','fontAwesome','selectAll', '|',
                        'html', '|','outdent', 'indent', 'quote','insertFile','insertImage', 'insertVideo','|', 'fullscreen',
                        'getPDF','clearFormatting','specialCharacters','print','help' ],
                },
                articles:[],
                success:false,
                deleted:false,
                poster:true,
                image:"",
                user:"",
                props:{
                    calendarButton:Boolean,
                }
            }
        },
        mounted(){
            axios.get('/api/user').then((response)=>{
                if(response.data!=''){
                    this.user=response.data
                }
            })
            axios.get('/api/post/'+this.$route.params.id).then((response)=>{
                if(response.data!=''){
                    this.articles=response.data
                }
            })
        },
        methods:{
            envoyer(){
                axios.put('/api/post/edit/'+this.$route.params.id, {
                    titre:this.articles.titre,
                    lieu:this.articles.lieu,
                    commune:this.articles.commune,
                    date:this.articles.date,//this.$moment(this.articles.date).format('MMMM Do YYYY')
                    description:this.articles.description,
                    online:this.articles.online,
                    poster:this.articles.poster,
                    image:this.articles.poster ? this.articles.image : "No image"
                }).then(()=>{
                    this.success=true;
                    //window.location = '/acceuil';
                }).catch(()=>{
                    console.log('error')
                })
            },
            supprimer(){
                axios.delete('/api/post/edit/'+this.$route.params.id)
                    .then(()=>{this.deleted=true}).catch(()=>{
                        alert("Vous n'etes pas authoriser a supprimer cette article")
                })


            },
            onChange () {
                console.log('New picture selected!')
                if (this.poster){
                    if (this.$refs.pictureInput.file ) {
                        console.log('Picture loaded.')
                        this.articles.image=this.$refs.pictureInput.image
                    } else {
                        console.log('FileReader API not supported: use the <form>, Luke!')
                    }
                }
            }
        }
    }
</script>