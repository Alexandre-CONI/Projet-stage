@extends('template')

@section('head')
    <title id="title-doc">Mentions informatiques et libertés</title>
    <link rel="stylesheet" href="/../Projet-capteur/public/css/cnil.css">
@stop

@section('contenu')

    <div class="container corps">
        <div class="row">
            <div class="col-md-offset-3 col-md-8 col-xs-12">
                <h1 class="pageTitre">Mentions Informatiques et Libertés</h1>
                <div id="corps">
                    <div>
                        <strong>Eiffage Énergie Gestion &amp; Développement</strong> collecte et traite vos données afin de répondre à votre demande d’informations, de devis et de tous services associés. Les champs renseignés par un astérisque [*] sont obligatoires, à défaut de les renseigner votre demande ne pourra pas être prise en compte.</div>
                    <div>
                        Conformément à la Loi n°78-17 du 6 janvier 1978 relative à l’informatique, aux fichiers et aux libertés, vous disposez d’un droit d’accès, de rectification ainsi que d’un droit d’opposition sur les données vous concernant que vous pouvez exercer dans les conditions prévues dans la <a onclick="self.location.href='{{url('Politique-de-confidentialite')}}'" title="Politique de confidentialité">Politique de confidentialité</a>.</div>

                </div>
                <div>
                    &nbsp;</div>
            </div>
        </div>
    </div>


@stop

