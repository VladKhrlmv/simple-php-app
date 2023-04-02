<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css">
    <title>Lab 7</title>
</head>

<body>
    <table>
        <?php
        if (isset($_GET["n"]) && $_GET["n"] >= 5 && $_GET["n"] <= 20) {
            $n = $_GET["n"];
        } else {
            $n = 10;
            echo "Wrong query. Default size = 10 is used.";
        }

        $numbers = [];
        for ($i = 0; $i < $n; $i++) {
            $numbers[$i] = random_int(1, 99);
        }
        // create table
        for ($i = -1; $i < $n; $i++) {
            for ($j = -1; $j < $n; $j++) {
                if ($i == -1 && $j == -1) {
                    echo "<tr><td class=\"header\"></td>";
                } elseif ($i == -1) {
                    echo "<td class=\"header\">$numbers[$j]</td>";
                } elseif ($j == -1) {
                    echo "<tr><td class=\"header\">$numbers[$i]</td>";
                } else {
                    $num = $numbers[$i] * $numbers[$j];
                    echo "<td class=" . ($num % 2 == 0 ? "even" : "odd") . ">$num</td>";
                }
            }
            echo "</tr>";
        }
        ?>
    </table>

    <?php
    $nameErr = $typeErr = $priceErr = "";
    $name = $type = $zip = $price = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = testInput($_POST["name"]);
        }
        if (empty($_POST["type"])) {
            $typeErr = "Type is required";
        } else {
            $type = testInput($_POST["type"]);
        }
        if (empty($_POST["zip"])) {
            $zip = "";
        } else {
            $zip = testInput($_POST["zip"]);
        }
        if (empty($_POST["price"])) {
            $priceErr = "Price is required";
        } else {
            $price = testInput($_POST["price"]);
        }
    }
    function testInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <h2>Form</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" /><br>
        <label for="type">Type</label>
        <select name="type" id="type">
            <option value="Type 1">Type 1</option>
            <option value="Type 2">Type 2</option>
            <option value="Type 3">Type 3</option>
        </select>
        <br>
        <label for="zip">Zip</label>
        <input type="text" id="zip" name="zip" pattern="[0-9]*"><br>
        <label for="price">Price</label>
        <input type="number" id="price" name="price" /><br>
        <button type="submit" id="submit">Submit</button>
    </form>
    <?php
    if ($nameErr != "" || $typeErr != "" || $priceErr != "")
        echo "Errors: <br>";
    echo "<p class=\"errors\">";
    if ($nameErr != "") {
        echo "$nameErr <br>";
    }
    if ($typeErr != "") {
        echo "$typeErr <br>";
    }
    if ($priceErr != "") {
        echo "$priceErr <br>";
    }
    echo "</p>";
    echo "Sent data: <br>";
    echo "<p class=\"data\">";
    echo "Name: $name <br>";
    echo "Type: $type <br>";
    echo "Zip: $zip <br>";
    echo "Price: $price <br>";
    echo "</p>";
    ?>
</body>

</html>