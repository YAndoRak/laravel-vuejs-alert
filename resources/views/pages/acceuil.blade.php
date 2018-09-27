@extends('layouts.app')

@section('content')
    <div class="container" id="Vueapp">
            <acceuil-component></acceuil-component>
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