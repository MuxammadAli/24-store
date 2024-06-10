<article class="bof story">
	<div class="box_in dark_top userinfo_top">
		<ul class="title user_tab h1">
			<li class="active"><a href="#user1" data-toggle="tab">[group=5]������������ [/group]{usertitle}</a></li>
			[not-logged]<li><a href="#user2" data-toggle="tab">�������������</a></li>[/not-logged]
		</ul>
		<div class="avatar">
			<a href="#"><span class="cover" style="background-image: url({foto});">{usertitle}</span></a>
		</div>
	</div>
	<div class="box_in">
		<div class="tab-content">
			<div class="tab-pane active" id="user1">
				<ul class="usinf">
					<li><div class="ui-c1 grey">���</div> <div class="ui-c2">{fullname}[not-fullname]����������[/not-fullname]</div></li>
					<li><div class="ui-c1 grey">����� ����������</div> <div class="ui-c2">{land}[not-land]����������[/not-land]</div></li>
					<li><div class="ui-c1 grey">���������������</div> <div class="ui-c2">{registration}</div></li>
					<li><div class="ui-c1 grey">��������� ����������</div> <div class="ui-c2">{lastdate}</div></li>
					<li><div class="ui-c1 grey">������</div> <div class="ui-c2">{status}</div></li>
					<li><div class="ui-c1 grey">������</div> <div class="ui-c2">[online]<span style="color: #70bb39;">������</span>[/online][offline]������[/offline]</div></li>
				</ul>
				<ul class="usinf">
					<li><div class="ui-c1 grey">���-�� ����������</div> <div class="ui-c2">{news-num}&nbsp;&nbsp; [ {news} ]</div></li>
					<li><div class="ui-c1 grey">���-�� ������������</div> <div class="ui-c2">{comm-num}&nbsp;&nbsp; [ {comments} ]</div></li>
									</ul>
				<h4 class="heading">� ����</h4>
				<p>{info}</p>
				[signature]
					<h4 class="heading">�������</h4>
					{signature}
				[/signature]
			</div>
			
		</div>
			[not-logged]
			<div class="tab-pane" id="user2">
				<!-- ��������� ������������ -->
				<div id="options" style="display:none;">
					<div class="addform">
						<ul class="ui-form">
							<li class="form-group">
								<label for="fullname">���� ���</label>
								<input type="text" name="fullname" id="fullname" value="{fullname}" class="wide">
							</li>
							<li class="form-group">
								<label for="email">��� e-mail</label>
								<input type="email" name="email" id="email" value="{editmail}" class="wide" required>
								<div class="checkbox">{hidemail}</div>
							</li>
							<li class="form-group">
								<label for="land">����� ����������</label>
								<input type="text" name="land" id="land" value="{land}" class="wide">
							</li>
							<li class="form-group">
								<label>������� ����</label>
								{timezones}
							</li>
							<li class="form-group form-sep"></li>
							<li class="form-group">
								<label for="altpass">������ ������</label>
								<input type="password" name="altpass" id="altpass" class="wide">
							</li>
							<li class="form-group">
								<label for="password1">����� ������</label>
								<input type="password" name="password1" id="password1" class="wide">
							</li>
							<li class="form-group">
								<label for="password2">��������� ����� ������</label>
								<input type="password" name="password2" id="password2" class="wide">
							</li>
							<li class="form-group form-sep"></li>
							<li class="form-group">
								<label for="image">��������� ������</label>
								<input type="file" name="image" id="image" class="wide">
							</li>
							<li class="form-group">
								<input placeholder="������������ Gravatar" type="text" name="gravatar" id="gravatar" value="{gravatar}" class="wide">
							</li>
							<li class="form-group">
								<div class="checkbox"><input type="checkbox" name="del_foto" id="del_foto" value="yes" />�<label for="del_foto">������� ������</label></div>
							</li>
							<li class="form-group form-sep"></li>
							<li class="form-group">
								<label for="info">� ����</label>
								<textarea name="info" id="info" rows="5" class="wide">{editinfo}</textarea>
							</li>
							<li class="form-group">
								<label for="signature">�������</label>
								<textarea name="signature" id="signature" rows="3" class="wide">{editsignature}</textarea>
							</li>
							<li class="form-group form-sep"></li>
							<li class="form-group">
								<label for="signature">������ ������������ �������������:</label>
								{ignore-list}
							</li>
							<li class="form-group form-sep"></li>
							[group=1,2,3]
							<li class="form-group">
								<label for="allowed_ip">���������� �� IP</label>
								<textarea placeholder="�������: 192.48.25.71 or 129.42.*.*" name="allowed_ip" id="allowed_ip" rows="5" class="field wide">{allowed-ip}</textarea>
							</li>
							[/group]
							<li class="form-group">
								<table class="xfields">
								{xfields}
								</table>
							</li>
							<li class="form-group">
								<div class="checkbox">{news-subscribe}</div>
							</li>
							<li class="form-group">
								<div class="checkbox">{comments-reply-subscribe}</div>
							</li>
							<li class="form-group">
								<div class="checkbox">{unsubscribe}</div>
							</li>
							<li class="form-group">
								<div class="checkbox">{twofactor-auth}</div>
							</li>
						</ul>
						<div class="form_submit">
							<button class="btn btn-big" name="submit" type="submit"><b>���������</b></button>
							<input name="submit" type="hidden" id="submit" value="submit">
						</div>
					</div>
				</div>
				<!-- / ��������� ������������ -->
			</div>
			[/not-logged]
	</div>
</article>
<style>
    .bof, .comment {
    background-color: #fff;
    margin-bottom: 25px;
    border-radius: 2px;
    position: relative;
    box-shadow: 0 1px 3px 0 rgba(0,0,0,0.2);
    -webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,0.2);
}
    .box_in {
    padding: 4% 8%;
}
    .dark_top {
    border-radius: 2px 2px 0 0;
    color: #fff;
    background: #2c2c2c;
}
    .userinfo_top {
    position: relative;
    padding-bottom: 50px;
    margin-bottom: 50px;
}
  
    /* --- �������� ������������ --- */
.userinfo_top { position: relative; padding-bottom: 50px; margin-bottom: 50px; }
.userinfo_top .avatar { position: absolute; }
.user_tab { list-style: none; padding: 0; margin: 0; }
	.user_tab > li { display: inline; margin-right: 1.2em; }
	.user_tab > li > a {
		text-decoration: none !important;
		font-size: 0.8em;
		-webkit-transition: all ease .3s; transition: all ease .3s;
	}
	.user_tab > li > a { color: #fff; opacity: .5; }
	.user_tab > li > a:hover { color: inherit; }
	.user_tab > li.active > a { cursor: default; font-size: 2em; opacity: 1; }

	.usinf { list-style: none; padding: 0; margin: 0 0 25px 0; } 
	.usinf li { padding: 12px 0; border-top: 1px solid #e6e6e6; }
	.usinf li:first-child { border-top-width: 0; }

	.ui-c1, .ui-c2 { display: inline-block; vertical-align: top; }
	.ui-c1 { width: 30%; margin-right: 5%; }
	.ui-c2 { width: 60%; }

	/* ���� ������������ */
	.userinfo { padding-left: 90px; }
	.userinfo .avatar { position: absolute; float: left; margin: 0 0 0 -90px; }
	.userinfo .avatar .cover { width: 60px; height: 60px; }
	.userinfo > ul { list-style: none; padding: 0; margin: 0; }

    </style>