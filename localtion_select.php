<?php
header("content-type: text/html; charset=utf-8");
header ("Expires: Wed, 21 Aug 2013 13:13:13 GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");

include "connect.php";

$data = $_GET['data'];
$val = $_GET['val'];
$pointer = $_GET['pointer'];

if ($data=='province') {
  echo "<select name='province' class='form-control' onChange=\"dochange('amphur', this.value,'')\">";
  $result=mysql_query("select * from province order by PROVINCE_NAME");
  while($row = mysql_fetch_array($result)){?>
    <option value='<?=$row["PROVINCE_ID"]?>' <?if($pointer == $row["PROVINCE_ID"]){echo "selected";}?>><?=$row["PROVINCE_NAME"]?></option>
    <?
    //echo "<option value='$row[PROVINCE_ID]'",if($pointer == $row["PROVINCE_ID"]){echo "selected";}," >$row[PROVINCE_NAME]</option>" ;
  }
} else if ($data=='amphur') {
  echo "<select name='amphur' class='form-control' onChange=\"dochange('district', this.value,'')\">";
  $result=mysql_query("SELECT * FROM amphur WHERE PROVINCE_ID= '$val' ORDER BY AMPHUR_NAME");
  while($row = mysql_fetch_array($result)){?>
    <option value='<?=$row["AMPHUR_ID"]?>' <?if($pointer == $row["AMPHUR_ID"]){echo "selected";}?>><?=$row["AMPHUR_NAME"]?></option>
    <?
    //echo "<option value=\"$row[AMPHUR_ID]\" >$row[AMPHUR_NAME]</option> " ;
  }
} else if ($data=='district') {
  echo "<select name='district' class='form-control'>\n";
  $result=mysql_query("SELECT * FROM district WHERE AMPHUR_ID= '$val' ORDER BY DISTRICT_NAME");
  while($row = mysql_fetch_array($result)){?>
    <option value='<?=$row["DISTRICT_ID"]?>' <?if($pointer == $row["DISTRICT_ID"]){echo "selected";}?>><?=$row["DISTRICT_NAME"]?></option>
    <?
    //echo "<option value=\"$row[DISTRICT_ID]\" >$row[DISTRICT_NAME]</option> \n" ;
  }
}
echo "</select>\n";

echo mysql_error();

?>
