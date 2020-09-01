<?php 

    //验证
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST')  {
        // var_dump(122);
        // add();
        setStorage();
    }


    //封装验证
    
    function add() {

       /*------------验证文件域和文件的合法性: 文件域是否存在 以及 选择了上传文件--------------*/
        
        var_dump($_POST);

        //是否选择了文件域
        if (!isset($_FILES['avatar'])) {
            $GLOBALS['message'] = '请选择头像';
            return;
        }

        //是否选择了文件
        if ( empty($_FILES['avatar']['name']) ) {
            var_dump(122);
            
            $GLOBALS['message'] = '请选择头像';
            return;
        }


        $avatar = $_FILES['avatar'];

        //检查上传文件的error

        if ($avatar['error'] !== UPLOAD_ERR_OK) {

            $GLOBALS['message'] = '头像上传失败';
            return;
        }


        //保存文件
        $source = $avatar['tmp_name']; //上传文件的临时路径

        $targetPath = './images/' . $avatar['name']; //目标路径，不能使用绝对路径

        $move_status = move_uploaded_file($source, $targetPath); //移动文件到目标路径

        if (!$move_status) { //  判断移动文件的状态
            $GLOBALS['message'] = '头像上传失败';
            return;
        }

         var_dump($targetPath);

        // 保存文件路径
        
        $finalFilePath = '/student' . str_replace('./','/',$targetPath); //相对路径替换成绝对路径

        var_dump($finalFilePath);




        /*----------------------验证文本域--------------------------*/

        //判断 name： name文本域是否存在 以及 name是否为空
        
        if ( !isset($_POST['name']) || empty($_POST['name'])) {
            $GLOBALS['message'] = '姓名不能为空';
            return;
        }


        //判断 gender： 文本域是否存在 以及 是否为空
        
        if ( !isset($_POST['gender']) || empty($_POST['gender'])) {
            $GLOBALS['message'] = '性别不能为空';
            return;
        } 


        //判断 birthday： 文本域是否存在 以及 是否为空
        
        if ( !isset($_POST['birthday']) || empty($_POST['birthday'])) {
            $GLOBALS['message'] = '出生日期不能为空';
            return;
        }

        //保存文本
        
        $name = $_POST['name'];

        $gender = $_POST['gender'];

        $birthday = $_POST['birthday'];
        
        
    }


    /*-----------------------------数据库操作---------------------------*/

    function setStorage (name,birthday,gender,avatar) {

        //链接数据库：mysqli_connect 返回一个连接对象----"桥"
        $connection = mysqli_connect('localhost','root','123456','test');

        //查询之前设置编码
        mysqli_set_charset($connection,'utf8');

        if(!$connection) {
            $GLOBALS['message'] = mysqli_connect_error();
            return;
        }


        //发起对数据库的查询，返回的是一个数据堆
        $query = mysqli_query($connection,'select * from student;');

        if (!$query) {
            $GLOBALS['message'] = '查询数据库失败';
            return;
        }



        //遍历数据堆里面的数据

        while ($row = mysqli_fetch_assoc($query)) {
            var_dump($row);
        }
    

        //查询动作影响了多少行
        $affectedRows = mysqli_affected_rows($connection);

        

        //炸桥，关闭与数据库的链接
        mysqli_close($connection);
    }











    //保存

 ?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>XXX管理系统</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">XXX管理系统</a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.html">用户管理</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">商品管理</a>
            </li>
        </ul>
    </nav>
    <main class="container">
        <h1 class="heading">添加用户</h1>
        <div>
            <?php 
                if (isset($message)) {
                    echo $message;
                }

            ?>
                
        </div>


        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="avatar">头像</label>
                <input type="file" class="form-control" id="avatar" name="avatar">
            </div>
            <div class="form-group">
                <label for="name">姓名</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="gender">性别</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="">请选择性别</option>
                    <option value="1">男</option>
                    <option value="0">女</option>
                </select>
            </div>
            <div class="form-group">
                <label for="birthday">生日</label>
                <input type="date" class="form-control" id="birthday" name="birthday">
            </div>
            <button class="btn btn-primary">保存</button>
        </form>
    </main>
</body>
</html>
