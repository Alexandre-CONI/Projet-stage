<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="/../Projet-capteur/public/image/favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/../Projet-capteur/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/../Projet-capteur/public/css/Template.css">
    <script type="text/javascript" src="/../Projet-capteur/public/js/jquery-3.2.1.js"></script>
    <script src="/../Projet-capteur/public/js/bootstrap.min.js"></script>
    <script src="/../Projet-capteur/public/js/Find.js"></script>

    @yield('head')
</head>

<header id="head" >
    <div class="container-fluid">
        <div class="row" id="caisse">
            <div id="red" >
                <div class="col-md-offset-9 col-md-3 logo logo">
                    <a href="https://www.facebook.com/EiffageEnergie"target="_blank"><img id="logos" src="/../Projet-capteur/public/image/facebook.png" alt="facebook"></a>
                    <a href="https://www.youtube.com/user/EiffageEnergie"target="_blank"><img id="logosY" src="/../Projet-capteur/public/image/youtube.png" alt="youtube" ></a>
                    <a href="http://fr.viadeo.com/fr/company/eiffage-energie"target="_blank"><img id="logos" src="/../Projet-capteur/public/image/viadeo.png" alt="viadeo"></a>
                    <a href="https://fr.linkedin.com/company/eiffage-energie" target="_blank"><img id="logos" src="/../Projet-capteur/public/image/linked.png" alt="linked"></a>
                </div><br>

            </div>
            <div class="col-md-offset-2 col-md-2 col-sm-3 col-xs-12">
                <a onclick="self.location.href='{{url('Accueil')}}'"target="_self"><img class=img-responsive id="icon" src="/../Projet-capteur/public/image/logo.png" alt="icon"></a>
            </div>
            <div id="menucaisse" class="col-md-5 col-sm-6 col-xs-12 menu ">
                @if(Hash::check(Session::get('user_rang'),Session::get('user_hash')) AND Session::get('user_rang')=="admin-eiffage")
                    @if(Hash::check('admin-eiffage',Session::get('user_hash')))
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><button onclick="self.location.href='{{url('Gerer-les-sites')}}'" type="button" >Gérer les sites</button></div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><button onclick="self.location.href='{{url('Gerer-les-clients')}}'" type="button" >Gérer les clients</button></div>
                        <div class="btn-group col-md-4 col-sm-4 col-xs-4"><button type="button" onclick="self.location.href='{{url('Gerer-les-capteurs')}}'">Gérer les capteurs</button></div>
                    @endif
                @elseif(Hash::check(Session::get('user_rang'),Session::get('user_hash') ) AND Session::get('user_rang')=="client-eiffage")
                    @if(Hash::check('client-eiffage',Session::get('user_hash')))
                        <div class="col-md-offset-3 col-sm-offset-3 col-xs-offset-3  col-lg-6 col-md-6 col-sm-6 col-xs-6"><button type="button" onclick="self.location.href='{{url('Liste-des-sites')}}'">Liste des sites </button></div>
                    @endif
                @elseif(Hash::check(Session::get('user_rang'),Session::get('user_hash') ) AND Session::get('user_rang')=="visiteur-eiffage")
                    @if(Hash::check('visiteur-eiffage',Session::get('user_hash')))
                        <div class="col-md-offset-3 col-sm-offset-3 col-xs-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-6"><button  onclick="self.location.href='{{url('Liste-des-sites-vi')}}'" type="button" >Sites visiteurs</button></div>
                    @endif
                @else @endif
            </div >

            <div class=" col-md-2 col-sm-3 col-xs-12">
                @if(Hash::check(Session::get('user_rang'),Session::get('user_hash') ) AND Session::get('user_rang')=="admin-eiffage")
                    @if(Hash::check('admin-eiffage',Session::get('user_hash') ))
                        <div class=" col-md-12 col-sm-12 col-xs-12"><br><a href="{{url('Deco')}}" type="button" ><button class="button">Deconnexion</button></a></div>

                    @endif
                @elseif(Hash::check(Session::get('user_rang'),Session::get('user_hash') ) AND Session::get('user_rang')=="client-eiffage" || Session::get('user_rang')=="visiteur-eiffage" )
                    @if(Hash::check('client-eiffage',Session::get('user_hash') ) || Hash::check('visiteur-eiffage',Session::get('user_hash') ))
                        <div class=" col-md-12 col-sm-12 col-xs-6">
                            <a href="{{url('Deco')}}" type="button" ><button class="button">Deconnexion</button></a></div>
                        <div class="btn-group col-md-12 col-sm-12 col-xs-6">
                            <button type="button" class=" button2 dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                                Profil <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu drop" role="menu">
                                @if(Hash::check('client-eiffage',Session::get('user_hash') ))
                                    <li><a onclick="self.location.href='{{url('Gerer-les-visiteurs')}}'" >Gérer les visiteurs </a></li>
                                @endif
                                <li><a onclick="self.location.href='{{url('Profil')}}'">Profil</a></li>
                            </ul>
                        </div>
                    @endif
                @else
                    <script type="text/javascript" id="cookiebanner" src="http://cookiebanner.eu/js/cookiebanner.min.js" data-position="top" data-fg="#FFFFFF" data-bg="#FF0000" data-link="#FFFFFF" data-moreinfo="{{url('Politique-de-confidentialite')}}" data-message="Les cookies assurent le bon fonctionnement de notre site Internet. En utilisant ce dernier, vous acceptez leur utilisation." data-linkmsg="En savoir plus"></script>
                    <div class=" col-md-12 col-sm-12 col-xs-6"><button class="button" onclick="self.location.href='{{url('Inscription')}}'" type="button" >Inscription</button></div>
                    <div class=" col-md-12 col-sm-12 col-xs-6"><button class="button" onclick="self.location.href='{{url('Connexion')}}'" type="button" >Connexion</button></div>
                    <br>

                @endif
            </div>
        </div>


    </div>

</header>
<div class="row"></div>
<div class="break"></div>
<br>

@yield('contenu')







<footer>
    <div id="footer" class="container-fluid">
        <div class="row img-responsive pieds" >
            <div class="col-md-offset-1 col-md-2">
                <ul>
                    <li><a onclick="self.location.href='{{url('Conditions-gene-dutilisation')}}'">Conditions générales d'utilisation</a> | </li>
                    <li><a onclick="self.location.href='{{url('Mentions-legales')}}'">Mentions Légales</a> | </li>
                    <li><a onclick="self.location.href='{{url('Plan-du-site')}}'" >Plan du site</a></li>
                </ul>
            </div>
            <div class="col-md-offset-2 col-md-7 img-responsive">
                <ul>
                    <li ><a class="eiffage" href="http://www.eiffage.com/home.html"  target="_blank">Eiffage</a></li>
                    <li><a href="http://www.eiffageconstruction.com/" class="eiffageC" target="_blank">Construction</a></li>
                    <li><a href="http://www.eiffageinfrastructures.com/" target="_blank" class="eiffageI">Infrastructures</a></li>
                    <li><a href="http://www.eiffageenergie.com/accueil" class="eiffageE" target="_blank">Énergie</a></li>
                    <li><a href="http://www.eiffageconcessions.com/" class="eiffageCo" target="_blank">Concessions</a></li>
                    <li><a href="http://www.aprr.com/fr" class="eiffageAPRR" target="_blank">Autoroutes APRR</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</html>