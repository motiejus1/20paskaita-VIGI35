<?php
include("Products.php");
$productEntity = new Product();
$products = $productEntity->index();
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
        <p>Iš viso yra <?php echo $productEntity->total; ?> produktų</p>
        <p>Esame puslapyje <?php echo isset($_GET["page"]) ? $_GET["page"] : "1" ?>/<?php echo $productEntity->pages ?> </p>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php for ($i=1; $i <= $productEntity->pages; $i++ ) { ?>
                    <?php if((isset($_GET["page"]) && $_GET["page"] == $i) || (!isset($_GET["page"]) && $i == 1)) {  ?>
                    <li class="page-item active"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i ?></a></li>
                    <?php } else { ?>
                        <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i ?></a></li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </nav>
        <table class="table table-striped">
            <tr>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Product Line</th>
                <th>Qty</th>
                <th>Price</th>
            </tr>

            <?php foreach ($productEntity->products as $product) { ?>
                <tr>
                    <td><?php echo $product['productCode']; ?></td>
                    <td><?php echo $product['productName']; ?></td>
                    <td><?php echo $product['productLine']; ?></td>
                    <td><?php echo $product['quantityInStock']; ?></td>
                    <td><?php echo $product['buyPrice']; ?></td>
                </tr>
            <?php } ?>

        </table>


    </div>
</body>

</html>