<div class="box-out">
		<div class="block-head">������������ ������</div>
	<table class="tableform">
		<tr>
			<td class="label">
				��� ����� ��� E-Mail �� �����:
			</td>
			<td><input class="f_input" type="text" name="lostname" /></td>
		</tr>
		[sec_code]
		<tr>
			<td class="label">
				������� ���<br />� ��������:<span class="impot">*</span>
			</td>
			<td>
				<div>{code}</div>
				<div><input class="f_input" style="width:115px" maxlength="45" name="sec_code" size="14" /></div>
			</td>
		</tr>
		[/sec_code]
		[recaptcha]
		<tr>
			<td class="label">
				������� ��� �����,<br />���������� �� �����������:<span class="impot">*</span>
			</td>
			<td>
				<div>{recaptcha}</div>
			</td>
		</tr>
		[/recaptcha]
	</table>
    <div align="center"><hr />
		<button name="submit" class="fbutton" type="submit"><span>���������</span></button>
	</div>
</div>