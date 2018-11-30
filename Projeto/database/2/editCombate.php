<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href= "http://www.pngall.com/wp-content/uploads/2016/04/Database-PNG.png">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>Editar Meio de Combate</title>
        <style>
            body{
                background-color: #474747;
            }
            h3{
                color: white;
                text-align: center;
            }
            h6{
                color: white;
                text-align: center;
                margin-left: 130;
                margin-right: 130;
            }
            img{
                cursor: pointer;
            }
            a{
                margin: 1;
            }
            table{
                color: white;
                margin: 0 auto;
            }
            .centered{
                margin: 20 auto;
            }
            .leftie{
                margin: 10 10;
            }
        </style>
    </head>
    <body>

    <?php 
        echo($_REQUEST['type']);
    ?>
        
        <div class="leftie">
            <a href="combate.php"><button type="button" class="btn btn-primary">Back</button></a>
        </div>

        <div class="centered">
            <h3>Editar Meio de Combate:</h3>
            <form action='edit.php' method='post'>
                <h6>Nº: <?php $_REQUEST['num']?> </h6>
                <h6>Novo Nome: <input type='text' name='new_name' required='required'/> </h6>
                <h6>Entidade: <?php $_REQUEST['entidade']?> </h6>
                <h6><input class="btn btn-success" type="submit" value="Submit"/> </h6>
            </form>
        </div>

        <?php 

        if( isset($_REQUEST['new_name'])){
            try
            {           
                $new_name  = $_REQUEST['new_name'];
                $num       = $_REQUEST['num'];
                $ent       = $_REQUEST['entidade'];

                $host = "db.ist.utl.pt";
                $user ="ist186512";
                $password = "fico6299";
                $dbname = $user;
            
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                $sql = "UPDATE meio SET nomemeio = :new_name WHERE nummeio = :num AND nomeentidade = :entidade);";
            
                $result = $db->prepare($sql);
                $result->execute([':new_name' => $new_name, ':num' => $num, ':entidade' => $ent]);
            
                $db = null;

                $newURL = 'combate.php';
                header('Location: '.$newURL);
            }
            catch (PDOException $e)
            {
                $type = $e->getCode();
            }
        }

        ?>
            
    </body>
</html>
