<?php
/**
 * Created by PhpStorm.
 * User: tito_
 * Date: 23/10/2018
 * Time: 8:45 PM
 */

require_once '../util/jwt/vendor/autoload.php';
require_once '../util/jwt/auth.php';


function validarToken($token){
    try {
        if (Auth::Check($token) ){
            return TRUE;
        }
    } catch (Exception $e) {
        throw $e;
    }
}