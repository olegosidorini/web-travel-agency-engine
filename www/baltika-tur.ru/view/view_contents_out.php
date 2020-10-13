<?php
require_once "view_files_out.php";

function init_contents($start, $dbh){
  $result=$dbh->query('SELECT * FROM ve_pages WHERE id="'.$start.'" AND status="1"')->fetch(PDO::FETCH_ASSOC);
  if($result['type'] == "obr"){
    $root=$dbh->query('SELECT * FROM ve_pages WHERE id="'.$result['pid'].'" ')->fetch(PDO::FETCH_ASSOC);
    $root=$dbh->query('SELECT * FROM ve_pages WHERE id="'.$root['pid'].'" ')->fetch(PDO::FETCH_ASSOC);
    $html_out = '
      <a href="'.HOST_STRING.'" class="link">Главная</a>
      &nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.HOST_STRING.'?id='.$root['id'].'"  class="link">'.$root['name'].'</a>
      &nbsp;&nbsp;|&nbsp;&nbsp;'.$result['name'].'<br><br><br>';
  }
  else $html_out = '';
  $tp_cont = $dbh->query("SELECT * FROM ve_contents WHERE id=".$result['cid']." AND status='1'")->fetch(PDO::FETCH_ASSOC);
  $name=$tp_cont['name'];
  $t_of_c = $dbh->query("SELECT * FROM ve_table_of_contents WHERE cid=".$tp_cont['id']." AND status='1'")->fetch(PDO::FETCH_ASSOC);
  $descr = $dbh->query("SELECT * FROM ve_descriptions WHERE pid=".$t_of_c['id']." AND status='1'");
  $count = count($descr);
  $html='';
  $html .= init_files($start,$dbh);
  $search1 = chr(13);
  $search2 = chr(10);
  $replace = "<br>";
  foreach($descr as $val){
    $html .= "<p><strong class='br'>".$val['title']."</strong><br>";
    $str = $val['text'];
    if ($str){
      $str = str_replace($search1, $replace, $str);
      $str = str_replace($search2, $replace, $str);
      $html .= $str;
    }
    $html .= "</p>";
  }
  
  
  $html_out.='
  <div class="wrapper-title">
    <div class="corner-top-left">
      <div class="corner-top-right">
        <div class="corner-bottom-left">
          <div class="corner-bottom-right clear">
            <div class="wrapper-title-bull">
              <div class="wrapper-title-indent">
                <div class="clear title-border contentpaneopen">
                  <div class="fright">
                    <div class="icon-indent"></div>
                  </div>

                </div>
              <div class="clear contentpaneopen"></div>
            </div>
          </div>
        <div class="content-text">
          <div class="clear">
            <table class="contentpaneopen">
              <tbody>
                <tr>
                  <td colspan="2" class="article_indent" valign="top">
                    <div class="clear">'.$html.'
                      <div></div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="indent-article-separator"><span class="article_separator">&nbsp;</span></div>
      </div>
    </div>
  </div>';
  
  return $html_out;
  }
  

  