<meta http-equiv="pragma" content="no-cache" />
<?php
Session::flush();
Cache::flush();

return Redirect::to('Accueil')->with('message',trans('message.deco'));
?>



