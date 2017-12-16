<div class="shortstory">
	<div class="shortstorytitle">
		<div style="width: 120px;float: right;">
			<span class="izbrannoe">
				<span class="favoriticon">{favorites}</span>
			</span>
			<span class="podrobnosti_right">
			[rating]
				[rating-type-1]{rating}[/rating-type-1]
				[rating-type-2]
				<div class="ratebox2">
					<ul class="reset">
						<li>[rating-plus]<img src="{THEME}/images/like.png" title="��������" alt="��������" style="width:14px;" />[/rating-plus]</li>
						<li>{rating}</li>
					</ul>
				</div>
				[/rating-type-2]
				[rating-type-3]
				<div class="ratebox3">
					<ul class="reset">
						<li>[rating-minus]<img src="{THEME}/images/ratingminus.png" title="�� ��������" alt="�� ��������" style="width:14px;" />[/rating-minus]</li>
						<li>{rating}</li>
						<li>[rating-plus]<img src="{THEME}/images/ratingplus.png" title="��������" alt="��������" style="width:14px;" />[/rating-plus]</li>
					</ul>
				</div>
				[/rating-type-3]
			[/rating]
			</span>
		</div>
		<h2 class="zagolovki">
			<a href="{full-link}">{title}</a>
		</h2>
	</div>
	<div class="shortimg">
		<div id="{news-id}" style="display:inline;">
			[xfvalue_poster]
			<noindex>
				{short-story limit="500"}...<br><br>
				<b>��� �������:</b> {year}<br>
				<b>������:</b> {country}<br>
				<b>����:</b> {genre}<br>
				[xfgiven_quality]<b>��������:</b> [xfvalue_quality]<br>[/xfgiven_quality]
				[xfgiven_postproduction]<b>�������:</b> [xfvalue_postproduction]<br>[/xfgiven_postproduction]
				[xfgiven_time]<b>�����������������:</b> [xfvalue_time]<br>[/xfgiven_time]
				[xfgiven_premier_rus]<b>�������� (��):</b> [xfvalue_premier_rus]<br>[/xfgiven_premier_rus]
			</noindex>
		</div>
	</div>
</div>
<div class="icons">
	<span class="podrobnee" style="padding: 4px 0 4px 20px;">
		<a href="{full-link}">
			<span class="fbutton-img">
				<img src="{THEME}/images/viewmore.png" border="0" alt="C������� ������">
			</span>
		</a>
	</span>  
	<span style="float:right; padding: 7px 20px 19px 20px;">
		<span class="dateicon" title="����">{date}</span> 
		[not-group=5]
		[edit]<span class="editicon" title="�������������">�������������</span>[/edit]
		[/not-group]
	</span>
</div>