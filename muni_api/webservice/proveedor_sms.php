<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 03/05/20
 * Time: 04:12 PM
 */

require_once '../client-php-master/autoload.php';
require_once '../util/funciones/Funciones.clase.php';



use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;

// Configure client
$config = Configuration::getDefaultConfiguration();
//$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU0MzQzMTIwMCwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjY0Nzc5LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.HEm0dd6IhGN4FqFXa35Rn2RVqyZXxjE3oyzwiVaqEHA';
$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU4ODU0MDM4NywiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjc5OTc4LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.xFwnqXNVQB-XIvJogafMZq0A5zcs2E1xbC-ZXodoAXk';
$config->setApiKey('Authorization', $token);
$apiClient = new ApiClient($config);
$messageClient = new MessageApi($apiClient);


//$telefono = $resultado["telefono"];
//$medico= $resultado["medico"];
//$cant = $resultado2["num"];

$telefono = '961682973';
$medico= 'Jhonny';

$sendMessageRequest1 = new SendMessageRequest([
    'phoneNumber' => '+51961682973',
    'message' => 'prueba one XD mas naki',
    'deviceId' => 106060
]);
$sendMessages = $messageClient->sendMessages([
    $sendMessageRequest1]);

Funciones::imprimeJSON(200, "",$sendMessages);