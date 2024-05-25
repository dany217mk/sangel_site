<main>
    <div class="clm">
      <div>
        <h2>Администраторы</h2>
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
                  <td><?= $columns; ?></td>
           <? endforeach; ?>
           <td>
             <? if ($item[0] != 1): ?>
               <a href="<?= $type . '/delete/' . $item[0]; ?>">Удалить</a>
             <? endif; ?>
           </td>
       </tr>
       <? endforeach; ?>
   </tbody>
 </table>
      </div>
  </main>
