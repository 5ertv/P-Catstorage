<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2023-Presente <a href="../index.php">CATSTORAGE</a></strong> Todos los derechos reservados.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
<!-- select2 -->
<script src="../js/select2.js"></script>
<!-- sweetalert2 -->
<script src="../js/sweetalert2.js"></script>
</body>
<script>
  let funcion = 'devolver_avatar';
  $.post('../controlador/UsuarioController.php',{funcion},(response)=>{

      const avatar = JSON.parse(response);
    $('#avatar4').attr('src','../img/'+avatar.avatar);
  })
   funcion='tipo_usuario';
   $.post('../controlador/UsuarioController.php',{funcion},(response)=>{
     if(response==1){
      $('#ver_analisis1').hide();
       $('#ver_analisis').hide();
     }
     else if(response==2){
       $('#administrar_proveedor').hide();
       $('#ver_analisis').hide();
       $('#administrar_producto').hide();
       $('#administrar_lotes').hide();
       $('#administrar_proveedor1').hide();
       $('#ver_analisis1').hide();
       $('#administrar_producto1').hide();
       $('#administrar_lotes1').hide();
       $('#administrar_usuario').hide();
     }  
   })
</script>
</html>