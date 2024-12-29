<?php
// 数据库文件路径（SQLite3 数据库是一个文件）
$db_file = 'Source.sqlite3';

// 创建一个 SQLite3 数据库连接
try {
    $db = new SQLite3($db_file);
} catch (Exception $e) {
    echo "连接失败: " . $e->getMessage() . "<br>";
    exit;
}

$count=0;
$getarray=[];
$result = $db->query('SELECT * FROM Deal');

$res=$db->query('SELECT * FROM Manager');
while($user=$res->fetchArray()){
    array_push($getarray,$user);
    $count=$count+1;
}
$users_data=json_encode($getarray,JSON_UNESCAPED_UNICODE);

?>


<script>
const users=[];
const password=[];
//const fileInput = document.getElementById('fileInput');


var amount=<?php echo $count;?>;
//alert(amount);
var getusers_data=<?php echo $users_data;?>;


function login(){
    const judge=1;
    for(var i=0;i<amount;i++){
        users.push(getusers_data[i].name);
        password.push(getusers_data[i].password);
        }
    while(judge){
    var username=prompt("请输入用户名");
    
    let index=users.indexOf(username);
    alert(index);
    if(index!=-1){
        var userpassword=prompt("请输入密码");
        if(userpassword==password[index]&&userpassword!="null"){
            //alert(userpassword);
            alert("success");
        judge=0; 
        }
        else{
            alert("wrong password");
            break;
        }
    }
    else if(index==-1){
        break;
    }
    else{
    alert("unknown user");}
}

}

</script>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>客户信息</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            text-align: center; /* 居中所有文本 */
        }
        .header {
            background-color: #333;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .button:hover {
            background-color: #45a049;
        }

        .button.remove {
            background-color: #f44336;
        }

        .button.remove:hover {
            background-color: #da190b;
        }

        h2 {
            color: #4CAF50;
            padding: 20px;
            margin-top: 50px;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center; /* 居中容器内的内容 */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            margin-left: auto;
            margin-right: auto;
        }

        th, td {
            padding: 12px;
            text-align: center; /* 居中表格的内容 */
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9f9e6;
        }

        .footer {
            font-size: 14px;
            color: #888;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<header class="header">
        <h1>熊猫下载站</h1>
        <div class="user-controls"> 
        <form method="POST">   
        <button class="button"  id="fileInput" onclick=login()>登录</button>   
    </form>
        </div>
    </header>

    <h2>资源信息</h2>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>名称</th>
                    <th>内容</th>
                    <th>上传者</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // 输出查询结果到表格
                while ($row = $result->fetchArray()) {  
                        echo "<tr>
                                <td><a href= ".htmlspecialchars($row['name']).">".htmlspecialchars($row['name'])." </td>
                                <td>" . htmlspecialchars($row['config']) . "</td>
                                <td>" . htmlspecialchars($row['up']) . "</td>
                              </tr>";
                    }
                
                ?>
            </tbody>
        </table>
    </div>


</body>
</html>
