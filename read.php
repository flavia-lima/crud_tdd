<?php
//Verificação da existência de um ID para prosseguir com a query.
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    require_once "config.php";
    
    
    $sql = "SELECT * FROM employees WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        //Seta os parâmetros.
        $param_id = trim($_GET["id"]);
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                $name = $row["name"];
                $address = $row["address"];
                $salary = $row["salary"];

                //Testa se nome e endereço são iguais. Espera-se FALSE como resultado.
                echo "Nome e Endereço são semelhantes? ------->";
                var_dump(hash_equals($name, $address));

            } else{
                //Caso a URL não tenha um parâmetro ID válido, redireciona para a página de erro.
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Algo deu errado. Tente novamente em instantes.";
        }
    }
     
    //Fecha o stmt.
    mysqli_stmt_close($stmt);
    
    //Fecha a conexão.
    mysqli_close($link);
} else{
    //Caso a URL não tenha um parâmetro ID válido, redireciona para a página de erro.
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalhes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Detalhes do Funcionário</h1>
                    </div>
                    <div class="form-group">
                        <label>Nome</label>
                        <p class="form-control-static"><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Endereço</label>
                        <p class="form-control-static"><?php echo $row["address"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Salário</label>
                        <p class="form-control-static"><?php echo $row["salary"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Voltar</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>