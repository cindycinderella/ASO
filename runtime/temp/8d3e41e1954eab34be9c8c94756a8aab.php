<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:32:"./static/index\add_web_side.html";i:1508923826;s:24:"./static/index\base.html";i:1508923826;s:23:"./static/index\top.html";i:1508923826;s:23:"./static/index\nav.html";i:1508923826;s:26:"./static/index\footer.html";i:1508923826;}*/ ?>
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
		
<!-- start: Content -->
<div id="content" class="span10">


	<ul class="breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="<?php echo url('index/system/config'); ?>">首页</a> 
			<i class="icon-angle-right"></i>
		</li>
		<li><a href="javascript:void(0);" class="title" ><?php echo $title; ?></a>
			<i class="icon-angle-right"></i>
		</li>
		<li><a href="javascript:void(0);"><?php echo $add; ?></a></li>
	</ul>

	<div class="row-fluid sortable">		
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white th-list"></i><span class="break"></span><span class="title"><?php echo $title; ?></span></h2>						
			</div>
			<div class="box-content">					                 	                       
				<form class="form-horizontal"  action="" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $material_id; ?>" />
					<input type="hidden" name="type" value="<?php echo $title_id; ?>" />
					<fieldset>
						<div class="control-group">
							<label class="control-label"><font><font>页端</font></font></label>
							<div class="controls">
								<?php if(is_array($material_type) || $material_type instanceof \think\Collection || $material_type instanceof \think\Paginator): if( count($material_type)==0 ) : echo "" ;else: foreach($material_type as $key=>$vo): ?>
								<label class="checkbox inline">
									<div class="checker <?php if($material_id): ?> disabled <?php endif; ?>" id="uniform-inlineCheckbox1"><span 
										<?php if($title_id==$vo['id']): ?>class="checked" <?php endif; ?> >
										<input type="checkbox"  <?php if($material_id): ?> disabled <?php endif; if($title_id==$vo['id']): ?> checked="checked" <?php endif; ?> class="inlineCheckbox1" value="<?php echo $vo['id']; ?>"></span></div><font><font><span class="title_name<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></span>
									</font></font></label>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="inputSuccess"><font><font>模板名称</font></font></label>
								<div class="controls">
									<input type="text" name="name" value="<?php echo $material['name']; ?>" >
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="inputSuccess"><font><font>模板文件名称</font></font></label>
								<div class="controls">
									<input type="text" name="filename" value="<?php echo $material['filename']; ?>" >
								</div>
							</div>	
							<div class="control-group">
								<label class="control-label" for="inputSuccess"><font><font>标签</font></font></label>
								<div class="controls">
									<input type="text" name="tag" value="<?php echo $material['tag']; ?>" >
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="selectError3">模板类型</label>
								<div class="controls">
									<select id="selectError3" name="web_type">
										<option value="0">模板类型</option>
										<option  <?php if($material['type'] ==1): ?>selected<?php endif; ?>  value="1">爬虫模板</option>
										<option  <?php if($material['type'] ==2): ?>selected<?php endif; ?>  value="2">前端模板</option>
									</select>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="selectError3">模板种类</label>
								<div class="controls">
									<select id="selectError3" name="pertain_type">
										<option value="0">模板种类</option>
										<option <?php if($material['pertain_type'] ==1): ?>selected<?php endif; ?> value="1">详情页模板</option>
										<option <?php if($material['pertain_type'] ==2): ?>selected<?php endif; ?> value="2">首页模板</option>
										<option <?php if($material['pertain_type'] ==3): ?>selected<?php endif; ?> value="3">聚合页模板</option>
										<option <?php if($material['pertain_type'] ==4): ?>selected<?php endif; ?> value="4">客户官网模板</option>
										<option <?php if($material['pertain_type'] ==5): ?>selected<?php endif; ?> value="5">流量优化页面</option>
									</select>
								</div>
							</div>


							
							<div class="control-group fileInput">
								<label class="control-label" for="fileInput">上传文件</label>
								<div class="controls">
									<div class="uploader" id="uniform-fileInput">
										<input class="input-file uniform_on" name="file" id="fileInput" type="file">
										<span class="filename" style="user-select: none;">No file selected</span>
										<span class="action" style="user-select: none;">Choose File</span>
									</div>
									<span style="color:red;">请先把css、js、htmL文件压缩成ZIP格式的压缩包,大小限制为8M</span>
								</div>
							</div>							
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">保存</button>
								<button type="reset" class="btn">取消</button>
							</div>
						</fieldset>
					</form>   



				</div>
			</div><!--/span-->
			
		</div><!--/row-->

	</div><!--/.fluid-container-->
	
	<!-- end: Content -->
</div><!--/#content.span10-->
</div><!--/fluid-row-->



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
<script>
	$(function(){
			//实现复选框变单选
			$('.inlineCheckbox1').change(function(){
				$('.inlineCheckbox1').parent('span').each(function(index, element) {
					$(this).removeClass("checked");
				});	
				$(this).parent('span').addClass("checked");
				var cal = $(this).val()
				$("input[name='type']").val(cal);
				var title = $('.title_name'+cal).html();
				$('.title').html(title);					
			})
			//实现去除具体模板功能
			$("select[name='web_type']").change(function(){
				
				var web_type = $(this).val();
				if(web_type==0)
				{
					return false;
				}
				if(web_type==1)
				{
					$("select[name='pertain_type']").find('option').each(function(index, element) {
						if($(this).val()==4||$(this).val()==5)
						{
							$(this).css('display','none');
						}else
						{
							$(this).css('display','block');
						}
					});	
				}else if(web_type==2)
				{
					$("select[name='pertain_type']").find('option').each(function(index, element) {
						if($(this).val()==4||$(this).val()==5||$(this).val()==0)
						{
							$(this).css('display','block');
						}else
						{
							$(this).css('display','none');
						}
					});	
				}

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
