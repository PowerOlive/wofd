<?php
function k2u($string)  {
$string = ereg_replace("�","&#x0410;",$string);
$string = ereg_replace("�","&#x0411;",$string);
$string = ereg_replace("�","&#x0412;",$string);
$string = ereg_replace("�","&#x0413;",$string);
$string = ereg_replace("�","&#x0414;",$string);
$string = ereg_replace("�","&#x0415;",$string);
$string = ereg_replace("�","&#x0415;",$string);
$string = ereg_replace("�","&#x0417;",$string);
$string = ereg_replace("�","&#x0417;",$string);
$string = ereg_replace("�","&#x0418;",$string);
$string = ereg_replace("�","&#x0418;",$string);
$string = ereg_replace("�","&#x041A;",$string);
$string = ereg_replace("�","&#x041B;",$string);
$string = ereg_replace("�","&#x041C;",$string);
$string = ereg_replace("�","&#x041D;",$string);
$string = ereg_replace("�","&#x041E;",$string);
$string = ereg_replace("�","&#x041F;",$string);
$string = ereg_replace("�","&#x0420;",$string);
$string = ereg_replace("�","&#x0421;",$string);
$string = ereg_replace("�","&#x0422;",$string);
$string = ereg_replace("�","&#x0423;",$string);
$string = ereg_replace("�","&#x0424;",$string);
$string = ereg_replace("�","&#x0425;",$string);
$string = ereg_replace("�","&#x0426;",$string);
$string = ereg_replace("�","&#x0427;",$string);
$string = ereg_replace("�","&#x0428;",$string);
$string = ereg_replace("�","&#x0449;",$string);
$string = ereg_replace("�","&#x042C;",$string);
$string = ereg_replace("�","&#x044B;",$string);
$string = ereg_replace("�","'",$string);
$string = ereg_replace("�","&#x042D;",$string);
$string = ereg_replace("�","&#x042e;",$string);
$string = ereg_replace("�","&#x042f;",$string);
$string = ereg_replace("�","&#x0430;",$string);
$string = ereg_replace("�","&#x0431;",$string);
$string = ereg_replace("�","&#x0432;",$string);
$string = ereg_replace("�","&#x0433;",$string);
$string = ereg_replace("�","&#x0434;",$string);
$string = ereg_replace("�","&#x0435;",$string);
$string = ereg_replace("�","&#x0435;",$string);
$string = ereg_replace("�","&#x0436;",$string);
$string = ereg_replace("�","&#x0437;",$string);
$string = ereg_replace("�","&#x0438;",$string);
$string = ereg_replace("�","&#x0439;",$string);
$string = ereg_replace("�","&#x043A;",$string);
$string = ereg_replace("�","&#x043B;",$string);
$string = ereg_replace("�","&#x043C;",$string);
$string = ereg_replace("�","&#x043D;",$string);
$string = ereg_replace("�","&#x043E;",$string);
$string = ereg_replace("�","&#x043F;",$string);
$string = ereg_replace("�","&#x0440;",$string);
$string = ereg_replace("�","&#x0441;",$string);
$string = ereg_replace("�","&#x0442;",$string);
$string = ereg_replace("�","&#x0443;",$string);
$string = ereg_replace("�","&#x0424;",$string);
$string = ereg_replace("�","&#x0445;",$string);
$string = ereg_replace("�","&#x0446;",$string);
$string = ereg_replace("�","&#x0447;",$string);
$string = ereg_replace("�","&#x0448;",$string);
$string = ereg_replace("�","&#x0449;",$string);
$string = ereg_replace("�","&#x044C;",$string);
$string = ereg_replace("�","&#x044B;",$string);
$string = ereg_replace("�","'",$string);
$string = ereg_replace("�","&#x044d;",$string);
$string = ereg_replace("�","&#x044E;",$string);
$string = ereg_replace("�","&#x044F;",$string);
return $string;
}
// �������� email
       function check_email_addr($email) {
    if (ereg('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'. '@'.'[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'.'[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $email)) {
        return 1;  }else{ return 0;  } }

        // �������
   function error($error) {
 print " <card id=\"error\" title=\"MAIL\">
         <p>$error
         </p>
       </card></wml>\n";
                   exit;
         }
//������������ �������
 //����� ������:
 //1- �������� ��� "�������� �����" � ��������������� �����
 $mode = '1';
   // ���� ��������� ����� �������� ����� ( $mode = 1):
      //����� Email ��������������
        $admin_email=k2u("gladk0w@mail.ru");
      // ��������� ��������
        $title_fb=k2u("�������� ������");
      //���� ���������
        $add_topic=k2u("From my World of Death:");
      // ��������� ����������:
        $your_email=k2u("��� Email");
        $your_topic=k2u("���� ���������");
        $message=k2u("����� ���������");
// ������������ �� ������ ������� iconv (����������� ������� � ���������).
//���� ��� �������� ��������� ���������� �� ������, �� ��������� �� "no"
$support_icov = 'no';

// ��������� ���������
$main=k2u("�� �������");
$back=k2u("�����");
$home='wap.domen.ru';
$own_error=k2u("������ ����������. ����������, �������� ��������������: gladk0w@mail.ru <br/> <a href=$home>$main</a>");
$send=k2u("���������");
$no_body=k2u("��������� �����������! <br/> <do type=\"prev\" lable=\"$back\"> <prev/></do>");
$no_email=k2u("����������� Email! <br/> <do type=\"prev\" lable=\"$back\"> <prev/></do>");
$fuck_email=k2u("Email �������!<br/> <do type=\"prev\" lable=\"$back\"> <prev/></do>");
$good=k2u("��������� ������� ����������! <br/> <a href=\"$home\">$main</a>");





//������ WML-��������
Header("Content-type: text/vnd.wap.wml");
print "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
print "<!DOCTYPE wml PUBLIC \"-//WAPFORUM//DTD WML 1.1//EN\"\n";
print "\"http://www.wapforum.org/DTD/wml_1.1.xml\">\n";
print "<wml>\n";
// ���� �� ������ ����� ������ �������
   if(!@$mode) {
        error($own_error);
               }

// ���� ����� ����������
if(isset($go)) {
  // �������� ��� ������ "�������� �����"
  if($mode == '1') {
    // ���� �� ������ Email
    if(!@$from)$from='no@email.ru';
    // ���� �� ������� ���� ���������
    if(!@$topic)$topic='no topic';
    // ���� ����������� ����� ���������
    if(!@$body) { error($no_body); }

$subject=$add_topic.$topic;
$message=$body;
 // ������������� ������->1251
$subject = iconv("UTF-8", "CP1251", "$subject");
$message = iconv("UTF-8", "CP1251", "$message");

mail($admin_email, $subject, $message, "From: $from");
error($good);

          }
  // �������� ��� ������ "�������� Email"
  if($mode == '2') {
     // ���� �� ������ Email
    if(!@$to) { error($no_email); }
    // ���� Email ��������
    if (check_email_addr($email) == 1) {
          error($fuck_email);
            }
    // ���� �� ������� ���� ���������
    if(!@$topic)$topic='no topic';
    // ���� ����������� ����� ���������
    if(!@$body) { error($no_body); }

$subject=$topic;
$message=$body;
$message .=$adding;

 // ������������� ������->1251
$subject = iconv("UTF-8", "CP1251", "$subject");
$message = iconv("UTF-8", "CP1251", "$message");

mail($to, $subject, $message, "From: WAP");
Unset($go);
error($good);
          }
        }
// ���� ������ ����� "�������� �����" ($mode = 1)
   if($mode == '1')  {
print "<card id=\"feedback\" title=\"$title_fb\">
              <p>
      $your_email:<br/>
      <input type=\"text\" name=\"from\"/><br/>
      $your_topic:<br/>
      <input type=\"text\" name=\"topic\"/><br/>
      $message:<br/>
      <input type=\"text\" name=\"body\"/><br/>
      </p><do type=\"accept\" label=\"$send\">
            <go href=\"c.g\" accept-charset=\"UTF-8\" method=\"post\">
                <postfield name=\"from\" value=\"$(from)\"/>
                <postfield name=\"topic\" value=\"$(topic)\"/>
                <postfield name=\"body\" value=\"$(body)\"/>
                <postfield name=\"go\" value=\"go\"/>
            </go>
        </do>
         </card></wml>\n";
 exit;
           }
?>
