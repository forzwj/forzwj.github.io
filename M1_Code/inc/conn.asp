<%
datedir="data"  						'���ݿ��ϼ��ļ������ƣ������������޸��ļ�������

title="��˹����α��ѯϵͳ"					'���ò�ѯ����,�����㶮�ġ�

tiaojian="��α��"  						'������ƣ����α��

changdus="14"  							'��ĳ��ȣ�Ĭ��������ĸ���

charset="gb2312"						'���ݿ����

verver="20160610"						'�汾�ţ�����һ���޸�һ��




'�޸��������ã����²��ù�
'��������: admin@ewuyi.net ����רע�ڼ򵥶�ʵ�õĸ��ֲ�ѯϵͳ
'������ҳ: http://www.7384.org/
'��Ʒ��ʾ: http://macode.7384.org/
'��Ʒ����: http://item.taobao.com/item.htm?id=43504433203
'ʹ��˵����excel ��һ����16λ��α�룬����Ķ������Զ��壬Ȼ���Ƶ����±����棬�������ĺ�׺Ϊ.dat���������ݿ��ļ���


 '==============================
 '�ж��ļ�����
 '==============================
Function IsFile(FilePath)
	Set Fsod=Server.CreateObject("Scri"&"pting.File"&"Sys"&"temObject")
	If (Fsod.FileExists(Server.MapPath(FilePath))) Then
		IsFile=True
	Else
		IsFile=False
	End If
	Set Fso=Nothing
End Function
 '==============================
 '��ȡ�ļ�����
 '==============================
 Function FsoFileRead(FilePath,charset)
 Set objAdoStream = Server.CreateObject("A"&"dod"&"b.St"&"r"&"eam")
 objAdoStream.Type=2
 objAdoStream.mode=3 
 objAdoStream.charset=charset
 objAdoStream.open 
 objAdoStream.LoadFromFile Server.MapPath(FilePath) 
 FsoFileRead=objAdoStream.ReadText 
 objAdoStream.Close
 Set objAdoStream=Nothing
 End Function

'==============================
'�� �ã�������
'==============================
Function RegExpTester(patrn, strng) 'patrn:��Ҫ���ҵ��ַ� strng:�����ҵ��ַ���
   Dim regEx, Match, Matches      ' ����������
   Set regEx = New RegExp             ' ����������ʽ��
   regEx.Pattern = patrn          ' ����ģʽ��'"\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*"'
   regEx.IgnoreCase = True            ' �����Ƿ����ִ�Сд��
   regEx.Global = True            ' ����ȫ��ƥ�䡣
   Set Matches = regEx.Execute(strng)     ' ִ��������
   For Each Match In Matches      ' ѭ������Matches���ϡ�
     RetStr = RetStr & Match.Value & "|"
   Next
   RegExpTester = RetStr
End Function

'==============================
'�� �ã������ת��ָ��ҳ��
'==============================
Function AlertUrl(AlertStr,Url) 
 Response.Write "<script>" &vbcrlf
 Response.Write "alert('"&AlertStr&"');" &vbcrlf
 Response.Write "location.href='"&Url&"';" &vbcrlf
 Response.Write "</script>" &vbcrlf
 Response.End()
End Function
'==============================
'�� �ã�����󷵻���һҳ��
'==============================
Function AlertBack(AlertStr) 
 Response.Write "<script>" &vbcrlf
 Response.Write "alert('"&AlertStr&"');" &vbcrlf
 Response.Write "history.go(-1)" &vbcrlf
 Response.Write "</script>"&vbcrlf
 Response.End()
End Function
%>