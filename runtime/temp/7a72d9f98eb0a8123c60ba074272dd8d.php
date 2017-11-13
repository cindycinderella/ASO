<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:28:"./static/index\authView.html";i:1508923826;s:24:"./static/index\base.html";i:1508923826;s:23:"./static/index\top.html";i:1508923826;s:23:"./static/index\nav.html";i:1508923826;s:26:"./static/index\footer.html";i:1508923826;}*/ ?>
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
		<li><a href="javascript:void(0);"><?php echo $title; ?></a></li>
	</ul>

	<div class="row-fluid sortable">		
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white th-list"></i><span class="break"></span><?php echo $title; ?></h2>
				<div class="box-icon">
					<a href="javascript:void(0);"><i class="halflings-icon white plus"></i></a>							
				</div>						
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
				<table class="table table-striped">
					<thead>
						<tr>
							<th style="text-align: center;">id</th>
							<th style="text-align: center;">父权限</th>
							<th style="text-align: center;">权限名</th>
							<th style="text-align: center;">描述</th>
							<th style="text-align: center;">排序</th>
							<th style="text-align: center;">图标</th>
							<th style="text-align: center;">是否显示</th>
							<th style="text-align: center;">操作</th>   									  
						</tr>
					</thead>   
					<tbody>
						<?php if(is_array($nav_list) || $nav_list instanceof \think\Collection || $nav_list instanceof \think\Paginator): if( count($nav_list)==0 ) : echo "" ;else: foreach($nav_list as $key=>$vo): ?>
						<tr>
							<td style="text-align: center;"><?php echo $vo['id']; ?></td>
							<td style="text-align: center;" alt="<?php echo $vo['pid']; ?>"><?php echo $vo['pid_name']; ?></td>
							<td style="text-align: center;"><?php echo $vo['url']; ?></td>
							<td style="text-align: center;"><?php echo $vo['name']; ?></td>
							<td style="text-align: center;"><?php echo $vo['asc']; ?></td>
							<td style="text-align: center;" alt="<?php echo $vo['css_img']; ?>"><?php if($vo['css_img'] != ''): ?><i class="<?php echo $vo['css_img']; ?>"></i><?php endif; ?></td>
							<td style="text-align: center;"><?php if($vo['status'] == 1): ?> 
								<span style="cursor:pointer;" class="label label-success status" alt="<?php echo $vo['id']; ?>">是</span>
								<?php else: ?>
								<span style="cursor:pointer;" class="label label-important status" alt="<?php echo $vo['id']; ?>">否</span>
								<?php endif; ?>
							</td>
							<td style="text-align: center;">
								<a class="btn btn-info" href="JavaScript:void(0);">
									<i class="halflings-icon white edit"></i>  
								</a>
							</td> 
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

<div class="modal hide fade" id="myModal" style="left: 39%;width: 50%">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h3>修改权限</h3>
	</div>
	<div class="modal-body" style="max-height: 530px;">
		<form class="form-horizontal" method="POST" action="<?php echo url('index/System/add'); ?>">
			<input type="hidden" name="id" value="">
			<fieldset>
				<div class="control-group">
					<label class="control-label" for="selectError3">父级权限</label>
					<div class="controls">
						<select id="selectError3" name="pid">
							<option value="0">选择父级权限</option>
							<?php if(is_array($parents) || $parents instanceof \think\Collection || $parents instanceof \think\Paginator): if( count($parents)==0 ) : echo "" ;else: foreach($parents as $key=>$navInfo): ?>
							<option value="<?php echo $navInfo['id']; ?>"><?php echo $navInfo['name']; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><font color="red">* </font>权限名称</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="url"  value="">
						<span class="help-inline" style="display: none;">请输入权限名称</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><font color="red">* </font>描述</label>
					<div class="controls">
						<input type="text" class="input-xlarge"  name="name" value="">
						<span class="help-inline" style="display: none;">请输入描述</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">图标</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="css_img"  value="">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">是否显示菜单栏</label>
					<div class="controls">
						<select id="selectError" name="status" style="width: 100px;">
							<option value="1">显示</option>
							<option value="-1">隐藏</option>
						</select>
					</div>
				</div>	
				<div class="control-group">
					<label class="control-label">排序</label>
					<div class="controls">
						<input type="text" onkeyup="value=value.replace(/[^\d]/g,'')" class="input-xlarge"  name="asc" style="width: 50px;"  value="0">
						<font color="red">由大到小排序</font>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
	<div class="modal-footer">
		<a href="JavaScript:void(0);" class="btn" data-dismiss="modal">Close</a>
		<a href="JavaScript:void(0);" class="btn btn-primary">Save</a>
	</div>
</div>

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
	$('.btn-info').click(function(){
		$('#myModal .modal-header h3').html('修改权限');
		$(this).parents('tr').find('td').each(function(index,e){
			if (index==0)
			{
				$("input[name='id']").val($(this).html());
			}else if (index==1)
			{
				var pid = $(this).attr('alt');
				if (pid==100000)
				{
					pid =1;
				}
				$("#selectError3").val(pid);
			}else if (index==2)
			{
				$("input[name='url']").val($(this).html());
			}else if (index==3)
			{
				$("input[name='name']").val($(this).html());
			}else if (index==4)
			{
				$("input[name='asc']").val($(this).html());
			}else if (index==5)
			{
				var pid = $(this).attr('alt');
				$("input[name='css_img']").val(pid);
			}else if (index==6)
			{
				var status = $(this).find('span').html();
				$("#selectError option").each(function(index,e){
					$(this).attr("selected",false);					
					if (status=='是')
					{
						if ($(this).html()=='显示')
						{
							$(this).attr("selected",true);
						}
						
					}else
					{
						if ($(this).html()=='隐藏')
						{
							$(this).attr("selected",true);
						}
					}

				})
			}
		})	

		$('#myModal').modal({backdrop: 'static', keyboard: false});
	})
	$('.box-icon').click(function(){
		$("input[name='id']").val('');
		$('#myModal .modal-header h3').html('添加权限');
		$('#myModal').modal({backdrop: 'static', keyboard: false});
	})
	$('input[name="name"]').blur(function(){
		if ($(this).val()!='')
		{
			$("input[name='name").next().hide();	
			$("input[name='name']").parents('.control-group').removeClass('error')
		}
	})
	$('input[name="url"]').blur(function(){
		if ($(this).val()!='')
		{
			$("input[name='url").next().hide();	
			$("input[name='url']").parents('.control-group').removeClass('error')
		}
	})
	$(document).on('click','.btn-primary',function(){
		var _this = $(this);   
		//添加或者修改权限		
		$(".form-horizontal").ajaxSubmit({  		
			dataType:"json",    
			beforeSend: function() { 
				_this.removeClass('btn-primary');
			},    	
			success:function(data)
			{
				_this.addClass('btn-primary');
				if (data.status==404)
				{
					$('#myModal').modal('hide')
					$('.alert-error').find('strong').html(data.message);
					$('.alert-error').css('display','block')
					$('.alert-error').fadeOut(3000)
					return false;
				}else if (data.status!=200)
				{
					$("input[name='"+data.name+"']").next().show();	
					$("input[name='"+data.name+"']").parents('.control-group').addClass('error')		  				
					return false;
				}else
				{
					$('#myModal').modal('hide')
					$('.alert-success').find('strong').html(data.message);
					$('.alert-success').css('display','block')
					$('.alert-success').fadeOut(3000);
	        	 	//sleep(3000);
	        	 	setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
					window.location.reload();//页面刷新
				},3000); 
	        	 }

	        	},
	        error:function(xhr){ //上传失败 
	        	$('.alert-error').find('strong').html('操作失败');
	        	$('.alert-error').css('display','block')
	        	$('.alert-error').fadeOut(3000)
	        } 	

	    });

	})
	$(document).on('click','.status',function(){
		var title_id = $(this).attr('alt');
		var _this = $(this);
		$.ajax({    
			type: 'POST',    
			url: "<?php echo url('index/System/navStatus'); ?>",
			dataType:"json",    
			data:{
				"title_id":title_id
			},
			success:function(data)
			{
				if(data.status==0)
				{
					$('.alert-success').find('strong').html(data.message);
					$('.alert-success').css('display','block')
					$('.alert-success').fadeOut(3000);
	        	 	setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
					window.location.reload();//页面刷新
					},2000);
	        	}else
	        	 {
	        	 	$('.alert-error').find('strong').html(data.message);
	        	 	$('.alert-error').css('display','block')
	        	 	$('.alert-error').fadeOut(3000)
	        	 }    
	        	},
	        	error: function() {
	        		$('.alert-error').find('strong').html('请求数据失败，请联系技术人员');
	        		$('.alert-error').css('display','block')
	        		$('.alert-error').fadeOut(3000)
	        	}	

	        });

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
