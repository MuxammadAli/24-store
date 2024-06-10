<link media="screen" href="{THEME}/images/orderdesc/style.css" type="text/css" rel="stylesheet" />
<script src="{THEME}/images/orderdesc/script.js"></script>

<div id="orderdesc-area">
	<h1 title="���� �������">���� �������</h1>
	<p>��� ���� ���������� ������� ������ �� ������ �������� ���� ���������. ��� ���������� ��������� ����������� ���� ��� ������ ������/�����������/�������/���� � �� ����������� � ��������� ����� ��� ����� � �������� �� �����.<br/>�������, ��� ����� ��������� ���������� �� �������, ��� ������� �����/����������/������/���� ����� ������ � ������� � ��� �� �����!</p>
	<div id="orderdesc-actions">
		[guest]<a href="#" id="orderdesc-add">�������� ������</a>[/guest]
		<form id="orderdesc-search-area" method="get">
			{searchqueries}
			<input type="text" value="��� ����?" onfocus="if(this.value=='��� ����?')this.value='';" onblur="if(this.value=='') this.value='��� ����?';" MAXLENGTH="50" name="search" id="orderdesc-search-input" /><input type="submit" value="" id="orderdesc-search-find" />
		</form>
	</div>
	<div class="odclear"></div>
[guest]	<div id="orderdesc-add-area">
		<form method="post">
			<h4>�������� �� ������� �����(*):</h4>
			<input type="text" name="title" id="orderdesc_title" class="orderdesc-add-input orderdesc-inputclass" />
			<ul id="orderdesc_related"></ul>
			<h4>�������� �� ������������ �����:</h4>
			<input type="text" name="orig_title" class="orderdesc-add-input orderdesc-inputclass" />
			<h4>��� ����������?:</h4>
			<select name="category" class="orderdesc-inputclass">{catlist}</select>
			<h4>������:</h4>
			<select name="year" class="orderdesc-inputclass">
				
				<option value="DLE">DLE</option>
				<option value="LB">LogicBoard</option>
				<option value="BE">Bullet Energy</option>
				<option value="FAPOS">FAPOS</option>
				<option value="" selected></option>
			</select>
			<h4>���� ���������:</h4>
			<textarea name="descr" class="orderdesc-inputclass"></textarea>
			<input type="hidden" name="do" value="orderdesc" /><input type="hidden" name="action" value="addorder" />
			<input type="submit" value="��������" id="orderdesc-add-submit" />
		</form>
	</div>
[/guest]
[filters]	<div id="orderdesc-filters">{filters}<div class="odclear"></div></div>[/filters]
	<table id="orderdesc-table">
		<thead><tr>
			<td title="������ ������" width="16px"><i class="orderdesc-icon"></i></td>
			<td><a href="{url}&amp;sort=title" title="����������� �� ���������">��������</a></td>
			<td width="85px">���������</td>
			<td width="90px">��������</td>
			<td class="odtdcenter" width="75px"><a href="{url}&amp;sort=date" title="����������� �� ���� ������ ������">���� ������</a></td>
			<td class="odtdcenter" width="30px"><a href="{url}&amp;sort=year" title="����������� �� ���� ������">������</a></td>
			<td class="odtdcenter" width="40px" title="�������"><a class="orderdesc-icon orderdesc-rating-td" href="{url}&amp;sort=rating" title="����������� �� ��������"></a></td>
		</tr></thead>
		<tbody>{list}</tbody>
	</table>
	
	[navigation]<div id="orderdesc-navigation">{navigation}</div>[/navigation]
</div>