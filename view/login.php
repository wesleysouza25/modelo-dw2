<!DOCTYPE html>
<html>
    <head>
        <title>Sistema modelo</title>
        <meta charset="utf-8">
        <link href="../config/bootstrap-3.4.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="../config/js/jquery-3.4.0.min.js" type="text/javascript"></script>
        
        <link rel="stylesheet" type="text/css" href="../config/css/user.css">
        <script>
            $(document).ready(function () {

                // Click event of the showPassword button
                $('#mostrarSenha').on('click', function () {

                    // Get the password field
                    var passwordField = $('#password');

                    // Get the current type of the password field will be password or text
                    var passwordFieldType = passwordField.attr('type');

                    // Check to see if the type is a password field
                    if (passwordFieldType == 'password')
                    {
                        // Change the password field to text
                        passwordField.attr('type', 'text');
                    } else {
                        // If the password field type is not a password field then set it to password
                        passwordField.attr('type', 'password');
                    }
                });
            });
        </script>

    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <center>
                    <h3 class="header">Acesso ao sistema</h3>
                    <img src="../config/img/login.png" alt="usuário" width="150" />
                    <br/>
                    <br/>
                </center>

                <form id="login-form" action="../controller/login.php" method="post" >

                    <div class="form-group">
                        <input type="text" name="login" id="username" class="form-control" placeholder="Usuário">
                    </div>
                    <div class="input-group form-group">
                        <input type="password" name="senha" id="password" class="form-control" placeholder="password" /> 
                        <span class="input-group-addon"><a class="glyphicon glyphicon-eye-open" id="mostrarSenha" href="#"></a></span>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="submit" name="login-submit" id="login-submit" class="form-control" value="Entrar">
                            </div>
                            <div class="col-md-6">
                                <input type="submit" name="cadastrar" id="cadastrar-submit" class="form-control" value="Cadastrar">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </body>
</html>