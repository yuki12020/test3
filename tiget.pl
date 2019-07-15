#!/usr/bin/perl
#strictプラグマを有効
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
# $ENV{'PERL_LWP_SSL_VERIFY_HOSTNAME'} = 0;
# $ENV{PERL_NET_HTTPS_SSL_SOCKET_CLASS} = 'Net::SSL'; # prefer Crypt-SSLeay;
# use utf8;
# use encoding 'utf8';
# use open IO  => ":utf8";

# binmode(STDERR, ':raw :encoding(utf8)');
# binmode(STDIN,  ":utf8");
# binmode(STDOUT, ":utf8");
use URI::Escape;

my $eth = IO::Interface::Simple->new('eth1');
my $local_ip = '';
my $ua = LWP::UserAgent->new;
my $cook = HTTP::Cookies->new;

my $req = "";
my $strUrl = "";
my $res = "";
my $content = "";
my $log_file_name = "";
#UA初期設定
$ua->agent(`/usr/bin/php /root/tsc/get_useragent2.php`);
#cookie初期設定
$ua->cookie_jar($cook);
#文字化け
$res = Encode::decode('utf-8',$res);


#---------------------------------------------------
#mail_address
my $mail_address = $ARGV[0];
#password
my $pass = $ARGV[1];
#講演名 空白スペースが＋に表示されるので変換する必要あり
$ARGV[2] =~ s/\s/+/i;
$ARGV[2] =~ s/#/%23/i;
my $event_name = $ARGV[2];
#開催日時
my $event_date = $ARGV[3]; 
#詳細情報
my $event_detail = $ARGV[4];
#audience_name
my $name =$ARGV[5];
#チケット枚数
my $number_of_sheets =$ARGV[6];


#----------------------------------------------login
$strUrl= "https://tiget.net/users/sign_in";
$req = HTTP::Request->new(GET => ' ' .$strUrl);
# #リクエスト 
$res = $ua->request($req)->as_string();
# #文字化け
$res = Encode::decode('utf-8',$res);

# #login_page token 
$content ="";
$res =~/<input type="hidden" name="authenticity_token" value="(.*?)" \/><div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10">/;
my $token = $1; #token information
# #/を削除 firefox上ではスラッシュのついてないパラメーターしかない為
$token =~s/\///g;

# #formで送るデータを&で接続していく
$content .= "&authenticity_token=".$token;
#parameter上ではuser[email]:mail_addressとなっている
$content .= "&user%5Bemail%5D=".$mail_address;  
$content .= "&user%5Bpassword%5D=".$pass;
 
# # #contentがパラメーター　getとは別で設定するPOStの場合
$strUrl= "https://tiget.net/users/sign_in";
$req = HTTP::Request->new(POST => ' ' .$strUrl);
$req->header('Content-Type' => 'application/x-www-form-urlencoded');
$req->content($content); 
#リクエスト
$res = $ua->request($req)->as_string();
#-----------------------------------------------

#---------------------------------------------------
$strUrl ="";
$strUrl= "https://tiget.net/events?utf8=✓&q[words]=".$event_name;
$req = HTTP::Request->new(GET => ' ' .$strUrl);
# #リクエスト
$res = $ua->request($req)->as_string();
# #文字化け
$res = Encode::decode('utf-8',$res);

our $event_number;
if($res=~/<div class="event-box btn-effect">(.*?)<\/div>/){
    # 検索結果が存在しただしくイベントnumberを取得する場合
    # #正規表現＿１ 検索ページ内　抽出 
    $res =~/<div class="event-title"><a href="\/events\/(.*?)">(.*?)<\/a>/;
    $event_number = $1;
    print "\n$event_number\n";
    my $venue = $2;
    print "$venue\n";
    #検索ページ
    open(WFH, "> /root/suzuki_perl_kensyu/tiget_test/log_html/log.html");
    print WFH $res;
    close(WFH);
}else{
    print "exitしました 108";
    exit;
}

# #--------------------------------------------------講演ページ内
$req = "";
$strUrl = "";
$res = "";
$content = "";
$log_file_name = "";
#UA初期設定
$ua->agent(`/usr/bin/php /root/tsc/get_useragent2.php`);
#cookie初期設定
$ua->cookie_jar($cook);
#文字化け
$res = Encode::decode('utf-8',$res);
#request
$strUrl= "https://tiget.net/events/"."$event_number";
$req = HTTP::Request->new(GET => ' ' .$strUrl);

print $res;
my $obj_url = "";
$res =~/margin-top:200px; margin-bottom:200px">(.*?)<\/div>/;
print "\n".$1."\n";


#event_numberに値が入ってなければプログラムを終了する
if(!defined($event_number)){
    print "exitしました137";
    exit;
}
    for(my $i=0;$i<70;$i++){
        print $i."\n";
        #リクエスト
        $res = $ua->request($req)->as_string();
        #文字化け
        $res = Encode::decode('utf-8',$res);
            # #log保存先
            $log_file_name = "suzuki_perl_kensyu/tiget_test/log_txt/log_page_1.txt";
            # #URLのlog
            $res =~/<a class="button" rel="nofollow" data-method="post" href="\/events\/(.*?)\/event_favorites">/;
            $obj_url = "\n\n"."https://tiget.net/events/".$1; 
            open(DATEFILE, ">> /root/".$log_file_name ) or die("Errror:$!");  
            print DATEFILE "$obj_url\n";close(DATEFILE);   
        if($res =~ /class="play_datetime"/i && $res =~ /ticket_type_id=[0-9]{5}/ ){
            last;
        }
    sleep(1);
    }

#講演ページ
open(WFH, "> /root/suzuki_perl_kensyu/tiget_test/log_html/log.html");
print WFH $res;
close(WFH);

#title
$res =~/<h1 class="title-box">(.*?)<\/h1>/;
my $venue_title = "$1"; 
open(DATEFILE, ">> /root/".$log_file_name ) or die("Errror:$!");  
print DATEFILE "$venue_title\n";
close(DATEFILE);

            while($res=~/<div class="play_datetime">(.*?)<\/div>/gi){
                       print $1."\n";  #date 公演日時
                       my $play_date =$1;
                       #開催日時
                       $event_date = $ARGV[3];
                       $event_date = Encode::decode('utf-8',$event_date);
                       #print $event_date;
                       print "play:date:".$play_date."\n";
                       print "hikisuu_date:".$event_date."\n";
                       
            if($play_date eq $event_date){    
                   while($res =~/<div class="tikcet-type-name">(.*?)<\/div><div class="reception-button-frame button-effect fade-effect"><a href="\/home\/tickets\/new\?ticket_type_id=(.*?)">/gi){
                           print "\n\n";
                           #詳細情報
                           $event_detail = $ARGV[4];
                           $event_detail = Encode::decode('utf-8',$event_detail);                          
                          #正規表現で取得した値の前後の空白行を削除する
                           sub trim {
                                    my $val = shift;
                                    $val =~ s/^ *(.*?) *$/$1/;
                                    return $val;
                            }
                           #----------------------------------
                           my $tktid =$1;
                           $tktid = trim($tktid);
                           
                           $event_detail =trim($event_detail);
                           
                           print "event of d:".$event_detail."-\n";  #詳細情報   
                           print "tkyid of d:".$1."-\n";  #詳細情報                
                           print "ticket_id:".$2."-\n";  #ticket_id     
                           
                           #条件分岐
                           my $test =$event_detail eq $tktid ? our $ticket_type_id = $2: next;                       
                           print "\n\n".$test."\n\n";                           
                       next;
                    }
                }else{
                    next;
                }
            last;
           }   

#---------------------------------------予約ページに飛ぶ   
$strUrl="";
my $ticket_id = our $ticket_type_id;
print $ticket_id;
#get read only
$strUrl= "https://tiget.net/home/tickets/new?ticket_type_id="."$ticket_id";
$req = HTTP::Request->new(GET => ' ' .$strUrl);
#リクエスト
$res = $ua->request($req)->as_string();
#文字化け
$res = Encode::decode('utf-8',$res);
print "\n".$strUrl."\n";

#売り切れ、受付終了だとticket_idが存在しないので、exitする
if($ticket_id eq ""){
    print "exitしました229";
    exit;
}else{
    $res =~/<div class="(.*)"><label class="control-label" for="">お目当ての出演者<\/label>/;
    #print ("$1\n");
    open(WFH, "> /root/suzuki_perl_kensyu/tiget_test/log_html/log_eventpage_0.html");
    print WFH $res;
    close(WFH); 

    #正規表現でトークン情報を取得
    $res =~/name="authenticity_token".+?value="(.+?)"/i;
    print $1;
    $token = $1; #token information
    print $token;
    #/を削除 スラッシュ,==のついてないパラメーターが送られている為
    #$token =~s/\///g;
    #$token =~s/==//;
    #ログインで$contentを使用しているので、一度初期化する必要がある為、””で空白の処理にしてやらないといけない
    $content = "";
    #受付formで送るデータを＆で括る
    #utf8
    $content .="utf8=%E2%9C%93";
    #tokenの情報内に含まれている（/）や（==）などエスケープする必要がある為、宣言部でUse URI:escape;を宣言してやらないといけない
    $content .="&authenticity_token=".uri_escape_utf8($token);
    #$content .="&authenticity_token=".$token;
    #temp
    $content .="&audience%5Bprogram_id%5D=";
    $content .="&audience%5Bprogram_id%5D=";
    #ticket_id
    $content .="&audience%5Bticket_type_id%5D="."$ticket_id";
    $content .="&method=";
    #name
    $content .="&audience%5Bname%5D="."$name";
    #email_address
    $content .="&audience%5Bemail%5D="."$mail_address";
    #枚数
    $content .="&audience%5Bvolume%5D="."$number_of_sheets";
    #お目当ての出演者(あるものとないものがある)分岐させる必要がある
    if($res =~/<label class="control-label" for="">お目当ての出演者<\/label>/){
    $content .="&audience%5Bintroducer%5D="."";
    }else{
    $content .="";
    }
    #備考
    $content .="&audience%5Bnote%5D="."";
    #post $strUrl= "https://tiget.net/home/tickets/new?ticket_type_id="."$number";
    #パラメーター送信先のURLを確認するには、firefoxのデベロッパーツール→ネットワーク→POST→ヘッダー→要求URL
    $strUrl= "https://tiget.net/home/tickets/preview";
    $req = HTTP::Request->new(POST => ' ' .$strUrl);
    $req->header('Content-Type' => 'application/x-www-form-urlencoded');
    $req->content($content); 
    #アクセス元のURIを求めてくる場合もあるので、※つながらない場合はリファラの処理を書いてやる
    $req->referer("https://tiget.net/home/tickets/new?ticket_type_id="."$ticket_id"); 
    #リクエスト
    $res = $ua->request($req)->as_string();
}

#**************
#ticket 予約ページから取得するデータを変数に格納して処理する
$res =~/イベント<\/div><div class="col-md-10 col-lg-10 rowdata">(.*?)<\/div><\/div>/; 
my $get_ivent_name = $1;
print "\n".$get_ivent_name."\n";

$res =~/開催日<\/div><div class="col-md-10 col-lg-10 rowdata">(.*?)<\/div><\/div>/;
my $get_date =$1;
print "\n".$get_date."\n";

$res =~/料金<\/div><div class="col-md-10 col-lg-10 rowdata">(.*?)<\/div><\/div>/;
my $get_fee =$1;
print "\n".$get_fee."\n";

#コメント文記述でエラーになっていたため注意
$res =~/枚数<\/div><div class="col-md-10 col-lg-10 rowdata">(.*?)<\/div><\/div>/;
my $get_sheets =$1;
print "\n".$get_sheets."\n";
#**************


#fileへの書き込み
$log_file_name = "suzuki_perl_kensyu/tiget_test/log_txt/log_accept_form_123.txt";
open(DATEFILE, ">> /root/".$log_file_name ) or die("Errror:$!");  
print DATEFILE "param:$content\n";
close(DATEFILE);      
#htmlへの書き込み
open(WFH, "> /root/suzuki_perl_kensyu/tiget_test/log_html/log_eventpage_1.html");
print WFH $res;
close(WFH);
#----------------------------------------------------------

#予約確定ページに飛ぶ-------------------------------------------
if($res =~/<h1 class="text-center">現在ページを表示できません。<\/h1>/ || /margin-bottom:200px">ページが存在しません<\/div>/){
    print "exitしました 322";
    exit;
}else{
    print "\n".$token."\n";
    $token ="";
    $res =~/<input type="hidden" name="authenticity_token" value="(.*?)" \/><div class="rowitem"><div class="col-md-2 col-lg-2 rowhead">/;
    $token =$1; #token information
    $content = "";
    $content .="utf8=%E2%9C%93";    #utf8
    $content .="&authenticity_token=".uri_escape_utf8($token);
    $content .="&audience%5Bprogram_id%5D=";
    #ticket_id
    $content .="&audience%5Bticket_type_id%5D="."$ticket_id";
    #name
    $content .="&audience%5Bname%5D=".uri_escape_utf8($name);
    $content .="&audience%5Bemail%5D="."$mail_address";
    #枚数
    $content .="&audience%5Bvolume%5D="."$number_of_sheets";
    #お目当ての出演者(あるものとないものがある)分岐させる必要がある
    if($res =~/<label class="control-label" for="">お目当ての出演者<\/label>/){
    $content .="&audience%5Bintroducer%5D="."";
    }else{
    $content .="&audience%5Bintroducer%5D="."";
    }
    #備考
    $content .="&audience%5Bnote%5D="."";
    print $content."\n";

    #post先  にデータを送る
    $strUrl= "https://tiget.net/home/tickets";
    $req = HTTP::Request->new(POST => ' ' .$strUrl);
    $req->header('Content-Type' => 'application/x-www-form-urlencoded');
    $req->content($content);
    $req->referer("https://tiget.net/home/tickets/preview"); 
    $res = $ua->request($req)->as_string();

    open(WFH, "> /root/suzuki_perl_kensyu/tiget_test/log_html/log_eventpage_2.html");
    print WFH $res;
    close(WFH);
}

#------------最終遷移先のページに遷移し、受付番号を取得する
if($res =~/<h1 class="text-center">現在ページを表示できません。<\/h1>/ || /margin-bottom:200px">ページが存在しません<\/div>/){
    print "exitしました 365";
    exit;
}else{
    $res =~/<html><body>You are being <a href="(.*?)">redirected<\/a>/;
    $strUrl = $1;
    #get read only
    $req = HTTP::Request->new(GET => ' ' .$strUrl);
    #リクエスト
    $res = $ua->request($req)->as_string();
    #文字化け
    $res = Encode::decode('utf-8',$res);

    $res =~/<span class="num">(.*?)<\/span>/;
    #受付番号
    my $accept_number = $1;
    print "\n".$accept_number."\n";

    open(WFH, "> /root/suzuki_perl_kensyu/tiget_test/log_html/log_eventpage_3.html");
    print WFH $res;
    close(WFH);
    #--------------------------------------------------------------------
    print "\n".$get_ivent_name."\n";
    print "\n".$get_date."\n";
    print "\n".$get_fee."\n";
    print "\n".$get_sheets."\n";
    print "\n".$accept_number."\n";

    my $log_file = "suzuki_perl_kensyu//tiget_test/log_txt/tiget_log.txt";
    open(DATEFILE, ">> /root/".$log_file )  or die("Errror:$!");  
    print DATEFILE "\n";
    print DATEFILE $get_ivent_name."\n";
    print DATEFILE $get_date."\n";
    print DATEFILE $get_fee."\n";
    print DATEFILE $get_sheets."\n";
    print DATEFILE $accept_number."\n";
    close(DATEFILE); 


#チケット購入　管理画面へ    
    my $strTDIaddr;
    open(RFH, "< /root/tsc/data/distserver.addr"); 
    $strTDIaddr = <RFH>;
    close(RFH);
        my $playguide = "tiget";
        my $km = 0;
        my $title = $get_ivent_name." ".$get_date;
        $get_fee =~ /^.+?([0-9,]+)/;
        my $price = $1;
        $price =~ s/[^0-9]//g;
        my $totalPrice = $price * $number_of_sheets;
        my $body = '<seatDetail>'.$get_fee." ".$get_sheets.'</seatDetail><ticketNum>'.$accept_number.'</ticketNum>'
                        .'<price>'.$price.'</price><totalPrice>'.$totalPrice.'円</totalPrice>'.'<localip>'.$local_ip.'</localip>';

        my ($hour,$min,$sec,$mday,$mon,$year) = (localtime(time))[2,1,0,3,4,5];
        my $ontime = sprintf("%04d-%02d-%02d %02d:%02d:%02d",($year+1900),($mon+1),$mday,$hour,$min,$sec);

        my $setDataUrl = 'http://'.$strTDIaddr.'/set_dist_data.php?playguide='.$playguide.'&account='.urlencode($mail_address)
                                     .'&title='.urlencode($title).'&body='.urlencode($body).'&km='.$km.'&ontime='.urlencode($ontime)
                                     .'&yoyaku='.urlencode($get_sheets);

        my $req2 = HTTP::Request->new(GET => $setDataUrl);
        $req2->header('Content-Type' => 'application/x-www-form-urlencoded');

        my $res2 = $ua->request($req2)->content;
        my $kanri_id;
        
        #unique Idを判定する
        if( $res2 =~ /([1-9][0-9]{6,})/ ){
             $kanri_id = $1;
        }
        
        $setDataUrl = 'http://'.$strTDIaddr.'/yoyaku_done.php?account='.$kanri_id.'&yoyaku='.urlencode($get_sheets);
        $req2 = HTTP::Request->new(GET => $setDataUrl);
        $req2->header('Content-Type' => 'application/x-www-form-urlencoded');
        $res2 = $ua->request($req2)->content;
        
    sleep(1);
    exit;
}


sub urlencode{
	my $URLencode=shift;
	#return $URLencode;
	$URLencode=~s/([^0-9A-Za-z_ ])/'%'.unpack('H2',$1)/ge;
	$URLencode=~s/\s/+/g;
	return $URLencode;
}