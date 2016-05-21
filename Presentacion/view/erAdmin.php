<?php //comprueba que la session este iniciada
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
//verifica si el usuario esta logueado
if ($_SESSION['signUp'] != 1) {
    header("Location: ../");
}; ?>
<!DOCTYPE html>
<html lang="en" spellcheck="true">

<head>
    <meta charset="utf-8">
    <title>The Escape</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="../img/logo.ico"/>
    <?php include 'head.php'; ?>
</head>

<body>
<!-- Menu -->
<?php include 'menu.php';
require '../../Logica/functions.php'; ?>

<!-- container body -->
<div class="container" id="admin-page">
    <div id="erAdmin-content">
        <p class="title_seccion">Administrator ER</p>


        <!-- Sub-Menu Nav tabs -->
        <div class="tabs_ER col-md-12">
            <a class="btn list-btn-profile" data-target="#addER" data-toggle="tab">Add Escape Room</a>
            <a class="btn list-btn-profile" data-target="#modifyER" data-toggle="tab">Modify Escape Room</a>
            <a class="btn list-btn-profile" data-target="#listER" data-toggle="tab">List Escape Room</a>
        </div>

        <div class="tab-content">

            <div class="tab-pane" id="addER">
                <div class="addER-content">
                    <div class="descrip col-md-12"> Descripcion de Agregar Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt
                          ut laoreet dolore magna aliquam erat
                        </div>
                    <form action="../../Logica/controller.php" method="POST" data-toggle="validator" id="addERAdmin"
                          role="form">
                        <div class="col-md-6">
                            <label for="add-new-ER">Name:</label>
                            <input class="label-adduser form-control" id="user-input" type="text"
                                   placeholder="Enter name" name="name" required="required">
                        </div>
                        <div class="col-md-6">
                            <label for="add-new-ER">Address:</label>
                            <input class="label-adduser form-control" id="user-input" type="text"
                                   placeholder="Enter Address" name="address" required="required">
                        </div>
                        <div class="col-md-6">
                            <label for="add-new-user"> Descrip: </label>
                            <textarea rows="10" cols="20" class="label-adduser form-control" id="user-input" type="text"
                                      placeholder="Enter ER Descrip" name="descrip" required="required"></textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="add-new-user">Mark: </label>
                            <input class="label-adduser form-control" id="user-input" type="number" min="1" max="10"
                                   placeholder="Mark" name="mark" required="required">
                        </div>
                        <div class="col-md-4">
                            <label for="add-new-user">Price: </label>
                            <input class="label-adduser form-control" id="user-input" type="number" placeholder="Price"
                                   name="price" required="required">
                        </div>
                        <div class="col-md-4">
                            <input type='submit' name='AddER' class="btn btn-default" value="Add"/>
                        </div>

                    </form>
                </div>
            </div>

            <div class="tab-pane" id="modifyER">
                <div class="modifyER-content">
                    <div class="descrip col-md-12"> Descripcion de MOdificar Lorem ipsum dolor sit amet, consectetuer adipiscing elit , sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat
                        </div>
                    <form action="../../Logica/controller.php" method="POST">

                        <div class="col-md-6">
                            <label for="change_ER"> Seleccionar el ER a modificar</label>
                            <!--CODIGO PHP QUE LISTA LOS ER DEL ADMINISTRADOR-->
                            <select name="list_er_modify" id="listERmodify">
                                <?php
                                $data = listDataEscapeRoom($_SESSION['username']);
                                if ($data != null) {
                                    $index = 0;
                                    foreach ($data as $value) {
                                        $dataER = explode("-", $value);
                                        echo "<option >" . $dataER[1] . "</option>> ";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="add-new-ER">Address:</label>
                            <input class="label-adduser form-control" id="user-input" type="text"
                                   placeholder="Enter Address" name="address" required="required">
                        </div>
                        <div class="col-md-6">
                            <label for="add-new-user">Descrip: </label>
                            <input class="label-adduser form-control" id="user-input" type="text"
                                   placeholder="Enter ER Descrip" name="descrip" required="required">
                        </div>
                        <div class="col-md-6">
                            <label for="add-new-user">Mark: </label>
                            <input class="label-adduser form-control" id="user-input" type="text" placeholder="Mark"
                                   name="mark" required="required">
                        </div>
                        <div class="col-md-6">
                            <label for="add-new-user">Price: </label>
                            <input class="label-adduser form-control" id="user-input" type="number" placeholder="Price"
                                   name="price" required="required">
                        </div>
                        <div class="col-md-6">
                            <label for="add-new-user">Duration: </label>
                            <input class="label-adduser form-control" id="user-input" type="number"
                                   placeholder="Duration" name="duration" required="required">
                        </div>
                        <input type='submit' name='ModER' class="btn btn-default" value="Modify"/>
                    </form>
                </div>
            </div>
            <div class="tab-pane active" id="listER">
                <div class="col-md-offset-1 col-md-10 listER-content">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Code Escape Room</th>
                            <th>Name</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $data = listDataEscapeRoom($_SESSION['username']);
                        if ($data != null) {
                            $index = 0;
                            foreach ($data as $value) {
                                $dataER = explode("-", $value);
                                echo "<tr>
                                            <td>" . $index . "</td>
                                            <td>" . $dataER[0] . "</td>
                                            <td>" . $dataER[1] . "</td>
                                            <td>" . $dataER[2] . "</td>
                                            </tr>";
                                $index++;
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <!--Borrar Escape Room-->
                    <div class="col-md-offset-8 col-md-4 erDelete" id="erDelete">
                        <form id="form_del" action="../../Logica/controller.php" method="POST">
                            <h6>Are you sure you want to delete this ER? </h6>
                            <input type="text" name="cod_er" placeholder="write the code ER">
                            <input type='submit' name='DelER' class="btn btn-default" value="Delete"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--FOOTER-->
<footer class="footer center">
    <?php include_once 'footer.php'; ?>
</footer>
</body>

</html>