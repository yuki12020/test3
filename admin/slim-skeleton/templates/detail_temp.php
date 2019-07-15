<!DOCTYPE html>
<html lang="en">
<head>
<!--head-->
<?php  include dirname(__FILE__) ."./../include/head.php"; ?>					
<!--head end-->
    <style>
        .scrollbox {
          poisition: relative;
          width: 100%;
          height: 400px;
          margin: 20px auto;
          padding: 10px;
          background-color: #fff;
          overflow: scroll;
          box-shadow:0 2px 10px rgba(#000,.5);
          @include box-sizing(border-box);
        }

        // スクロールバー全体
        .scrollbox::-webkit-scrollbar {
            width:10px;
            background:#D8EAFF;
        }
        // 横スクロールバー全体
        .scrollbox::-webkit-scrollbar:horizontal {
            height:10px;
        }
        
        // スクロールバー上下左右末端のボタン
        .scrollbox::-webkit-scrollbar-button {
            width:10px;
            height:10px;
            background:#D8EAFF;
        }
        // ドラッグするツマミ部分
        .scrollbox::-webkit-scrollbar-thumb {
            background:#D8EAFF;
            border-radius: 10px;
            box-shadow: none;
        }
        // 右下角部分
        .scrollbox::-webkit-scrollbar-corner {
            background:#D8EAFF;
        }
    </style>		
</head>
<body>
    <div class="wrapper">	
<!--sidebar-->
<?php  include dirname(__FILE__) ."./../include/side.php"; ?>					
<!--sidebar end-->		
        <div class="main-panel">	
			<!--nav　インクルード　-->
			<?php  include dirname(__FILE__) ."./../include/nav.php"; ?>
			<!--nav　インクルード　end-->						
			<?php echo "detail_tempテンプレ記述エリア";?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">詳細ページサンプル</h4>
                                <p class="category">こちらのページは詳細ページです。</p>
                            </div>
                            <div class="content">
                            
                            <div class="row">
                                <div class="col-md-2 col-md-offset-0">
                                <a href="/public/point/" class="btn btn-primary">一つ前に戻る</span></a>
                                </div>
                            </div>	
                                    
                            <?php 
							//テストデータ
							$id_number=99999;
							$take_point="test";
							$retention_point="test";
							$record_date="test";
							$secession_date="test";
							?>
                                
								<div class="typo-line" style="margin-bottom:50px">
                                <h5><p class="category">No.</p></h5>
                                <p><?php echo $id_number; ?></p>
                                </div>
                                
                                <form action ="/public/point/" method ="post">
									<div class="typo-line">
									<h5><p class="category">メールアドレス</p></h5>
									<p><input class="form-control" name ="mail_addr" value="<?php echo htmlspecialchars($mail,ENT_QUOTES,'UTF-8'); ?>"></p>
									</div>
									
									<div class="typo-line" style="margin-bottom:50px">
									<h5><p class="category">所持ポイント</p></h5>
									<p><?php echo $take_point; ?></p>
									</div>
																	
									<div class="typo-line" style="margin-bottom:50px">
									<h5><p class="category">保留ポイント</p></h5>
									<p><?php echo $retention_point; ?></p>
									</div>
									
									<div>
									<p style="text-align:center;">
									<input type = "submit" class="btn btn-primary" value ="更新">
									</p>
									</div>
                                </form>
                                                 
                                
                            <div class="row">
                                <div class="col-md-2 col-md-offset-0">
                                <a href="/public/point/" class="btn btn-primary">一つ前に戻る</span></a>
                                </div>
                            </div>
			
			
            <footer class="footer">
					<!--copywrite-->
					<?php  include dirname(__FILE__) ."./../include/copywrite.php"; ?>					
					<!--copywrite end-->	
            </footer>
        </div>
    </div>
</body>
</body>
<!--core_js-->
<?php  include dirname(__FILE__) ."./../include/core_js.php"; ?>					
<!--core_js end-->		
</html>
