#!/usr/bin/perl　　#Perlのパス。とりあえず先頭行に書。
#yum cpan install
use warnings; #これ書いとかないとdebugが出てこなくなったりするので何をするときでも絶対記述
use strict; #、エラーになりそうな箇所も教えてくれる
use DBI; #データベース接続モジュール yum -y install perl-DBI perl-DBD-MySQL rootでインスト
use LWP::UserAgent; #yum install perl-libwww-perl
use HTTP::Cookies;
use Encode::Guess; 
use LWP::Protocol::https; #cpan install LWP::Protocol::https
use Image::Magick; #yum install ImageMagick-perl
use IO::Handle;
use IO::Interface::Simple; # yum install perl-IO-Interface
use Sys::Hostname;
#use Cv;  #OpenCvをインスト
use Time::HiRes qw/ gettimeofday /;
$ENV{'PERL_LWP_SSL_VERIFY_HOSTNAME'} = 0;
$ENV{PERL_NET_HTTPS_SSL_SOCKET_CLASS} = 'Net::SSL'; # prefer Crypt-SSLeay;
use utf8;
use encoding 'utf8';
use open IO  => ":utf8";
binmode(STDERR, ':raw :encoding(utf8)');
binmode(STDIN,  ":utf8");
binmode(STDOUT, ":utf8");
use URI::Escape;

# データベース接続準備
my $dbname = "dbi:mysql:database=movie_info;";
my $host = "host=192.168.179.6;"; 
my $port = "port=3306";
my $db =$dbname.$host.$port;
print $db;

my $user = "test123";
my $pass ="password";

# データベースハンドル
my $dbh = DBI->connect( 
	$db, $user, $pass,
  { RaiseError => 1, PrintError => 1, AutoCommit => 1, Warn => 1 }
)|| die $DBI::errstr;
$dbh->do("set names utf8");
print $dbh;
#下記をDB上のテーブルで適応する必要ある
#show variables like 'char%';
#ALTER TABLE テーブル名 CONVERT TO CHARACTER SET utf8;


my $eth = IO::Interface::Simple->new('eth1');
my $local_ip = '';

my $ua = LWP::UserAgent->new;
my $cook = HTTP::Cookies->new;

my $req = "";
my $content = "";
my $strUrl = "";
my $res = "";
#UA初期設定
$ua->agent(`/usr/bin/php /root/tsc/get_useragent2.php`);
#cookie初期設定
$ua->cookie_jar($cook);
my $url = $ARGV[0];
print $url;

$req = HTTP::Request->new(GET => ''.$url);
print $req; #IP取得　IOInterface

# #リクエスト
$res = $ua->request($req)->as_string();
# #文字化け　２ｃｈ掲示板はshift_jis で取得するぽい
$res = Encode::decode('Shift_JIS',$res);


my $num;
my $uid;
my $message;
my $block;
my $title;
my $sql;

my $thid;

#2ch　タイトル抜き取り \nが改行コード
$res =~/<h1 class="title">(.*?)\n<\/h1>/;
$title=$1;
print $title;

$res =~/<input type="hidden" name="key" value="(.*?)">/;
$thid = $1;
print $thid;

my $i;
#for($i=0;$i<10;$i++){}
while($res =~/<div class="post" id="(.*?)" data-date="(.*?)" data-userid="(.*?)" data-id="(.*?)">/gi)
{
	$num = $4;
	$uid = $3;
	print "----".$num."/n/n";
	print $uid;
	while($res =~/<div class="message"><span class="escaped">(.*?)<\/span><\/div>/gi)
	{
		$message = $1;
		$block = $message;
		last;
	}
	print $thid;
	#channelテーブルに詳細データをインサート
	$sql = "INSERT INTO `movie_info`.`channel` 
	(`id`,`num`,`uuid`,`title`,`block`) 
	VALUES ('".$thid."','".$num."','".$uid."','".$title."','".$block."');";
	#print $sql."--\n".$i++."\n\n";
	#アスキーアートがそのまま入力するとデーターベースエラーで、
	#アスキーアートのとき、次の繰り返しに移行（next;）
	if($block =~/<span class="AA">(.*?)<\/span>/gi){
	next;
	}else{
	$dbh->do($sql);	
	}
}

# INSERT db名.テーブル名
$sql = "INSERT INTO `movie_info`.`channel_title_id` 
(`id`,`title`) 
VALUES ('".$thid."','".$title."');";
print $sql;
$dbh->do($sql);


# INSERT db名.テーブル名
# $sql = "INSERT INTO `movie_info`.`channel` 
# (`title`,`block`) 
# VALUES ('".$title."','".$block."');";
# print $sql;
# $dbh->do($sql);

sleep(1);
exit;#行末に全角スペースなど入ってるとUnrecognized character \x{3000};を吐いて動かなくなるので注意