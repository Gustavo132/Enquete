<?php require 'head.php' ?>

<body>
    <div class="container col-12">
        <header>
            <div class="title text-center">
                <h2>Enquete</h2>
                <h4>Quais linguagens de programação você usa?</h4>
            </div>
        </header><br>
        <div class="row text-centerv">
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
                Selecione a linguagem que você mais usa ou esta aprendendo.
            </div>
            <br><br>
        </div>
                <?php
                    if(isset($_POST['user_name']) && !empty($_POST['user_name'])
                    && isset($_POST['language_name']) && !empty($_POST['language_name'])){
                        $user_name = addslashes($_POST['user_name']);
                        $language_name = $_POST['language_name'];   
                        $languages = implode(', ', $language_name);

                        if(trim($user_name)==''){
                            echo '<div class="alert alert-warning">
                                <strong>Favor não preencher seu nome com em branco. </strong> 
                                <a href="index.php">
                                    <div class=" voltar col-1 btn btn-primary btn-radius">
                                        Voltar
                                    </div>
                                </a>
                            </div>';
                            exit();
                        }
                            
                        $sql = "SELECT user_name FROM user WHERE user_name = '$user_name'";
                        $sql = $pdo->query($sql);

                        if($sql->rowCount() >0){
                            echo '<div class="alert alert-warning text-center">
                                <strong>Usuário '.$user_name.' já cadastrado, favor inserir seu nome como esta no grupo DevAt. </strong>
                            </div>';
                        }else{
                            $sql = "INSERT INTO user SET user_name= '$user_name'";
                            $pdo->query($sql);
                            
                            foreach($language_name as $language){
                                $sql = "SELECT user.user_id, programming_language.language_id FROM user, programming_language 
                                WHERE user.user_name= '$user_name' AND programming_language.language_name= '$language'";
                                $sql = $pdo->query($sql);
                            
                                if($sql->rowCount() >0 ){
                                    $sql = $sql->fetch();
                                    $user_id = $sql['user_id'];
                                    $language_id = $sql['language_id'];

                                    $sql = "INSERT INTO used_language SET user_id = '$user_id', language_id= '$language_id'";
                                    $pdo->query($sql);
                                }
                            }
                            echo '<div class=" alert alert-success">
                            Obrigado por Participar '.$user_name.' :)
                            Você selecionou a(s) linguagen(s) '.strtoupper($languages).'</div>';
                        }
                    }
                ?>
             
            <form method="POST" onsubmit="return validation() ">
                <div class="row enquete ">
                    <div class=" insert_name col-md-4 text-center">
                        Digite seu nome da mesma forma que esta no grupo (DevAt)
                        <br>
                        <input class="col-md-10" type="text" name="user_name" id="user_name"  required placeholder="Seu Nome" >
                    </div><br>
                    
                    <div class="col-md-8 text-left ">
                        <div class="lista-linguagens">
                            <?php
                                $sql = "SELECT * FROM  programming_language ORDER BY language_name ASC ";
                                $sql = $pdo->query($sql);
                                if($sql->rowCount() >0 ){
                                    foreach($sql->fetchAll() as $language){
                                        echo '<div><input type="checkbox" name="language_name[]" value="'.$language['language_name'].'"> '.strtoupper($language['language_name']    ).' </div>';
                                    }
                                }
                            ?>   
                        </div>
                    </div>
                </div><!-- /row -->
                <br>
                <div class="col-12 submit-enquete" >
                    <a class="col-3" href="resultado.php">
                        <div class="voltar btn btn-primary btn-radius ">
                            Resultado
                        </div>
                    </a>
                    <input type="submit" class="btn btn-success btn-radius col-3" value="Confirmar">
                </div>
            </form>
        </div>-
    </div><!-- /container-fluid -->

    <script src="assets/js/script.js"></script>
    <script src="assets/js/jquery-3.3.1.mim.js"></script>
    <script src="assets/js/bootstrap.bundle.mim.js"></script>
</body>
</html>