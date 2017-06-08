@extends('template')

@section('head')
    <title id="title-doc">Plan du site</title>
    <link rel="stylesheet" href="/../Projet-capteur/public/css/cnil.css">
@stop

@section('contenu')
    <div class="container corps">
        <div class="row">
            <div class="col-md-offset-2 col-md-10 col-xs-12">
                <h1 class="pageTitre">Plan de site</h1>
                <div class="row">
                    <br>
                    <div id="horco" class="col-md-2">
                        <a onclick="self.location.href='{{url('Accueil')}}'" title="Politique de confidentialité">Accueil</a><br>
                        <a onclick="self.location.href='{{url('Connexion')}}'" title="Politique de confidentialité">Connexion</a><br>
                        <a onclick="self.location.href='{{url('Inscription')}}'" title="Politique de confidentialité">Inscription</a><br>
                        <a onclick="self.location.href='{{url('Plan-du-site')}}'" title="Politique de confidentialité">Plan du site</a><br>
                    </div>
                    @if(Hash::check(Session::get('user_rang'),Session::get('user_hash') ) AND Session::get('user_rang')=="admin-eiffage")
                        @if(Hash::check('admin-eiffage',Session::get('user_hash') ))
                            <div id="adco" class="col-md-2">
                                <a onclick="self.location.href='{{url('Detail-sur-un-client')}}'" title="Politique de confidentialité">Détails sur un client</a><br>
                                <a onclick="self.location.href='{{url('Gerer-les-capteurs')}}'" title="Politique de confidentialité">Gérer les capteurs</a><br>
                                <a onclick="self.location.href='{{url('Gerer-les-clients')}}'" title="Politique de confidentialité">Gérer les clients</a><br>
                                <a onclick="self.location.href='{{url('Gerer-les-sites')}}'" title="Politique de confidentialité">Gérer les sites</a><br>
                                <a onclick="self.location.href='{{url('Gerer-les-zones')}}'" title="Politique de confidentialité">Gérer les zones</a><br>
                            </div>
                        @endif
                    @elseif(Hash::check(Session::get('user_rang'),Session::get('user_hash') ) AND Session::get('user_rang')=="client-eiffage" || Session::get('user_rang')=="visiteur-eiffage" )
                        @if(Hash::check('client-eiffage',Session::get('user_hash') ) || Hash::check('visiteur-eiffage',Session::get('user_hash') ))
                            <div id="clico" class="col-md-2">
                                <a onclick="self.location.href='{{url('Profil')}}'" title="Politique de confidentialité">Profil</a><br>
                                @if(Hash::check(Session::get('user_rang'),Session::get('user_hash') ) AND Session::get('user_rang')=="client-eiffage")
                                    @if(Hash::check('client-eiffage',Session::get('user_hash') ))
                                        <a onclick="self.location.href='{{url('Gerer-les-visiteurs')}}'" title="Politique de confidentialité">Gérer les visiteurs</a><br>
                                    @endif
                                @endif
                            </div>

                            <div id="vico" class="col-md-2">
                                <a onclick="self.location.href='{{url('Donnee-du-capteur')}}'" title="Politique de confidentialité">Données du capteur</a><br>
                                <a onclick="self.location.href='{{url('Liste-des-capteurs')}}'" title="Politique de confidentialité">Liste des capteurs</a><br>
                                @if(Hash::check('client-eiffage',Session::get('user_hash') ))
                                    <a onclick="self.location.href='{{url('Liste-des-sites')}}'" title="Politique de confidentialité">Liste des sites</a><br>
                                @endif
                                @if(Hash::check('visiteur-eiffage',Session::get('user_hash') ))
                                    <a onclick="self.location.href='{{url('Liste-des-sites-vi')}}'" title="Politique de confidentialité">Sites visiteurs</a><br>
                                @endif
                                <a onclick="self.location.href='{{url('Liste-des-zones')}}'" title="Politique de confidentialité">Liste des zones</a><br>
                            </div>
                        @endif
                    @endif
                    <div id="cnil">
                        <a onclick="self.location.href='{{url('Conditions-gene-dutilisation')}}'" title="Politique de confidentialité">Conditions générales d'utilisation</a><br>
                        <a onclick="self.location.href='{{url('Mentions-info-et-libertes')}}'" title="Politique de confidentialité">Mentions informatiques et libertés</a><br>
                        <a onclick="self.location.href='{{url('Mentions-legales')}}'" title="Politique de confidentialité">Mentions légales</a><br>
                        <a onclick="self.location.href='{{url('Politique-de-confidentialite')}}'" title="Politique de confidentialité">Politique de confidentialité</a><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@stop