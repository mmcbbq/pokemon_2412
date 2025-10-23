<?php
require_once '../src/database/datenbank.php';
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://pokeapi.co/api/v2/pokemon?limit=150',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));
$response = curl_exec($curl);
curl_close($curl);
$poke_array = json_decode($response,true);
$con = dbcon();
$sql = " INSERT INTO pokemon (name, caught, type) VALUES (:name, 0, :type)";
$stmt = $con->prepare($sql);
for ($i = 0; $i < count($poke_array["results"]); $i++) {

    $poke_name = $poke_array["results"][$i]['name'];
    $poke_url = $poke_array["results"][$i]['url'];
    $poke_curl = curl_init();
    curl_setopt_array($poke_curl, array(
        CURLOPT_URL => $poke_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    $pokemon_json = curl_exec($poke_curl);
    curl_close($poke_curl);
    $pokemon = json_decode($pokemon_json,true);
    $poketype = $pokemon['types'][0]['type']['name'];
    $stmt->bindParam(":name",$poke_name);
    $stmt->bindParam(":type",$poketype);
    $stmt->execute();
}







