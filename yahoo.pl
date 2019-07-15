#!/usr/bin/perl
use warnings;
use strict;
use LWP::UserAgent;
use HTTP::Cookies;
use Encode::Guess;
use Image::Magick;
use IO::Handle;
use IO::Interface::Simple;
use Sys::Hostname;
use Cv;
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

#URL
#取得ページの1ページ目のURL　＊50件以上あるページに限る
#$strUrl= $ARGV[1];
$strUrl="https://auctions.yahoo.co.jp/category/list/%E5%8E%A8%E6%88%BF%E6%A9%9F%E5%99%A8-%E5%BA%97%E8%88%97%E7%94%A8%E5%93%81-%E4%BA%8B%E5%8B%99-%E5%BA%97%E8%88%97%E7%94%A8%E5%93%81/2084048468/?p=%E5%8E%A8%E6%88%BF%E6%A9%9F%E5%99%A8&auccat=2084048468&fixed=2&aucminprice=140000&aucmaxprice=142999&exflg=1&b=1&n=50&s1=featured&mode=2";
$req = HTTP::Request->new(GET => ' ' .$strUrl);

# postの場合
#$req->content( $content);
#$req->header('Content-Type' => 'application/x-www-form-urlencoded');

#リクエスト
$res = $ua->request($req)->as_string();

#文字化け
$res = Encode::decode('utf-8',$res);


$res =~/<p class="total">(\w)<em>(.*)<\/em>(\w)/;
my $total =$2; 
my $i;
#count of number
print"***********\n";
print "件数：$total\n";
my $next_string = $ARGV[0]; #commandline argument　of　next designation
print "$next_string\n";
#---------------------------------------

#category
# $res =~/<p class="$next_string"><a href="(.*)b=(.*)(&amp;|&)n=(.*)(&amp;|&)(.*)"  data-ylk="(.*)" >/;
# my $url_test=$1.$2.$3.$4.$5.$6;
# print "$url_test\n\n";

# # #変換後
# $url_test =~s/&amp;/&/g;
# print $url_test;
# print "\n";

 for($i=1; $i<$total; $i +=50){
     # my $tmp = "<p class=\"$next_string\"><a href=\"(.*)b=$i(&amp;|&)n=(.*)(&amp;|&)s1=featured(&amp;|&)(.*)\"  data-ylk=\"(.*)\" >";
     # print "\n$tmp\n";
     # $res =~/$tmp/; 
     # print $1.$2.$3.$4.$5.$6;
     $res =~/<p class="$next_string"><a href="(.*)b=(.*)(&amp;|&)n=(.*)(&amp;|&)(.*)"  data-ylk="(.*)" >/;
     my $url_test=$1."b=$i".$3."n=$4".$5.$6;     
     $url_test =~s/&amp;/&/g;
     print "$url_test\n\n";
     $url_test ="$url_test";
     $req = HTTP::Request->new(GET => ' ' .$url_test);
         
    #リクエスト
    $res = $ua->request($req)->as_string();
    #文字化け
    $res = Encode::decode('utf-8',$res);
    while($res =~/<table>\n<tr><td>\n<a href="https:\/\/page.auctions.yahoo.co.jp\/jp\/auction\/(.*) data-ylk=(.*)>\n<img src=(.*) alt=(.*) width=(.*) height=(.*)/gi)
    {
    open(DATEFILE, ">> /root/suzuki_perl_kensyu/log_test_3.txt") or die("Errror:$!");  
    print DATEFILE "商品名：$4\n";
    close(DATEFILE); 
    print "商品名：$4\n";
    
        while($res =~/<a href="https:\/\/page.auctions.yahoo.co.jp\/jp\/auction\/(\w|)(.*)"  data-ylk="(.*)/g){
        open(DATEFILE, ">> /root/suzuki_perl_kensyu/log_test_3.txt") or die("Errror:$!");  
        print DATEFILE "オークションID：$1$2\n";
        close(DATEFILE);  
        print "オークションID：$1$2\n";
        last;
        }
        while($res =~/(<td class="pr1">)\n(.*)/gi){
        open(DATEFILE, ">> /root/suzuki_perl_kensyu/log_test_3.txt") or die("Errror:$!");  
        print DATEFILE "現在　価格：$2\n";
        close(DATEFILE); 
        print "現在価格：$2\n"; #現在価格　（改行は/nであらわす）
        last;
        }
        while($res =~/(<td class="pr2">)\n(.*)/gi){
            if("$2" eq "<span>－</span>"){   #文字列の比較はeqで比較するので注意
                open(DATEFILE, ">> /root/suzuki_perl_kensyu/log_test_3.txt") or die("Errror:$!");  
                print DATEFILE "即決　価格：-\n";
                close(DATEFILE);
                print "即決価格：-\n"; #即決価格　（改行は/nであらわす）
                last;
            }else{
                open(DATEFILE, ">> /root/suzuki_perl_kensyu/log_test_3.txt") or die("Errror:$!");  
                print DATEFILE "即決　価格：$2\n";
                close(DATEFILE); 
                print "即決　価格：$2\n"; #即決価格　（改行は/nであらわす）
                last;
            }
        }
        while($res =~/(<td class="ti">)\n(.*)/gi){
                open(DATEFILE, ">> /root/suzuki_perl_kensyu/log_test_3.txt") or die("Errror:$!");  
                print DATEFILE "時間：$2\n\n";
                close(DATEFILE);     
                print "時間：$2\n"; #残り時間　（改行は/nであらわす）
                last;
        }
    }
    print"\n"; 
 }

open(WFH, "> /root/suzuki_perl_kensyu/log_test_3.html");
print WFH $res;
close(WFH);

sleep(1);
exit;