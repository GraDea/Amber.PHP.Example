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

$select = [
    new \AmberSdk\Client\Model\PropertyPath("Id"),
    new \AmberSdk\Client\Model\PropertyPath("Phone"),
    new \AmberSdk\Client\Model\PropertyPath("Name"),
];

$query = new \AmberSdk\Client\Model\ExecutionQuery();
$query->select=$select;
$query->customObjectCode= "BaseLead";
$propertyStatus = new \AmberSdk\Client\Model\ExpressionElement();
$propertyStatus->propertyPath = new \AmberSdk\Client\Model\PropertyPath("Status.Name");

$operatorEqual = new \AmberSdk\Client\Model\ExpressionElement();
$operatorEqual->operator = new \AmberSdk\Client\Model\Operator("EqualTo");

$constantStatus = new \AmberSdk\Client\Model\ExpressionElement();
$constantStatus->constant = new \AmberSdk\Client\Model\ConstantElement("String", "Новый");

$predicat =
    new \AmberSdk\Client\Model\ExpressionElement(new \AmberSdk\Client\Model\Brackets([
        $propertyStatus,
        $operatorEqual,
        $constantStatus]));

$query->where = [$predicat];
$leads = $client->execQuery($query);

foreach ($leads as $lead) {
    echo "<tr><td><a href = '/lead.php?id={$lead->Id}'>{$lead->Id}</a></td><td>{$lead->Name}</td><td>{$lead->Phone}</td></tr>";
}

?>
    </tbody>
</table>
    </div>
</body>
</html>


