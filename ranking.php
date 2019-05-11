<?php require 'head.php' ?>

<?php
$sql = $pdo->prepare("SELECT language_name FROM programming_language 
ORDER BY language_name");
$sql->execute();

if($sql->rowCount() >0){
    foreach($sql->fetchAll() as $language){
        $language_name = $language['language_name'];

        $sql = $pdo->prepare("SELECT programming_language.language_name FROM used_language 
        LEFT JOIN programming_language ON used_language.language_id =
        programming_language.language_id WHERE language_name = '$language_name'");
        $sql->execute();
        
        if($sql->rowCount() >0){
            $language = $sql->fetchAll(PDO::FETCH_COLUMN);
            $language_score = implode('', array_count_values($language));
            
            $ranking[$language_name] = $language_score;
            arsort($ranking);
        }     
    }
}
?> 
<body>
    <div class="container col-12">
        <header>
            <div class="title text-center">
                <h2><strong>Enquete</strong></h2>
                <br>
                <h4>Ranking</h4>
            </div>
            <div class="navbar">
                <a href="index.php">
                    <div class=" voltar col-1 btn btn-primary btn-radius">
                        Voltar
                    </div>
                </a>
                <a href="resultado.php">
                    <div class=" voltar col-1 btn btn-primary btn-radius">
                        resultado
                    </div>
                </a>
            </div>
        </header><br>
        <div class="row text-center">
            <br><br>
            <div class="col-12 text-center resultado">
                <h3>Linguagens usadas pelo grupo ordenadas por polularidade.</h3><br>
                <table class="table table-striped table-bordered table-hover text-center" >
                        <tr>
                            <th>Liguagem</th>
                            <th>Usuários</th>
                        </tr>
                        <?php
                        foreach($ranking as $language_name => $language_score){
                            echo '<tr>';
                            echo '<td>'.strtoupper($language_name).'</td>';   
                            echo '<td>'.$language_score.'</td>';         
                            echo '</tr>'; 
                        }
                        ?>
                </table>
            </div> <!-- /resultado -->
        </div>
    </div><!-- /container-fluid -->
   
    
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>