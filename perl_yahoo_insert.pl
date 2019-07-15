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
#my $dsn = "dbi:mysql:database=movie_info;host=192.168.179.6;port=3306";
#print $dsn;
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
my $keyword = $ARGV[0];
$strUrl= "https://auctions.yahoo.co.jp/search/search?select=22&exflg=1&b=1&n=50&p=".uri_escape($keyword);
print $strUrl;


#文字化け
$keyword = Encode::decode('utf-8',$keyword);
print $keyword;

#$req = HTTP::Request->new(GET => ' ' .$strUrl);
$req = HTTP::Request->new(GET => ''.$strUrl);
print $req; #IP取得　IOInterface

#リクエスト
$res = $ua->request($req)->as_string();
#文字化け
$res = Encode::decode('utf-8',$res);
#resがURLのソースファイルを出力する
print $res;

$res =~/<span class="Info__subText">の検索結果<\/span>(.*?)件<\/h1>/;
#件数出力
#print $1;
my $kensu;
$kensu = $1;
$kensu=~ s/,//g; #カンマを削除。カンマのまま代入するとSQLが理解できない為
print "件数：".$kensu."---";

# INSERT db名.テーブル名
my $sql = "INSERT INTO `movie_info`.`perl` 
(`keyword`,`kensu`) 
VALUES ('".$keyword."','".$kensu."');";

# my $sql = "INSERT INTO `movie_info`.`perl` 
# (`keyword`) 
# VALUES ('".$keyword."');";

print $sql;
$dbh->do($sql);

sleep(1);
exit;#行末に全角スペースなど入ってるとUnrecognized character \x{3000};を吐いて動かなくなるので注意