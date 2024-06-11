<?php
# ブラウザにエラー出力する。実運用時にこの設定にしてはならない。
ini_set('display_errors', 1);

# POST されてきたデータの受け取り（decode）
# POST されてきた jsonを受け取る
$json = file_get_contents("php://input");

# jsonをPHPのデータ構造に変換
$submit = json_decode($json, true);

# 値の取り出し
$title = $submit['title'];
$param1 = $submit['param1'];
$param2 = $submit['param2'];
# コントローラ（あるいはdispatcherとして）の処理
$submit['error'] = false;

switch($title) {
  case 'fill-in-the-blanks':
    $submit['result'] = "output"
  case 'add':	# 加算
    $submit['result'] = $param1 + $param2;
    break;
  case 'sub':	# 減算
    $submit['result'] = $param1 - $param2;
    break;
  default:	#error
    $submit['error'] = true; 
}

# json 文字列に符号化
$json = json_encode($submit);

# HTTP headerでjsonを指定
header('Content-Type: application/json; charset=UTF-8');

# HTTP body としてjson文字列を出力
print($json);

?>
