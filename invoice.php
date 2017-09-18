
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<link rel="stylesheet" href="css/table_amount.css" type="text/css">
<style>
.element
{
    text-shadow: 0px 0px 1px rgba(0, 0, 0, 0.75);
    color: #0080ff;
    font-size:24px;
	font-weight:bold;
	padding:1px 1px 1px 1px;
}
.text_header{ font-family:Tahoma, Geneva, sans-serif;
font-size:30px;
text-align:center;
color:#F00;
font-weight:bold;
text-align:center;
margin:0px  0px 5px 0px;
width:500px;
background-color:#FF0;
border:3px solid #F00;
border-radius:1em;
	
}
.text_header:hover {
	background-color:#F00;
	color:#FFF;
	border:3px solid #000;
	
	}
	
	.myTable { background-color:#FFF;border-collapse:collapse;}
.myTable th { background-color:#000044; color:white; }
.myTable td, .myTable th { padding:5px;border:1px solid #000011; text-align:center;}
</style>



<? include("config.php");
date_default_timezone_set('Asia/Bangkok');
?>
<?
$che="$";
if ($_POST['month'] <>'') {
	$month = $_POST['month'];
	}else{
	$month	=  date("m");
		}
		
if ($_POST['years'] <>'') {
	$years = $_POST['years'];
	}else{
	$years	=  date("Y");
		}
		
		
if 	($month==1) {$month_text = "มกราคม";}	
if 	($month==2) {$month_text = "กุมภาพันธ์";}	
if 	($month==3) {$month_text = "มีนาคม";}
if 	($month==4) {$month_text = "เมษายน";}	
if 	($month==5) {$month_text = "พฤษภาคม";}	
if 	($month==6) {$month_text = "มิถุนายน";}
if 	($month==7) {$month_text = "กรกฎาคม";}	
if 	($month==8) {$month_text = "สิงหาคม";}	
if 	($month==9) {$month_text = "กันยายน";}	
if 	($month==10) {$month_text = "ตุลาคม";}	
if 	($month==11) {$month_text = "พฤศจิกายน";}	
if 	($month==12) {$month_text = "ธันวาคม";}	


$sql="SELECT [SGD Inter Trading Co_,Ltd".$che."Cust_ Ledger Entry].[Document Type], [SGD Inter Trading Co_,Ltd".$che."Cust_ Ledger Entry].[Posting Date], [SGD Inter Trading Co_,Ltd".$che."Cust_ Ledger Entry].[Document No_], [SGD Inter Trading Co_,Ltd".$che."Customer].No_, [SGD Inter Trading Co_,Ltd".$che."Customer].Name, [SGD Inter Trading Co_,Ltd".$che."Cust_ Ledger Entry].[Salesperson Code]
FROM [SGD Inter Trading Co_,Ltd".$che."Cust_ Ledger Entry] INNER JOIN [SGD Inter Trading Co_,Ltd".$che."Customer] ON [SGD Inter Trading Co_,Ltd".$che."Cust_ Ledger Entry].[Customer No_] = [SGD Inter Trading Co_,Ltd".$che."Customer].No_
WHERE ((([SGD Inter Trading Co_,Ltd".$che."Cust_ Ledger Entry].[Document Type]) In (2,3)) AND (([SGD Inter Trading Co_,Ltd".$che."Cust_ Ledger Entry].[Salesperson Code])='".$_GET['code']."') AND ((Year([Posting Date])) In (".$_GET['year'].")) AND ((Month([Posting Date])) In (".$_GET['month'].")))";

$rs = odbc_exec($Conn,$sql);
$I=0;
?>
<div class="element">Sales Invoice / Credit Memo by Salesperson</div>
<div class="element">บริษัท เอส.จี.ดี.อินเตอร์ เทรดดิ้ง</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="myTable">
  <tr>
    <td width="54" bgcolor="#66FFFF">ลำดับ</td>
    <td width="163" bgcolor="#66FFFF">เลขที่เอกสาร</td>

    <td width="167" bgcolor="#66FFFF">วันที่เอกสาร</td>

    <td width="381" bgcolor="#66FFFF">ชื่อลูกค้า</td>
    <td width="96" bgcolor="#66FFFF">ก่อนภาษี</td>
    <td width="91" bgcolor="#66FFFF">ภาษี</td>
    <td width="102" bgcolor="#66FFFF">รวมภาษี</td>
  </tr>
 <?  while (odbc_fetch_row($rs)){ 
$dateList = odbc_result($rs,"Posting Date"); 
$NewDate_sho =date("d-m-y",strtotime(str_replace('/', '-',$dateList)));

 $sql_Search="SELECT Sum([SGD Inter Trading Co_,Ltd".$che."Detailed Cust_ Ledg_ Entry].Amount) AS SumOfAmount
From [SGD Inter Trading Co_,Ltd".$che."Detailed Cust_ Ledg_ Entry]
WHERE ((([SGD Inter Trading Co_,Ltd".$che."Detailed Cust_ Ledg_ Entry].[Document No_])='".odbc_result($rs,'Document No_')."'))";
$rs_search = odbc_exec($Conn,$sql_Search);
if (odbc_result($rs_search,'SumOfAmount') <>0){
$amount_invat=	number_format(odbc_result($rs_search,'SumOfAmount'),2);
$vat = number_format((odbc_result($rs_search,'SumOfAmount')/107)*7,2);
$amount=number_format(odbc_result($rs_search,'SumOfAmount')-(odbc_result($rs_search,'SumOfAmount')/107)*7,2);
	}else{
		$amount_inva=0;
		$vat=0;
		$amount=0;
		}

 $sql_Open="Select [Open] as ok from  [SGD Inter Trading Co_,Ltd".$che."Cust_ Ledger Entry] where [Document No_]='" .odbc_result($rs,'Document No_')."'";
$rs_Open = odbc_exec($Conn,$sql_Open);
if (odbc_result($rs_Open,'ok')==0) {
	$Opens='yes';
	}else{
	$Opens='no';
	}

 ?>
  <tr>
    <td><div style=" text-align:center;"><? echo  ++$I;?></div></td>
    <td><div style=" text-align:center;"><? echo odbc_result($rs,'Document No_');	?></div></td>

    <td align="left"  class="<? echo $Opens;?>"><? echo $NewDate_sho;?></td>
  
    <td class="group_go"><div style=" text-align:left"><? echo odbc_result($rs,'Name');	?></div></td>
    <td class="coins_add" style=" text-align:right; font-weight:bold;" ><? echo $amount;?></td>
    <td class="coins_delete" style=" text-align:right; color:#F00;font-weight:bold;"><? echo $vat;?></td>
    <td class="coins" style=" text-align:right;font-weight:bold; color:#03F;"><? echo $amount_invat;?></td>
  </tr>

  <? }?>
  <?
$sql_sum="SELECT Sum([SGD Inter Trading Co_,Ltd".$che."Detailed Cust_ Ledg_ Entry].Amount) AS SumOfAmount
From [SGD Inter Trading Co_,Ltd".$che."Detailed Cust_ Ledg_ Entry]
WHERE ((([SGD Inter Trading Co_,Ltd".$che."Detailed Cust_ Ledg_ Entry].[Document No_]) In (
SELECT [SGD Inter Trading Co_,Ltd".$che."Cust_ Ledger Entry].[Document No_]
FROM [SGD Inter Trading Co_,Ltd".$che."Cust_ Ledger Entry] INNER JOIN [SGD Inter Trading Co_,Ltd".$che."Customer] ON [SGD Inter Trading Co_,Ltd".$che."Cust_ Ledger Entry].[Customer No_] = [SGD Inter Trading Co_,Ltd".$che."Customer].No_
WHERE ((([SGD Inter Trading Co_,Ltd".$che."Cust_ Ledger Entry].[Document Type]) In (2,3)) AND (([SGD Inter Trading Co_,Ltd".$che."Cust_ Ledger Entry].[Salesperson Code])='".$_GET['code']."') AND ((Year([Posting Date])) In (".$_GET['year'].")) AND ((Month([Posting Date])) In (".$_GET['month'].")))
GROUP BY [SGD Inter Trading Co_,Ltd".$che."Cust_ Ledger Entry].[Document No_]
)))";
$rs_sum = odbc_exec($Conn,$sql_sum);
if (odbc_result($rs_sum,'SumOfAmount')<>0) {
	 $total = number_format(odbc_result($rs_sum,'SumOfAmount') - (odbc_result($rs_sum,'SumOfAmount')/107)*7,2);
	$total_vat = number_format( (odbc_result($rs_sum,'SumOfAmount')/107)*7,2);
	$total_invat = number_format(odbc_result($rs_sum,'SumOfAmount'),2);
	}else{
		$total =0;
		$total_vat =0;
		$total_invat =0;
	}

?>
    <tr>
    <td colspan="4" bgcolor="#66FFFF"><strong>สรุปยอดขาย พนักงาน : <font color="#FF0000"><? echo $_SESSION['sale_name'] ;?></font></strong></td>
    <td bgcolor="#66FFFF" style=" text-align:right;">&nbsp;<strong><? echo $total;?></strong></td>
    <td bgcolor="#66FFFF" style=" text-align:right;">&nbsp;<strong><? echo $total_vat;?></strong></td>
    <td bgcolor="#66FFFF" style=" text-align:right;">&nbsp;<strong><? echo $total_invat;?></strong></td>
  </tr>
</table>
