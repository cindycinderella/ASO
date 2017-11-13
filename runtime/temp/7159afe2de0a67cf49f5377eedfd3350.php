<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:28:"./static/index\analysis.html";i:1508923826;s:24:"./static/index\base.html";i:1508923826;s:23:"./static/index\top.html";i:1508923826;s:23:"./static/index\nav.html";i:1508923826;s:26:"./static/index\footer.html";i:1508923826;}*/ ?>
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
		
<style type="text/css">
	.table th, .table td {
		vertical-align: middle;
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
	<div style="margin-bottom: 10px;">
		<a class="btn btn-large <?php if(($status==1 && $data_id==0) OR $data_id != 0): ?> btn-primary <?php endif; ?>" <?php if($status==1 OR $data_id != 0): ?> href="<?php echo url('index/data/analysisLog',['id'=>$title_id]); ?>"<?php else: ?> href="javascript:void(0);" <?php endif; ?>   style="padding: 4px 50px;">全部</a>
		<a class="btn btn-large <?php if(($status==0 && $data_id==0) OR $data_id != 0): ?> btn-primary<?php endif; ?> " <?php if($status==0 OR $data_id != 0): ?> href="<?php echo url('index/data/analysisLog',['id'=>$title_id,'status'=>1]); ?>"<?php else: ?>href="javascript:void(0);"<?php endif; ?>  style="padding: 4px 50px;">特别关心</a>
		<div class="controls" style="float: right;width: 140px;margin-right: 140px;">
			<select id="selectError" name="file_name" data-rel="chosen">
				<option value="0">日志文件名</option>
				<?php if(is_array($data_list) || $data_list instanceof \think\Collection || $data_list instanceof \think\Paginator): if( count($data_list)==0 ) : echo "" ;else: foreach($data_list as $key=>$list): ?>
				<option <?php if($list['id'] == $data_id): ?> selected="selected" <?php endif; ?> value="<?php echo $list['id']; ?>"><?php echo $list['file_name']; ?></option>
				<?php endforeach; endif; else: echo "" ;endif; ?>					
			</select>
		</div>

	</div>
	<div class="row-fluid sortable">		
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white th-list"></i><span class="break"></span><?php echo $title; ?></h2>														
			</div>
			<div class="box-content alerts">
				<div class="alert alert-success" style="display: none;">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong></strong>
				</div>
				<div class="alert alert-error" style="display: none;">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong></strong>
				</div>														
				<table class="table table-striped">
					<thead>
						<tr>
							<th style="text-align: center;" colspan="2"><font><font>日志文件名</font></font></th>	
							<th style="text-align: center;"><font><font>百度</font></font></th>
							<th style="text-align: center;"><font><font>360</font></font></th>
							<th style="text-align: center;"><font><font>搜狗</font></font></th>
							<th style="text-align: center;"><font><font>谷歌</font></font></th>	
							<th style="text-align: center;"><font><font>必应</font></font></th>
							<th style="text-align: center;"><font><font></font></font></th>								  
							<th style="text-align: center;"><font><font>操作</font></font></th>  									  
						</tr>
					</thead>   
					<tbody>
						<?php if(is_array($analysis) || $analysis instanceof \think\Collection || $analysis instanceof \think\Paginator): if( count($analysis)==0 ) : echo "" ;else: foreach($analysis as $key=>$vo): ?>
						<tr>									
							<td style="text-align: center;" rowspan="4"><font><font><?php echo $vo['today']['file_name']; ?></font></font></td>													
						</tr>		
						<tr>									
							<td style="text-align: center;" ><font><font><?php echo $vo['today']['date']; ?></font></font></td>
							<td style="text-align: center;"><font><font><?php echo $vo['today']['baidu']; ?></font></font></td>
							<td style="text-align: center;"><font><font><?php echo $vo['today']['hao_sou']; ?></font></font></td>
							<td style="text-align: center;"><font><font><?php echo $vo['today']['sogou']; ?></font></font></td>
							<td style="text-align: center;"><font><font><?php echo $vo['today']['google']; ?></font></font></td>	
							<td style="text-align: center;"><font><font><?php echo $vo['today']['bing']; ?></font></font></td>	
							<td style="text-align: center;" rowspan="4"><a class="setLove" alt="<?php echo $vo['today']['id']; ?>" style="cursor: pointer;"><i class="glyphicons-icon <?php if($vo['today']['status']==1): ?>heart<?php else: ?>heart_empty<?php endif; ?> "></i></a></td>
							<td style="text-align: center;" rowspan="4"><a class="btn btn-info" href="<?php echo url('index/data/analysisDetails',['id'=>$title_id,'data_id'=>$vo['today']['data_id']]); ?>">
								<i class="halflings-icon white search"></i>  
							</a></td>								
						</tr>
						<tr>									
							<td style="text-align: center;" ><font><font><?php echo $vo['yestoday']['date']; ?></font></font></td>
							<td style="text-align: center;"><font><font><?php echo $vo['yestoday']['baidu']; ?></font></font></td>
							<td style="text-align: center;"><font><font><?php echo $vo['yestoday']['hao_sou']; ?></font></font></td>
							<td style="text-align: center;"><font><font><?php echo $vo['yestoday']['sogou']; ?></font></font></td>
							<td style="text-align: center;"><font><font><?php echo $vo['yestoday']['google']; ?></font></font></td>	
							<td style="text-align: center;"><font><font><?php echo $vo['yestoday']['bing']; ?></font></font></td>						
						</tr>
						<tr>				
							<td style="text-align: center;" ><font><font>对比</font></font></td>					
							<td style="text-align: center;" >
								<?php if($vo['compared']['baidu']>=0): ?>
								<span style="cursor:pointer;" class="label label-success"><font><font><?php echo $vo['compared']['baidu']; ?></font></font></span>
								<?php else: ?> 
								<span style="cursor:pointer;" class="label label-important"><font><font><?php echo abs($vo['compared']['baidu']); ?></font></font></span>
								<?php endif; ?></td>	
								<td style="text-align: center;">
									<?php if($vo['compared']['hao_sou']>=0): ?>
									<span style="cursor:pointer;" class="label label-success"><font><font><?php echo $vo['compared']['hao_sou']; ?></font></font></span>
									<?php else: ?> 
									<span style="cursor:pointer;" class="label label-important"><font><font><?php echo abs($vo['compared']['hao_sou']); ?></font></font></span>
									<?php endif; ?>
								</td>
								<td style="text-align: center;"><?php if($vo['compared']['sogou']>=0): ?>
									<span style="cursor:pointer;" class="label label-success"><font><font><?php echo $vo['compared']['sogou']; ?></font></font></span>
									<?php else: ?> 
									<span style="cursor:pointer;" class="label label-important"><font><font><?php echo abs($vo['compared']['sogou']); ?></font></font></span>
									<?php endif; ?></td>
									<td style="text-align: center;"><?php if($vo['compared']['google']>=0): ?>
										<span style="cursor:pointer;" class="label label-success"><font><font><?php echo $vo['compared']['google']; ?></font></font></span>
										<?php else: ?> 
										<span style="cursor:pointer;" class="label label-important"><font><font><?php echo abs($vo['compared']['google']); ?></font></font></span>
										<?php endif; ?></td>	
										<td style="text-align: center;"><?php if($vo['compared']['bing']>=0): ?>
											<span style="cursor:pointer;" class="label label-success"><font><font><?php echo $vo['compared']['bing']; ?></font></font></span>
											<?php else: ?> 
											<span style="cursor:pointer;" class="label label-important"><font><font><?php echo abs($vo['compared']['bing']); ?></font></font></span>
											<?php endif; ?></td>								
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

		 //设置特别关心
		 $('.setLove').click(function(){			 	
		 	var analysis_id = $(this).attr('alt');
		 	var _this = $(this);
		 	$.ajax({    
		 		type: 'POST',    
		 		url: "<?php echo url('index/data/setLove'); ?>",
		 		dataType:"json",    
		 		data:{
		 			"analysis_id":analysis_id
		 		},
		 		success:function(data)
		 		{
		 			if (data.status==0)
		 			{
		 				if (data.type==0)
		 				{
		 					_this.find('i').addClass('heart_empty');
		 					_this.find('i').removeClass('heart')
		 				}else
		 				{
		 					_this.find('i').removeClass('heart_empty');
		 					_this.find('i').addClass('heart')
		 				}
		 				$('.alert-success').find('strong').html(data.msg);
		 				$('.alert-success').css('display','block')
		 				$('.alert-success').fadeOut(3000);		
		 			}else if (data.status==404)
		 			{
		 				$('.alert-error').find('strong').html(data.message);
		 				$('.alert-error').css('display','block')
		 				$('.alert-error').fadeOut(3000)
		 				return false;
		 			}else
		 			{
		 				$('.alert-error').find('strong').html(data.msg);
		 				$('.alert-error').css('display','block')
		 				$('.alert-error').fadeOut(3000)
		 			}	
		 		}	

		 	});

		 })
			//搜索文件名
			$('#selectError').change(function(){

				if($(this).val()==0)
				{
					$('.alert-error').find('strong').html("请选择日志文件名");
					$('.alert-error').css('display','block')
					$('.alert-error').fadeOut(3000)
					return false;
				}	
				var data_id = $(this).val();
				var url = "http://<?php echo $_SERVER['HTTP_HOST']; ?>/index/data/analysislog/id/<?php echo $title_id; ?>/data_id/"+data_id+".html"
				window.location.href =url;
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
