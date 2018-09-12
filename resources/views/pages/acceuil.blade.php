@extends('default')

@section('content')
    <div class="container">
        <div class="contenu">
            <div class="card-columns">

                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <h5>Titre</h5>
                        </div>
                        <img class="card-img-top" src="/imgs/img.jpeg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>


                        </div>

                        <div  class="card-footer border-info collapse">
                            <p class="card-text">
                            <p>Voici les document, Voici les doVoici les doici les dodocum ici les doici les dodocum iciVoici les document,
                                Voici les doVoici les doici les dodocum ici les doici les dodocum iciVoici les document, Voici les doVoici
                                les doici les dodocum ici les doici les dodocum ici</p>
                            <a href="#">En savoir plus</a>
                            </p>
                        </div>


                    </div>
                    <div class="card-footer bg-transparent border-success">

                        <p class="card-text">
                            <small class="text-muted">
                                Last updated 3 mins ago
                            </small>
                            <a href="#">En savoir plus</a>
                        </p>

                        <button class="btn btn-primary btn-group-sm expand">Plus</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
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
    </script>

@stop