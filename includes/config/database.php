<?php

function conectarDB() : mysqli {
    $db = mysqli_connect('localhost', 'root', 'Garbage17', 'bienes_raices');

    if(!$db) {
      echo "No conectado";
      exit;
    }

    return $db;
}