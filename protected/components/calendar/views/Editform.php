<?php
echo   '<form method="post" id="cal-edit-form">
          <input id="cal-edit-input-title" class="cal-edit-data-element" type="text" name="edited_title" value="'.$form['field']['title'].'" placeholder="">
          <select id="cal-edit-select-type" class="cal-edit-data-element cal-edit-type" name="edited_type" size="1">';
            for ($i=0; $i < count($form['users']['event']); $i++) {
              if (mb_strtolower($form['users']['event'][$i]['name'], 'UTF-8') == $form['field']['type']) {
echo            '<option selected value="'.$form['users']['event'][$i]['name'].'">'.$form['users']['event'][$i]['name'].'</option>';       
              } else {
echo            '<option value="'.$form['users']['event'][$i]['name'].'">'.$form['users']['event'][$i]['name'].'</option>';              
              }

            }
echo        '</select>
          <input id="cal-edit-input-date" class="cal-edit-data-element" type="text" name="edited_date" value="'.date('d/m/Y', strtotime($form['field']['date'])).'" placeholder="">
          <select id="cal-edit-select-user" class="cal-edit-data-element cal-edit-type" name="edited_user" size="1">';
            for ($i=0; $i < count($form['users']['users']); $i++) {
              if ($form['users']['users'][$i]['id'] == $form['field']['link_user']) {
echo            '<option selected value="'.$form['users']['users'][$i]['id'].'">'.$form['users']['users'][$i]['name'].'</option>';       
              } else {
echo            '<option value="'.$form['users']['users'][$i]['id'].'">'.$form['users']['users'][$i]['name'].'</option>';              
              }
            }
echo     '</select>
          <textarea id="cal-edit-textarea-text" class="cal-edit-data-element cal-edit-textarea" name="edited_text">'.$form['field']['text'].'</textarea>
          <input id="cal-edit-button-save" type="submit" name="" value="Сохранить" event_id="'.$event_id.'">
        </form>';
echo '<script src="../js/saveAndCancel.js" type="text/javascript"></script>';

