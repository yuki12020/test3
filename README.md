# perlファイルによる5ch掲示板のクローラー
<br>

<b>やる事<b><br>
(1)コマンドライン上でperlを実行。（引数に取得したい５ちゃんのURLを入力）
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

<br>
<b>やる事<b><br>
(2)perlで取得したデータを見せる用の画面で表示
  <br>データベースにコメントやタイトルをセレクトしまとめサイトの用に出力
  <br>bootstrapのmarbleを改良し出力
  <br>https://demos.freehtml5.co/marble/<br>
  ![result](https://github.com/yuki12020/images/blob/master/view.gif)
  
