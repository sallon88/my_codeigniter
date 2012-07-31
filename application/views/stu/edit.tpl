<h2 class="contentTitle">编辑学生信息</h2>

<div class="pageContent">
	<form method="post" action="{$url}/update/?navTabId=listStu&callbackType=closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,dialogAjaxDone);"><?php  //窗体组件采用这个 iframeCallback(this, navTabAjaxDone); ?>
		<input type="hidden" name="id" value="{$id}" />
		<div class="pageFormContent" layoutH="110">
			<dl>
				<dt>姓名：</dt>
				<dd><input type="text"  style="width:100%" name="name" value="{$name}"/></dd>
			</dl>
			<dl>
				<dt>性别：</dt>
				<dd><input type="text"  style="width:100%" name="sex"  value="{$sex}"/></dd>
			</dl>
			<dl>
				<dt>年龄：</dt>
				<dd><input type="text" size="10" style="width:100%" name="age"  value="{$age}"/></dd>
			</dl>
			<dl>
				<dt>班号：</dt>
				<dd><input type="text" style="width:100%" name="classid"  value="{$classid}"/></dd>
			</dl>
		</div>
		
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">修改</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>

