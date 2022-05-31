<?php


require_once('config.php');

date_default_timezone_set('Europe/Amsterdam');

$q_check_the_last_record = "SELECT * FROM test_for_appinventor ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $q_check_the_last_record);


foreach ($result as $row) {
    $last_listening_status_on_record = stripslashes($row['listening']);
    $current_record_id = stripslashes($row['id']);
    $creation_datetime = stripslashes($row['datetime_begin']);
}


$listening = mysqli_real_escape_string($conn, $_GET['listening']);



echo $creation_datetime . "creation";
echo strtotime($creation_datetime) . "unix";


# Calculer le temps entre la dernière modification du fichier log correspondant à la dernière utilisation et le temps actuel
$current_timestamp = new DateTime(date('Y-m-d H:i:s', time()));
$last_record_modification_timestamp = new DateTime(date('Y-m-d H:i:s' ,filemtime('logs/' . $current_record_id . '-logs.csv')));
$diff = $current_timestamp->diff($last_record_modification_timestamp);
$daysInSecs = $diff->format('%r%a') * 24 * 60 * 60;
$hoursInSecs = $diff->h * 60 * 60;
$minsInSecs = $diff->i * 60;
$seconds = $daysInSecs + $hoursInSecs + $minsInSecs + $diff->s;


$test = strtotime(date('Y-m-d H:i:s', time())) + 3600*2;

$time_before_ending_session = 10; #temps avant la fermeture de la session

echo $seconds;

if ($last_listening_status_on_record == 1){

    # Enregistrer la présence d'un appel d'urgence
    if (isset($_GET['emergencyCall'])) {
        $emergecy_call = mysqli_real_escape_string($conn, $_GET['emergencyCall']);
        $insert_new_emergency_call = "INSERT INTO data_for_analytics SET emergencyCall = '$emergecy_call'";
        $query_insert_new_emergency_call = mysqli_query($conn, $insert_new_emergency_call) or die(mysqli_error($db));
    }

    #Si la session est considérée comme périmée, elle va être fermée
    if ($seconds > $time_before_ending_session) {

        //Calculer le temps d'utilisation par la différence entre la dernière action enregistrée et le début de la session
        $d1 = strtotime($creation_datetime);
        $d2 = strtotime(date('Y-m-d H:i:s', filemtime('logs/' . $current_record_id . '-logs.csv')));
        $totalSecondsDiff = abs($d1 - $d2);

        // Récupérer les distances, calculer la moyenne et arrondir au centième près.
        $csv = array();
        $lines = file('logs/' . $current_record_id . '-logs.csv', FILE_IGNORE_NEW_LINES);
        foreach ($lines as $key => $value) {
            $csv[$key] = str_getcsv($value);
        }
        $ids = array_column($csv, 1);
        $average = round((array_sum($ids) / count($ids)), 2);

        $q_end_latest_record = "UPDATE test_for_appinventor SET listening = 0, datetime_end = FROM_UNIXTIME($test), average_distance = '$average', usetime = '$totalSecondsDiff' WHERE id = '$current_record_id'";
        $insert_q_end_lated_record = mysqli_query($conn, $q_end_latest_record) or die(mysqli_error($db));
        $last_listening_status_on_record = 0;

    } else {
        $date = date('Y-m-d H:i:s', time());
        $distance_and_moove = mysqli_real_escape_string($conn, $_GET['distance']);
        $distance = preg_replace('/[^0-9]/', '', $distance_and_moove);
        $moove = preg_replace('/[^a-zA-Z]/', '', $distance_and_moove);
        if($distance != ""){
            $file = fopen('logs/' . $current_record_id . '-logs.csv', 'a');  // 'a' for append to file - created if doesn't exit
            // Ajouter les nouvelles valeurs dans le fichier log
            fputcsv($file, array($date, $distance, $moove));
            fclose($file);    
        }

        
    }
}


if ($last_listening_status_on_record  == 0) {

    $test = strtotime(date('Y-m-d H:i:s', time())) + 3600 * 2;

    $q_create_new_record = "INSERT INTO test_for_appinventor (datetime_begin, listening) VALUES (FROM_UNIXTIME($test), '$listening')";
    $insert_q_create_new_record = mysqli_query($conn, $q_create_new_record);
    $current_record_id = $current_record_id + 1;

    $data = [
        ['Timestamp', 'Distance', 'Moove'],
    ];

    $filename = $current_record_id . '-logs.csv';

    // open csv file for writing
    $f = fopen('logs/' . $filename, 'w');

    foreach ($data as $row) {
        fputcsv($f, $row);
    }

    // close the file
    fclose($f);


    echo "new record created";
}

echo $current_record_id;
$distance = mysqli_real_escape_string($conn, $_GET['distance']);



$q_add_new_distance = "INSERT INTO test_for_appinventor (distance) VALUES ($distance) WHERE id = $current_record_id";



mysqli_close($conn);


// Distance
// Mouvements
// (GPS)
// Durée d'utilisation
// Niveau de batterie
// Appels d'urgence

?>
