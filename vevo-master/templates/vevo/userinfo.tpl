<div class="box-out margin">
		<div class="block-head">������������: {usertitle}</div>
    <div class="ratebox" style="float:right;">{rate}</div>

			<div class="uavatar"><img src="{foto}">

                <div class="user-status">
                    [online]<img src="{THEME}/images/online.png" title="������������ � ����">[/online]
            [offline]<img src="{THEME}/images/offline.png" title="������������ �� � ����">[/offline]
                     </div>           
			</div>

			<ul class="ulist">
				<li><span class="grey">������ ���:</span> <b>{fullname}</b></li>
				<li><span class="grey">������:</span> {status} [time_limit]&nbsp;� ������ ��: {time_limit}[/time_limit]</li>
        		<li><span class="grey">���� �����������:</span> <b>{registration}</b></li>
				<li><span class="grey">��������� ���������:</span> <b>{lastdate}</b></li>
				<li><span class="grey">������� � ����:</span> {info}</li>
            </ul>

    <div class="clr"></div><hr />
    <div class="info-block" style="overflow:hidden;">
    <ul class="uinfo">
        <li><h1>����������</h1></li>
        <li><span class="grey">���������� ����������:</span> <b>{news-num}</b><br /> [ {news} ][rss]<img src="{THEME}/images/rss.png" alt="rss" style="vertical-align: middle; margin-left: 5px;" />[/rss]</li>
        <li><span class="grey">���������� ������������:</span> <b>{comm-num}</b><br /> [ {comments} ]</li>
    </ul>
    
    <ul class="uinfo">
        <li><h1>�������������</h1></li>
		<li><span class="grey">ICQ:</span> {icq}</li>
        <li><span class="grey">����� ����������:</span> {land}</li>
        <li>{email}</li>
        [not-group=5]
        <li>{pm}</li>
        [/not-group]
    </ul>
    </div>
    <div class="clr"></div>
			<span class="small">[not-logged] [ {edituser} ] [/not-logged]</span>
</div>

{include file="engine/modules/ulogin/ulogin_tpl_profile.php?my_profile={my_profile}"}

    [not-logged]
<div id="options" class="box-out margin" style="display:none;">
     {include file="engine/modules/ulogin/ulogin_tpl_profile.php?my_profile={my_profile}"} 
    
    
		<div class="block-head">�������������� �������</div>
		<table class="tableform">
			<tr>
				<td class="label">���� ���:</td>
				<td><input type="text" name="fullname" value="{fullname}" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">��� E-Mail:</td>
				<td><input type="text" name="email" value="{editmail}" class="f_input" /><br />
				<div class="checkbox">{hidemail}</div>
				<div class="checkbox"><input type="checkbox" id="subscribe" name="subscribe" value="1" /> <label for="subscribe">���������� �� ����������� ��������</label></div></td>
			</tr>
			<tr>
				<td class="label">����� ����������:</td>
				<td><input type="text" name="land" value="{land}" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">������ ������������:</td>
				<td>{ignore-list}</td>
			</tr>
			<tr>
				<td class="label">����� ICQ:</td>
				<td><input type="text" name="icq" value="{icq}" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">������ ������:</td>
				<td><input type="password" name="altpass" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">����� ������:</td>
				<td><input type="password" name="password1" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label">���������:</td>
				<td><input type="password" name="password2" class="f_input" /></td>
			</tr>
			<tr>
				<td class="label" valign="top">���������� �� IP:<br />��� IP: {ip}</td>
				<td>
				<div><textarea name="allowed_ip" style="width:98%;" rows="5" class="f_textarea">{allowed-ip}</textarea></div>
				<div>
					<span class="small" style="color:red;">
					* ��������! ������ ��������� ��� ��������� ������ ���������.
					������ � ������ �������� ����� �������� ������ � ���� IP-������ ��� �������, ������� �� �������.
					�� ������ ������� ��������� IP �������, �� ������ ������ �� ������ �������.
					<br />
					������: 192.48.25.71 ��� 129.42.*.*</span>
				</div>
				</td>
			</tr>
			<tr>
				<td class="label">������:</td>
				<td>��������� � ����������: <input type="file" name="image" class="f_input" /><br /><br />
				������ <a href="http://www.gravatar.com/" target="_blank">Gravatar</a>: <input type="text" name="gravatar" value="{gravatar}" class="f_input" /> (������� E-mail �� ������ �������)
				<br /><br /><div class="checkbox"><input type="checkbox" name="del_foto" id="del_foto" value="yes" /> <label for="del_foto">������� ������</label></div>
				</td>
			</tr>
			<tr>
				<td class="label">� ����:</td>
				<td><textarea name="info" style="width:98%;" rows="5" class="f_textarea">{editinfo}</textarea></td>
			</tr>
			<tr>
				<td class="label">�������:</td>
				<td><textarea name="signature" style="width:98%;" rows="5" class="f_textarea">{editsignature}</textarea></td>
			</tr>
			{xfields}
		</table>
    <div align="center"><hr />
			<input class="fbutton" type="submit" name="submit" value="���������" />
		</div>
</div>
[/not-logged]