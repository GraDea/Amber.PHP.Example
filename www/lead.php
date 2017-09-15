<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('output_buffering', 'On');

require __DIR__ . '/../vendor/autoload.php';
$config = require __DIR__ . '/../config/config.php';
$endpoint = $config['base_uri'] . $config['endpoint'];
$client = new \AmberSdk\Client\AppClient($endpoint, new \AmberSdk\Client\AuthManager($config));

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {

    $name = htmlspecialchars($_POST["name"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $id = htmlspecialchars($_POST["id"]);

    $data = ['Name' => $name, 'Phone' => $phone];

    $client->updateObject('BaseLead', $id, $data);

    $query = "?id={$id}";
    header("Location: " . $_SERVER['REQUEST_URI'] . $query);
    exit();
}

$str = $_SERVER['QUERY_STRING'];
parse_str($str, $output);
$id = $output['id'];
$item = $client->getObject('BaseLead', $id);

?>
<html>
<head>
    <title>Leads</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1><a>Просмотр и редактирование</a></h1>
        <form method="post" action="lead.php">
            <div class="form_description">
                <h2>
                    <?php echo $item->Id ?>
                </h2>

            </div>
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($item->Id); ?>">
                <div>
                    <label class="description" for="element_1">Name</label>

                        <input id="name" name="name" class="form-control" type="text" maxlength="255" value="<?php echo htmlspecialchars($item->Name); ?>"/>
                    </div>
                <div>
                    <label class="description" for="element_2">Phone</label>

                        <input id="phone" name="phone" class="form-control" type="text" maxlength="255" value="<?php echo htmlspecialchars($item->Phone); ?>"/>
                    </div>
<div>
                    <input id="saveForm" class="btn btn-default" type="submit" name="submit" value="Сохранить" />
</div>

            </div>
        </form>

    </div>

</body>
</html>