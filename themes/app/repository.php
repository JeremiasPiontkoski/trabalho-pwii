<?php
echo "Oi";
var_dump($repository);
var_dump($language);
?>

<p><a href="<?= url("app/editarRepositorio/id?id=" . $repository->id)?>"><?=$repository->name?></a></p>