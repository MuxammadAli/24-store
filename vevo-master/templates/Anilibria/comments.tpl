<div class="comment" id="{comment-id}">
	<div class="com_info">
		<div class="avatar">
			[profile]<span class="cover" style="background-image: url({foto});">{login}</span>[/profile]
			[online]<span class="com_online" title="{login} - онлайн">Онлайн</span>[/online]
		</div>
		<div class="com_user">
			<b class="name">{author}</b>
			<span class="grey">
				от {date}
			</span>
		</div>
		
	</div>
	<div class="com_content">
		[aviable=lastcomments|search]<h4 class="title">{news_title}</h4>[/aviable]
		<div class="text">{comment}</div>
		[signature]<div class="signature">--------------------<br />{signature}</div>[/signature]
	</div>
</div>
<style>
.mass_comments_action > select {
       display: none;
}
  .bbcodes {
    display: none;
}  
    .mass_comments_action {
   
    display: none;
}
</style>