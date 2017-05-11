<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'wiki');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login_id = $_POST['inputEmail'];
    $pass_hash = $_POST['inputPaswd'];
    $sql = "select * from shadow where login_id = '$login_id' and pass_hash = '$pass_hash'";
    $query = $conn->query($sql);
    $array = $query->fetch_array();
    if (empty($array['user_id'])) {
        echo"
        <script>
        alert('Input the user name or password is not correct');
</script>
        ";
    }else{
        $_SESSION['uid'] = $array['user_id'];
        $_SESSION['login_id']=$array['login_id'];
        echo "
        <script>
        window.location.href='index.php';
</script>
        ";
    }
}
if(!empty($_GET['act'])){
    if($_GET['act']=="loginOut"){
        $_SESSION = array();
        if(isset($_COOKIE[session_name()])){  //判断客户端的cookie文件是否存在,存在的话将其设置为过期.
            setcookie(session_name(),'',time()-1,'/');
        }
        session_destroy();
    }
    $_GET['act']="";
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiki</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
    <script>var __adobewebfontsappname__ = "dreamweaver"</script>
    <script src="http://use.edgefonts.net/actor:n4:default;alfa-slab-one:n4:default;alegreya:n4,n7:default.js"
            type="text/javascript"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body style="padding-top: 70px">
<?php include("header.php"); ?>
<aside class="asideLeft">
    <h1>Collaborative Online Text Editing Tool</h1>
</aside>
<section class="sectionRight">
    <h2>Login</h2>
    <br>

    <form method="post" action="" name="myform">
        Email:<input name="inputEmail" type="email">
        <br>
        Password:<input name="inputPaswd" type="password">
        <br>
        <br>
        <br>
        <input type="submit" value="Submit" style="width: 10%">
    </form>
</section>
<footer>Copyright 2017.</footer>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
