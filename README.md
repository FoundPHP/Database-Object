# Database-object

官方网址：https://foundphp.com/?m=manual&id=1758

DBO 数据库操作采用模块化多语言架构，提供：安全、稳定、快速、简单、易用、语法统一的多数据库类。

目前支持数据库种类：Mysql、Mysqli、SqlServer、PostgreSQL、MariaDB、SQLite、SQLite3、redis、memcached （Oracle数据库支持可与我们商务合作）
DBO支持PHP5、PHP7、PHP8最新版本都可以稳定运行。

DBO 在传统应用基础上大量使用数组，并且为开发方便提供统一sql分页、sql 日志及 sql 调试平台，快速方便的让使用者找出sql语句的问题。

使用一套DBO，就可以用同一套开发语言，对不同数据库进行操作，方便开发人员学习。

采用最少的语法适配更多数据库，语法包含：添加数据、更新数据、删除数据、查询数据、分页方法、缓存用法、调试日志、调试平台、Redis 队列、Memcached

###使用方法
```php
<?php
//数据库设置
$config['db']['dbtype']	 		= 'mysql';				//数据库类型php 5.4后请用mysqli
$config['db']['dbhost'] 		= '127.0.0.1';			//服务器地址
$config['db']['dbport'] 		= '3306';				//服务器端口
$config['db']['dbname'] 		= 'foundphp';			//数据库名
$config['db']['dbuser'] 		= 'root';				//账号
$config['db']['dbpass'] 		= '';					//密码
$config['db']['charset'] 		= 'utf8mb4';			//语言编码
$config['db']['cache'] 			= 'data/cache/';		//缓存目录
$config['db']['lang'] 			= 'zh';					//语言

//引入dbo类并实例化
include 'database/dbo.php';
$db    = FoundPHP_dbo($config['db']);

//定义数据表
$table['a']    = 'admin_user';//管理员表
$table['b']    = 'admin_group';//管理员组表
$ljoin['b']    = 'b.id=a.gid';//关联条件
$t_field    = 'a.id,a.nickanme,b.group_name';//查询的字段

//添加数据
//构建插入数据
$insert_data = array(
    'nickname'    => 'FoundPHP user',//用户姓名
    'dates'        => time(),//插入时间
);
//构建数据插入验证条件
$check_data     = array(
    'nickname'    => 'FoundPHP user',//用户姓名
);
/*
    table 插入表名
    data  插入数据 array('字段名'=>'值');
    check 数据验证 array('验证字段名'=>'验证值')
*/
sql_update_insert(array('table'=>'admin_user','data'=>$insert_data,'check'=>$check_data));

//插入数据id
$id = $db->insert_id();
echo '插入数据id：'.$id;

//查询数据
$data_info    = sql_select(array('table'=>'admin_user','where'=>"id=1"));
print_r($data_info);


//更新数据
$update_data = array(
    'nickname'    => 'FoundPHP edit user',//用户姓名
);
sql_update_insert(array('table'=>'admin_user','data'=>$update_data,'where'=>'id=1'));


//删除数据
sql_del(array('table'=>'admin_user','where'=>'id!=1'));
//关闭数据库
$db->close();
?>
```
