<div class="box-out">
    [pmlist]<div class="block-head">������ ���������</div>[/pmlist]
    [newpm]<div class="block-head">����� ���������</div>[/newpm]
    [readpm]<div class="block-head">���� ���������</div>[/readpm]

    <ul class="pm-menu">
            <li>[inbox]�������� ���������[/inbox]</li>
            <li>[outbox]������������ ���������[/outbox]</li>
            <li>[new_pm]��������� ���������[/new_pm]</li>
        </ul>
    
    <div class="info-block">
        <h1>��������� �����</h1>
        ����� ������������ ��������� ��������� ��:
    	{pm-progress-bar}
    	{proc-pm-limit}% �� ������ ({pm-limit} ���������)
	</div>
[pmlist]
{pmlist}
[/pmlist]
[newpm]
	<table class="tableform">
		<tr>
			<td class="label">
				����:
			</td>
			<td><input type="text" name="name" value="{author}" class="f_input" /></td>
		</tr>
		<tr>
			<td class="label">
				����:<span class="impot">*</span>
			</td>
			<td><input type="text" name="subj" value="{subj}" class="f_input" /></td>
		</tr>
		<tr>
			<td class="label">
				���������:<span class="impot">*</span>
			</td>
			<td class="editorcomm">
			{editor}<br />
			<div class="checkbox"><input type="checkbox" id="outboxcopy" name="outboxcopy" value="1" /> <label for="outboxcopy">��������� ��������� � ����� "������������"</label></div>
			</td>
		</tr>
		[sec_code]
		<tr>
			<td class="label">
				���:<span class="impot">*</span>
			</td>
			<td>
				<div>{sec_code}</div>
				<div><input type="text" name="sec_code" id="sec_code" style="width:115px" class="f_input" /></div>
			</td>
		</tr>
		[/sec_code]
		[recaptcha]
		<tr>
			<td class="label">
				������� ��� �����, ���������� �� �����������:<span class="impot">*</span>
			</td>
			<td>
				<div>{recaptcha}</div>
			</td>
		</tr>
		[/recaptcha]
		[question]
			<tr>
				<td class="label">
					������:
				</td>
				<td>
					<div>{question}</div>
				</td>
			</tr>
			<tr>
				<td class="label">
					�����:<span class="impot">*</span>
				</td>
				<td>
					<div><input type="text" name="question_answer" id="question_answer" class="f_input" /></div>
				</td>
			</tr>
		[/question]
	</table>
    <div align="center"><hr />
		<button type="submit" name="add" class="fbutton"><span>���������</span></button>
		<input type="button" class="fbutton" onclick="dlePMPreview()" title="��������" value="��������" />
	</div>	
[/newpm]
[readpm]
    <div class="avatar"><img src="{foto}" alt=""/></div>

    <ul class="ulist">
        <li><span class="grey">�����������:</span> {author}</li>
        <li><span class="grey">���� ��������:</span> {date}</li>
		<li><span class="grey">������:</span> {group-name}</li>
        <li><span class="grey">�����������:</span> {registration}</li>
        <li><span class="grey">����:</span> {subj}</li>
    </ul>
    
    <div class="clr"></div><hr />
    <p>{text}</p>
    <ul class="pm-menu">
        <li>[reply]<b>��������</b>[/reply]</li>
		<li>[complaint]������������[/complaint]</li>
		<li>[ignore]������������[/ignore]</li>
		<li>[del]�������[/del]</li>
    </ul>
    [signature]<br />{signature}[/signature]
[/readpm]
</div>