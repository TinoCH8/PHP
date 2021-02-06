
<?php
session_start();
if(!isset($_SESSION['uData'])){
header("Location: ./login.php");
}

include "./php/conexion.php";
$resultado= $conexion->query("select * from usuarios order by id DESC")or die($conexion->error);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mi Tienda</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dashboard/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php include "./layouts/header.php"; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "./layouts/sidebar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Agregar Usuario</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        
          <div class="card-body">
              <?php
                if(isset($_GET['error'])){
                echo ''
              ?>
                  <div class="alert alert-danger">
                    <b>Error:</b>
                      <?php
                      echo $_GET['error'];
                      
                      ?>
                  </div>
                <?php
                }   
                if(isset($_GET['success'])){
              ?>
                  <div class="alert alert-success">
                    <b>Listo!</b>
                      <?php
                      echo $_GET['success'];
                      ?>
                  </div>
                <?php
                }   
              
        ?>
          <form action="./php/insertarUsuario.php" class="row" method="POST">
              <div class="col-4">
                  <label for="">Nombre</label>
                  <input type="text" class="form-control" placeholder="Inserta tu nombre" name="nom" id="txtNombre" required>
              </div>
              <div class="col-4">
                  <label for="">Apellido</label>
                  <input type="text" class="form-control" placeholder="Inserta tu apellido" name="ap" id="txtAP" required>
              </div>
              <div class="col-4">
                  <label for="">Email</label>
                  <input type="email" class="form-control" placeholder="Inserta tu email" name="email" required>
              </div>
              <div class="col-4">
                  <label for="">Password</label>
                  <input type="password" class="form-control" placeholder="Inserta tu password" name="p1" required>
              </div>
              <div class="col-4">
                      <label for="">Confirmar Password</label>
                      <input type="password" class="form-control" placeholder="confirma tu password" name="p2" required>
                  </div>
              <div class="col-4 p-2">
                      <br>
                      <button class="btn btn-primary"><i class="fa fa-plus"></i> insertar</button>                   
               </div>
          </form>
        </div>
        <!-- /.card-body -->
        
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

      <h2 class="subtitulo">Usuarios</h2>
          <table class="table">
              <thead>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th></th>
              </thead>
              <tbody>
                  <?php
                  
                    while($fila = mysqli_fetch_array($resultado)){

                  ?>
                  <tr>
                      <td><?php echo $fila['id'];  ?></td>
                      <td><?php echo $fila['nombre'].' '.$fila['apellido']; ?></td>
                      <td><?php echo $fila['email'];  ?></td>
                      <td>********</td>
                      <td> 
                          <button class="btn btn-sm btn-warning btnEdit" 
                          data-toggle="modal"
                          data-target="#modal-editar" 
                          data-id="<?php echo $fila['id'];  ?>"
                          data-nom="<?php echo $fila['nombre'];  ?>"
                          data-ap="<?php echo $fila['apellido'];  ?>"
                          data-email="<?php echo $fila['email'];  ?>" >
                            <i class="fa fa-edit"></i>
                          </button>
                      </td>
                      <td> 
                          <button class="btn btn-sm btn-danger btnEliminar" data-toggle="modal" 
                          data-target="#modal-eliminar" data-id="<?php echo $fila['id'];  ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                      </td>
                  </tr>
                  <?php              
              }
                  ?>
              </tbody>
          </table>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include "./layouts/footer.php"; ?>
   <!--MODAL ELIMINAR-->
   <div class="modal fade" id="modal-eliminar">
          <div class="modal-dialog">
            <div class="modal-content bg-danger">
              <div class="modal-header">
                <h4 class="modal-title">Eliminar Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form action="./php/eliminarUsuario.php" method="POST">
                <div class="modal-body">
                  <p>Deseas eliminar el usuario?</p>
                    <input type="hidden" id="idEliminar" name="id">
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-outline-light">Eliminar</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->          
    </div>  

    <!--MODAL Editar-->
    <div class="modal fade" id="modal-editar">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">editar Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
              <form action="./php/editarUsuario.php" method="POST">
                <div class="col-12">
                  <label for="">Nombre</label>
                  <input type="text" class="form-control" placeholder="inserta tu nombre" name="nom" id="nombreEdit" required>
                </div>
                <div class="col-12"> 
                  <label for="">Apellido</label>
                  <input type="text" class="form-control" placeholder="inserta tu Apellido" name="ap" id="apEdit" required> 
                </div>
                <div class="col-12">
                  <label for="">Email</label>
                  <input type="email" class="form-control" placeholder="inserta tu email" name="email" required id="emailEdit">
                </div>
                <div class="col-12">
                  <label for="">Password</label>
                  <input type="password" class="form-control" placeholder="inserta una password" name="p1">
                </div>   
                <div class="col-12">
                  <label for="">Confirmar Password</label>
                  <input type="password" class="form-control" placeholder="confirma tu password" name="p2">
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idEditar" name="id">
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->          
    </div>  





</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="./dashboard/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dashboard/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dashboard/dist/js/demo.js"></script>
<script>
      var idElimiar=0;  
      $(document).ready(function(){
      $(".btnEliminar").click(function(){
        idElimiar=$(this).data('id');
      $('#idEliminar').val(idElimiar);  
      });  
      $(".btnEdit").click(function(){
        var idEdit=$(this).data('id');
        var nombre=$(this).data('nom');
        var apellido=$(this).data('ap');
        var email=$(this).data('email');
        $('#nombreEdit').val(nombre);
        $('#apEdit').val(apellido);
        $('#emailEdit').val(email);
        $('#idEditar').val(idEdit);
      });
      });
    </script>
</body>
</html>
