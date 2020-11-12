<?php
/* Starts the session */
session_start();
if (!isset($_SESSION['UserData']['Username'])) {
    header("location:login.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto"></ul>
        <form class="form-inline my-2 my-lg-0">
            <a href="logout.php" class="btn btn-light my-2 my-sm-0" type="submit">Logout</a>
        </form>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12 border-bottom">
            <p class="mt-2 pt-2 text-success">Congratulation! You have logged into password protected page.</p>
        </div>
        <div class="col-md-12 mt-2">
            <h5 class="py-2">List of currencies</h5>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NumCode</th>
                    <th>CharCode</th>
                    <th>Name</th>
                    <th>Value</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // get xml data
                $xml = simplexml_load_string(file_get_contents('http://www.cbr.ru/scripts/XML_daily.asp'));

                $arr = [];

                $array = json_decode(json_encode($xml), true);

                if (!empty($array)) {
                $i = 0;
                foreach ($array['Valute'] as $elem) {
                ?>
                <tr>
                    <td><?php echo $arr[$i]['NumCode'] = $elem['NumCode']; ?></td>
                    <td><?php echo strval($xml->Valute[$i]['ID']); ?></td>
                    <td><?php echo $arr[$i]['CharCode'] = $elem['CharCode']; ?></td>
                    <td><?php echo $arr[$i]['Name'] = $elem['Name']; ?></td>
                    <td><?php echo $arr[$i]['Value'] = $elem['Value']; ?></td>
                    <td><?php echo $arr[$i]['Date'] = strval($xml['Date']); ?></td>
                    <?php
                    ++$i;
                    }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
