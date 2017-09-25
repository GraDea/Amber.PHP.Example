<html>
<head>
    <title>Leads</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
</head>https://scontent.fhrk1-1.fna.fbcdn.net/v/t1.0-9/546517_526169190743351_192053429_n.jpg?oh=d13ae0243ddd7ed87aac7f3da825aa02&oe=5A5C39A1
<body>
<div class="container">


<table class = "table table-bordered table-hover">
    <thead>
        <td>ID</td>
        <td>Name</td>
        <td>Phone</td>
    </thead>
    <tbody>
<?php

require __DIR__ . '/../vendor/autoload.php';
$config = require __DIR__ . '/../config/config.php';
$endpoint = $config['base_uri'] . $config['endpoint'];
$client = new \AmberSdk\Client\AppClient($endpoint, new \AmberSdk\Client\AuthManager($config));

$str = $_SERVER['QUERY_STRING'];
parse_str($str, $filter);

if(empty(filter)){
    $leads = $client->getObjects("BaseLead");
} else {
    $leads = $client->getObjects("BaseLead", $filter);
}

foreach ($leads as $lead) {
    echo "<tr><td><a href = '/lead.php?id={$lead->Id}'>{$lead->Id}</a></td><td>{$lead->Name}</td><td>{$lead->Phone}</td></tr>";
}

?>
    </tbody>
</table>
    </div>
</body>
</html>


