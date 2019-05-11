<?php require 'head.php' ?>
<body>
    <div class="container col-12">
        <header>
            <div class="title text-center">
                <h2>Enquete</h2>
                <h4>Quais linguagens de programação você usa?</h4>
            </div>
            <div class="navbar">
                <a href="index.php">
                    <div class=" voltar col-1 btn btn-primary btn-radius">
                        Voltar
                    </div>
                </a>
                <a href="ranking.php">
                    <div class=" voltar col-1 btn btn-primary btn-radius">
                        ranking
                    </div>
                </a>
            </div>
        </header><br>
        <div class="row text-center">
            <div class="col-12 text-left">
                <p class="text-center" >
                    Essa enquete tem o objetivo de descobrir quais as linguagens 
                    de programação os integrantes do grupo <strong>CyberMakers</strong> 
                    usam. Não importa se é pra trabalho, projeto pessoal ou ainda esta estudando.
                </p>
                <p class="text-center" >
                    Se sua linguagem não esta aqui, é só entrar em contato com Gustavo 👨🏻‍💻💻📱 
                    no grupo mesmo que assim que possível, atualizo a lista
                </p>
            </div><br><br>
            <div class="col-12 text-center">
                Lista dos participantes e suas respectivas linguagem.
            </div>
            <br><br>
            <div class="col-12 text-center resultado">
                <table class="table table-striped table-bordered table-hover text-center" >
                    <tr>
                        <th>Nome</th>
                        <th>Linguagem(ns)</th>
                    </tr>
                    <?php
                        $sql = "SELECT user_name, user_id FROM user";
                        $sql = $pdo->query($sql);
                        
                        if($sql->rowCount() >0 ){
                            foreach($sql->fetchAll() as $user){
                                $user_id = $user['user_id'];
                                $user_name = $user['user_name'];
                                
                                $sql = $pdo->prepare("SELECT programming_language.language_name FROM used_language 
                                LEFT JOIN programming_language ON used_language.language_id =
                                programming_language.language_id WHERE user_id = '$user_id'");
                                $sql->execute();
                                
                                if($sql->rowCount() >0){
                                    $language = $sql->fetchAll(PDO::FETCH_COLUMN);    
                                    $language = implode(', ', $language);
                                }
                                echo '<tr>';
                                echo '<td>'.$user_name.'</td>';
                                echo '<td>'.strtoupper($language).'</td>';      
                                echo '</tr>';    
                            }
                        }else{
                        echo '<div class="alert alert-warning">
                        Nenhum participante até agora :( seja o primeiro a contribuir.
                        </div>';}
                    ?>
                </table><br>
                
            </div> <!-- /resultado -->
        </div>
    </div><!-- /container-fluid -->
   
    
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>