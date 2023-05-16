<?php
    require_once  './load.php';

    function getData() {
        $client = new Google_Client();
        $client->setApplicationName('webserver');
        $client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig('./credentails.json');

        $service = new Google_Service_Sheets($client);
        $spreedsheetID = '';
        $range = 'A:D';

        $response = $service->spreadsheets_values->get($spreedsheetID, $range);

        if(!$response->getValues()) return;

        foreach ($response->getValues() as $item) {
            echo "<tr>";
            echo "<td>".$item[1]."</td>";
            echo "<td>".$item[0]."</td>";
            echo "<td>".$item[2]."</td>";
            echo "<td>".$item[3]."</td>";
            echo "</tr>";
        }
    }
