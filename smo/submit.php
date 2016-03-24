<?php 
//echo json_encode($_POST);

//echo json_encode(get_defined_vars());
// $fileName = "index.php";
// $myfile = fopen($fileName, "r") or die("Unable to open file!");
// echo fread($myfile,filesize($fileName));
// fclose($myfile);

$XMLsmo=simplexml_load_file("smo.xml") or die("Error: Cannot create object");

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
	elseif ($act=="addPara") {
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
	$XMLsmo->asXML("smo.xml");
}
echo "<br />go to <a href='index.php'>smo home</a>";
//echo 'redircting in 1 <meta http-equiv="refresh" content="0;URL=\'index.php\'" />';
//print_r($XMLsmo);


//$xml = new SimpleXMLElement($string);

// echo $xml->asXML();
?>