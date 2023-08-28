
<div class="d-flex gap-2 justify-content-center">
  <a href="/nomina/?var=empleados/nuevo" class="btn btn-primary" type="button">Nuevo</a>
</div>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Número</th>
      <th scope="col">Nombre</th>
      <th scope="col">Rol</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($empleados as $empleado){
    ?>
      <tr>
        <th scope="row"><?php echo $empleado['numero']; ?></th>
        <td><?php echo $empleado['nombre']; ?></td>
        <td><?php echo $empleado['rol']; ?></td>
        <td>
          <a style="border:none;" href="nominas/?var=empleados/editar/<?php echo $empleado['numero']; ?>">
            <?php echo $edit_svg; ?>
          </a>
          <a style="border:none;" href="nominas/?var=empleados/borrar/<?php echo $empleado['numero']; ?>">
            <?php echo $delete_svg; ?>
          </a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<!--
  <div class="d-flex gap-2 justify-content-center">
  <br style="clear: both;">
  <form>
  <div class="form-group">
    <label for="numero_empleado">Número</label>
    <input type="text" class="form-control" id="numero_empleado" placeholder="Ingresa número de empleado">
    <label for="nombre_empleado">Nombre</label>
    <input type="text" class="form-control" id="nombre_empleado" placeholder="Ingresa nombre del empleado">
  </div>
  <div class="form-group">
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="empleado_chofer" value="chofer">
    <label class="form-check-label" for="empleado_chofer">Chofer</label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="empleado_cargador" value="cargador">
    <label class="form-check-label" for="empleado_cargador">Cargador</label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="empleado_auxiliar" value="auxiliar">
    <label class="form-check-label" for="empleado_auxiliar">Auxiliar</label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
</div>
-->