<?php
session_start();
if (!isset($_SESSION['uid'])) {
    echo "
        <script>
        window.location.href='login.php';
</script>
        ";
}
$user_id = $_GET['id'];
//echo $user_id;
$conn = new mysqli('localhost', 'root', '', 'wiki');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fName'];
    $lname = $_POST['lName'];
    $email = $_POST['email'];
    $sqlSave = "update userprofile  set  fname = '$fname' , lname = '$lname', email = '$email' where user_id='$user_id '";
    //echo $sqlSave;
    $conn->query($sqlSave);
    echo 'error='.mysqli_error($conn);

    if (!empty($_POST['password'])) {
        $paswd = $_POST['password'];
        $sql = "update shadow  set  pass_hash = '$paswd' WHERE user_id ='$user_id' ";
        $conn->query($sql);
    }
}
$sql = "select * from userprofile where user_id  = '$user_id '";
$query = $conn->query($sql);
$array = $query->fetch_array();
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
    <script language="javascript">
        function checkForm(form) {
          //  alert(123);
            if (form.password.value != "" && form.password.value != form.confpass.value) {
                alert("The two passwords don't match！");
                form.password.focus();
                return false;
            }
        }
    </script>
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
    <h2>Account1</h2>

    <form method="post" action="" id="myform" name="myform" onSubmit="return checkForm(this);">
        First name:
        <input type="text" name="fName" value="<?php echo $array['fname'] ?>">
        <br>
        Last Name:
        <input type="text" name="lName" value="<?php echo $array['lname'] ?>">
        <br>
        Email:
        <input type="email" name="email" value="<?php echo $array['email'] ?>">
        <br>
        Password:
        <input type="password" name="password" value="">
        <br>
        Conform password:
        <input type="password" name="confpass">

    Privilege:
    <br>
    <select>
        <option value="Admin">Admin</option>
        <option value="Editor">Editor</option>
        <option value="Reader">Reader</option>
        <br>
    </select>
    <br>
    <br>

    <div style="margin-bottom: 50px;">
        <button type="button" onclick="cancelClick()">Cancel</button>
        <input type="submit" value="Submit" style="width: 10%">
    </div>
    </form>
</section>
<footer>Copyright 2017.</footer>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>