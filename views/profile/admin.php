<?php


$this->title = 'Bejegyzések kezelése';


?>

<h1><?= $this->title ?></h1>

<br>

<div class="row padding bold">
    <div class="col-xs-3 col-md-6">Cím</div>
    <div class="col-xs-3 col-md-2 text-center">Megtekintés</div>
    <div class="col-xs-3 col-md-2 text-center">Szerkesztés</div>  
    <div class="col-xs-3 col-md-2 text-center">Törlés</div>  
</div>

<?php
foreach($myArticles as $article){
    echo $this->render('_admin_item', ['article'=> $article]);
}
?>
