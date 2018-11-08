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
                <input type="text" class="form-control" name="titre" required v-model="articles.titre">
            </div>
            <div class="form-group">
                <label for="lieu">Lieu de l'incident : </label>
                <select class="browser-default custom-select mb-2" name="lieu" v-model="articles.lieu">
                    <option value="" disabled>Choisissez une ville</option>
                    <option>Tana</option>
                    <option>Majunga</option>
                    <option>Tamatave</option>
                    <option>Diego</option>
                </select>
            </div>
            <div class="form-group">
                <label for="commune">La commune où l'incident s'est produite :</label>
                <input type="text" class="form-control" name="commune" required v-model="articles.commune">
            </div>
            <!--Ici commence date -->
            <label>Date de decouverte de l'incident :</label>
            <div class="input-group mb-3" >
                <div class="input-group-prepend">
                    <span class="input-group-text">Annee</span>
                </div>
                <input type="text" class="form-control" v-model="articles.date">


            </div>


            <!-- Fin date -->

            <div class="form-group">
                <label for="description">Description :</label>
                <froala :tag="'textarea'" :config="config" v-model="articles.description"></froala>

            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox mt-2">
                    <input type="checkbox" class="custom-control-input" id="public" name="public" value="1" checked v-model="articles.online">
                    <label class="custom-control-label" for="public">Mettre en public ?</label>
                </div>
            </div>

            <button class="btn btn-primary btn-block btn-lg" @click="envoyer">Je veux editer</button>

        </div>

    </div>
</template>
<script>
    export default {
        data(){
            return {config: {
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
                    videoUploadURL: 'api/upload_video',
                    // Set request type.
                    videoUploadMethod: 'POST',
                    // Set max video size to 50MB.
                    videoMaxSize: 50 * 1024 * 1024,

                    // Set the file upload URL.
                    fileUploadURL: 'api/upload_file',

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
        },
        methods:{
            envoyer(){
                axios.post('/api/post/edit/'+this.$route.params.id, {
                    titre:this.articles.titre,
                    lieu:this.articles.lieu,
                    commune:this.articles.commune,
                    date:this.articles.date,
                    description:this.articles.description,
                    online:this.articles.online
                }).then((response)=>{
                    this.success=true;
                    window.location = '/acceuil';
                }).catch(()=>{
                    console.log('error')
                })
            }
        }
    }
</script>