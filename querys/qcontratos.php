<?php
    if(isset($data['results']) && is_array($data['results'])){
        foreach($data['results'] as $contrato){
          $id = htmlspecialchars($contrato['id']);
          $nombreContrato = htmlspecialchars($contrato['field_5217'] ?? 'N/A');
          $nombreCliente = "N/A";
        if(isset($contrato['field_5220']) && is_array($contrato['field_5220'])) {
        foreach($contrato['field_5220'] as $item) {
          if(isset($item['value'])) {
            $nombreCliente = htmlspecialchars($item['value']);
            break; // Salir del bucle una vez que se encuentra el valor
          }
        }
      }
      $nombreProducto = "N/A";
      if(isset($contrato['field_5222']) && is_array($contrato['field_5222'])) {
        foreach($contrato['field_5222'] as $item) {
          if(isset($item['value'])) {
            $nombreProducto = htmlspecialchars($item['value']);
            break; // Salir del bucle una vez que se encuentra el valor
          }
        }
      }
      $nombreProveedor = "N/A";
      if(isset($contrato['field_5224']) && is_array($contrato['field_5224'])) {
        foreach($contrato['field_5224'] as $item) {
          if(isset($item['value'])) {
            $nombreProveedor = htmlspecialchars($item['value']);
            break; // Salir del bucle una vez que se encuentra el valor
          }
        }
      }
      $medios = "N/A";
      if(isset($contrato['field_5226']) && is_array($contrato['field_5226'])) {
        foreach($contrato['field_5226'] as $item) {
          if(isset($item['value'])) {
            $medios = htmlspecialchars($item['value']);
            break; // Salir del bucle una vez que se encuentra el valor
          }
        }
      }
      $formaPago = "N/A";
      if(isset($contrato['field_5246']) && is_array($contrato['field_5246'])) {
        foreach($contrato['field_5246'] as $item) {
          if(isset($item['value'])) {
            $formaPago = htmlspecialchars($item['value']);
            break; // Salir del bucle una vez que se encuentra el valor
          }
        }
      }
          
    ?>
   <tr>
    <td>
    <?php echo "$id";?>
    </td>
    <td><?php echo "$nombreContrato";?></td>
    <td><?php echo "$nombreCliente";?></td>
    <td><?php echo "$nombreProducto";?></td>
    <td><?php echo "$nombreProveedor";?></td>
    <td><?php echo "$medios";?></td>
    <td><?php echo "$formaPago";?></td>
  
    <td><a href="#" class="btn btn-primary">Detail</a></td>
</tr>
    <?php
        }
    } else {
        echo "<tr><td colspan='9'>No se encontraron clientes</td></tr>";
    }
    ?>



