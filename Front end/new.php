<?php
session_start();
if(!isset($_SESSION['uid'])){
    echo "
        <script>
        window.location.href='login.php';
</script>
        ";
}
$conn = new mysqli('localhost', 'root', '', 'wiki');
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $user_id = $_SESSION['uid'];
    $doc_content = $_POST['doc_content'];
    $title = $_POST['doc_title'];
    $doc_cg = $_POST['doc_cg'];
    $status_id = 0;
    $ctime = date("Y-m-d H:i:s", time());
    $sql = "select max(document_id) from document";
    $query = $conn->query($sql);
    $array = $query->fetch_array();
    $doc_id = $array['max(document_id)'] + 1;
    $sqlSave = "insert into document  set  document_id = '$doc_id' , content = '$doc_content', user_id = '$user_id',doc_title = '$title',status_id='$status_id', creation_date ='$ctime',last_edit_date='$ctime',category = '$doc_cg' ";
    $conn->query($sqlSave);
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
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({selector: 'textarea'});</script>
    <script>
        function subClick() {
            document.getElementById("myform").submit();
        }
        function cancelClick() {
            window.location.href = "index.php";
        }
    </script>
</head>

<body style="padding-top: 70px">
<?php include("header.php"); ?>
<aside class="asideLeft">
    <h1>Collaborative Online Text Editing Tool</h1>
</aside>

<section class="sectionRight">
    <h2>Create a new document</h2>

    <form method="post" action="" id="myform" name="myform">
        <br>
        <span>Document name:</span>
        <input type="text" name="doc_title" value="">
        <br>
        <span>Category: </span>
        <input type="text" name="doc_cg" value="">
        <br>
        <br>
        <textarea name="doc_content">Enter your text here</textarea>
        <br>

        <div style="margin-bottom: 50px;">
            <button type="button" onclick="cancelClick()">Cancel</button>
            <button type="button" onclick="subClick()">Save draft</button>
            <button type="button" onclick="subClick()">Save</button>
            <button type="submit">Publish</button>
        </div>
    </form>
</section>
<footer>Copyright 2017.</footer>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
