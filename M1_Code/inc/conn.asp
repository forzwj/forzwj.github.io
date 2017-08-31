<%
datedir="data"  						'数据库上级文件夹名称，更改这里请修改文件夹名称

title="奥斯堡防伪查询系统"					'设置查询标题,相信你懂的。

tiaojian="防伪码"  						'码的名称，如防伪码

changdus="14"  							'码的长度，默认数字字母组成

charset="gb2312"						'数据库编码

verver="20160610"						'版本号，更新一次修改一次




'修改以上配置，以下不用管
'作者邮箱: admin@ewuyi.net 我们专注于简单而实用的各种查询系统
'作者主页: http://www.7384.org/
'产品演示: http://macode.7384.org/
'产品定制: http://item.taobao.com/item.htm?id=43504433203
'使用说明：excel 第一列是16位防伪码，其余的都可以自定义，然后复制到记事本保存，更名，改后缀为.dat，放入数据库文件夹


 '==============================
 '判断文件函数
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
 '读取文件函数
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
'作 用：正则函数
'==============================
Function RegExpTester(patrn, strng) 'patrn:需要查找的字符 strng:被查找的字符串
   Dim regEx, Match, Matches      ' 创建变量。
   Set regEx = New RegExp             ' 创建正则表达式。
   regEx.Pattern = patrn          ' 设置模式。'"\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*"'
   regEx.IgnoreCase = True            ' 设置是否区分大小写。
   regEx.Global = True            ' 设置全程匹配。
   Set Matches = regEx.Execute(strng)     ' 执行搜索。
   For Each Match In Matches      ' 循环遍历Matches集合。
     RetStr = RetStr & Match.Value & "|"
   Next
   RegExpTester = RetStr
End Function

'==============================
'作 用：警告后转入指定页面
'==============================
Function AlertUrl(AlertStr,Url) 
 Response.Write "<script>" &vbcrlf
 Response.Write "alert('"&AlertStr&"');" &vbcrlf
 Response.Write "location.href='"&Url&"';" &vbcrlf
 Response.Write "</script>" &vbcrlf
 Response.End()
End Function
'==============================
'作 用：警告后返回上一页面
'==============================
Function AlertBack(AlertStr) 
 Response.Write "<script>" &vbcrlf
 Response.Write "alert('"&AlertStr&"');" &vbcrlf
 Response.Write "history.go(-1)" &vbcrlf
 Response.Write "</script>"&vbcrlf
 Response.End()
End Function
%>