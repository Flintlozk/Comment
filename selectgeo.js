<script>

		//**** List Province (Start) ***จังหวัด//
		function ListProvince(SelectValue)
		{
			frmMain.ddlProvince.length = 0
			frmMain.ddlAmphur.length = 0
			//*** Insert null Default Value ***//
			var myOption = new Option('','')
			frmMain.ddlProvince.options[frmMain.ddlProvince.length]= myOption

			<?
			$intRows = 0;
			$strSQL = "SELECT * FROM province ORDER BY PROVINCE_ID ASC ";
			$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
			$intRows = 0;
			while($objResult = mysql_fetch_array($objQuery))
			{
			$intRows++;
			?>
				x = <?=$intRows;?>;
				mySubList = new Array();

				strGroup = <?=$objResult["GEO_ID"];?>;
				strValue = "<?=$objResult["PROVINCE_ID"];?>";
				strItem = "<?=$objResult["PROVINCE_NAME"];?>";
				mySubList[x,0] = strItem;
				mySubList[x,1] = strGroup;
				mySubList[x,2] = strValue;
				if (mySubList[x,1] == SelectValue){
					var myOption = new Option(mySubList[x,0], mySubList[x,2])
					frmMain.ddlProvince.options[frmMain.ddlProvince.length]= myOption
				}
			<?
			}
			?>
		}
		//**** List Province (End) ***//


		//**** List Amphur (Start) ***อำเภอ//
		function ListAmphur(SelectValue)
		{
			frmMain.ddlAmphur.length = 0
			frmMain.ddldistrict.length = 0
			//*** Insert null Default Value ***//
			var myOption = new Option('','')
			frmMain.ddlAmphur.options[frmMain.ddlAmphur.length]= myOption

			<?
			$intRows = 0;
			$strSQL = "SELECT * FROM amphur ORDER BY AMPHUR_ID ASC ";
			$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
			$intRows = 0;
			while($objResult = mysql_fetch_array($objQuery))
			{
			$intRows++;
			?>
				x = <?=$intRows;?>;
				mySubList = new Array();

				strGroup = <?=$objResult["PROVINCE_ID"];?>;
				strValue = "<?=$objResult["AMPHUR_ID"];?>";
				strItem = "<?=$objResult["AMPHUR_NAME"];?>";
				mySubList[x,0] = strItem;
				mySubList[x,1] = strGroup;
				mySubList[x,2] = strValue;

				if (mySubList[x,1] == SelectValue){
					var myOption = new Option(mySubList[x,0], mySubList[x,2])
					frmMain.ddlAmphur.options[frmMain.ddlAmphur.length]= myOption
				}
			<?
			}
			?>
		}
		//**** List Amphur (End) ***อำเภอ//

		//**** List District (Start) *** ตำบล//
		function Listdistrict(SelectValue)
		{
			frmMain.ddldistrict.length = 0

			//*** Insert null Default Value ***//
			var myOption = new Option('','')
			frmMain.ddldistrict.options[frmMain.ddldistrict.length]= myOption

			<?
			$intRows = 0;
			$strSQL = "SELECT * FROM district ORDER BY DISTRICT_ID ASC ";
			$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
			$intRows = 0;
			while($objResult = mysql_fetch_array($objQuery))
			{
			$intRows++;
			?>
				x = <?=$intRows;?>;
				mySubList = new Array();

				strGroup = <?=$objResult["AMPHUR_ID"];?>;
				strValue = "<?=$objResult["DISTRICT_ID"];?>";
				strItem = "<?=$objResult["DISTRICT_NAME"];?>";
				mySubList[x,0] = strItem;
				mySubList[x,1] = strGroup;
				mySubList[x,2] = strValue;

				if (mySubList[x,1] == SelectValue){
					var myOption = new Option(mySubList[x,0], mySubList[x,2])
					frmMain.ddldistrict.options[frmMain.ddldistrict.length]= myOption
				}
			<?
			}
			?>
		}
		//**** List District (End) ***ตำบล//

</script>
