<?php 
    include ('DatabaseManager.php'); 
    $db = new DatabaseManager();



    $products = $db->rawQuery('
    SELECT 
        kategorijos.pavadinimas AS kategorijos_pavadinimas,
        produktai.id, 
        produktai.pavadinimas AS produkto_pavadinimas,
        produktai.aprasymas,
        produktai.kaina
    FROM produktai
    LEFT JOIN kategorijos
    ON produktai.kategorijos_id = kategorijos.id');

    // var_dump($products);

?>
<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sujungtu lenteliu atvaizdavimas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1>ĄČĘĖĮŠŲŪŽ</h1>
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Produkto pavadinimas</th>
                <th>Produkto aprašymas</th>
                <th>Produkto kaina</th>
                <th>Kategorijos pavadinimas</th>
            </tr>
            
                <?php foreach($products as $product) { ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['produkto_pavadinimas']; ?></td>
                        <td><?php echo $product['aprasymas']; ?></td>
                        <td><?php echo $product['kaina']; ?></td>
                        <td><?php echo $product['kategorijos_pavadinimas']; ?></td>
                    </tr>
                <?php }?>    
            
        </table>
        



    </div>
</body>
</html>