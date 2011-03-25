//<?
$version = 0.85;
if ($PHP_SELF=='') $PHP_SELF = $_SERVER["PHP_SELF"];			// ���� � �������� �����
$tmp=$QUERY_STRING;if($tmp=='') $tmp=$_SERVER["QUERY_STRING"];	// � ����������� �� �������� �������
parse_str($tmp);

$admin = "user.dr_d00m";								// ����� ������, ������ ������� ��� �����������

// ��������� �� ���������
$game_title = "World of Death";						// �������� ����
$game_file = "game1.dat";							// ���� ��� ���������� ����
$time_logout = 5*60;								// ���� ������� ������ ������ �� ��������, ������� ��� �������
$time_objects_destroy = 20*60;						// ������� ��� ����������� ���������, ����� ���. ��� ������������
$time_crim = 30*60;								// �����, ������� ������� �������� ����������
$time_regenerate = 30;								// ����� ����������� ����� � ���� �� ������� (��� ����� ������� ����������� � ���������)
$points_limit_attr = 24;							// ����� ����� �� str.dex.int
$points_limit_attr_one=10;							// ������������ �������� str,dex,int
$points_limit_skills=980;							// ����� ����� �� ������
$points_limit_skills_one=10;							// ������. �������� ������ ������
$points_levelup = 5;								// �����., �� ������� ���������� ����� ����� ���������� � ������� ��� �������� �� ����. �������. ��� �������� ������� ���� ���������� � ����������� 1 ���� �����
$time_defspeed = 4;								// �� ��������� ������� ����� ������� �������� 4 �������
$count_show = 10;									// ����� ���-�� �������� ���������� �� ������ �� ���
$page_size = 1500;								// �� ����� �������� �������� ������ ���������� wml
$journal_count=10;									// ���-�� ������� � �������
$page_font=1;

######################### F_GILD.DAT

  $x[50]="������ � �����";
  $x[51]="�������� � ���� ������";
  $x[52]="�������� ������ ������";
  $x[54]="������ �� ����� ������!";
  $x[55]="�������� �����";
  $x[56]="������ � ���� ������ ���";
  $x[57]="����� ������";
  $x[58]="���������";
  $x[59]="�������";
  $x[60]="���������";
  $x[61]="�������";
  $x[62]="��������";
  $x[63]="��������";
  $x[64]="��������";
  $x[65]="� ����� ����� ��� ���� ����� ���������!";
  $x[66]="���. �����";
  $x[67]="�� ������ �����";
  $x[68]="��� �� ��������� �������";
  $x[69]="����� ��� � ��� � �������!";
  $x[70]="�����";
  $x[71]="���� ��������� � ����� ������ ������";
  $x[72]="�������!";
  $x[73]="���������";
  $x[74]="���� ���������";
  $x[75]="�������";
  $x[76]="��������� �� ����� �����";
  $x[77]="��������";
  $x[78]="����� ������������";
  $x[79]="�������� �����";
  $x[80]="C��������";
  $x[81]="���������";
  $x[82]="���� ������ ����";
// �������� ����������
$page_main = "";
$page_desc = "";

if (file_exists("flag_update"))  eval(implode('',file("f_update.dat")));

//��������� �������� �� ��������
eval(implode('',file("loc.dat")));

// ���������� ����������� ������
Error_Reporting(E_ALL & ~E_NOTICE);
function myErrorHandler ($errno, $errstr, $errfile, $errline) {
}
set_error_handler("myErrorHandler");

eval(implode('',file("decode.php")));

if ($login){
	if (substr($login,0,5)!='user.') $login='user.'.$login;
}
else{
	$p='';
	$login='';
	if ( $sid && strpos($sid,',') ){
		$sid_temp=split(',',$sid);
		$login="user.".$sid_temp[0];
		$p=$sid_temp[1];
	}
}

$sid='';
if ($login && $p) $sid=str_replace('user.','',$login).','.$p."&r=".rand(1,99);
$login=str_replace('$','',$login);	// ����� PHP �� �������� �� ����������
//remotec($login);

// ������ ����
$_fnumn = "g.flag";
$_fnumb = fopen($_fnumn,"a+");
flock($_fnumb,2);

function my_time(){
	$t = explode(" ",microtime());
	return ((float)$t[0] + (float)$t[1]);
}
$myt_start = my_time();
if ( file_exists($game_file) ) $game = unserialize(implode('',file($game_file)));
else eval(implode('',file("f_blank.dat")));


if ($site || $tmp=='') eval(implode('',file("f_site.dat"))); // ��� ��� �������� �����
if (!$login || !isset($game["players"][$login])) {$site="connect";eval(implode('',file("f_site.dat")));}

$info=split("\|",$game["loc"][$game["players"][$login]][$login]["info"]);
if ($info[0]!=$p) msg("������������ ������<br/><a href=\"$PHP_SELF\">�� �������</a><br/>",$game_title,0,'none');


// ��������� �� ������
if ( !isset($game["loc"]["loc.0"]) || count($game["loc"]["loc.0"])<2 ) eval(implode('',file("f_upgrade.dat")));

$player=&$game["loc"][$game["players"][$login]][$login];
$player["time"]=time();

$ip=(isset($_SERVER['REMOTE_ADDR']))?$_SERVER['REMOTE_ADDR']:0;
$player['ip']=$ip;
$player['browser']=@$HTTP_USER_AGENT;

// ���������
if (isset($player["pd"])){
	$pnas=split("\|",$player["pd"]);
	if ( isset($pnas[1]) ) if ( $pnas[1] ) $count_show = $pnas[1];
	if ( isset($pnas[2]) ) if ( $pnas[2] ) $page_size =$pnas[2];
	if ( isset($pnas[3]) ) if ( $pnas[3]==0 ) $page_font = $pnas[3];
	if ( isset($pnas[4]) ) if ( $pnas[4] ) $points_limit_skills = 1000;
	if ( isset($pnas[5]) ) if ( $pnas[5] ) $journal_count = $pnas[5];
}

// ������������� ��������
ai();

// ������������ ������
if ($adm) eval(implode('',file("f_admin.dat")));
if ($look) eval(implode('',file("f_look.dat")));
if ($speak) eval(implode('',file("f_speak.dat")));
if ($HTTP_POST_VARS["say"]) eval(implode('',file("f_say.dat")));
if ($msg) eval(implode('',file("f_msg.dat")));
if ($attack) eval(implode('',file("f_attack.dat")));
if ($take) eval(implode('',file("f_take.dat")));
if ($drop) eval(implode('',file("f_drop.dat")));
if ($use) eval(implode('',file("f_use.dat")));		// $use ����������� ������ $list!
if ($list) {
	if ($list=='skill') eval(implode('',file("f_listskill.dat")));
	if ($list=='magic') eval(implode('',file("f_listmagic.dat")));
	if ($list=='inv') eval(implode('',file("f_listinv.dat")));
	if ($list=='all') eval(implode('',file("f_listall.dat")));
	}
if ($go) eval(implode('',file("f_go.dat")));
if ($set) eval(implode('',file("f_set.dat")));
if ($save) eval(implode('',file("f_save.dat")));
if ($new3) eval(implode('',file("f_news.dat")));
if ($map) eval(implode('',file("f_map.dat")));
if ($npass) eval(implode('',file("f_set_npass.dat")));
if ($gild) eval(implode('',file("f_gild.dat")));
if ($serv) eval(implode('',file("f_serv.dat")));
// ���������� ����
//link����
$page_main.="<anchor>[����]<go href=\"#pers\"><setvar name=\"to\" value=\"$(to)\"/></go></anchor>";
// ����� ���������
$count = 0;
if ( isset($player["msg"]) && count($player["msg"]) ) foreach (array_keys($player["msg"]) as $i) if ( $player["msg"][$i] && isset($game["players"][$i]) ) $count++;
if ($count) $page_main.= "<a href=\"$PHP_SELF?sid=$sid&msg=1\">[�/�:$count]</a>";
// MAIN PAGE
if ($count) $page_main.= "\n"; else $page_main.= "";
$page_main.="<br/>".$player["life"]."/".$player["life_max"]." ".$player["mana"]."/".$player["mana_max"];
if ($player["ghost"]) $page_main.= "<br/>�� �������";
if ($player["crim"]) $page_main.= "<br/>�� ���������� (".date("i",$player["time_crim"]-time())." ���.)";
// SOUNDS
$stmp="";
$loc=split("\|",$locations[$player["loc"]]);

$zv=array();
for ($i=3;$i<count($loc);$i++) {
	if (substr($loc[$i],0,4)=='loc.') if (count($game["loc"][$loc[$i]])>0) foreach(array_keys($game["loc"][$loc[$i]]) as $j) if ((substr($j,0,5)=='user.') || substr($j,0,4)=='npc.') { if ( !isset( $zv[$loc[$i]] ) ) $zv[ $loc[$i] ]=''; $zv[ $loc[$i] ].="!";}
};
// FIX: ��� ���� �����������: ����������, ���, ������, ��������
// �������
$stmp="";
$ind=0; $count=0; if(!$start) $start=0;
if ($game["loc"][$player["loc"]]) foreach (array_keys($game["loc"][$player["loc"]]) as $i) if ($i!=$login) {
	if ($ind>=$start && $ind<$start+$count_show) {	//FIX: ����� +1?
		// ��������� ������� �������� ��������� � �������/npc (������� ���-�� � ������)
		if (substr($i,0,5)=='item.') {
			$k=split("\|",$game["loc"][$player["loc"]][$i]);
			if (substr($i,0,11)!='item.stand.' && $k[1]>1) $k=$k[0]." (".$k[1].")"; else $k=$k[0];
		}
		else {
			$k=$game["loc"][$player["loc"]][$i]["title"];
			$ktemp='';
			// if (substr($i,0,5)=="user." && $game["loc"][$player["loc"]][$i]["lag"]!="0") $ktemp="[".$game["loc"][$player["loc"]][$i]["lag"]."]";
			if ($game["loc"][$player["loc"]][$i]["lag"]=="1") $ktemp=" [���]";
			if ($game["loc"][$player["loc"]][$i]["lag"]=="2") $ktemp=" [���]";
			if (substr($i,0,5)=="user."){
      if ( isset($game["loc"][$player["loc"]][$i]["gild"]) ){
      $user_infos = split("\|",$game["loc"][$player["loc"]][$i]["gild"]);
      $ktemp=" [".$user_infos[1]."]";
				}
			}
      $k.=$ktemp;
			if ($game["loc"][$player["loc"]][$i]["life_max"]>0) $ltmp=round($game["loc"][$player["loc"]][$i]["life"]*100/$game["loc"][$player["loc"]][$i]["life_max"]);
			$st='';
			if ($ltmp<100) $st.=$ltmp."%";
			if ($game["loc"][$player["loc"]][$i]["ghost"]) $st.=" �������";
			if (substr($i,0,5)=='user.' && $game["loc"][$player["loc"]][$i]["crim"]) $st.=" ����������";
      $att=$game["loc"][$player["loc"]][$i]["attack"];
			if ($att && isset($game["loc"][$player["loc"]][$att]) && !$game["loc"][$player["loc"]][$att]["ghost"] && !$game["loc"][$player["loc"]][$i]["ghost"]) $st.=" ������� ".$game["loc"][$player["loc"]][$att]["title"];
      if ($st) {if ($st{0}==' ') $st=substr($st,1); $k.=" [".$st."]";}
		}
		$stmp.= "\n<br/><anchor>".$k."<go href=\"#menu\"><setvar name=\"to\" value=\"".$i."\"/></go></anchor>";
	}
	$ind++;
}

if ($start) {$stmp.= "\n<br/><a href=\"$PHP_SELF?sid=$sid\">^ </a>";}
if ($start+$count_show<count($game["loc"][$player["loc"]])-1) {if (!$start) $stmp.="\n<br/>"; $stmp.= "<a href=\"$PHP_SELF?sid=$sid&start=".($start+$count_show)."\">+ (".(count($game["loc"][$player["loc"]])-1-$start-$count_show).")</a>";}
$page_main.=$stmp;

// EXITS
$page_main.= "\n<br/>---";
$loc=split("\|",$locations[$player["loc"]]);

for ($i=3;$i<count($loc);$i++) {
	if (substr($loc[$i],0,4)=='loc.') {
		if ( !isset($zv[$loc[$i]]) ) $zv[$loc[$i]]='';
		$zv[$loc[$i]]=substr($zv[$loc[$i]],0,3);
		$page_main.= "\n<br/><a href=\"$PHP_SELF?sid=$sid&go=".$loc[$i]."\">[".$loc[$i-1]."]</a> ".$zv[$loc[$i]]."";
	}
};

if (!strpos($player["loc"],"oc.k.") && !strpos($player["loc"],"oc.L.")) $page_main.="<br/><a href=\"$PHP_SELF?sid=$sid&look=2\">[����]</a>";
else $page_main.="<br/><a href=\"$PHP_SELF?sid=$sid&map=1\">[�����]</a>";

if ($login==$admin) $page_main.="<br/>---\n<br/><a href=\"$PHP_SELF?sid=$sid&adm=res\">[res]</a>|<a href=\"$PHP_SELF?sid=$sid&adm=1\">[admin]</a>";
if (ereg("������", $player["gild"]) || ereg("���. �����", $player["gild"])) {
$page_main.="<br/>---\n<br/><a href=\"$PHP_SELF?sid=$sid&gild=menu\">[���� �����]</a>";
};
//����� ��������
$page_main.="</p></card><card id=\"pers\" title=\"��������\"><p>
<a href=\"$PHP_SELF?sid=$sid&list=inv\">[��������]</a><br/>
<a href=\"$PHP_SELF?sid=$sid\">[��������]</a><br/>
<a href=\"$PHP_SELF?sid=$sid&list=magic\">[�����]</a><br/>
<a href=\"$PHP_SELF?sid=$sid&msg=1\">[��������]</a><br/>
<a href=\"$PHP_SELF?sid=$sid&save=1\">[���������]</a><br/>
<a href=\"$PHP_SELF?sid=$sid&serv=1\">[������]</a>
";
// ����� ���� ���
$page_main.="</p></card><card id=\"menu\" title=\"����\">\n<p>
<a href=\"$PHP_SELF?sid=$sid&speak=$(to)\">[��������]</a>
<br/><a href=\"$PHP_SELF?sid=$sid&attack=$(to)&apl=4\">[���������]</a>
<br/>-<anchor>[���������]<go href=\"#at\"><setvar name=\"to\" value=\"$(to)\"/></go></anchor>
<br/><a href=\"$PHP_SELF?sid=$sid&to=$(to)&list=inv\">[�������]</a>
<br/><a href=\"$PHP_SELF?sid=$sid&take=$(to)\">[�����]</a>
<br/><a href=\"$PHP_SELF?sid=$sid&look=$(to)\">[����]</a>";
//����� ���������
$page_main.="</p></card><card id=\"at\" title=\"���������\"><p align=\"center\">
	<a href=\"$PHP_SELF?sid=$sid&attack=$(to)&apl=0\">[����.]</a>
	<br/><a href=\"$PHP_SELF?sid=$sid&attack=$(to)&apl=1\">[������]</a>
	<br/><a href=\"$PHP_SELF?sid=$sid&attack=$(to)&apl=2\">[�.����]</a><a href=\"$PHP_SELF?sid=$sid&attack=$(to)&apl=3\">[�.����]</a>
	<br/><a href=\"$PHP_SELF?sid=$sid&attack=$(to)&apl=4\">[����]</a>
	<br/><a href=\"$PHP_SELF?sid=$sid&attack=$(to)&apl=5\">[����]</a>";
msg($page_main,$loc[0],1,'main');
// ��������� �������
/////////////////////////////////

function mailadmin($text){
  mail("gladk0w@mail.ru","ERROR",$text);
	msg("<p align=\"center\">����������� ������<br/><anchor>[�����]<prev/></anchor>","error",0,'none');
}
function savegame(){				// ���������� ����
	global $game,$_fnumb,$game_file,$myt_start,$admin,$login;
	$fnum = fopen($game_file,"w+");
	fputs($fnum,serialize($game));
	fclose($fnum);
	// ������� ����
}

function getrandname() {			// ���������� ��������� ���
	eval(implode('',file("f_getrandname.dat")));
	return $stmp;
	}

function addjournal($to,$msg) {		// ��������� � ������ � ������, ���� �� ������������
	global $game,$journal_count;
	if (isset($game["players"][$to])) {
		$j=&$game["loc"][$game["players"][$to]][$to]["journal"];
		$j[]=$msg;
		if (count($j)>$journal_count) array_splice($j,count($j)-$journal_count);	// ��������� ������ n ��������� �������
		}
	}
function addjournalall($loc,$msg,$no1="",$no2="") {		// ��������� ������ ���� � ������, ����� $no1 � $no2
	global $game;
	if ($game["loc"][$loc]) foreach (array_keys($game["loc"][$loc]) as $i) if ($i!=$no1 && $i!=$no2) if (isset($game["players"][$i])) addjournal($i,$msg);
	}

function msg($msg,$title='World of Death',$journal=1,$menu='') {//linkMsg		// ����� ������ � �����
	// journal==1, �� ������� ����� � ��������
	// menu=='', ������ "� ����" � "�����"
	// menu=='none', ��� ������
	// menu=='main', �������� ����
	global $page_font,$game,$login,$page_size,$page_desc,$page_main,$debug,$PHP_SELF,$sid,$player,$page_size;

	$wml = "\n<wml>";
	$wml.="\n<head>\n<meta forua=\"true\" http-equiv=\"Cache-Control\" content=\"must-revalidate\"/>\n<meta forua=\"true\" http-equiv=\"Cache-Control\" content=\"no-cache\"/>\n<meta forua=\"true\" http-equiv=\"Cache-Control\" content=\"no-store\"/>\n</head>";
	// ������
	if ($journal==1 && $player["journal"] && count($player["journal"])>0) {		// FIX: ������-�� ���� ������ ������ ����� count=1
		$page_journal=implode("<br/>",$player["journal"]);
		$wml.= "\n<card title=\"������\">\n<do type=\"accept\" label=\"[������]\"><go href=\"#";
		if ($page_desc) $wml.= "desc";else $wml.= "main";
		$wml.= "\"/></do>\n<p>\n".$page_journal."<br/><a href=\"$PHP_SELF?sid=$sid#main\">[� ����]</a>\n</p>\n</card>";
		$player["journal"]=array();
		}

	$sizeok=1; 
	if ($player["look"]==$player["loc"]) {unset($player["look"]);$page_desc=0;}	// FIX: ����� ������� �������� �� ������ ������
	if ($page_desc) {
		$player["look"]=$player["loc"];
		eval(implode('',file("f_desc.dat")));
		if (strlen($wml.$msg.$desc[$player["loc"]])>$page_size) $sizeok=0;
		$wml.= "\n<card id=\"desc\" title=\"".$title."\">\n<do type=\"accept\" label=\"[������]\"><go href=\"";
		if ($sizeok) $wml.= "#main"; else $wml.= "$PHP_SELF?sid=$sid";
		$wml.= "\"/></do>\n<p>\n".$desc[$player["loc"]]."<br/><a href=\"$PHP_SELF?sid=$sid#main\">[������]</a>\n</p>\n</card>";
		}
	if ( $menu!='break' ) savegame();									// ����� ���� ��������� �������, ������ ����� ������
	// �������� �����
	if ($sizeok) {		// ������ ���� ������ ������ ��� �����
	$wml.= "\n<card id=\"main\" title=\"".$title."\""; 
	if ($menu=='main') $wml.= " ontimer=\"$PHP_SELF?sid=$sid\"><timer value=\"600\"/";
	$wml.= ">";
  	if ($menu=='') {
		$wml.= "\n<do name=\"o1\" type=\"options\" label=\"[� ����]\"><go href=\"$PHP_SELF?sid=$sid\"/></do>";
		$wml.= "\n<do name=\"a1\" type=\"accept\" label=\"[�����]\"><prev/></do>";
}
	if ($menu=='main') {
		$wml.= "\n<do name=\"o2\" type=\"options\" label=\"[��������]\"><go href=\"$PHP_SELF?sid=$sid&list=inv\"/></do>";
		$wml.= "\n<do name=\"o2\" type=\"options\" label=\"[��������]\"><go href=\"$PHP_SELF?sid=$sid\"/></do>";
		$wml.= "\n<do name=\"o3\" type=\"options\" label=\"[�����]\"><go href=\"$PHP_SELF?sid=$sid&list=magic\"/></do>";
		$wml.= "\n<do name=\"o5\" type=\"options\" label=\"[��������]\"><go href=\"$PHP_SELF?sid=$sid&msg=1\"/></do>";
		$wml.= "\n<do name=\"xco6\" type=\"options\" label=\"[���������]\"><go href=\"$PHP_SELF?sid=$sid&save=1\"/></do>";
		$wml.= "\n<do name=\"xco7\" type=\"options\" label=\"[������]\"><go href=\"$PHP_SELF?sid=$sid&serv=1\"/></do>";	
    }  if (substr($msg,strlen($msg)-4)!="</p>") $msg.="\n</p>";
	if ( substr($msg,0,2)!="<p" && substr($msg,0,3)!="<do" && substr($msg,0,4)!="<one" ) $msg = "\n<p>\n".$msg;
	$wml.= "\n".$msg."\n</card>";
	};// if sizeok

	$wml.= "</wml>";
	$wml=str_replace("&amp;","&",$wml);		// ����� �������� � ������ ����
	$wml=str_replace("&#","!t_mp!",$wml);
	$wml=str_replace("&","&amp;",$wml);
	$wml=str_replace("!t_mp!","&#",$wml);
	if ($page_font){
		$wml=str_replace("<p>","<p><small>",$wml);
		$wml=str_replace("<p align=\"center\">","<p align=\"center\"><small>",$wml);	
		$wml=str_replace("</p>","</small></p>",$wml);
		$wml=ereg_replace("(<input[[:print:]]*/>)","</small>\\1<small>",$wml);
		$wml=ereg_replace("(<select.*</select>)","</small>\\1<small>",$wml);
	}
	header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0, max-age=86400');
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Pragma: no-cache');
	header("Content-type: text/vnd.wap.wml");
	echo "<?xml version=\"1.0\"?>";
	echo "<!DOCTYPE wml PUBLIC \"-//WAPFORUM//DTD WML 1.1//EN\" \"http://www.wapforum.org/DTD/wml_1.1.xml\">";
	echo toutf($wml);
	exit;
}

function calcser($s) {return "s:".strlen($s).":\"".$s."\";";}

function savepl($pls,$names){				//��������� ������� � save
	if ( isset($pls["info"]) ){
		$file1="save/$names.dat";
		$file2="save1/$names.dat";
		if ( file_exists($file1) ) if ( filesize($file1)!=0 ){
			$data1=implode("",file($file1));
			$f_s3 = fopen ($file2, "w");
			fputs($f_s3,$data1);
			fclose ($f_s3);
		}
		$filesave2 = fopen ($file1, "w");
		$pls["macros"]=array(); //������� �������
		$s=serialize($pls);
		$s=preg_replace('/s:(?:\d+):"(.*?)";/e',"calcser('\\1')",$s);
		fputs($filesave2,$s);
		fclose ($filesave2);
	}
}
function ai() {		// ����� AI			//linkAI
	global $game,$locations,$login,$player,$time_logout;
	// �������� ������ ������ � ��������� ���� ����� �� ����
	if (time()>$game["lastai"]+60) {
		foreach(array_keys($game["players"]) as $j) if ($j!=$login) { 	// ��� � ������
			if (time()>$game["loc"][$game["players"][$j]][$j]["time"]+$time_logout) {
				if (isset($game["loc"][$game["players"][$j]][$j])) {
					// � �������

					$gtemp=$game["loc"][$game["players"][$j]][$j];
					$gtemp["journal"]=array();
					$gtemp["loc"]=$game["players"][$j];
					savepl($gtemp,$j);
	
					unset($game["loc"][$game["players"][$j]][$j]);
	        if ($info[2]=='f') {addjournalall($game["players"][$j],$gtemp["title"]." �������",$j);} else {addjournalall($game["players"][$j],$gtemp["title"]." �����",$j);}
          unset($game["players"][$j]);

				} else unset($game["players"][$j]);
			}
		}
		$game["lastai"]=time();
	}

	if (!$login || !$player) return;	// ��� ����� ������ ������� ������ ������

	// ��������� ������ ������� � �������� �������
	doai($player["loc"]);
	$ok=array($player["loc"]=>1);	// ��� ���������
	$loc=split("\|",$locations[$player["loc"]]);
	for ($i=3;$i<count($loc);$i++) if (substr($loc[$i],0,4)=='loc.') {
		doai($loc[$i]);
		$ok[$loc[$i]]=1;
		$loc1=split("\|",$locations[$loc[$i]]);
		for ($j=3;$j<count($loc1);$j++) if (substr($loc1[$j],0,4)=='loc.') if (!isset($ok[$loc1[$j]])) {doai($loc1[$j]); $ok[$loc1[$j]]=1;}
	}
}

function doai($i) {				// ������������� ���������, ��������� ������� � ������ $i
	global $game,$locations,$time_logout,$time_regenerate,$time_objects_destroy,$time_crim;

	$loc=split("\|",$locations[$i]);

	// ������� �������
	if (isset($game["loc_del"][$i])) foreach (array_keys($game["loc_del"][$i]) as $j) {
		if (time()>$game["loc_del"][$i][$j]) {	// �������� ��������/npc
			if ($info[2]=='f') {if (substr($j,0,4)=='npc.') addjournalall($i,$game["loc"][$i][$j]["title"]." �������");} else {if (substr($j,0,4)=='npc.') addjournalall($i,$game["loc"][$i][$j]["title"]." �����");}
			unset($game["loc"][$i][$j]);
			unset($game["loc_del"][$i][$j]);
			if (count($game["loc_del"][$i])==0) unset($game["loc_del"][$i]);
			}
		}
	if (isset($game["loc_add"][$i])) foreach (array_keys($game["loc_add"][$i]) as $j) {
		if (time()>$game["loc_add"][$i][$j]["time"]) {	// ���������� ��������/npc
			if ($game["loc_add"][$i][$j]["respawn"]) {
				$respawn=split("\|",$game["loc_add"][$i][$j]["respawn"]);
				$game["loc_add"][$i][$j]["time"]=time()+rand($respawn[0],$respawn[1]);
				if ($respawn[2] && $respawn[3] && substr($j,0,5)=='item.') {	// ������� ���-��
					$item=split("\|",$game["loc_add"][$i][$j]["item"]);
					$item[1]=rand($respawn[2],$respawn[3]);
					$game["loc_add"][$i][$j]["item"]=implode("|",$item);
					}
				}
			$game["loc"][$i][$j]=$game["loc_add"][$i][$j]["item"];
			if (substr($j,0,4)=='npc.') {
				addjournalall($i,"�������� ".$game["loc_add"][$i][$j]["item"]["title"]);
				unset($game["loc_add"][$i][$j]);	// npc �������, ��� ��������� ������ ��������� �����
				if (count($game["loc_add"][$i])==0) unset($game["loc_add"][$i]); 
				}
			}
		}

	// ������ ������, ���� ����� �����
	if ($game["loc"][$i]) foreach (array_keys($game["loc"][$i]) as $j) if (substr($j,0,9)=='npc.guard') if (time()>$game["loc"][$i][$j]["delete"]) {unset($game["loc"][$i][$j]); addjournalall($i,$game["loc"][$i][$j]["title"]." �����");}

	// ���� �� ������, ���� �� �����, ������ ������ (������� � ���� ������) � ������ �������
	$crim=array();
	$users=array();
	if ($game["loc"][$i]) foreach (array_keys($game["loc"][$i]) as $j) if (substr($j,0,5)=='user.' || substr($j,0,4)=='npc.') {
		if ($game["loc"][$i][$j]["healer"]) $healer=$game["loc"][$i][$j]["title"];
		if (substr($j,0,9)=='npc.crim.' || $game["loc"][$i][$j]["crim"]) if (!$game["loc"][$i][$j]["ghost"]) $crim[]=$j;	// ������-��������� �� ���������
		if (substr($j,0,9)=="npc.guard") $guard=1;
		if (substr($j,0,5)=="user." && !$game["loc"][$i][$j]["ghost"]) $users[]=$j;
		}
	// ��������� ������ �� 1 �� 3 ������
	if ($loc[1] && count($crim)>0 && !$guard) for ($k=0;$k<rand(1,3);$k++) {	
		srand ((float) microtime() * 10000000);
		$id = "npc.guard.".rand(5,9999);
		$title = getrandname()." [������]";
		$game["loc"][$i][$id]=array("title"=>$title,"life"=>"1000","life_max"=>"1000","speak"=>"npc.guard","war"=>"100|100|100|2|0|10|20|0|0|10|30|40|���������|0||","delete"=>time()+$time_logout);
		//$game["loc_del"][$i][$id]=time()+$time_logout;	// ����� ������� ������
		addjournalall($i,"�������� ".$title);
		}

	// ������ ���������� ������� � npc
	if ($game["loc"][$i]) foreach (array_keys($game["loc"][$i]) as $j) if (isset($game["loc"][$i][$j]) && (substr($j,0,5)=='user.' || substr($j,0,4)=='npc.')) {
		// ����������� ����� � ���� �������� ���������� �������
		$tm=time()-$game["loc"][$i][$j]["time_regenerate"];
		if ($tm>$time_regenerate && !$game["loc"][$i][$j]["ghost"]) {
			$life=0; $mana=0;
			if (substr($j,0,5)=='user.') {	// �������� ������ ����������� � ���������
				$skills=split("\|",$game["loc"][$i][$j]["skills"]);
				$life=$skills[16];
				$mana=$skills[5];
				}
			$game["loc"][$i][$j]["life"]+=round($tm/($time_regenerate-$life));
			$game["loc"][$i][$j]["mana"]+=round($tm/($time_regenerate-$mana));
			if ($game["loc"][$i][$j]["life"]>$game["loc"][$i][$j]["life_max"]) $game["loc"][$i][$j]["life"]=$game["loc"][$i][$j]["life_max"];
			if ($game["loc"][$i][$j]["mana"]>$game["loc"][$i][$j]["mana_max"]) $game["loc"][$i][$j]["mana"]=$game["loc"][$i][$j]["mana_max"];
			$game["loc"][$i][$j]["time_regenerate"]=time();
			}

		// ������
		if (substr($j,0,5)=="user.") {
			// ��������, �� ������ �� ����� �����
			if (time()>$game["loc"][$i][$j]["time_crim"]) {unset($game["loc"][$i][$j]["crim"]); unset($game["loc"][$i][$j]["time_crim"]);}
			// ���� ���� ������, �� �����������...
			if ($game["loc"][$i][$j]["ghost"] && $healer) {addjournalall($i,$healer.": ����������� � �����, ".$game["loc"][$i][$j]["title"]."!");ressurect($j);}
			}

		// NPC
		if (substr($j,0,4)=='npc.') {
			$b=0;	// ���� �� continue, ���� ���� � ��. �������
			// ������ ����� ������� �� ��������
			$owner=$game["loc"][$i][$j]["owner"];
			$follow=$game["loc"][$i][$j]["follow"];
			$guard=$game["loc"][$i][$j]["guard"];
			$attack=$game["loc"][$i][$j]["attack"];
			if ($owner) {
				// ������ ����� ���� ����
				if ($game["loc"][$i][$j]["crim"] && isset($game["loc"][$i][$owner])) docrim($owner);
				// ���� ����� ����� ��������
				if (time()>$game["loc"][$i][$j]["time_owner"]) {
					addjournal($owner,$game["loc"][$i][$j]["title"]." ������� ���");
					if ($game["loc"][$i][$j]["destroyonfree"]) {addjournalall($i,$game["loc"][$i][$j]["title"]." �����"); unset($game["loc"][$i][$j]); continue;}	// ������ �� ������������ ��� 
						else {unset($game["loc"][$i][$j]["time_owner"]); unset($game["loc"][$i][$j]["owner"]);unset($game["loc"][$i][$j]["follow"]); unset($game["loc"][$i][$j]["guard"]);}
					}
				}
			if ($follow && !isset($game["loc"][$i][$follow])) for ($k=3;$k<count($loc);$k++) if (substr($loc[$k],0,4)=='loc.' && isset($game["loc"][$loc[$k]][$follow])) {
				// ����� � �������� ������� $follow, ���� ����
				$game["loc"][$loc[$k]][$j] = $game["loc"][$i][$j];
				unset($game["loc"][$i][$j]);
				unset($game["loc"][$k][$j]["attack"]);
				addjournalall($i,$game["loc"][$loc[$k]][$j]["title"]." ���� ".$loc[$k-1]);
				addjournalall($loc[$k],"������ ".$game["loc"][$loc[$k]][$j]["title"]);
				$b=1;	// ������ �� ������������ � ������� �������
				break;
				}
			if ($b) continue;		//$j ���� �� ���� �������

			// �������� ������������ (���� �� �� ��� �� �������)
			if ($attack && !$game["loc"][$i][$j]["follow"] && !isset($game["loc"][$i][$attack])) for ($k=3;$k<count($loc);$k++) if (substr($loc[$k],0,4)=='loc.' && isset($game["loc"][$loc[$k]][$attack])) {	// �����!
				// ������� �� ����� ������������ � ����������� ����, � ������ �� ������� � ���� ����, � ����� ������ ����������!
				$crimj=$game["loc"][$i][$j]["crim"] || substr($j,0,9)=='npc.crim.';

				$loc1=split("\|",$locations[$loc[$k]]);
				$b=0;	
				if (($crimj && !$loc1[1]) || (!$crimj && $loc1[1]) || substr($j,0,9)=="npc.guard") $b=1;	// ���������� ������
				// �������� ����� ������ skill.hiding, ����� ��������� (�� ������ �� ���������)
				if (substr($attack,0,5)=='user.' && !substr($j,0,9)=="npc.guard") {
					$skills=split("\|",$game["loc"][$loc[$k]][$attack]["skills"]);
					if (rand(0,100)<=($skills[17]+$skills[1])*5) {$b=0;addjournal($attack,"�� �������� �� ������!");}
					}

/*mod*/				// if ($b) if ( substr($j,0,4)=="npc." && !isset($game["loc"][$i][$j]["move"]) ) $b=0;

				if ($b) {	// ������!
					$game["loc"][$loc[$k]][$j] = $game["loc"][$i][$j];
					unset($game["loc"][$i][$j]);
					addjournalall($i,$game["loc"][$loc[$k]][$j]["title"]." ���� ".$loc[$k-1]);
					addjournalall($loc[$k],"������ ".$game["loc"][$loc[$k]][$j]["title"]);
					} else unset($game["loc"][$i][$j]["attack"]);
				break;
				}
			if ($b) continue;		//$j ���� �� ���� �������
			// ���� ��������� ���� ������, ������ �����
			if ($attack && !$game["loc"][$i][$j]["follow"] && !isset($game["loc"][$i][$attack])) unset($game["loc"][$i][$j]["attack"]);

			// ���� �� ����, ���� �������� guard=id ���-�� ��������, ������� ���
			if ($guard && isset($game["loc"][$i][$guard])) {
				if ($game["loc"][$i]) foreach (array_keys($game["loc"][$i]) as $k) if ($game["loc"][$i][$k]["attack"]==$guard) {$game["loc"][$i][$j]["attack"]=$k; break;}
				}

			// ����� ������� ������, ����� �������
			if (!$game["loc"][$i][$j]["attack"]) {
				if (substr($j,0,9)=="npc.guard" && count($crim)>0) $game["loc"][$i][$j]["attack"]=$crim[rand(0,count($crim)-1)];
				if (($game["loc"][$i][$j]["crim"] || substr($j,0,9)=='npc.crim.') && count($users)>0) {
					$b=0;
					$attack=$users[rand(0,count($users)-1)];
					if (substr($attack,0,5)=='user.') {$skills=split("\|",$game["loc"][$i][$attack]["skills"]); if (rand(0,100)<=$skills[1]*2) {$b=1;addjournal($attack,"�� �������� �� ����� ".$game["loc"][$i][$j]["title"]);}}
					if (!$b) $game["loc"][$i][$j]["attack"]=$attack;
					}

      }

			// ��������� ��������� �������� NPC
			if (!$game["loc"][$i][$j]["attack"] && $game["loc"][$i][$j]["move"]) {
				$move=split("\|",$game["loc"][$i][$j]["move"]);
				$b=0;
				if (time()>$game["loc"][$i][$j]["time_nextmove"]) {	// ����...
					$k=$loc[2+2*rand(0,(count($loc)-2)/2-1)+1];	// ��������� �����
					// ������ �� ���� � ���� ����, � ������� �� ���
					$crimj=$game["loc"][$i][$j]["crim"] || substr($j,0,9)=='npc.crim.';
					$loc1=split("\|",$locations[$loc[$k]]);
					if (($crimj && !$loc1[1]) || (!$crimj && $loc1[1])) $b=1;	// ����
					if ($k==$i) $b=0;
					if ($b) {
						// �������
						$game["loc"][$k][$j]=$game["loc"][$i][$j];
						unset($game["loc"][$i][$j]);
						addjournalall($k,"������ ".$game["loc"][$k][$j]["title"]);
						$s=$game["loc"][$k][$j]["title"]." ���� ";
						if (array_search($k,$loc)) $s.=$loc[array_search($k,$loc)-1];
						addjournalall($i,$s);
						$game["loc"][$k][$j]["time_nextmove"]=time()+rand($move[1],$move[2]);	// ����. ���
						}
					}
				}
			if ($b) continue;		//$j ���� �� ���� �������
			// ��������� ����� NPC
			if ($game["loc"][$i][$j]["attack"] && $game["loc"][$i][$game["loc"][$i][$j]["attack"]]["ghost"]) unset($game["loc"][$i][$j]["attack"]);
			if ($game["loc"][$i][$j]["attack"]) attack($i,$j,$game["loc"][$i][$j]["attack"]);
			}//npc		
		}//foreach user & npc
	}

function ressurect($to) {
	eval(implode('',file("f_ressurect.dat")));
	}
function docrim($login) {
	eval(implode('',file("f_docrim.dat")));
	}
function calcparam($login) {
	eval(implode('',file("f_calcparam.dat")));
	};

function attack($loc,$fromid,$toid,$magic='',$answer=1) {//linkAttack		// answer=1 - ������������� ��������, 0 -���
	global $attackf,$apl;
	global $game,$locations,$login,$time_crim,$points_levelup,$time_objects_destroy,$time_logout,$time_defspeed;
	if (!$attackf) $attackf=implode('',file("f_attackf.dat"));
	eval($attackf);
	}

function view($file) {eval(implode('',file("f_view.dat")));}

function tsdecode($s) {
	if ($s!='') {
		$s1=$s;
		$s = str_replace("%D0%81","�",$s);
		$s = str_replace("%d0%81","�",$s);
		$s = str_replace("%D1%91","�",$s);
		$s = str_replace("%d1%91","�",$s);
		for ($i=144;$i<192;$i++) {$stmp = "%D0".urlencode(chr($i)); $s = str_replace(strtoupper($stmp),chr($i+48),$s); $s = str_replace(strtolower($stmp),chr($i+48),$s);}
		for ($i=128;$i<144;$i++) {$stmp = "%D1".urlencode(chr($i)); $s = str_replace(strtoupper($stmp),chr($i+112),$s);$s = str_replace(strtolower($stmp),chr($i+112),$s);}
		$s = urldecode($s);
		}
	return $s;
	}
function get_age($btime){
	$date0 = getdate($btime);
	$date1 = getdate(time());
	$age = $date1["year"] - $date0["year"];
	if ( $date1["mon"]<$date0["mon"] ) return $age-1;
	if ( $date1["mon"]>$date0["mon"] ) return $age;
	// ���� ������ �����...
	if ( $date1["mday"]>=$date0["mday"] ) return $age;
	return $age-1;
}

//?>
