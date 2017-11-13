<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:25:"./static/index\baidu.html";i:1508923826;s:24:"./static/index\base.html";i:1508923826;s:23:"./static/index\top.html";i:1508923826;s:23:"./static/index\nav.html";i:1508923826;s:26:"./static/index\footer.html";i:1508923826;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>ASO优化管理系统--后台</title>
	<meta name="description" content="ASO">
	<meta name="author" content="ASO">
	<meta name="keyword" content="ASO">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="__INDEX__css/bootstrap.min.css" rel="stylesheet">
	<link href="__INDEX__css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="__INDEX__css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="__INDEX__css/style-responsive.css" rel="stylesheet">
	<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'> -->
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="__INDEX__css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="__INDEX__css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="__INDEX__img/favicon.ico">
	<!-- end: Favicon -->
</head>

<body>
<div class="navbar">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="<?php echo url('index/system/config'); ?>"><span>ASO</span></a>								
			<!-- start: Header Menu -->
			<div class="nav-no-collapse header-nav">
				<ul class="nav pull-right">																								
					<!-- start: User Dropdown -->
					<li class="dropdown">
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="halflings-icon white user"></i><?php echo $username; ?>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="dropdown-menu-title">
								<span>帐号设置</span>
							</li>
							<li><a href="JavaScript:void(0);"><i class="halflings-icon user"></i><?php echo session('admin_user.group_name');; ?></a></li>
							<li><a href="<?php echo url('index/index/loginOut'); ?>"><i class="halflings-icon off"></i>退出</a></li>
						</ul>
					</li>
					<!-- end: User Dropdown -->
				</ul>
			</div>
			<!-- end: Header Menu -->				
		</div>
	</div>
</div>

<!-- start: Header -->
<div class="container-fluid-full">
	<div class="row-fluid">			
		<!-- start: Main Menu -->
		<div id="sidebar-left" class="span2">
			<div class="nav-collapse sidebar-nav">
				<ul class="nav nav-tabs nav-stacked main-menu">
					
					
				<?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): if( count($nav)==0 ) : echo "" ;else: foreach($nav as $key=>$vo): ?>
				   <li>
				   <a <?php if(!empty($vo['child_nav'])): ?> 
				   class="dropmenu" href="javascript:void(0);"  <?php else: ?>  href="<?php echo url($vo['url']); ?>"   <?php endif; ?>			 
				 >
				   <i class="<?php echo $vo['css_img']; ?>"></i>
				   <span class="hidden-tablet"> <?php echo $vo['name']; ?></span>
				   </a>
				   <?php if(!empty($vo['child_nav'])): $url = explode('/',$vo['url']);$url=$url[1];?>			   
					<ul <?php if(strpos($url,$class)!==FALSE): ?>
					style="display: block;"
					<?php endif; ?>>						
						<?php if(is_array($vo['child_nav']) || $vo['child_nav'] instanceof \think\Collection || $vo['child_nav'] instanceof \think\Paginator): if( count($vo['child_nav'])==0 ) : echo "" ;else: foreach($vo['child_nav'] as $key=>$nav_c): ?>
						<li <?php if($nav_c['id'] == $title_id): ?>
						class="active"
						<?php endif; ?>>
						<a class="submenu" href="<?php echo url($nav_c['url'],'id='.$nav_c['id']); ?>">
						<i class="<?php if($nav_c['css_img'] == ''): ?>icon-file-alt <?php else: ?><?php echo $nav_c['css_img']; endif; ?>>"></i>
						<span class="hidden-tablet"><?php echo $nav_c['name']; ?></span>
						</a>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>	
				   <?php endif; ?>
				   </li>
				<?php endforeach; endif; else: echo "" ;endif; ?>			
				</ul>
			</div>
		</div>

<script src="__INDEX__js/highcharts.js"></script>
<script src="__INDEX__js/data.js"></script>
<script src="__INDEX__js/drilldown.js"></script>		
<style type="text/css">
	.table th, .table td {
		vertical-align: middle;
	}
	/*上传进图条*/
	.progress{background-image: -webkit-linear-gradient(top,#ebebeb 0,#f5f5f5 100%);
		background-image: -o-linear-gradient(top,#ebebeb 0,#f5f5f5 100%);
		background-image: -webkit-gradient(linear,left top,left bottom,from(#ebebeb),to(#f5f5f5));
		background-image: linear-gradient(to bottom,#ebebeb 0,#f5f5f5 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffebebeb', endColorstr='#fff5f5f5', GradientType=0);
		background-repeat: repeat-x;height: 20px;
		margin: 10px;
		overflow: hidden;
		background-color: #f5f5f5;border-radius: 4px;
		-webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
		box-shadow: inset 0 1px 2px rgba(0,0,0,.1); display:none; }
		.progress-bar-striped {
			background-image: -webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
			background-image: -o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
			background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
		}
		.progress-bar {
			background-image: -webkit-linear-gradient(top,#337ab7 0,#286090 100%);
			background-image: -o-linear-gradient(top,#337ab7 0,#286090 100%);
			background-image: -webkit-gradient(linear,left top,left bottom,from(#337ab7),to(#286090));
			background-image: linear-gradient(to bottom,#337ab7 0,#286090 100%);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff337ab7', endColorstr='#ff286090', GradientType=0);
			background-repeat: repeat-x;
		}
		.progress-bar-striped, .progress-striped .progress-bar {
			background-image: -webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
			background-image: -o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
			background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
			-webkit-background-size: 40px 40px;
			background-size: 40px 40px;
		}
		.progress-bar {
			float: left;
			width: 0%;
			height: 100%;
			font-size: 12px;
			line-height: 20px;
			color: #fff;
			text-align: center;
			background-color: #337ab7;
			-webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
			box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
			-webkit-transition: width .6s ease;
			-o-transition: width .6s ease;
			transition: width .6s ease;
		}
		.cursor:hover
		{
			color: #646464;
		}
	</style>
	<!-- start: Content -->
	<div id="content" class="span10">


		<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="<?php echo url('index/system/config'); ?>">首页</a> 
				<i class="icon-angle-right"></i>
			</li>
			<li><a href="javascript:void(0);"><?php echo $title; ?></a></li>
		</ul>

		<div class="row-fluid sortable">		
			<div class="box span12">
				<div class="box-header" data-original-title>
					<h2><i class="halflings-icon white th-list"></i><span class="break"></span><?php echo $title; ?></h2>														
				</div>
				<div class="box-content">
					<div class="alert alert-success" style="display: none;">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong></strong>
					</div>
					<div class="alert alert-error" style="display: none;">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong></strong>
					</div>
					<form class="form-horizontal" method="POST" action="<?php echo url('index/Baidu/upload'); ?>" id="myupload"  enctype="multipart/form-data">
						<fieldset>
							<div class="controls file" style="float: left;margin-left: 10px;">
								<input type="file" name="file[]" multiple="" >
							</div>
							<a class="btn btn-primary upload" style="padding: 3px 12px;margin-left: 6px;">上传</a>						
							<!-- 上传进图条 -->
							<div class="progress">
								<div class="progress-bar progress-bar-striped" ><span class="percent">0%</span></div>
							</div>							
						</div>

					</fieldset>
				</form>
				<table class="table table-striped"> 
					<tbody>
						<?php if(is_array($domain) || $domain instanceof \think\Collection || $domain instanceof \think\Paginator): if( count($domain)==0 ) : echo "" ;else: foreach($domain as $k=>$vo): ?>		
						<tr>
							<th style="text-align: left;" colspan="5"><?php echo $vo['name']; ?>-<?php echo $vo['domain']; ?></th>
							<th style="text-align: right;"><a style="text-decoration:underline;" href="<?php echo url('index/baidu/domain',array('id'=>$title_id,'site_id'=>$vo['site_id'])); ?>">SEO综合分析</a></th>	
						</tr>
						<tr>
							<th style="text-align: center;" ></th>
							<th style="text-align: center;">百度</th>
							<th style="text-align: center;">360</th>
							<td style="text-align: center;width: 300px;height:200px;" rowspan="4" id="container<?php echo $k; ?>"></td>
							<td style="text-align: center;width: 300px;height:200px;" rowspan="4" id="containers<?php echo $k; ?>"></td>
							<td style="text-align: center;width: 100px;" rowspan="4">
								前10<?php if($vo['change'][0]>=0): ?>
								<span style="cursor:pointer;" class="label label-success"><?php echo abs($vo['change'][0]); ?></span>
								<?php else: ?> 
								<span style="cursor:pointer;" class="label label-important"><?php echo abs($vo['change'][0]); ?></span>
								<?php endif; ?><br>
								前20<?php if($vo['change'][1]>=0): ?>
								<span style="cursor:pointer;" class="label label-success"><?php echo abs($vo['change'][1]); ?></span>
								<?php else: ?> 
								<span style="cursor:pointer;" class="label label-important"><?php echo abs($vo['change'][1]); ?></span>
								<?php endif; ?><br>
								前30<?php if($vo['change'][2]>=0): ?>
								<span style="cursor:pointer;" class="label label-success"><?php echo abs($vo['change'][2]); ?></span>
								<?php else: ?> 
								<span style="cursor:pointer;" class="label label-important"><?php echo abs($vo['change'][2]); ?></span>
								<?php endif; ?><br>
								前50
								<?php if($vo['change'][3]>=0): ?>
								<span style="cursor:pointer;" class="label label-success"><?php echo abs($vo['change'][3]); ?></span>
								<?php else: ?> 
								<span style="cursor:pointer;" class="label label-important"><?php echo abs($vo['change'][3]); ?></span>
								<?php endif; ?><br>
							</td>
							<script type="text/javascript">								
								var chart = new Highcharts.Chart('container<?php echo $k; ?>', {
									chart: {
										type: 'line'
									},
									title: {
										text: ''
									},
									subtitle: {
										text: ''
									},
									xAxis: {
										title: {
											text: '收录分析趋势'
										},
										labels: {
											enabled: false
										},
										categories: <?php echo $vo['date']; ?>									 
									},
									yAxis: {
										title: {
											text: ''
										},labels: {
											enabled: false
										}
									},
									tooltip: {				                    
				                   	shared: true,
				                	},
									plotOptions: {
										line: {
											dataLabels: {
						                    enabled: false          // 开启数据标签
						                },
						                enableMouseTracking: true // 关闭鼠标跟踪，对应的提示框、点击事件会失效
						            }
						        },
						        legend: {
						        	enabled: false
						        },
						        series: [{
						        	name: '百度',
						        	data: <?php echo $vo['baidu']; ?>
						        },{
						        	name: '360',
						        	data: <?php echo $vo['haoSou']; ?>
						        }]
						    });
								var chart = new Highcharts.Chart('containers<?php echo $k; ?>', {
									chart: {
										type: 'line'
									},
									title: {
										text: ''
									},
									subtitle: {
										text: ''
									},
									tooltip: {				                    
				                   	shared: true,
				                	},
									xAxis: {
										title: {
											text: '关键字排名趋势'
										},labels: {
											enabled: false
										},
										categories: <?php echo $vo['rank']['date']; ?>
									},
									yAxis: {
										title: {
											text: ''
										},labels: {
											enabled: false
										}
									},
									legend: {
										enabled: false
									},
									plotOptions: {
										line: {
											dataLabels: {
							                    enabled: false          // 开启数据标签
							                },
							                enableMouseTracking: true // 关闭鼠标跟踪，对应的提示框、点击事件会失效
							            }
							        },
							        series: [{
							        	name: '前10',
							        	data: <?php echo $vo['rank']['one']; ?>
							        },{
							        	name: '前20',
							        	data: <?php echo $vo['rank']['two']; ?>
							        },{
							        	name: '前30',
							        	data: <?php echo $vo['rank']['three']; ?>
							        },{
							        	name: '前50',
							        	data: <?php echo $vo['rank']['four']; ?>
							        }]
							    });
							</script>
						</tr>	
						<tr>
							<td style="text-align: center;">权重</td>
							<td style="text-align: center;"><?php echo $vo['baidu_weights']; ?></td>
							<td style="text-align: center;"><?php echo $vo['haosou_weights']; ?></td>
						</tr>
						<tr>
							<td style="text-align: center;">收录</td>
							<td style="text-align: center;"><?php echo $vo['baidu_record']; ?></td>
							<td style="text-align: center;"><?php echo $vo['haosou_record']; ?></td>
						</tr>
						<tr>
							<td style="text-align: center;">IP</td>
							<td style="text-align: center;" colspan="2"><?php echo $vo['ip_count']; ?></td>
						</tr>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>  
				<div class="pagination pagination-centered" style="float:right">
					<?php echo $page; ?>
				</div>        
			</div>
		</div><!--/span-->

	</div><!--/row-->

</div><!--/.fluid-container-->

<!-- end: Content -->
</div><!--/#content.span10-->
</div><!--/fluid-row-->


<form style="display: none;" method="POST" action="<?php echo url('index/data/analysis'); ?>" id="analysis">
	<input type="hidden" class="analysis_id" name="analysis_id" value="">
	<input type="file" name="file[]" multiple="" >
</form>
<div class="clearfix"></div>

<!-- start: JavaScript-->
<script src="__INDEX__js/jquery-1.9.1.min.js"></script>
<script src="__INDEX__js/jquery-migrate-1.0.0.min.js"></script>

<script src="__INDEX__js/jquery-ui-1.10.0.custom.min.js"></script>

<script src="__INDEX__js/jquery.ui.touch-punch.js"></script>

<script src="__INDEX__js/modernizr.js"></script>

<script src="__INDEX__js/bootstrap.min.js"></script>

<script src="__INDEX__js/jquery.cookie.js"></script>

<script src='__INDEX__js/fullcalendar.min.js'></script>

<script src='__INDEX__js/jquery.dataTables.min.js'></script>

<script src="__INDEX__js/excanvas.js"></script>
<script src="__INDEX__js/jquery.flot.js"></script>
<script src="__INDEX__js/jquery.flot.pie.js"></script>
<script src="__INDEX__js/jquery.flot.stack.js"></script>
<script src="__INDEX__js/jquery.flot.resize.min.js"></script>

<script src="__INDEX__js/jquery.chosen.min.js"></script>

<script src="__INDEX__js/jquery.uniform.min.js"></script>

<script src="__INDEX__js/jquery.cleditor.min.js"></script>

<script src="__INDEX__js/jquery.noty.js"></script>

<script src="__INDEX__js/jquery.elfinder.min.js"></script>

<script src="__INDEX__js/jquery.raty.min.js"></script>

<script src="__INDEX__js/jquery.iphone.toggle.js"></script>

<script src="__INDEX__js/jquery.uploadify-3.1.min.js"></script>

<script src="__INDEX__js/jquery.gritter.min.js"></script>

<script src="__INDEX__js/jquery.imagesloaded.js"></script>

<script src="__INDEX__js/jquery.masonry.min.js"></script>

<script src="__INDEX__js/jquery.knob.modified.js"></script>

<script src="__INDEX__js/jquery.sparkline.min.js"></script>

<script src="__INDEX__js/counter.js"></script>

<script src="__INDEX__js/retina.js"></script>

<script src="__INDEX__js/custom.js"></script>
<script src="__INDEX__js/jquery.form.js"></script>
<script>
	$(function(){
		var progress = $(".progress"); 
		var progress_bar = $(".progress-bar");
		var percent = $('.percent');
		$('.upload').click(function(){			
			$("#myupload").ajaxSubmit({     
				dataType:"json",    
            	beforeSend: function() { //开始上传 
            		progress.show();
            		var percentVal = '0%';
            		progress_bar.width(percentVal);
            		percent.html(percentVal);
            	},
            	uploadProgress: function(event, position, total, percentComplete) { 
		  			var percentVal = percentComplete + '%'; //获得进度 
		  			progress_bar.width(percentVal); //上传进度条宽度变宽 
		  			percent.html(percentVal); //显示上传进度百分比 
		  		}, 
		  		success:function(data)
		  		{
		  			if (data.status!=200)
		  			{
		  				$('.alert-error').find('strong').html(data.message);
		  				$('.alert-error').css('display','block')
		  				$('.alert-error').fadeOut(3000)
		  				progress.hide();
		  				return false;
		  			}else
		  			{

		  				$('.alert-success').find('strong').html(data.message);
		  				$('.alert-success').css('display','block')
		  				$('.alert-success').fadeOut(3000);
		  				setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
						window.location.reload();//页面刷新
						},3000);
		  			}

		  		},
		        error:function(xhr){ //上传失败 
		        	$('.alert-error').find('strong').html('上传失败');
		        	$('.alert-error').css('display','block')
		        	$('.alert-error').fadeOut(3000)
		        	progress.hide(); 
		        } 	

		    });


		})



	})
</script>
<!-- end: JavaScript-->

<div class="clearfix"></div>
<footer>
<p>
	<span style="text-align:left;float:left">&copy; 2017 <a href="downloads/janux-free-responsive-admin-dashboard-template/" alt="Bootstrap_Metro_Dashboard">ASO</a></span>		
</p>
</footer>
	

</body>
</html>
