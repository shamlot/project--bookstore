<?php
$def_charset = "Content-Type: text/html; charset=utf-8";($def_charset);
$link = @mysql_connect("localhost", "root") or die("Невозможно соединиться с сервером");
$db=@mysql_select_db("Вookstore") or die("Нет такой базы данных");
@mysql_query("SET SESSION character_set_results = cp1251;");
@mysql_query("SET SESSION Character_set_client = cp1251;");
@mysql_query("SET SESSION Character_set_results = cp1251;");
@mysql_query("SET SESSION Collation_connection = cp1251_general_ci;");
@mysql_query("SET SESSION Character_set_connection = cp1251;");createXMLElem($dom, $parent, $row, $name)
{
    $elem = $dom->createElement($name);
    $elem = $parent->appendChild($elem);($row as $fieldname => $fieldvalue)
    {
    $val = iconv('windows-1251', 'utf-8', $fieldvalue);
    $elem->setAttribute($fieldname,$val);
    }$elem;
    }
    $g = $_POST['g'];
    $g_query="SELECT `ID`, `name` FROM `Genre` where `ID`=".$g;
    $b_query="SELECT `fio`, `name`, `price`, `genre` FROM `Books`";
    $xml = new DOMDocument('1.0');
    $root = $xml->createElement('Вookstore');
    $root = $xml->appendChild($root);
    $g=mysql_query($g_query);($g_row = mysql_fetch_assoc($g))
    {
    
    $g_elem = createXMLElem($xml, $root, $g_row, 'Genre');	
    $g1 = $g_row['ID'];
    $b=mysql_query($b_query);($b_row = mysql_fetch_assoc($b))
    {
    $g2 = $s_row['genre'];($g1==$g2)
    {
    $b_elem = createXMLElem($xml, $g_elem, $b_row, 'Books');
    }
    }
    }$xml->save("file.xml");
    ?>
    