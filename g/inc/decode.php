<?
function toutf($input)
{
$string=$input;

$string = str_replace(chr(208),'P',$string);        # �
$string = str_replace(chr(192),'A',$string);        # �
$string = str_replace(chr(193),'&#x0411;',$string); # �
$string = str_replace(chr(194),'B',$string);        # �
$string = str_replace(chr(195),'&#x0413;',$string); # �
$string = str_replace(chr(196),'&#x0414;',$string); # �
$string = str_replace(chr(197),'E',$string);        # �
$string = str_replace(chr(168),'E',$string);        # �
$string = str_replace(chr(198),'&#x0416;',$string); # �
$string = str_replace(chr(199),'3',$string);        # �
$string = str_replace(chr(200),'&#x0418;',$string); # �
$string = str_replace(chr(201),'&#x0419;',$string); # �
$string = str_replace(chr(202),'K',$string);        # �
$string = str_replace(chr(203),'&#x041B;',$string); # �
$string = str_replace(chr(204),'M',$string);        # �
$string = str_replace(chr(205),'H',$string);        # �
$string = str_replace(chr(206),'O',$string);        # �
$string = str_replace(chr(207),'&#x041F;',$string); # �
$string = str_replace(chr(209),'C',$string);        # �
$string = str_replace(chr(210),'T',$string);        # �
$string = str_replace(chr(211),'&#x0423;',$string); # �
$string = str_replace(chr(212),'&#x0424;',$string); # �
$string = str_replace(chr(213),'X',$string);        # �
$string = str_replace(chr(214),'&#x0426;',$string); # �
$string = str_replace(chr(215),'&#x0427;',$string); # �
$string = str_replace(chr(216),'&#x0428;',$string); # �
$string = str_replace(chr(217),'&#x0429;',$string); # �
$string = str_replace(chr(218),'&#x042A;',$string); # �
$string = str_replace(chr(219),'&#x042B;',$string); # �
$string = str_replace(chr(220),'b',$string);        # �
$string = str_replace(chr(221),'&#x042D;',$string); # �
$string = str_replace(chr(222),'&#x042E;',$string); # �
$string = str_replace(chr(223),'&#x042F;',$string); # �
$string = str_replace(chr(224),'a',$string);        # �
$string = str_replace(chr(225),'&#x0431;',$string); # �
$string = str_replace(chr(226),'&#x0432;',$string); # �
$string = str_replace(chr(227),'&#x0433;',$string); # �
$string = str_replace(chr(228),'&#x0434;',$string); # �
$string = str_replace(chr(229),'e',$string);        # �
$string = str_replace(chr(184),'e',$string);        # �
$string = str_replace(chr(230),'&#x0436;',$string); # �
$string = str_replace(chr(231),'&#x0437;',$string); # �
$string = str_replace(chr(232),'&#x0438;',$string); # �
$string = str_replace(chr(233),'&#x0439;',$string); # �
$string = str_replace(chr(234),'k',$string);        # �
$string = str_replace(chr(235),'&#x043B;',$string); # �
$string = str_replace(chr(236),'&#x043C;',$string); # �
$string = str_replace(chr(237),'&#x043D;',$string); # �
$string = str_replace(chr(238),'o',$string);        # �
$string = str_replace(chr(239),'&#x043F;',$string); # �
$string = str_replace(chr(240),'p',$string);        # �
$string = str_replace(chr(241),'c',$string);        # �
$string = str_replace(chr(242),'&#x0442;',$string); # �
$string = str_replace(chr(243),'y',$string);        # �
$string = str_replace(chr(244),'&#x0444;',$string); # �
$string = str_replace(chr(245),'x',$string);        # �
$string = str_replace(chr(246),'&#x0446;',$string); # �
$string = str_replace(chr(247),'&#x0447;',$string); # �
$string = str_replace(chr(248),'&#x0448;',$string); # �
$string = str_replace(chr(249),'&#x0449;',$string); # �
$string = str_replace(chr(250),'&#x044A;',$string); # �
$string = str_replace(chr(251),'&#x044B;',$string); # �
$string = str_replace(chr(252),'&#x044C;',$string); # �
$string = str_replace(chr(253),'&#x044D;',$string); # �
$string = str_replace(chr(254),'&#x044E;',$string); # �
$string = str_replace(chr(255),'&#x044F;',$string); # �

return $string;
}
?>