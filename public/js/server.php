<?php

/*****||||||||||||||||||||||||||||||||||||||||||*****\
                    CONNECT_DB                   
\*****||||||||||||||||||||||||||||||||||||||||||*****/

define ('ERROR_LOG_FILE', 'Error.log');

function connect_db($host, $username, $password, $port, $db){
    try{
        $bdd = new PDO('mysql:host=' . $host . ';dbname=' . $db . ';port=' . $port . ';charset=utf8', $username, $password);
        return $bdd;
    }
    catch (PDOException $error){
        $message = $error->getMessage();
        file_put_contents(ERROR_LOG_FILE, $message);
        echo "PDO ERROR: " . $message . " storage in " . ERROR_LOG_FILE . "\n";
    }
}

if(!isset($bdd)){
    $bdd = connect_db('127.0.0.1', 'root', 'root', 3306, 'Printeerz');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}

/*****||||||||||||||||||||||||||||||||||||||||||*****\
                    SQL REQUESTS                   
\*****||||||||||||||||||||||||||||||||||||||||||*****/

// $request = $bdd->prepare('SELECT * FROM todo');
// $request->execute();
// $data = $request->fetchAll(PDO::FETCH_ASSOC);
// if($data){
//     foreach($data as $element){
//         echo "\n #" . $element['name'] . "\n";
//         //var_dump($element);
//         $request2 = $bdd->prepare('SELECT * FROM tag');
//         $request2->execute();
//         $data2 = $request2->fetchAll(PDO::FETCH_ASSOC);
//         if($data2){
//             foreach($data2 as $element2){
//                 echo "\n #" . $element2['name'] . "\n";
//             }
//         }
//     }
// }



