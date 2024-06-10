<style type="text/css" media="all">
.form_bord
{
	margin-left: 3px;
	margin-right: 3px;
	margin-top: 1px;
	border: 1px solid #5e6d7e;
	background-color: #eff4f6;
}
</style>

<div align="left">
{id-orders}.&nbsp<img src="{status_img}" border="0" align="absmiddle"> <a title="{autor}" href="javascript:ShowOrHide('{id-orders}');">{date} - {autor}</a> <b> - {status}</b>[editor] <span class="copy"><i>(обработал <font color="#0080ff"><b>{editor}</b></font>)</i></span>[/editor] {adminlink}
<div id="{id-orders}" style="display:none;font:12px Arial; padding:5px; color:#ffffff; border:1px dotted #ffffff;">
<p><strong>Дата:</strong> {date}
<p><strong>Название (Рус.):</strong> {runame}
<p><strong>Оригинальное название:</strong> {enname}
<p><strong>Тип файла:</strong> {category}
<p><strong>Год издания:</strong> {fileyear}
<p><strong>Ссылка:</strong><div style="">{loclink_s}</div><br/>
{answer}
</div></div>