<?php
  session_start();
  if(!isset($_SESSION['uData'])){
  header("Location: ./login.php");
  }
  include "./php/conexion.php";

  $resultado= $conexion->query("select * from productos order by id DESC")or die($conexion->error);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi tienda</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../dashboard/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dashboard/dist/css/adminlte.min.css">
  </head>
  <body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
    
    <!-- Navbar -->
    <?php include "./layouts/header.php"?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include "./layouts/sidebar.php"?>
  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>
                  Producto
              </h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Agregar producto</h3>

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
              <form action="./php/insertarProducto.php" class="row" method="POST" enctype="multipart/form-data">
                  <div class="col-4">
                      <label for="">Nombre</label>
                      <input type="text" class="form-control" placeholder="inserta tu nombre" name="nom" id="txtnombre" required>
                  </div>
                  <div class="col-4"> 
                      <label for="">precio</label>
                      <input type="number" class="form-control" placeholder="inserta el precio" name="precio" id="txtprecio" required> 
                  </div>
                  <div class="col-4">
                      <label for="">inventario</label>
                      <input type="number" class="form-control" placeholder="inserta el inventario" min="1" name="inventario" required>
                  </div> 
                  <div class="col-4">
                      <label for="">Imagen</label>
                      <input type="file" class="form-control" placeholder="inserta una password" name="imagen" required>
                  </div>  
                  <div class="col-12 p-2">
                  <br>
                  <button class="btn btn-primary"><i class="fa fa-plus"></i> insertar</button>                   
                  </div>

              </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <h2 class="subtitulo">Productos</h2>
          <table class="table">
              <thead>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>precio</th>
                  <th>inventario</th>
                  <th></th>
              </thead>
              <tbody>
                  <?php
                  
                    while($fila = mysqli_fetch_array($resultado)){

                  ?>
                  <tr>
                      <td><?php echo $fila['id'];  ?></td>
                      <td> 
                      <img src="./img/product/<?php echo $fila['imagen']?>" width="50px" height="50px" alt="">
                      <?php echo $fila['nombre']?></td>
                      <td><?php echo $fila['precio'];  ?></td>
                      <td><?php echo $fila['inventario'];  ?></td>
            
  
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

    <?php include "./layouts/footer.php"?>
  
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




    
    <!-- jQuery -->
    <script src="../dashboard/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dashboard/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dashboard/dist/js/demo.js"></script>
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

