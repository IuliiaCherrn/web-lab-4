<?php
    require_once '../load.php';

    function redirectTo($url) : void {
        header('Location: '.$url);

        exit();
    }

    if(!isset($_POST['email'], $_POST['title'], $_POST['category'], $_POST['description'])) {
        redirectTo('/');
    }

    $email = $_POST['email'];
    $category = $_POST['category'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $client = new Google_Client();
    $client->setApplicationName('webserver');
    $client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
    $client->setAccessType('offline');
    $client->setAuthConfig('../credentails.json');

    $service = new Google_Service_Sheets($client);

    $options = [
        'valueInputOption' => 'RAW'
    ];

    $spreedsheetID = '';

    $result = $service->spreadsheets_values->get($spreedsheetID, 'A:B');
    $rows = $result->getValues();

    $lastIndex = $rows ? count($rows) + 1 : 1;
    $range = 'A'.$lastIndex.':D'.$lastIndex;
    $data = [
        [
            $email,
            $category,
            $title,
            $description
        ]
    ];

    $values = new Google_Service_Sheets_ValueRange([
        'values' => $data
    ]);

    $service->spreadsheets_values->update($spreedsheetID, $range, $values, $options);

    redirectTo('/');
?>
