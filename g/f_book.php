$five = 500;            // ����� �������� �� ��������
$dir = './book/';      // ����� � �������. �������
$tranc = 1;            // ��������� �� 0 ���� �� ������ ������������ ���������� ��������������
$title = '���������� ����'; // ���������

header("Content-type: text/vnd.wap.wml;charset=utf-8");
$ret = "<?xml version=\"1.0\"?><!DOCTYPE wml PUBLIC \"-//WAPFORUM//DTD WML 1.1//EN\"". " \"http://www.wapforum.org/DTD/wml_1.1.xml\"><wml><card title=\"$title\">";

$open_dir=opendir($dir);
while (false!==($file=readdir($open_dir)))
{
if (is_file("$dir/$file")) $f[]=$file;
}
closedir($open_dir);


$count = sizeof($f);

if(!isset($_GET['id']))
  {
  for( $i = 0;  $i < $count ; $i++ )
     {
     $ret .= '<a href="b.g?id='.$i.'">'.substr($f[$i],0,-4).'</a><br/>';
     }
  }
else

{

$id = $_GET['id'];
if(!array_key_exists($id,$f)) header("Location: b.g");

if(!isset($_GET['p']))$p=1; else $p = $_GET['p'];
$file_name = $dir.$f[$id];
$file= join('',file($file_name));
$obsum = $p * $five;
$nasum = $obsum - $five;
$end='0';

if(!isset($_GET['go']))
  {

  for($i=$nasum; $i<$obsum; $i++)
     {
     if(!isset($file[$i])) $end='1'; else $ret .=$file[$i];
     }

  $ret .= '<br/>';

  if($p == '1')  $ret .= ''; else {$ret .= '<a href="b.g?id='.$id.'&amp;p='.($p-1).'">�����</a>';$ret .= ' '; }
  if($end=='1')  $ret .= ''; else {$ret .= '<a href="b.g?id='.$id.'&amp;p='.($p+1).'">�����</a>';}

  $ret .= '<br/><a href="b.g?go=1&amp;id='.$id.'">�������</a>';
  $ret .= '<br/><a href="b.g">� ������</a>';
  }
  else $ret .='
  ������� ����� �������� �� 1 �� '.(ceil(strlen($file)/$five)).'<br/><input name="code" format="*N"  maxlength="10" title="code"/>
  <anchor title="go">�������<go href="b.g" method="get">
  <postfield name="p" value="$(code)"/>
  <postfield name="id" value="'.$id.'"/>
  </go></anchor>';

}

$ret .= '</card></wml>';

function unicode($string)
{
$rus=array('�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�',
           '�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�');
$string = str_replace('�','&#1025;',$string);
$string = str_replace('�','&#1105;',$string);
for($i=0; $i<count($rus); $i++)
   {
   $s=1040;
   $d = '&#'.($s+$i).';';
   $string = str_replace($rus[$i],$d,$string);
   }
return $string;
}

if($tranc==0) echo $ret; else echo unicode($ret);
