<main>
    <div class="clm">
      <div>
        <h2>Продукты</h2>
        <a href="<?= './' . $type . '/add'?>" class="link_add">Добавить</a></div>
        <?php
    require_once "./views/admin/common/thead.html";
   ?>
   <tbody>
       <? foreach ($data as $item) : ?>
       <? $cnt=0; ?>
       <tr>
           <? foreach ($item as $columns) : ?>
              <? $cnt++; ?>
             <? if ($cnt == 4): ?>
                  <td><img src="<?=IMG_PRODUCT .  '/' . $columns?>"></td>
              <? else: ?>
                  <td><?= $columns; ?></td>
              <? endif; ?>
           <? endforeach; ?>
           <td>
               <a href="<?= $type . '/edit/' . $item[0]; ?>">Редактировать</a>
               <a href="<?= $type . '/delete/' . $item[0]; ?>">Удалить</a>
           </td>
       </tr>
       <? endforeach; ?>
   </tbody>
 </table>
      </div>
  </main>
