<?php
/*	(C)2006-2020 FoundPHP Framework.
*	   name: Database Object
*	 weburl: http://www.FoundPHP.com
* 	   mail: master@FoundPHP.com
*	 author: 孟大川
*	version: v3.201212
*	  start: 2006-05-24
*	 update: 2020-12-12
*	payment: Free 免费
*	This is not a freeware, use is subject to license terms.
*	此软件为授权使用软件，请参考软件协议。
*	http://www.FoundPHP.com/agreement
*/

Class Dirver_sqlite{
	var $Lists	= '';
	var $nums	= 0;
	//连接数据库
	function DBLink($dba=''){
		$this->LinkID = sqlite_open($dba['dbhost'].$dba['dbname'],0666,$sqliteerror);
		$this->set_names= 0;
		return $this->LinkID;
	}
	
	//查询语句
	function query($query,$limit='') {
		//检测如果有限制数据集则处理
		if($limit>0){
			$query = $query.' LIMIT '.$limit;
		}
		//时间处理
		if (@stristr($query, "now()") !== FALSE){
			$query = preg_replace("/(.*)\'now\(\)\'(.*)/is","\\1now()\\2",$query);
		}
		return array('query'=>sqlite_query($this->LinkID,$query,SQLITE_ASSOC),'sql'=>$query);
	}
	
	//返回数组资料
	function fetch_array($query) {
		if ($query){
			return sqlite_fetch_array($query);
		}
		return false;
	}
	
	//取得返回列的数目
	function num_rows($query){
		if ($query){
			return sqlite_num_rows($query);
		}
		return false;
	}
	
	//返回最后一次使用 INSERT 指令的 ID
	function insert_id(){
		return sqlite_last_insert_rowid($this->LinkID);
	}
	
	//关闭当前数据库连接
	function close(){
		return sqlite_close($this->LinkID);
	}
	
	//检测mysql版本
	function version(){
		return	@sqlite_libversion();
	}
}
?>