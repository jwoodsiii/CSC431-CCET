<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            <a class="navbar-brand" href="index.html">Wiki</a></div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="topFixedNavbar1">
            <ul class="nav navbar-nav navList">
                <li class="navListItem active"><a href="index.php">Home</a> </li>
                <li class="navListItem"><a href="new.php">New Document</a></li>
                <li class="navListItem"><a href="audit.php">Audit Trail</a> </li>
                <li class="navListItem"><a href="account.php">Account Information</a></li>
                <li class="navListItem"><a href="login.php?act=loginOut" >Logout</a></li>

            </ul>
            <form class="navbar-form navbar-left" role="search"  method="get" action="edit.php" name="myformSh">
                <div class="form-group">
                    <input type="hidden" name="act" class="form-control"value="search">
                    <input type="text" name="search" class="form-control" placeholder="Full Text Search">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>