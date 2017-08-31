<%



option explicit

class com_gifcode_class
public noisy, count, width, height, angle, offset, border, bc

private graph(), margin(3)

private sub class_initialize()
randomize
noisy = 6			'干扰点出现的概率
count = 4			'字符数量
width = 50			'图片宽度
height = 15			'图片高度
angle = 4			'角度随机变化量
offset = 8			'偏移随机变化量
border = 1			'边框大小
bc = request("bc")
end sub

public function create()
const ccharset = "123456789"
dim i, x, y
dim vvalidcode : vvalidcode = ""
dim vindex
redim graph(width-1, height-1)
for i = 0 to count - 1
vindex = int(rnd * len(ccharset))
vvalidcode = vvalidcode + mid(ccharset, vindex+1 , 1)
setdraw vindex, i
next
create = vvalidcode
end function

sub setdot(px, py)
if px * (width-px-1) >= 0 and py * (height-py-1) >= 0 then
graph(px, py) = 1
end if
end sub

public sub setdraw(pindex, pnumber)
'字符数据
dim dotdata(8)
dotdata(0) = array(30, 15, 50, 1, 50, 100)
dotdata(1) = array(1 ,34 ,30 ,1 ,71, 1, 100, 34, 1, 100, 93, 100, 100, 86)
dotdata(2) = array(1, 1, 100, 1, 42, 42, 100, 70, 50, 100, 1, 70)
dotdata(3) = array(100, 73, 6, 73, 75, 6, 75, 100)
dotdata(4) = array(100, 1, 1, 1, 1, 50, 50, 35, 100, 55, 100, 80, 50, 100, 1, 95)
dotdata(5) = array(100, 20, 70, 1, 20, 1, 1, 30, 1, 80, 30, 100, 70, 100, 100, 80, 100, 60, 70, 50, 30, 50, 1, 60)
dotdata(6) = array(6, 26, 6, 6, 100, 6, 53, 100)
dotdata(7) = array(100, 30, 100, 20, 70, 1, 30, 1, 1, 20, 1, 30, 100, 70, 100, 80, 70, 100, 30, 100, 1, 80, 1, 70, 100, 30)
dotdata(8) = array(1, 80, 30, 100, 80, 100, 100, 70, 100, 20, 70, 1, 30, 1, 1, 20, 1, 40, 30, 50, 70, 50, 100, 40)
dim vextent : vextent = width / count
margin(0) = border + vextent * (rnd * offset) / 100 + margin(1)
margin(1) = vextent * (pnumber + 1) - border - vextent * (rnd * offset) / 100
margin(2) = border + height * (rnd * offset) / 100
margin(3) = height - border - height * (rnd * offset) / 100
dim vstartx, vendx, vstarty, vendy
dim vwidth, vheight, vdx, vdy, vdeltat
dim vangle, vlength
vwidth = int(margin(1) - margin(0))
vheight = int(margin(3) - margin(2))
'起始坐标
vstartx = int((dotdata(pindex)(0)-1) * vwidth / 100)
vstarty = int((dotdata(pindex)(1)-1) * vheight / 100)
dim i, j
for i = 1 to ubound(dotdata(pindex), 1)/2
if dotdata(pindex)(2*i-2) <> 0 and dotdata(pindex)(2*i) <> 0 then
'终点坐标
vendx = (dotdata(pindex)(2*i)-1) * vwidth / 100
vendy = (dotdata(pindex)(2*i+1)-1) * vheight / 100
'横向差距
vdx = vendx - vstartx
'纵向差距
vdy = vendy - vstarty
'倾斜角度
if vdx = 0 then
vangle = sgn(vdy) * 3.14/2
else
vangle = atn(vdy / vdx)
end if
'两坐标距离
if sin(vangle) = 0 then
vlength = vdx
else
vlength = vdy / sin(vangle)
end if
'随机转动角度
vangle = vangle + (rnd - 0.5) * 2 * angle * 3.14 * 2 / 100
vdx = int(cos(vangle) * vlength)
vdy = int(sin(vangle) * vlength)
if abs(vdx) > abs(vdy) then vdeltat = abs(vdx) else vdeltat = abs(vdy)
for j = 1 to vdeltat
setdot margin(0) + vstartx + j * vdx / vdeltat, margin(2) + vstarty + j * vdy / vdeltat
next
vstartx = vstartx + vdx
vstarty = vstarty + vdy
end if
next
end sub

public sub output()
response.expires = -9999
response.addheader "pragma", "no-cache"
response.addheader "cache-ctrol", "no-cache"
response.contenttype = "image/gif"
'文件类型
response.binarywrite chrb(asc("G")) & chrb(asc("I")) & chrb(asc("F"))
'版本信息
response.binarywrite chrb(asc("8")) & chrb(asc("9")) & chrb(asc("a"))
'逻辑屏幕宽度
response.binarywrite chrb(width mod 256) & chrb((width \ 256) mod 256)
'逻辑屏幕高度
response.binarywrite chrb(height mod 256) & chrb((height \ 256) mod 256)
response.binarywrite chrb(128) & chrb(0) & chrb(0)
'全局颜色列表
if bc = "white" then
response.binarywrite chrb(255) & chrb(255) & chrb(255)
else
response.binarywrite chrb(252) & chrb(251) & chrb(230)
end if
response.binarywrite chrb(40) & chrb(118) & chrb(164)

'图象标识符
response.binarywrite chrb(asc(","))
response.binarywrite chrb(0) & chrb(0) & chrb(0) & chrb(0)
'图象宽度
response.binarywrite chrb(width mod 256) & chrb((width \ 256) mod 256)
'图象高度
response.binarywrite chrb(height mod 256) & chrb((height \ 256) mod 256)
response.binarywrite chrb(0) & chrb(7) & chrb(255)
dim x, y, i : i = 0
for y = 0 to height - 1
for x = 0 to width - 1
if rnd < noisy / 100 then
response.binarywrite chrb(1-graph(x, y))
else
if x * (x-width) = 0 or y * (y-height) = 0 then
response.binarywrite chrb(graph(x, y))
else
if graph(x-1, y) = 1 or graph(x, y) or graph(x, y-1) = 1 then
response.binarywrite chrb(1)
else
response.binarywrite chrb(0)
end if
end if
end if
if (y * width + x + 1) mod 126 = 0 then
response.binarywrite chrb(128)
i = i + 1
end if
if (y * width + x + i + 1) mod 255 = 0 then
if (width*height - y * width - x - 1) > 255 then
response.binarywrite chrb(255)
else
response.binarywrite chrb(width * height mod 255)
end if
end if
next
next
response.binarywrite chrb(128) & chrb(0) & chrb(129) & chrb(0) & chrb(59)
end sub

end class

dim mcode
set mcode = new com_gifcode_class
session("getcode") = mcode.create()

mcode.output()
set mcode = nothing
%>