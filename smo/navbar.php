<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Profilo</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!-- <li class="active"><a href="#"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print <span class="sr-only">(current)</span></a></li> -->
        <li><a onclick="window.print();"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print <!-- <span class="sr-only">(current)</span> --></a></li>
        <li><a href="#">Themes</a></li>
        <?php if ($editor == 1) {
          echo '
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="dropdown-header">Any Disaster?</li>
            <li><a class="btn-warning" href="#" data-toggle="modal" data-target="#resetFactoryModal">Reset Factory</a></li>
            <li><a href="#" data-toggle="modal" data-target="#restoreSafeModal">Restore Last "SAFE"</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header">Risky!</li>
            <li><a data-toggle="modal" data-target="#changeXmlModal">Change xml File</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" data-toggle="modal" data-target="#markSafeModal">Mark this version as "SAFE"</a></li>
          </ul>
        </li>';
        } ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Refresh</a></li>
        <?php if ($editor == 1) {
          echo '
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Logout</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>';
      } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>