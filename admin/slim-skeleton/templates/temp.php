<!DOCTYPE html>
<html lang="en">
<head>
<!--head-->
<?php  include dirname(__FILE__) ."./../include/head.php"; ?>					
<!--head end-->		
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
			           <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title">Striped Table with Hover</h4>
                                    <p class="card-category">Here is a subtitle for this table</p>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Salary</th>
                                            <th>Country</th>
                                            <th>City</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Dakota Rice</td>
                                                <td>$36,738</td>
                                                <td>Niger</td>
                                                <td>Oud-Turnhout</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Minerva Hooper</td>
                                                <td>$23,789</td>
                                                <td>Curaçao</td>
                                                <td>Sinaai-Waas</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
