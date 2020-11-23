<?php

use yii\helpers\Html;

?>
<div class="other_table_content_container">

<table class="table table-striped table-bordered detail-view">
  <tr>
    <th class="view_table_row_header">Специальности</td>
    <td>
    <?php 
      foreach ($model->medicalSpecialties as $spec) {
        ?> <span> <?= $spec['specialty_title'] ?>, <span>
        <?php
      }
    ?>
    </td>
  </tr>
</table>

</div>