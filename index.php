
<?php
    include('./conect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Pesquisar Veiculos </title>
</head>
<body>

    <div class="container">
        <h1>Pesquisar Veículos</h1>

        <div class="pesquisa">
            <form action="">
                <input placeholder="digite..." value='<?php if(isset($_GET['busca'])) echo $_GET['busca'];?>' type="text" name="busca">
                <button type='submit'>Buscar</button>
            </form>
        </div>

        <table>
            <tr>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Ano</th>
                <th>Cor</th>
            </tr>

            <?php
            if(!isset($_GET['busca'])) { 
            ?>

            <tr>
                <td colspan='4'>Digite algo para pesquisar</td>
            </tr>

            <?php 
             } else {
                $pesquisa = $mysqli->real_escape_string($_GET['busca']);
                $sql = "SELECT * FROM cars
                 WHERE modelo LIKE '$pesquisa%'
                  OR marca LIKE '$pesquisa%' 
                  OR ano LIKE  '$pesquisa' 
                  OR cor LIKE '$pesquisa' ";
                $sql_query = $mysqli->query($sql) or die("Erro ao consultar!!" . $mysqli->error);

                if($sql_query->num_rows == 0 ) { 
                   
         ?>

                    <tr>
                        <td colspan='4'>Nenhum resultado encontrado</td>
                    </tr>

        <?php 
                } else {
                    while($dados = $sql_query->fetch_assoc()) { 
                    ?>
                    <tr>
                        <td><?= $dados['modelo'] ?></td>
                        <td><?= $dados['marca'] ?></td>
                        <td><?= $dados['ano'] ?></td>
                        <td><?= $dados['cor'] ?></td>
                    </tr>
        <?php
                   }
               }
              
        ?>

        <?php
        
        } ?>

        </table>
    </div>

</body>
</html>