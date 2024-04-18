<main>
    <div class="clm">
      <div>
        <h2>Обратная связь</h2>
        <?php
    require_once "./views/admin/common/thead.html";
   ?>
   <tbody>
       <? foreach ($data as $item) : ?>
       <? $cnt=0; ?>
       <tr>
           <? foreach ($item as $columns) : ?>
           <? $cnt++; ?>
           <? if ($cnt == 7): ?>
              <?php
              $checked = '';
                if ($columns !== null){
                  $checked = "checked";
                }
              ?>
              <td><input type="checkbox" <?= $checked; ?> disabled> <?= $columns; ?></td>
            <? else: ?>
              <td><?= $columns; ?></td>
            <? endif; ?>
            

           <? endforeach; ?>
           <td>
           <? if ($checked == ""): ?>
               <a href="<?= $type . '/edit/' . $item[0]; ?>">Обработать</a>
               <? endif; ?>
               <a href="<?= $type . '/delete/' . $item[0]; ?>">Удалить</a>
           </td>
       </tr>
       <? endforeach; ?>
   </tbody>
 </table>
      </div>
    </div>
  </main>
  