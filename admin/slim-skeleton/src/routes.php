<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    // $container = $app->getContainer();
    // $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // // Sample log message
        // $container->get('logger')->info("Slim-Skeleton '/' route");

        // // Render index view
        // return $container->get('renderer')->render($response, 'index.phtml', $args);
    // });
	
	//detail_tmp.phtmlの初期ページ
	// $app->map(['GET', 'POST'], '/detail_tmp', function ($request, $response, $args) {
	  // $mapper = new TestMapper($this->db);
	  // $test = $mapper->getTests();
	  // $response = $this->renderer->render($response, "detail_tmp.phtml", ["data" => $mapper]);
	// });

	// //出来てる
	 $app->get('/book_api', function (Request $request, Response $response, array $args) use ($container) {
		 error_reporting(0);
		  $mapper = new TestMapper($this->db);
		  $test = $mapper->getTests();

		  ob_start();
		  var_dump($test);
		  $t = ob_get_contents();
		  ob_end_clean();
		  var_dump($test);

		  return $response;
   });
   
   	// //出来てる
	 $app->get('/movie', function (Request $request, Response $response, array $args) use ($container) {
		  echo "movie";
		  error_reporting(0);
		  //ファイル名movie_class.php 
		  //クラス名もmovie_classで統一しないとデータが上手く表示されない模様
		  $mapper = new movie_class($this->db);
		  $test = $mapper->movie_info();
		  var_dump($test);
   });

	
	//movie_info出来てる｛
	$app->map(['GET', 'POST'],'/movie_info', function ($request, $response, $args) {
	  //movie_class.phpのmovie_classクラスのインスタンス作成
	  $mapper = new movie_class($this->db);
	  $response = $this->renderer->render($response, "movie_info.phtml", ["data" => $mapper]);
	});
	
	//movie_info_details出来てる｛
	$app->map(['GET', 'POST'],'/movie_info_detail', function ($request, $response, $args) {
	  //movie_class.phpのmovie_classクラスのインスタンス作成
	  $mapper = new movie_class_details($this->db);
	  $response = $this->renderer->render($response, "movie_info_detail.phtml", ["data" => $mapper]);
	});
	
	//-----2ch---------------------------------
	$app->map(['GET', 'POST'],'/ch2_info', function ($request, $response, $args) {
	  //movie_class.phpのmovie_classクラスのインスタンス作成
	  $mapper = new ch2_class($this->db);
	  $response = $this->renderer->render($response, "ch_title.phtml", ["data" => $mapper]);
	});
	
	$app->map(['GET', 'POST'],'/ch2_info_detail', function ($request, $response, $args) {
	  //movie_class.phpのmovie_classクラスのインスタンス作成
	  $mapper = new ch2_class_details($this->db);
	  $response = $this->renderer->render($response, "2ch_info_detail.phtml", ["data" => $mapper]);
	});
	
	//----list---------------------------------
	$app->map(['GET', 'POST'],'/ch2_list', function ($request, $response, $args) {	  
	  $mapper = new list_class($this->db);
	  $response = $this->renderer->render($response, "list.phtml", ["data" => $mapper]);
	});
	
	$app->map(['GET', 'POST'],'/list_detail', function ($request, $response, $args) {	  
	  $mapper = new list_detail_class($this->db);
	  $response = $this->renderer->render($response, "list_detail.phtml", ["data" => $mapper]);
	});
	
};
