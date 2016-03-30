<?php 
//echo json_encode($_POST);

//echo json_encode(get_defined_vars());
// $fileName = "index.php";
// $myfile = fopen($fileName, "r") or die("Unable to open file!");
// echo fread($myfile,filesize($fileName));
// fclose($myfile);

$SMO_DATA_FILE = "./smo.xml";
$SMO_SAFE_FILE = "./backup/smo_safe.profilo";
$SMO_FACT_FILE = "./backup/smo_factory.profilo";

$XMLsmo=simplexml_load_file($SMO_DATA_FILE) or die("Error: Cannot create object");
$redir=1;
$flag=1;
if (isset($_GET['act'])) {
	$act = $_GET['act'];
	if($act=="editTitle")
	{
		if (isset($_POST['newTitle'])) {
			//echo $XMLsmo->title->name;
			$XMLsmo->title->name = utf8_decode($_POST['newTitle']);
			//echo utf8_decode($XMLsmo->title->name);
		}
		if (isset($_POST['newsubTitle'])) {
			$XMLsmo->title->subtitle = $_POST['newsubTitle'];
		}
		if (isset($_POST['newPageTitle'])) {
			$XMLsmo->pagetitle = $_POST['newPageTitle'];
		}
		
			echo "title updated";
	}
	elseif ($act=="editPara")
	{
		$paraList = $XMLsmo->para->item;
		if (isset($_POST['data-seq'])) {
			echo json_encode($_POST);
			$i = $_POST['data-seq'] - 1;
			$paraList[$i]->dt = $_POST['paraTitle'];
			$paraList[$i]->dd = $_POST['paraContent'];
		}
		echo "para updated";
	}
	elseif($act=="deletePara")
	{
		$paraPapa = $XMLsmo->para;
		if (isset($_POST['data-seq'])) {
			echo json_encode($_POST);
			$i = $_POST['data-seq'] - 1;
			unset($paraPapa->item[$i]);
			echo "para deleted";

		}
	}
	elseif ($act=="addPara")
	{
		$paraList = $XMLsmo->para->item;
			$i = sizeof($paraList);
			//echo json_encode($paraList).$i;
			if($i==0)
			{	//list is empty, create first node and add it
				$XMLsmo->para->item->dt = $_POST['paraTitle'];
				$XMLsmo->para->item->dd = $_POST['paraContent'];
				//echo json_encode($paraList).$i;
			}
			else
			{
				$paraList[$i]->dt = $_POST['paraTitle'];
				//echo json_encode($paraList).$i;
				$paraList[$i]->dd = $_POST['paraContent'];
				//echo json_encode($paraList).$i;
			}
			echo "para added";
	}
	elseif ($act=="addFile")
	{
		echo json_encode($_POST);
		$dlist = $XMLsmo->dls->item;
		$i = sizeof($dlist);
		echo $i;
		$fType = $_POST['fileType'];
		if($fType=="upload")
		{
			$fp = $_FILES['filePointer'];
			echo json_encode($fp);
			if(move_uploaded_file($fp['tmp_name'], "../files/".$fp['name'])){
				echo "file uploaded";
			}
			$link = "../files/".$fp['name'];
		}
		elseif ($fType=="ext") {
			$link = $_POST['linkText'];
		}
		if($i==0)
			{	//list is empty, create first node and add it
				$XMLsmo->dls->item->descr = $_POST['fileDescr'];
				$XMLsmo->dls->item->clickCount = $_POST['fileClickInt'];
				$XMLsmo->dls->item->fType = $fType;
				$XMLsmo->dls->item->link = $link;
				//echo json_encode($paraList).$i;
			}
			else
			{
				$dlist[$i]->descr = $_POST['fileDescr'];
				//echo json_encode($paraList).$i;
				$dlist[$i]->clickCount = $_POST['fileClickInt'];
				$dlist[$i]->fType = $fType;
				$dlist[$i]->link = $link;
				//echo json_encode($paraList).$i;
			}
	}
	elseif ($act=="editFile")
	{
		$dlist = $XMLsmo->dls->item;
		if (isset($_POST['data-fseq'])) {
			echo json_encode($_POST);
			$i = $_POST['data-fseq'] - 1;
			$dlist[$i]->descr = $_POST['fileDescr'];
			$dlist[$i]->clickCount = $_POST['fileClickInt'];
		}
		echo "file description updated";
	}
	elseif ($act=="deleteFile") {
		$filePapa = $XMLsmo->dls;
		if (isset($_POST['data-fseq'])) {
			echo json_encode($_POST);
			$i = $_POST['data-fseq'] - 1;
			unset($filePapa->item[$i]);
			echo "File deleted";
		}
	}
	elseif ($act=="markSafe") {
		echo copy($SMO_DATA_FILE,$SMO_SAFE_FILE);
	}
	elseif ($act=="restoreSafe") {
		echo copy($SMO_SAFE_FILE,$SMO_DATA_FILE);
		$flag=0;
	}
	elseif ($act=="resetFactory") {
		echo copy($SMO_FACT_FILE,$SMO_DATA_FILE);
		$flag=0;
	}
	if ($flag==1) {
		$XMLsmo->asXML($SMO_DATA_FILE);		
	}
}
echo "<br />go to <a href='./index.php'>smo home</a>";
if($redir==1)
echo 'redircting in 1 <meta http-equiv="refresh" content="0;URL=\'./\'" />';
//print_r($XMLsmo);


//$xml = new SimpleXMLElement($string);

// echo $xml->asXML();
?>