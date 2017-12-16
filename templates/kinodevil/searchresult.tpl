[searchposts]
[fullresult]
{include file="shortstory.tpl"}
[/fullresult]
[shortresult]
<a class="sres-wrap clearfix" href="{full-link}">
<div class="sres-img"><img src="{image-1}" alt="{title}" />
<div class="sres-date">{date}</div>
</div>
<div class="sres-text">
<h2>{title}</h2>
<div class="sres-desc">{short-story limit="450"}</div>
</div>
</a>
[/shortresult]
[/searchposts]

[searchcomments]
[fullresult]
<div class="last-comm-link">{news_title}</div>

<div class="comm-item clearfix">
	<div class="comm-one clearfix [online]status-online[/online]">
		<div class="comm-av img-box"><img src="{foto}" alt="{login}"></div>
		<div class="comm-meta flex-col">
			<div class="comm-author">{author}</div>
			<div class="comm-group">{group-name}</div>
		</div>
		<div class="comm-meta flex-col">
			<div class="comm-date">{date}</div>
			<div class="comm-num"><span class="fa fa-comment-o"></span> {comm-num}</div>
		</div>
	</div>
	<div class="comm-two">
		<div class="comm-body clearfix">
			{comment}
		</div>
		[signature]<div class="signature">{signature}</div>[/signature]
	</div>
</div>
[/fullresult]
[shortresult]
<div class="last-comm-link">{news_title}</div>

<div class="comm-item clearfix">
	<div class="comm-one clearfix [online]status-online[/online]">
		<div class="comm-av img-box"><img src="{foto}" alt="{login}"></div>
		<div class="comm-meta flex-col">
			<div class="comm-author">{author}</div>
			<div class="comm-group">{group-name}</div>
		</div>
		<div class="comm-meta flex-col">
			<div class="comm-date">{date}</div>
			<div class="comm-num"><span class="fa fa-comment-o"></span> {comm-num}</div>
		</div>
	</div>
	<div class="comm-two">
		<div class="comm-body clearfix">
			{comment}
		</div>
		[signature]<div class="signature">{signature}</div>[/signature]
	</div>
</div>
[/shortresult]
[/searchcomments]