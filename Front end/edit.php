<?php
session_start();
if (!isset($_SESSION['uid'])) {
    echo "
        <script>
        window.location.href='login.php';
</script>
        ";
}

if(isset($_SESSION['uid'])){
    $user_id = $_SESSION['uid'];
}

header("Content-type: text/html; charset=utf-8");
$conn = new mysqli('localhost', 'root', '', 'wiki');
if (isset($_GET['document_id'])) {
    $doc_id = $_GET['document_id'];
    $sql = "select * from document where document_id = '$doc_id'";
    $query = $conn->query($sql);
    $array = $query->fetch_array();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['delete']=="delete") {
        $sqlDel = "DELETE FROM document WHERE document_id = '$doc_id' ";
        $res = $conn->query($sqlDel);
       echo "
       <script>
       window.location.href='index.php';
</script>";
    } else {
        $doc_content = $_POST['doc_content'];
        $ctime = date("Y-m-d H:i:s", time());
        if (!empty($doc_id)) {
            $sqlSave = "update document set content = '$doc_content',last_edit_date='$ctime',user_id = '$user_id'  where document_id = '$doc_id' ";
        } else {
            $title = $_POST['doc_title'];
            $sql = "select document_id from document";
            $query = $conn->query($sql);
            $array = $query->fetch_array();
            $doc_id = $array['document_id'] + 1;
            $sqlSave = "insert into document  set document_id = '$doc_id' , content = '$doc_content', user_id = '$user_id',doc_title = '$title', creation_date ='$ctime',last_edit_date='$ctime' ";

        }
        $conn->query($sqlSave);
    }
}

if (isset($_GET['act'])) {
    if ($_GET['act'] == 'search') {
        $content_sh = $_GET['search'];
        echo $content_sh;
        $sql = "select * from document where doc_title  LIKE '%$content_sh%'";
        //  echo $sql;
        $query = $conn->query($sql);
        $array = $query->fetch_array();
    }
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
        function deleteClick() {
            var del = document.getElementById("delete");
            del.value = "delete";
            document.getElementById("myform").submit();
        }
    </script>
</head>

<body style="padding-top: 70px">
<?php include("header.php"); ?>
<aside class="asideLeft">
    <h1>Collaborative Online Text Editing Tool</h1>
</aside>
<form method="post" action="" id="myform" name="myform">
    <section class="sectionRight">

        <?php
        if (empty($array['doc_title'])) {
            ?>
            <input type="text" name="doc_title" value="Please enter a title">
        <?php
        } else { ?>
            <h2 data_temp_dwid="1"
                ><?php echo $array['doc_title']; ?></h2>
        <?php
        }
        ?>

        <br>
        <textarea
            name="doc_content"><?php echo empty($array['content']) ? 'Enter your text here' : $array['content']; ?></textarea>
        <br>
        <input type="hidden" value="" name="delete" id="delete">
        <button type="button" onclick="cancelClick()">Cancel</button>
        <button type="button" onclick="subClick()">Save draft</button>
        <button type="button" onclick="subClick()">Save</button>
        <button type="submit">Publish</button>
        <button type="button"  onclick="deleteClick()">Delete</button>
    </section>
</form>


<footer>Copyright 2017.</footer>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
