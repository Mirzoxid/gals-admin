<div class="mov movie-item ignore-select short-movie">
	<div class="mov-c nowrap"><b>����:</b> {date} </div>
	<div class="mov-i img-box">
        <img src="{image-1}" alt="{title}" />
        <i class="fa fa-info show-desc"></i>
        <a class="mov-mask flex-col ps-link" href="{full-link}" ><span class="fa fa-play"></span></a>
    <!--	    <div class="mov-mask flex-col ps-link" data-link="{full-link}"><span class="fa fa-play"></span></div> -->
			[xfgiven_quality]<div class="mov-m">[xfvalue_quality]</div>[/xfgiven_quality]
        
	</div>
	<a class="mov-t nowrap" href="{full-link}"  title="{title}">{title}</a>
	<div class="mov-c nowrap">{link-category}</div>
    <div class="movie-desc">
		<div class="movie-date"><b>���� ������ �������:</b> {date=j F Y}</div>
       [xfgiven_rating]<div class="movie-kp"><i class="fa fa-bar-chart"></i>[xfvalue_rating]</div>[/xfgiven_rating]
		[xfgiven_year]<div class="movie-year"><b>���:</b> [xfvalue_year]</div>[/xfgiven_year]
		[xfgiven_director]<div class="movie-rejis"><b>������:</b> [xfvalue_director]</div>[/xfgiven_director]
         [xfgiven_actors]<div class="movie-actor"><b>� �����: </b> [xfvalue_actors]</div>[/xfgiven_actors]
        <!-- <div class="movie-director"><b>��� ���� ��������:</b> ��� ���� ������ �������</div> -->
		<!-- <div class="movie-text">{short-story limit="200"}</div> -->
          [xfgiven_description]<div class="movie-text"><b>��������:</b> [xfvalue_description limit="200"]</div>[/xfgiven_description]
        [rating-type-1]<div class="movie-rate"><i class="fa fa-thumbs-o-up"></i>{vote-num}</div>[/rating-type-1]
        		[rating-type-2]<div class="movie-rate"><i class="fa fa-thumbs-o-up"></i>{rating}</div>[/rating-type-2]
		[rating-type-3]<div class="movie-rate"><i class="fa fa-thumbs-o-up"></i>{rating}</div>[/rating-type-3]
        <div class="movie-rate"><i class="fa fa-eye"></i>{views}</div>
        <div class="movie-rate"><i class="fa fa-comments"></i> {comments-num}</div>
		</div>

</div>





