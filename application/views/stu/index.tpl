<form id="pagerForm" action="{$url}/index" method="post">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="{$numPerPage}" /><!--每页显示多少条-->
	<input type="hidden" name="orderField" value="{$orderField}" /><!--查询排序-->
	<input type="hidden" name="orderDirection" value="{$orderDirection}" /><!--升序降序-->
</form>

<div class="pageHeader">
	<form rel="pagerForm" onsubmit="return navTabSearch(this);" method="post">
	<div class="searchBar">
			<table class="searchContent">
				<tr>
					
					<td>
						姓名：<input type="text" value="{$smarty.post.name|default:''}" name="name" />
					</td>
					<td>
						<div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div>
					</td>
				</tr>
			</table>
	</div>
	</form>
</div>

<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="{$url}/add" target="dialog" mask="true" height="480" title="添加学员信息"><span>新增</span></a></li>
			<li><a class="delete" href="{$url}/delete/{ldelim}s_id{rdelim}/?navTabId=listStu" target="ajaxTodo" title="你确定要删除吗？" warn="请选择要操作的信息"><span>删除</span></a></li>
			<li><a class="edit" href="{$url}/edit/{ldelim}s_id{rdelim}" target="dialog" mask="true" height="500" warn="请选择要操作的信息" title="编辑学员信息"><span>编辑</span></a></li>
			<li class="line">line</li>
			
		</ul>
	</div>

	<table class="table" width="100%" layoutH="112">
		<thead>
		<tr>
			<th width="40" orderField="id" {if $orderField eq 'id'} class="{$orderDirection}" {/if} >学号</th>
			<th width="80" orderField="name" {if $orderField eq 'name'} class="{$orderDirection}" {/if} >姓名</th>
			<th width="40" orderField="sex" {if $orderField eq 'sex'} class="{$orderDirection}" {/if} >性别</th>
			<th width="80" orderField="age" {if  $orderField eq 'age'} class="{$orderDirection}" {/if} >年龄</th>
			<th width="100" orderField="classid" {if $orderField eq 'classid'} class="{$orderDirection}" {/if} >班号</th>
		</tr>
		</thead>
		<tbody>
			{foreach $list as $ov}
				<tr target="s_id" rel="{$ov.id}">
					<td>{$ov.id}</td>
					<td>{$ov.name}</td>
					<td>{$ov.sex}</td>
					<td>{$ov.age}</td>
					<td>{$ov.classid}</td>
				</tr>
			{/foreach}
			</tbody>
	</table>

	<div class="panelBar">
		<div class="pages">
			<span>显示</span>
			<select class="combox" name="numPerPage" onchange="navTabPageBreak({ numPerPage:this.value})">
				  <option value="5" {if $numPerPage eq 5}selected{/if}>5</option>
				  <option value="10" {if $numPerPage eq 10}selected{/if}>10</option>
				  <option value="20" {if $numPerPage eq 20}selected{/if}>20</option>
			</select>
			<span>条,共{$totalCount}条</span>
		</div>
		<div class="pagination" targetType="navTab" totalCount="{$totalCount}" numPerPage="{$numPerPage}" pageNumShown="10" currentPage="{$currentPage}"></div>
	</div>

</div>
