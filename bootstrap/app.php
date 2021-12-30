<?php

$app = new DI\ContainerBuilder();

$app->useAutowiring(true);
$app->useAnnotations(true);

return $app->build();
