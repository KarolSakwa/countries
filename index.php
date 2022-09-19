<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Countries</title>
        <meta name="description" content="Countries and capitals of the world">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <div class="mainContainer">

        <?php
            $response = json_decode(file_get_contents('https://restcountries.com/v3.1/all'), true);
            array_multisort(array_column($response, 'name'), SORT_ASC, $response);

            foreach ($response as $key => $value) {
                // IF THERE'S NO CAPITAL, I MARK THE WHOLE COUNTRY
                $longitude = $value['capitalInfo']['latlng'][1] ?? $value['latlng'][1];
                $latitude = $value['capitalInfo']['latlng'][0] ?? $value['latlng'][0];
                echo '
                <div id="country_'.$key.'_container">
                    <button class="toggleMapButton" onclick="toggleCountryCapitalMap(\''.$key.'\', \''.$longitude.'\', \''.$latitude.'\');">'.$value['name']['common'].'</button>
                </div>
                    ';
            }
        ?>
        </div>
        <script src="https://www.openlayers.org/api/OpenLayers.js"></script>
        <script src="app.js"></script>

    </body>
</html>