# perlファイルによる5ch掲示板のクローラー
<br>

<b>やる事<b><br>
(1)コマンドライン上でperlを実行。
 perl_2ch_insert_2.pl 
<br>（引数に取得したい５ちゃんのURLを入力）
<br>データベースにコメントやタイトルを保存する

（１）
perlのクローラーにより<br>
https://asahi.5ch.net/newsplus/<br>
の５ちゃん掲示板のスレッドのコメントやタイトルを取得<br>
データベースに保存
![result](https://github.com/yuki12020/images/blob/master/perl.gif)
<br>
<br>
ただし、アスキーアートや特殊文字が頻発しているものは完全に取得できない為、改良が必要。
<br>
これはデーターベースインサート時に特殊文字が頻発するアスキーアートをエスケープしきれない為である。
<br>

<hr>
<br>
<br>marbleフォルダ内
<b>やる事<b><br>
(2)perlで取得したデータを見せる用の画面で表示
  <br>データベースにコメントやタイトルをセレクトしまとめサイトの用に出力
  <br>bootstrapのmarbleを改良し出力<br>
  marble url: https://demos.freehtml5.co/marble/<br>
  <br>
  
![result2](https://github.com/yuki12020/images/blob/master/view.gif)
 
<hr>
<br>
<br>adminフォルダ内
<b>やる事<b><br>
(3)perlで取得したデータを見せる用の画面で表示
  <br>データベースにコメントやタイトルをセレクトしまとめサイトの用に出力
  <br>データベースのデータを更新、削除、リスト付けしている
  <br>bootstrapのlightを改良し出力<br>
  light url: https://www.creative-tim.com/product/light-bootstrap-dashboard<br>
  <br>
  (2)と異なり、こちらはadminフォルダ内でslimというフレームワークを使用している
  slim url::  http://www.slimframework.com/
  
![result2](https://github.com/yuki12020/images/blob/master/dash.gif)
