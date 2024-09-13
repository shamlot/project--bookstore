$def_charset = "Content-Type: text/html; charset=utf-8";($def_charset);
$link = @mysql_connect("localhost", "root") or die("Невозможно соединиться с сервером");

$db=@mysql_select_db("Вookstore") or die("Нет такой базы данных");
@mysql_query("SET SESSION character_set_results = cp1251;");
@mysql_query("SET SESSION Character_set_client = cp1251;");
@mysql_query("SET SESSION Character_set_results = cp1251;");
@mysql_query("SET SESSION Collation_connection = cp1251_general_ci;");
@mysql_query("SET SESSION Character_set_connection = cp1251;");
$g_query="select `ID`, `name` from `Genre`";createXMLElem($dom, $parent, $row, $name)
{
$elem = $dom->createElement($name);
$elem = $parent->appendChild($elem);($row as $fieldname => $fieldvalue)
{
$val = iconv('windows-1251', 'utf-8', $fieldvalue);
$elem->setAttribute($fieldname,$val);
}$elem;
}
$xml = new DOMDocument('1.0');
$root = $xml->createElement('Вookstore');
$root = $xml->appendChild($root);
$g=mysql_query($g_query);($g_row = mysql_fetch_assoc($g))
{
$g_elem = createXMLElem($xml, $root, $g_row, 'Genre');	
}$xml->save("newfile.xml");
?>
