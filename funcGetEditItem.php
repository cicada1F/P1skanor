<?php


function get_edit_item_form(){
    // if ($_SESSION['status']==1)
    if ($_SESSION['status'] == 1 || $_SESSION['status'] == 2) {
        global $link;
        echo '<div class="d_cont">';
        
        $query = 'SELECT * FROM active WHERE id_act='.$_GET['id_act']; 
        $res = mysqli_query( $link, $query ) or die("Ошибка " . mysqli_error($link)); 
        $item = mysqli_fetch_array( $res ); 
        echo '<form name="editform" action="'.$_SERVER['PHP_SELF'].'?action=update&id_act='.$_GET['id_act'].'" method="POST">'; 
        
        echo '<br><table border="1" class="data_tbl">'; 
        echo '<tr>'; 
        echo '<td>Наименование</td>'; 
        echo '<td><input type="text" name="name" value="'.$item['name'].'"></td>'; 
        echo '</tr>';  

        echo '<tr>'; 
        echo '<td>Ссылка</td>'; 
        echo '<td><input type="text" name="linksite" value="'.$item['linksite'].'"></td>'; 
        echo '</tr>';  

        echo '<tr>'; 
        echo '<td>Выберите Услугу</td>'; 
        echo '<td><select name="id_cat">'; 
        $sql4 = 'SELECT * FROM category'; 
        $res4 = mysqli_query($link,$sql4) or die("Error in $sql4: " . mysqli_error($link));
        echo '<option value="" disabled selected>Выберите услугу</option>';
        while ($row = mysqli_fetch_array($res4)) { 
            $id_cat = intval($row['id_cat']); 
            $name_cat = htmlspecialchars($row['name_cat']); 
            if ($id_cat == $item['id_cat']) { 
                echo '<option value="' . $id_cat . '" selected>' . $name_cat . '</option>'; 
            } else { 
                echo '<option value="' . $id_cat . '">' . $name_cat . '</option>'; 
            } 
        }     
        echo "</select>\r\n";
        echo '</td>';

        echo '</tr>';  
        echo '<tr>'; 
        echo '<td>доп.услуги</td>'; 
        echo '<td><input type="text" name="ed_izm" value="'.$item['ed_izm'].'"></td>'; 
        echo '</tr>';  
        echo '<tr>'; 
        
        echo '</tr>';  
        echo '<tr>'; 
        echo '<td>Цена от</td>'; 
        echo '<td><input type="text" name="price" value="'.$item['price'].'"></td>'; 
        echo '</tr>';  

        echo '<tr>'; 
        echo '<td>Комментарий</td>'; 
        echo '<td><input type="text" name="comments" value="'.$item['comments'].'"></td>'; 
        echo '</tr>'; 

     // Объединение значений полей name и linksite
$name = $item['name'];
$linksite = $item['linksite'];
$formattedText = "<a href='$linksite'>$name</a>";

echo '<tr>'; 
echo '<td>Ссылка с названием</td>';
echo '<td><input type="hidden" name="name_act" value="'.$formattedText.'">';
echo $formattedText;
echo '</td>';
echo '</tr>';


		
	    echo '<tr align="center">'; 
	    echo '<td colspan=5><ul ><button type="submit">Сохранить</button></ul></td>';
	    echo '</tr>';
	    echo '</table>';
	    echo '</form>';
	    echo '</div>';
	    echo '<br>';
	} else {
	    echo '<meta http-equiv="refresh" content="0;URL=active.php">';
	}
	}
?>
