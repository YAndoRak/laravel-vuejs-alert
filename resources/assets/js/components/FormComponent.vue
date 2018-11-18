<template>
    <div>
        <div class="container mt-4" v-if="success">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Felecitation!</h4>
                <p>Votre message a ete bien envoyer.</p>
                <hr>
                <p class="mb-0">Merci pour votre participation, pour retourner a la page d'acceuil <a href="/acceuil">Cliquer ici</a></p>
            </div>
        </div>

        <div class="formulaire" v-else>
            <h2 class="text-center">Signaler</h2>

            <div class="form-group">
                <label for="titre">Sujet de votre declaration :</label>
                <input type="text" class="form-control" name="titre" id="titre" placeholder="ex: mot de passe wifi trop facile" required v-model="titre">
            </div>
            <div class="form-group">
                <label for="lieu">Lieu de l'incident : </label>
                <select class="browser-default custom-select mb-2" id="lieu" name="lieu" v-model="lieu">
                    <option value="" disabled>Choisissez une ville</option>
                    <option>Tana</option>
                    <option>Majunga</option>
                    <option>Tamatave</option>
                    <option>Diego</option>
                </select>
            </div>
            <div class="form-group">
                <label for="commune">La commune où l'incident s'est produite :</label>
                <input type="text" class="form-control" id="commune" name="commune" placeholder="ex: Antanimena" required v-model="commune">
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox mt-2">
                    <input type="checkbox" class="custom-control-input" id="poster" v-model="poster" checked value="true">
                    <label class="custom-control-label" for="poster"> Ajouter un poster :</label>
                </div>
                <div class="custom-control custom-checkbox mt-2">
                    <picture-input v-if="poster"
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
                <datepicker :bootstrap-styling="true" :calendar-button="true" placeholder="ex: 17 Nov 2018" calendar-button-icon="fa fa-calendar" v-model="date">
                </datepicker>
            </div>


            <!-- Fin date -->
            <div class="form-group">
                <label for="description">Description :</label>
                <froala :tag="'textarea'" :config="config" id="description" v-model="description"></froala>

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
    import Datepicker from 'vuejs-datepicker';
    import PictureInput from 'vue-picture-input';
    export default {
        components: {
            Datepicker,
            PictureInput
        },

        data(){
            return {
                props: {
                    placeholder: String,
                    calendarButton:Boolean,
                    calendarButtonIcon: String,
                    required: Boolean,
                    bootstrapStyling: Boolean,
                },
                config: {
                    placeholderText:"Veuillez decrir ici les details de l'incident",
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
                online:1,
                success:false,
                poster:true,
                image:""

            }
        },
        methods:{
            envoyer(){
                axios.post('/form', {
                    titre:this.titre,
                    lieu:this.lieu,
                    commune:this.commune,
                    date:this.date,
                    description:this.description,
                    online:this.online,
                    poster:this.poster,
                    image:this.poster ? this.image : "No image"
                }).then(()=>{
                    this.success=true;
                }).catch(()=>{
                    console.log('error')

                })
            },
            onChange () {
                console.log('New picture selected!')
                if (poster='true'){
                    if (this.$refs.pictureInput.file ) {
                        console.log('Picture loaded.')
                        this.image=this.$refs.pictureInput.image
                    } else {
                        console.log('FileReader API not supported: use the <form>, Luke!')
                    }
                }
            }

        }
    }
</script>
