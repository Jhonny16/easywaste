<?php

require_once '../model/venta.php';

$objetoventa = new venta();

$objetoventa->setTotal();
$valor = 35;

$objetoventa->getTotal($valor);

$objetoventa->lista();
