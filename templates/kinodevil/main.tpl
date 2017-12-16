<!DOCTYPE html>
<html lang="ru">
<head>
  {headers}
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="{THEME}/images/favicon.png" />
  <link href="{THEME}/style/styles.css" type="text/css" rel="stylesheet" />
  <link href="{THEME}/style/engine.css" type="text/css" rel="stylesheet" />
      <!-- ���������� ���� ������ -->
      <link href="{THEME}/style/frameworks.css" type="text/css" rel="stylesheet" />
      <link href="{THEME}/style/style228.css" type="text/css" rel="stylesheet" />

<!-- ���������� ���� ����� -->  
  <!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <link href='{THEME}/style/fonts.css?family=Open+Sans:400,300,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
</head>

<body>

<div class="wrap">
	<!-- 
	<a href="#" class="brand-link"></a>
	 ������ ����, ������� �� �� �����������, ���� ����� ����� �������������� ������ �� ����� -->

	<div class="main center">
	
		<header class="header" id="header">
			<a href="/" class="logotype" title="�� �������">����-������</a>
			<div class="search-box">
					<form id="quicksearch" method="post">
						<input type="hidden" name="do" value="search" />
						<input type="hidden" name="subaction" value="search" />
<!--						<input type="hidden" name="titleonly" value="3" /> -->
						<div class="search-inner">
							<input id="story" name="story" placeholder="�����..." type="text" />
							<button type="submit" title="�����"><span class="fa fa-search"></span></button>
						</div>
					</form>
			</div>
				<!-- <div class="share-box" data-img="{THEME}/images/tt-fav.png"></div> -->
			<div class="show-login img-box" id="loginbtn"><span class="fa fa-user"></span></div>
		</header>
		
         [aviable=main|cat]    
	<div class="related tcarusel carou-top">
        <div class="rel-title">�������:</div>
		<div class="tcarusel-scroll clearfix">
			{custom tags="2017" template="custom-carou" order="date" from="0" limit="30" cache="yes"}
		</div>
		<div class="tcarusel-prev"><span class="fa fa-arrow-left"></span></div>
		<div class="tcarusel-next"><span class="fa fa-arrow-right"></span></div>
	</div>
    [/aviable]
        
		<div class="cols clearfix" id="cols">
		
			<div class="content">
				
				{info}
				[aviable=main|cat]
				<div class="main-title clearfix">
					<h1>��������� �����������</h1>
					[sort]
					<div class="sorter" data-label="����������� ��">
						<span class="fa fa-chevron-down"></span>
						{sort}
					</div>
					[/sort]
				</div>
				<div class="floaters clearfix">
					{content}
                   
				</div>
				[/aviable]
					
				[not-aviable=main|cat]<div class="full-wrap clearfix">{content}</div>[/not-aviable]
				
			</div>
			<!-- end content -->
			
			<aside class="sidebar">
			
				<div class="side-b">
					<div class="side-t ic-l decor"><span class="fa fa-film"></span>���������</div>
					<nav class="side-c nav">
						<ul class="flex-row">
                            <li><a href="/anime/">�����</a></li>
                             <li><a href="/aziat/">���������</a></li>
                            <li><a href="/action_war/">������</a></li>
                            <li><a href="/war/">�������</a></li>
                            <li><a href="/vestern/">�������</a></li>
                            <li><a href="/drama/">�����</a></li>
                            <li><a href="/konzerti/">��������</a></li>
                            <li><a href="/documentals/">��������������</a></li>
                            <li><a href="/detective/">��������</a></li>
                            <li><a href="/india/">���������</a></li>
                            <li><a href="/history/">������������</a></li>
                            <li><a href="/criminal/">��������</a></li>
                            <li><a href="/comedy/">�������</a></li>
                            <li><a href="/clips/">�����</a></li>
                            <li><a href="/cartoon/">�����������</a></li>
                            <li><a href="/melodrama/">���������</a></li>
                            <li><a href="/adventures/">�����������</a></li>
                            <li><a href="/family/">��������</a></li>
                            <li><a href="/serial/">�������</a></li>
                            <li><a href="/sport/">�����</a></li>
                            <li><a href="/trailers/">��������</a></li>
                            <li><a href="/thriller/">��������</a></li>
                            <li><a href="/tv_show/">��-���</a></li>
                            <li><a href="/horror/">�����</a></li>
                            <li><a href="/fantastic/">����������</a></li>
                            <li><a href="/fantasy/">�������</a></li>
                            <li><a href="/3d/">3D</a></li>
                            <li><a href="/hd-bd/">HD-BD</a></li>
                            
						</ul>
					</nav>
				</div>
				
			<div class="side-b">
					<div class="side-t ic-l decor"><span class="fa fa-trophy"></span>��������</div>
					<div class="side-c nav">
						<ul class="flex-row">
							<li><a href="/collections/">��� ��������</a></li>
							<li><a href="/collections/marvel_universe/">Marvel</a></li>
							<li><a href="/collections/luchshie_filmy_pro_buduschee/">��� �������</a></li>
							<li><a href="/collections/lego/">������� Lego</a></li>
							<!--<li><a href="#">������</a></li>
							<li><a href="#">������</a></li>
							<li><a href="#">������</a></li>
							<li><a href="#">������</a></li> -->
						</ul>
					</div>
				</div>
				
				<div class="side-b">
					<div class="side-c">
					<!-- 	<img src="{THEME}/images/rkl.jpg" alt="" /> -->
					</div>
				</div>

				<div class="side-b">
					<div class="side-t ic-l decor"><span class="fa fa-commenting"></span>�����������</div>
					<div class="side-c">
						{customcomments template="comm-item" available="global" from="0" limit="5" order="date" cache="no"}
					</div>
				</div>
				
				<div class="side-b">
					<div class="side-t ic-l decor"><span class="fa fa-align-left"></span>����������</div>
					<div class="side-c flex-row">
						{topnews}
					</div>
				</div>
				
			</aside>
			
		</div>
		<!-- end cols -->
		
	<!--	{include file="main-seo-bottom.tpl"} -->
		
		<footer class="footer">
				<ul class="bot-menu clearfix">
					<li><a href="/">�������</a></li>
					<li><a href="/rules.html">�������</a></li>
					<li><a href="/index.php?do=feedback">��������</a></li>
				</ul>
				<div class="bot-text">
				��� ����� �� �������� �������������� ����������� ��������������� ������������. ��� ����� �������� ������ ��� �������� ������������� - ��� ������ ����� �� ������ ������ ������������ ������. Powered by <a target="_blank" href="http://gals.uz/">Gals-Telecom</a>
				</div>
				<!-- <div class="share-box" data-img="{THEME}/images/tt-fav.png"></div> -->
			<!-- <div class="count">��� ��������</div> -->
		</footer>
		
	</div>
	<!-- end main -->
	
</div>
<!-- end wrap -->	

{login}
{jsfiles}
<script src="{THEME}/js/libs.js"></script>
{AJAX}

</body>
</html>