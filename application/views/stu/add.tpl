<h2 class="contentTitle">添加学生信息</h2>

<div class="pageContent">
	<form method="post" action="{$url}/insert/?navTabId=listStu&callbackType=closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  //窗体组件采用这个 iframeCallback(this, navTabAjaxDone); ?>
		<div class="pageFormContent" layoutH="110">
			<dl>
				<dt>姓名：</dt>
				<dd><input type="text"  style="width:100%" name="name"/></dd>
			</dl>
			<dl>
				<dt>性别：</dt>
				<dd><input type="text"  style="width:100%" name="sex"/></dd>
			</dl>
			<dl>
				<dt>年龄：</dt>
				<dd><input type="text" size="10" style="width:100%" name="age"/></dd>
			</dl>
			<dl>
				<dt>班号：</dt>
				<dd><input type="text" style="width:100%" name="classid"/></dd>
			</dl>
		</div>
		
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>

