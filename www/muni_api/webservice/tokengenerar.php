<?php
/**
 * Created by PhpStorm.
 * User: tito_
 * Date: 23/10/2018
 * Time: 11:31 PM
 */

require_once '../util/jwt/vendor/autoload.php';
require_once '../util/jwt/auth.php';


function generarToken($data=null, $timeToken=3600){
    return Auth::SignIn($data, $timeToken);
}