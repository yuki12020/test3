# perlファイルによる5ch掲示板のクローラー
<br>

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
