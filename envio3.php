<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 28/02/2019
 * Time: 16:09
 */



$nombre = strip_tags(str_replace(array('"', "'",' '), "", $_POST["nombre2"]));
$telefono = $_POST["telefono2"];
$provincia = "-----";

$params = date("Y-m-d").'-'.$telefono;
$transaccion = hash('sha256', $params);

//API VIEJA
//$str= "?apikey=KD1TmzmweLpLQwMOug4yu4m3oKD1TmzmweLpLQwMOug4yu4m3okasdjasd&nombre=".$nombre."&telefono=".$telefono."&email=".$email."&provincia=".$provincia."&tsource=".$transaccion;

//Prueba con ApiKey errónea
//$str= "?apikey=G1zY3bngmXYxaBRp1MJRBvMAJFB&nombre=".$nombre."&telefono=".$telefono."&email=".$email."&provincia=".$provincia."&tsource=LANDING-CAMBIATE&ip=".$_SERVER['REMOTE_ADDR']."&hour=now";

//API SALESFORCE
$str = "?cid=autoconsumo&name=".$nombre."&lname=.&phone=".$telefono."&email=".$email;

$ch=curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch,CURLOPT_URL,'https://salesforce.gaolania.com.es/addlead'.$str);
$respuesta = curl_exec($ch);

if($respuesta=='{"data":"OK"}')
{
    echo ("<script LANGUAGE='JavaScript'>
    window.location.href='https://ganaenergia.com/formulario-de-llamada-recibido/';
    </script>");
    exit;
}else
{
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Ha ocurrido un error enviando tus datos. Por favor intenta de nuevo.');
    window.location.href='index.html';
    </script>");
    exit;
}

curl_close($ch);