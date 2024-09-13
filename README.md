# project-bookstore
Создаю Web-версию книжного магазина

В ходе выполнения работы мной были созданы XSL-спецификации трансформации «Default.xsl» и «Browse.xsl». Листинги программного кода данных файлов представлены ниже:
. Листинг кода файла «Default.xsl»:
<?xml version="1.0" encoding="windows-1251" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<HTML xmlns="http://www.w3.org/1999/xhtml" >
<HEAD>
<TITLE>Магазин книг</TITLE>
<LINK href="images/style.css" rel="stylesheet" type="text/css"/>
</HEAD>
<BODY style="font-size: 12pt">
<form action="file.xml" method="get" name="ff">
<TABLE class="pageborder" border="0" width="600">
<TR>
<TD width="100%">
<SPAN class="text1">Магазин книг</SPAN>
<BR/>
<HR class="line"/><HR class="line" width="70%" align="left"/>
</TD>
</TR>
<TR>
<TD style="height: 17px; text-align: right;" width="100%">
<SPAN style="color: #ff0000; font-size:13pt; font-family: 'Century Schoolbook'">Выбор &#160;</SPAN>
<SPAN style="color: #669999; font-size:13pt; font-family: 'Century Schoolbook'"><A href="javascript:document.ff.submit();" style="text-decoration:
 none">Просмотр</A></SPAN>
</TD>
         </TR>
<TR>
<TD><BR/>
<TABLE align="center" width="550">
<TR height="50px" valign="top">
<TD style="width: 163px"><SPAN class="text3">Жанр</SPAN></TD>
<TD>
<select name="Genre" style="width: 350px">
<option value="0" selected="selected">Выбор жанра...</option>
<xsl:for-each select="Bookstore/Genre">
<option>
<xsl:attribute name="value">
<xsl:value-of select="@ID"/>
</xsl:attribute>
<xsl:value-of select="@name"/>
</option>
</xsl:for-each>
</select>
</TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</form>
</BODY>
</HTML>
</xsl:template>
</xsl:stylesheet>
. Листинг кода файла «Browse.xsl»:
<?xml version="1.0" encoding="windows-1251" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<HTML xmlns="http://www.w3.org/1999/xhtml" >
<HEAD>
<TITLE>Магазин книг</TITLE>
<LINK href="images/style.css" rel="stylesheet" type="text/css"/>
</HEAD>
<BODY style="font-size: 12pt">
<TABLE class="pageborder" border="0" width="600">
<TR>
<TD width="100%">
<SPAN class="text1">Магазин книг</SPAN>
<BR/>
<HR class="line"/><HR class="line" width="70%" align="left"/>
</TD>
</TR>
<TR>
<TD style="height: 17px; text-align: right;" width="100%">
<SPAN style="color: #669999; font-size:13pt; font-family: 'Century Schoolbook'">
<A href="newfile.xml" style="text-decoration: none">Выбор</A> &#160;</SPAN>
<SPAN style="color: #ff0000; font-size:13pt; font-family: 'Century Schoolbook'">Просмотр</SPAN>
</TD>
</TR>
<TR>
<TD><BR/>
<TABLE width="500" align="center" class="headborder">
<TR>
<TD width="30%"><SPAN class="headtext">Автор</SPAN></TD>
<TD width="40%" align="center"><SPAN class="headtext">Название</SPAN></TD>
<TD width="10%" align="center"><SPAN class="headtext">Цена</SPAN></TD>
<TD width="20%" align="center"><SPAN class="headtext">Жанр</SPAN></TD>
</TR>
</TABLE>
<TABLE width="500" align="center" class="textborder">
<TR>
<TD width="30%"><SPAN class="tabletext"></SPAN></TD>
<TD width="40%" align="center"><SPAN class="tabletext"></SPAN></TD>
<TD width="10%" align="center"><SPAN class="tabletext"></SPAN></TD>
<TD width="20%" align="center"><SPAN class="tabletext"></SPAN></TD>
</TR>
</TABLE>

<xsl:for-each select="Books/Books/Books/Genre">
<TD width="30%"><SPAN class="tabletext"><xsl:value-of select="../@fio"/></SPAN></TD>
<TD width="40%" ><SPAN class="tabletext"><xsl:value-of select="@name"/></SPAN></TD>
<TD width="10%" ><SPAN class="tabletext"><xsl:value-of select="@price"/></SPAN></TD>
<TD width="20%" ><SPAN class="tabletext"><xsl:value-of select="@genre"/></SPAN></TD>
</xsl:for-each>
</TD>
</TR>
</TABLE>
</BODY>
</HTML>
</xsl:template>
</xsl:stylesheet>
Программирование серверных сценариев
На данном этапе работы была применена «технология PHP и СУБД MySQL». Были созданы следующие файлы:
«Index.php»: <?php
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
При проверке работоспособности созданного PHP-сценария результат, представленный в файле, имел следующий вид:
<Вookstore>
<Genre ID="Приключения" name="приключения">
</Genre>
<Genre ID="Детектив" name="детектив">
</Genre>
<Genre ID="Роман" name="любовный роман">
</Genre>
<Genre ID="Мемуары" name="биография и мемуары">
</Genre>
</Вookstore>
. «Browse.php»:
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
При проверке работоспособности созданного PHP-сценария результат, представленный в файле, имел следующий вид:
<Books>
<Genre ID="Приключения" >
<Books fio="Марк Твен" name="Приключения Гекльберри Финна" price="$5.49" />
<Books fio="Майкл Морпупго" name="Боевой конь" price="$6.10" />
</Genre>
<Genre ID="Детектив" >
<Books fio="Натаниэль Готорн" name="Мраморный фавн" price="$10.95" />
</Genre>
<Genre ID="Роман" >
<Books fio="Сесилия Ахерн" name="Время моей жизни" price="$5.00" />
</Genre>
<Genre ID="Мемуары" >
<Books fio="Шифф Стейси" name="Клеопатра" price="$6.10" />
</Genre>
</Books>
   В итоге мной было разработано Web-приложение «Книжный магазин», состоящее из двух Web-страниц. На первой странице пользователь должен выбирать жанр произведений из раскрывающегося списка. Передача выбранных пользователем параметров на сервер выполняется нажатием на ссылку «Просмотр».
В результате выполняется переход на страницу, где отображается информация о книгах выбранного жанра.
Таким образом, нами были закреплены навыки XSL-трансформации XML-данных в Web-приложениях.
