<!--#include file="M1_Code/inc/conn.asp"-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<title><%=title%></title>
<script language="javascript">
var tiaojian="<%=tiaojian%>";
var changdus="<%=changdus%>";
var $=function(node){
return document.getElementById(node);
}
function $(objId){
return document.getElementById(objId);
}
function Trim(Str){
return  Str.replace(/(^\s*)|(\s*$)/g,"");
}
function inst() {
if ($("coder")) {
 $("coder").value = $("tishi1").innerHTML;
}
}
function check() {
var queryString;
var codes=$("coder").value.replace(/(^\s+)|(\s+$)/g, "");
var coder=codes.length;
if (!codes.match(/^[0-9A-Za-z]{<%=changdus%>}$/)) { //<%=tiaojian%>������������ж�
if (coder == 0) {
$("coder").value = $("tishi1").innerHTML;
$("tishi").innerHTML = "<span class=STYLE6>��ȷ����<%=changdus%>λ���кŲſɲ�ѯ.</span>";
}else if(coder == <%=changdus%>){
$("tishi").innerHTML = "<span class=STYLE6><%=tiaojian%>��ʽ������:��ĸ������� .... </span>";
}else if(coder == <%=changdus+1%>){
$("tishi").innerHTML = "<span class=STYLE6>����<%=tiaojian%>����̫���� .... </span>";
}else{
var coden=<%=changdus%>-coder;
$("tishi").innerHTML = "<span class=STYLE6>��������"+coden+"�ְ�! .... </span>";
}
$('coder').style.borderColor='red';
$("sub").disabled = true;
$("sub").value = "����ȷ�������к�";
return false;
}else{
$("tishi").innerHTML = "<span class=STYLE3>���к�����ȷ����,����������ѯ.... </span>";
$("sub").disabled = false;
$("sub").value = "������ѯ";
$('coder').style.borderColor='green';
}
}
</script>
<link href="M1_Code/inc/wap.css?v=<%=verver%>" rel="stylesheet" type="text/css" />

<body onLoad="inst();">
<div class="sub_bod"></div>
<div class="sub_top">
	<div class="title"><%=title%></div>
	<div class="back" id="pageback"><a href="index.asp"><img src="M1_Code/inc/18.jpg" alt="������ҳ" border="0"/></a></div>  
	<div class="menu" id="topmenus"><a href="#"><img src="M1_Code/inc/2.jpg" border="0"/></a></div>
</div>
<%
codar=""&trim(request("c"))&""
coder=""&trim(request.form("coder"))&""
coder=UCase(coder) 'תΪ��д��ĸ
'coder=LCase(coder) 'תΪСд��ĸ

if coder="" then
%>
<form name="queryForm" method="post" class="" action="" onsubmit="return check(0);">
<div class="so_box" id="11">
<input name="coder" type="text" class="txts" id="coder" maxlength="<%=changdus%>" value="<%=codar%>" onKeyUp="check(1);" ondown="check(1);" onChange="check(1);" onBlur="check(1)" onfocus="this.value=''" />
</div>
<div class="so_box" id="33">
<input name="codes" type="text" class="txts" id="codes" value="������4λ��֤��" onfocus="this.value=''" onBlur="check(2)" />
<div class="more" id="clearkey">
<img src="M1_Code/inc/Coder.asp?t=<%=timer%>" id="Codi" onClick="this.src='M1_Code/inc/Coder.asp?t='+new Date();"/>
</div></div>
<div class="so_box">
<input type="submit" name="button" class="buts" id="sub" value="������ѯ" />
</div>

<!--<div class="so_box" id="tishi" >����ȷ�������к�</div>!-->
<div class="xlh_box" id="xlh1"></br><img src='M1_Code/inc/xlh.jpg' width='100%'></div>
<div id="tishi1" style="display:none;">������<%=changdus%>λ���к�</div>
<div id="codes" style="display:none;">������4λ������֤��</div>
</form><div id="jieguo">

<%
else
if trim(session("getcode")) <> trim(Request("codes")) then
ErrorMessage = "��������ȷ����֤��"
response.write(" <script>alert('"&ErrorMessage&"');location.href='index.asp' </script>")
response.end
end if

if len(coder)<>14 Then
 call AlertBack("������"&changdus&"λ�������кţ�")
End if

iii=0
 TruePath=Server.MapPath("M1_Code/"&datedir&"/")
set fso=CreateObject("Scripting.FileSystemObject") 
 if fso.FolderExists(TruePath) then
 Set theFolder=fso.GetFolder(TruePath)
 For Each theFile In theFolder.Files
if right(theFile.name,4)=".dat" then 
 EditFile=theFile.name 
 
Files = "M1_Code/"&datedir&"/"&EditFile&""

Set Fso22 = Server.CreateObject("Scripting.FileSystemObject")
Set myFile22 = Fso22.OpenTextFile(Server.MapPath(Files),1,True)

While Not myFile22.AtEndOfStream
 shuju = myFile22.ReadLine
 zhide=split(shuju,VbTab)
 numde=Ubound(zhide)
iii=iii+1
if iii=1 then '�ҵ���һ�еı���
	line1=shuju
else
rs33=trim(zhide(0))  '��ȡ������ ��һ��
if instr(rs33," ")>0 then rs33=replace(rs33," ","") 
if rs33=coder then
yyy=yyy+1
Response.Write "<table cellspacing=""0"">"&vbcrlf
 Response.Write "<caption align='center'>��ѯ���: <span></span></caption>"&vbcrlf
 For xM1C=0 To numde
 curValue = trim(zhide(xM1C))
 If IsNull(curValue) or len(curValue)<1 Then
  curValue="-"
 End If
 curValue = CStr(curValue)
      Response.Write "<tr>"&vbcrlf
Response.Write "<td class=""r"">" & split(line1,VbTab)(xM1C) & "</td>"&vbcrlf
Response.Write "<td class=""span"">" & curValue & "</td>"&vbcrlf
 Response.Write "</tr>"&vbcrlf
Next
Response.Write "</table>"&vbcrlf
end if

end if 
Wend
myFile22.Close
Set myFile22 = Nothing
Set Fso22 = Nothing
end if
next
end if

if yyy>0 then
 Response.Write "<p class=""STYLE3""></br>����ѯ�����к�Ϊ��Ʒ��</br></p>"	'ok
else
 Response.Write "<p class=""STYLE6"">�޷���ѯ�����ṩ�ķ�α����Ϣ���ܿ��������򵽵��Ƿ���Ʒ��</p>"	'��Ӧ���ݿ���������
end if

Response.Write ""&vbcrlf

Response.Write ""&vbcrlf
%>
<div class="so_box">
<input type="button" value="�� ��" class="buts" onclick="location.href='?index.asp';" id="reset"></div>
</div>
<div align="center">
  <%end if%></div>
</div>

<div class="foot">
  <div class="title">
    <span>&copy; 2014-<%=year(now)%>&nbsp;&nbsp;
<a href="#"><%=title%></a></span>
  </div>
</div>

</body>
</html>