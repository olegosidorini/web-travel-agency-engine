<?php
function init_files($start, $dbh){
  $result=$dbh->query('SELECT * FROM ve_pages WHERE id="'.$start.'" AND status="1"')->fetch(PDO::FETCH_ASSOC);
  $t_of_c = $dbh->query("SELECT * FROM ve_table_of_contents WHERE cid=".$result['cid']." AND status='1'")->fetch(PDO::FETCH_ASSOC);
  $photos = $dbh->query("SELECT * FROM ve_photos WHERE pid=".$t_of_c['id']." AND status='1' AND type='file'");

  $html='<table >';
  foreach($photos as $photo){
       $path=$photo['path'];
       $pos = strpos($path, '.');
      if ($pos){
        $type_file = substr($path,$pos+1);
        $pic_path="images/".$type_file;
        $html .= "
        <tr>
          <td width='20' align='left'>
            <a href='".$path."'><img  src='".$pic_path.".gif'  alt='".$photo['title']."' title='".$photo['title']."'></a>
          </td>
          <td align='left' style='vertical-align:middle;'>
            <a href='".$path."' style='font:normal 11px Arial, Helvetica, sans-serif;'>".$photos[$i][text]."</a>
          </td>
        </tr>";
      }
  }
  $html .="</table><br><br>";
  
  return $html;
  }
  