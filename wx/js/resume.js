// JavaScript Document

var content = new Array(
						["求职意向","intention",true],
						["关于我","aboutme",false],
						["专业技能","skill",false],
						["工作经历","company",false],
						["项目经验","program",false],
						["教育经历","education",false],
						["培训经历","train",false],
						["证书","certificate",false],
						["语言能力","language",false],
						["荣誉","honour",false],
						["其它小作","other",false]
						);
document.write("<div id='nav' style = 'position:fixed; top:20px; right:5px; color:#555;'>");
document.write("	 <dl style='border:1px solid #e7e7e7;padding:8px;background:#f6f6f6;'>");
document.write("		<dt style = 'margin-bottom:6px; padding-bottom:2px;border-bottom:1px solid #e7e7e7;text-align:center;'>信息导航</dt>");
for( var i = 0;i<content.length;i++){
	content[i][2] = "";
	document.write("		<dd style='padding-bottom:2px;'><a onclick='changecolor(this);' style='text-decoration:none;color:"+(location.hash=='#'+content[i][1]?'red':'blue')+"' href='"+location.pathname+"#"+content[i][1]+"'>" + content[i][0] + "</a></dd>");
}
document.write("</dl>");
document.write("</div>");

function changecolor(d){
	var x = document.getElementById('nav').getElementsByTagName('a');
	for(i = 0; i < x.length;i++){
		x[i].style.color = 'blue';
	}
	d.style.color = 'red';
}