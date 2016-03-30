<!DOCTYPE html>
<html lang="en">
	<?php
		$XMLsmo=simplexml_load_file("smo.xml") or die("Error: Cannot create object");
		//print_r($XMLsmo);
		
		?>
	<?php
		$editor = 1;
		if(isset($_GET['edit']))
		$editor = $_GET['edit'];//0;
		?>
	<head>
		<title><?php echo $XMLsmo->pagetitle; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="../bootstrap/jquery-2.2.2.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container" <?php if($editor==1) echo 'onmouseover="showp(\'btn-file\');" onmouseout="hidep(\'btn-file\');"'; ?> >
			<?php include 'navbar.php';?>
			<div class="jumbotron" <?php if($editor==1) echo 'onmouseover="showp(\'btn-title\');" onmouseout="hidep(\'btn-title\');"'; ?> >
				<?php if($editor==1) 
					echo '<div class="btn-group" role="group" aria-label="...">
					
					<button class="btn btn-primary btn-title btn-xs hidden" data-toggle="modal" data-target="#editTitleModal" type="button" name="title"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit Title</button>
					</div>'; ?>
				<h1 class="text-center text-uppercase" id="titleData"><?php echo ($XMLsmo->title->name); ?></h1>
				<h3 class="text-center" id="subtitleData"><?php echo $XMLsmo->title->subtitle; ?></h3>
			</div>
			<div class="container">
				<div class="row marketing" <?php if($editor==1) echo 'onmouseover="showp(\'btn-para\');" onmouseout="hidep(\'btn-para\');"'; ?> >
					<?php if($editor==1) echo '<div class="btn-group" role="group" aria-label="..."><button class="btn btn-primary btn-para btn-xs hidden" data-toggle="modal" data-target="#addParaModal" type="button" name="para1" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New Para</button>
						<button class="btn btn-primary btn-para btn-xs hidden" data-toggle="modal" data-target="#editParaModal" type="button" name="para1" ><span class="glyphicon glyphicon-sort" aria-hidden="true"></span> Change Sequence</button></div>'; ?>
					<dl class="dl-horizontal"><?php
						$paraList = $XMLsmo->para->item;
						for ($i=0; $i < sizeof($paraList); $i++)
						{
							$object = $paraList[$i];
							echo "<dt>".$object->dt." </dt>";
							echo '<dd>';
							if($editor==1) 
							{
								echo '<div class="btn-group" role="group" aria-label="...">
								<button class="btn btn-primary btn-para btn-xs hidden" data-toggle="modal" data-target="#editParaModal" data-seq="'.($i+1).'" type="button" name="para1" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</button>
								<button class="btn btn-danger btn-para btn-xs hidden" data-toggle="modal" data-target="#deleteParaModal" data-seq="'.($i+1).'" type="button" name="para1" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</button>
								</div>';
							}
							echo $object->dd." </dd>";
						}
						?></dl>
				</div>
				<div id="download" class="table-responsive" <?php if($editor==1) echo 'onmouseover="showp(\'btn-table\');" onmouseout="hidep(\'btn-table\');"'; ?> >
					<table class="table table-bordered table-hover" >
						<thead>
							<tr>
								<th>Sr No.</th>
								<th>Available Downloads &nbsp;&nbsp;&nbsp; <?php if($editor==1) echo '<div class="btn-group" role="group" aria-label="..."><button class="btn btn-primary btn-table hidden" data-toggle="modal" data-target="#addFileModal"  type="submit"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  New File</button></div>'; ?> </th>
								<th>Actions </th>
							</tr>
						</thead>
						<tbody>
							<?php
							$dlist = $XMLsmo->dls->item;
							for ($i=0; $i < sizeof($dlist); $i++)
							{ 
								$di = $dlist[$i];
								echo '<tr><td>'.($i+1).'.</td>';
								echo '<td>'.$di->descr.'</td>';
								echo '
								<td>
									<div class="btn-group" role="group" aria-label="...">
										<a class="btn btn-primary " type="submit" hrtef="'.$di->link.'" ';
								echo ($di->fType=="upload")?('download'):('');
								echo ' onclick="counter('.($i+1).')"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download <span class="badge">'.$di->clickCount.'</span></a>';
								if($editor==1)
								echo '<button class="btn btn-primary btn-table hidden" data-seq="'.($i+1).'" data-toggle="modal" data-target="#editFileModal" type="submit">Edit</button>
										<button class="btn btn-danger btn-table hidden" data-seq="'.($i+1).'" data-toggle="modal" data-target="#deleteFileModal" type="submit">Delete</button>
									';
								echo '
									</div>
								</td>
								';
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<p class="text-muted">Place sticky footer content here.</p>
			</div>
		</footer>
		<?php if($editor==1) include 'modals.html';?>
		<!-- Include forEdit.js if editor is ON -->
		<?php if($editor==1) echo '<script src="forEdit.js"></script>'; ?>
	</body>
	<script type="text/javascript">
	function counter (r) {
		console.log(r);
		 window.location.href = "redir.php?w1=" + r;
	}
	</script>
</html>