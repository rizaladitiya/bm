<?php




echo "<body onload='window.print();window.close();'>";
echo "<div style='position:absolute; top:0cm; left:13cm'>";
	//echo "<img src='pic/iso.jpg' height='60'/>";
	//echo "<font style='font-family:verdana; font-size:0.3cm; color:00BB00'>";
	//	echo "ISO 9001:2015 CERTIFICATION<br/>";
	//	echo "ISO 14001:2015 CERTIFICATION<br/>";
	//	echo "CoC-FSC CERTIFICATION";
	//echo "</font>";
echo "</div>";

echo "<div style='position:absolute; top:4.5cm; left:7cm'>";
	//echo "<img src='barcode.png'/>";
	echo "<font style='font-family:verdana; color:red; font-size:45; font-weight:bold'>Label<br>Manual</font>";
echo "</div>";

echo "<div style='position:absolute; top:2.2cm; left:9cm'>";
	echo "<font style='font-family:verdana; font-size:50; font-weight:bold'>".arrtostr(cariarray($master->jenis,$roll->jenis))." ".$roll->gsm." GSM</font>";
echo "</div>";
echo "<div style='position:absolute; top:4.7cm; left:12cm'>";
	echo "<font style='font-family:verdana; font-size:50; font-weight:bold'> ".$roll->lebar."</font>";
echo "</div>";
echo "<div style='position:absolute; top:7.2cm; left:12cm'>";
	echo "<font style='font-family:verdana; font-size:50; font-weight:bold'>".number_format($roll->berat)."</font>";
echo "</div>";
echo "<div style='position:absolute; top:9.7cm; left:9cm'>";
	echo "<font style='font-family:verdana; font-size:50; color:red; font-weight:bold'>".koderoll($master->tahun,$roll->datetime,$roll->pm,$roll->no_roll)."</font>";
echo "</div>";
echo "<div style='position:absolute; top:12.2cm; left:9cm'>";
	echo "<font style='font-family:verdana; font-size:50; font-weight:bold'>Q1</font>";
echo "</div>";

echo "<div style='position:absolute; top:13cm; left:19cm'>";
	//echo "<img src='pic/$warna.jpg' height='20' width='20'/>";
echo "</div>";

echo "<div style='position:absolute; top:13cm; left:0cm; width:18.5cm; text-align:right''>";
	//echo "<font style='font-family:verdana; font-size:0.5cm; font-weight:bold'>".gabungnama($masalah,$master->masalah)."</font>";
echo "</div>";

echo "<div style='position:absolute; top:12.7cm; left:5cm'>";
	//echo "<img src='pic/recycle.jpg' height='40'/>";
echo "</div>";

/*echo "<div style='position:absolute; top:14.6cm; left:16cm'>";
	echo "<font style='font-family:verdana; font-size:0.3cm; color:00BB00; font-style:italic'>FORM/F2FG/007,Rev0</font>";
echo "</div>";*/
echo "</body>";

?>
