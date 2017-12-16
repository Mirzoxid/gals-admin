<article class="full">

	<header class="full-title">
		<h1>{title}</h1>
	<!-- 	<div class="orig-name">������������ �������� ���</div> -->
	</header>
	
	<div class="cols-mov clearfix ignore-select">

		<div class="col-mov-left">
			<div class="mov-img">
				<img src="{image-1}" alt="{title}" />
			[xfgiven_quality]<div class="mov-m">[xfvalue_quality]</div>[/xfgiven_quality]
			</div>
			[rating-type-3]
			<div class="rate3 clearfix rate-f">
				<div class="pluss" id="pluss-{news-id}" onclick="doRateLD('plus', '{news-id}');"><span class="fa fa-thumbs-o-up"></span></div>
				<div class="minuss" id="minuss-{news-id}" onclick="doRateLD('minus', '{news-id}');"><span class="fa fa-thumbs-o-down"></span></div>
                     {rating}
                {vote-num}
                 
			</div>
			[/rating-type-3]
		</div>
		<!-- end col-mov-left -->

		<div class="col-mov-right">
			
			<div class="full-tools">
			    [edit]<span class="fa fa-bars"></span>[/edit]
			    [add-favorites]<span class="fa fa-star-o" title="�������� � ��������"></span>[/add-favorites][del-favorites]<span class="fa fa-star" title="������ �� ��������"></span>[/del-favorites]
			</div>
			
			<div class="rates">
			[xfgiven_rating]<div class="r-kp" data-label="KP"><font color="green">[xfvalue_rating]</font></div> [/xfgiven_rating]
				<!-- <div class="r-imdb" data-label="IMDB">8.00</div> -->
                <b>����� �������:</b> {author}. &nbsp <b>����:</b> {date}
			</div>
			<ul class="mov-list">
				[xfgiven_year]<li><div class="mov-label">���:</div> <div class="mov-desc">[xfvalue_year]</div></li>[/xfgiven_year]
				<li><div class="mov-label">����:</div> <div class="mov-desc">{link-category}</div></li>
				[xfgiven_country]<li><div class="mov-label">������:</div> <div class="mov-desc">[xfvalue_country]</div></li>[/xfgiven_country]
				[xfgiven_director]<li><div class="mov-label">��������:</div> <div class="mov-desc">[xfvalue_director]</div></li>[/xfgiven_director]
				[xfgiven_actors]<li><div class="mov-label">� ������� �����:</div> <div class="mov-desc">[xfvalue_actors]</div></li>[/xfgiven_actors]
				[xfgiven_produser]<li><div class="mov-label">��������:</div> <div class="mov-desc">[xfvalue_produser]</div></li>[/xfgiven_produser]
 				[xfgiven_sound]<li><div class="mov-label">�������:</div> <div class="mov-desc">[xfvalue_sound]</div></li>[/xfgiven_sound]

			</ul>
			
		<!-- 	<div class="full-soc">
			<script type="text/javascript">(function() {
				  if (window.pluso)if (typeof window.pluso.start == "function") return;
				  if (window.ifpluso==undefined) { window.ifpluso = 1;
					var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
					s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
					s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
					var h=d[g]('body')[0];
					h.appendChild(s);
				  }})();</script>
				<div class="pluso" data-background="transparent" data-options="big,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email"></div>
			</div> -->
			
		</div>
		<!-- end col-mov-right -->
		
	</div>
	<!-- end cols-mov -->
 <!--        [xfgiven_online]<div class="mov-desc-text full-text clearfix" data-slice="200"> [/xfgiven_online] -->
<!--			 [xfgiven_trailer]<div class="mov-desc-text full-text clearfix" data-slice="200">[/xfgiven_trailer] -->
		{full-story}
	
    		[xfgiven_scrinlistx]
    <br>
    <br>
    <div class="namegats">C��������:</div>
    <br>
    <br>
    <br>
        <div class="box visible box-screens">
            [xfvalue_scrinlistx]
        </div>
		[/xfgiven_scrinlistx]
	
  <br />
 [xfgiven_ssilka] <h3><center><a class="button black" href="[xfvalue_ssilka]" >�������: [xfvalue_filename]</a></center></h3> [/xfgiven_ssilka]
        <br>
    <br>
 <!--   [xfgiven_online]</div> [/xfgiven_online] -->
<!--			 [xfgiven_trailer]</div>[/xfgiven_trailer] -->
	
	<div class="tabsbox ignore-select">
		<div class="tabs-sel">
			 [xfgiven_online]<span>�������� ������</span> [/xfgiven_online]
			 [xfgiven_trailer]<span>�������</span>[/xfgiven_trailer]
		</div>
		[xfgiven_online]<div class="tabs-b video-box">
			<!-- ������ ������ -->
        <!--dle_video_begin:[xfvalue_online]-->
        <div class="dlevideoplayer" style="width:100%;max-width:100%;">
			<ul data-theme="dark" data-preload="metadata">
				<li data-title="" data-type="m4v" data-url="[xfvalue_online]" ></li>
			</ul>
		</div><!--dle_video_end--> 
        <!-- /����� ������ -->
        </div> [/xfgiven_online]
        [xfgiven_trailer] <div class="tabs-b video-box">
			 <!-- ������ �������� -->
       <!--dle_video_begin:[xfvalue_trailer]-->
        <div class="dlevideoplayer" style="width:100%;max-width:100%;">
			<ul data-theme="dark" data-preload="metadata">
				<li data-title="" data-type="m4v" data-url="[xfvalue_trailer]" ></li>
			</ul>
		</div><!--dle_video_end--> 
        <!-- /����� �������� -->
		</div> [/xfgiven_trailer]
		<div class="mov-compl ic-l">[complaint]<span class="fa fa-exclamation"></span>����� �� ��������[/complaint]</div>
	
    </div>
	<br />
    <br />
    <br />
    <br />
    <!--  <div class="sub-text clearfix ignore-select">
		<span class="fa fa-mobile"></span>�������� {title} � ����� ����������.
    </div>   -->
	[related-news]
	<div class="related tcarusel">
		<h2 class="rel-title">������� ������:</h2>
		<div class="tcarusel-scroll clearfix">
			{related-news}
		</div>
		<div class="tcarusel-prev"><span class="fa fa-arrow-left"></span></div>
		<div class="tcarusel-next"><span class="fa fa-arrow-right"></span></div>
	</div>
	[/related-news]
</article>

<div class="full-comms ignore-select" id="full-comms">
	<div class="add-commbtn button ic-l" id="add-commbtn"><span class="fa fa-plus"></span>��������������</div>
	{addcomments}
	<div class="comments-items">{comments}{navigation}</div>
</div>
