<?php
//db接続用のファイル
include dirname(__FILE__) ."./../conf/db_connect.php";
?>
<?php
class keijiban_index{
	//詳細なスレッドのコメントえお保管するのがchannel　テーブル
	//タイトトルとidを保存するのがchannel_title_idテーブル

	public function total2($target){
	//データの総件数取得、ページングで使用する。検索結果によって、ページングの個数を判定する
	global $db;
	$sql .="select count(distinct id) from channel";
	$sql .=" where true ";
	//何も検索されないとき、は普通のトータルを検索（total（））と同じ処理になる。文字検索かかると、それ分の総件数を検索する
	$sql .= empty($target) ? "": "and title like '%".$target."%'";
	$info = $db->query($sql);
	$results = $info->fetchColumn();
	return $results;		
	}
	
	public function total3($id){
	//データの総件数取得、ページングで使用する。検索結果によって、ページングの個数を判定する
	global $db;
	$sql .="select count(id) from channel";
	$sql .=" where id=".$id;
	$info = $db->query($sql);
	$results = $info->fetchColumn();
	return $results;		
	}
		
	public function select($page,$target){
	global $db;
	$limit = 4; //1ページに表示するレコード
	$offset = ($page-1)*$limit;
	$sql .="select * from channel_title_id";
	$sql .=" where true ";
	$sql .= empty($target) ? "": "and title like '%".$target."%'";
	$sql .=" order by id desc";
	$sql .=" limit ".strval($limit);
	$sql .=" offset ".strval($offset);
	#クエリの実行
	$info = $db->query($sql);	
	#データベースのデータを全て取得fetchAll(PDO::FETCH_ASSOC);
	#データベースのデータを1行取得fetchColumn();
	$results = $info->fetchAll(PDO::FETCH_ASSOC);	
	return $results;
	}	
	
	public function select_detail($page,$id){
	global $db; //includeの＄ｄｂ変数取得
	$limit = 20; //1ページに表示するレコード
	$offset = ($page-1)*$limit;	
	$sql="select * from channel where id=".$id;
	$sql .=" limit ".strval($limit);
	$sql .=" offset ".strval($offset);
	$info= $db->query($sql);
	$results= $info->fetchAll(PDO::FETCH_ASSOC);
	return $results;		
	}
	
	public function select_info(){
	global $db; //includeの＄ｄｂ変数取得
	$sql .="select distinct title,id from channel";
	$sql .=" where true ";
	$sql .=" order by id desc";
	$info= $db->query($sql);
	$results= $info->fetchAll(PDO::FETCH_ASSOC);
	return $results;		
	}
	
	public function select_title($id){
	global $db; //includeの＄ｄｂ変数取得
	$sql="select distinct title from channel where id=".$id;
	$info= $db->query($sql);
	$results= $info->fetchAll(PDO::FETCH_ASSOC);
	return $results;		
	}
	
}
?>