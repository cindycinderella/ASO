<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:28:"./static/index\log_list.html";i:1510220444;s:24:"./static/index\base.html";i:1508923826;s:23:"./static/index\top.html";i:1508923826;s:23:"./static/index\nav.html";i:1508923826;s:26:"./static/index\footer.html";i:1508923826;}*/ ?>
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
			<div class="box-content alerts">
				<div class="alert alert-success" style="display: none;">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong></strong>
				</div>
				<div class="alert alert-error" style="display: none;">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong></strong>
				</div>
				<form class="form-horizontal" method="POST" action="<?php echo url('index/data/upload'); ?>" id="myupload"  enctype="multipart/form-data">
					<fieldset>
						<div class="control-group">
							<label class="control-label" style="width: 76px;" for="selectError">日志目录</label>
							<div class="controls" style="float: left;margin-left: 10px;margin-top: 2px;width: 140px;">
								<select id="selectError" name="file_name" data-rel="chosen">
									<option value="0">请选择文件夹</option>
									<?php if(is_array($path_list) || $path_list instanceof \think\Collection || $path_list instanceof \think\Paginator): if( count($path_list)==0 ) : echo "" ;else: foreach($path_list as $key=>$path): ?>
									<option value="<?php echo $path['id']; ?>"><?php echo $path['file_name']; ?></option>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</div>

							<label class="control-label" style="width: 56px;margin-left: 10px;" for="selectError">日志类型</label>
							<div class="controls" style="float: left;margin-left: 10px;margin-top: 2px;width: 140px;">
								<select id="selectErrors" name="type" data-rel="chosen">
									<option value="0">请选择日志类型</option>
									<option value="1">Apache</option>
									<option value="2">Ngnix</option>
									<option value="3">IIS</option>
								</select>
							</div>

							<div class="controls list" style="float: left;margin-left: 10px;">
								<input type="file" id="dialog" name="file_list[]" multiple webkitdirectory />
								<input type="hidden" name="list_name" value="" />
								<script>
									dialog.onchange = function(e) {
										var files = this.files;
										if (files.length>20)
										{
											$('.alert-error').find('strong').html("目录内的文件夹不能超过20个文件");
											$('.alert-error').css('display','block')
											$('.alert-error').fadeOut(3000)
											return false;
										}
										var f = files[0];
										$("input[name='list_name']").val(f.webkitRelativePath);
									};
								</script>								
							</div>
							<div class="controls file" style="float: left;margin-left: 10px; display: none;">
								<input type="file" name="file[]" multiple="" >
							</div>
							<a class="btn btn-primary upload" style="padding: 3px 12px;margin-left: 6px;">上传</a>
							<a class ="cursor" style="text-decoration:underline;cursor: pointer;margin-right: 200px;float: right; display: inline-block;height: 30px; line-height: 30px;">全选</a>
							<a class="btn btn-primary analysis" style="padding: 3px 12px;margin-right: 10px;float: right;">分析日志</a>

							<!-- 上传进图条 -->
							<div class="progress">
								<div class="progress-bar progress-bar-striped" ><span class="percent">0%</span></div>
							</div>							
						</div>

					</fieldset>
				</form>

				<table class="table table-striped">
					<thead>
						<tr>
							<th style="text-align: center;"><font><font>ID</font></font></th>	
							<th style="text-align: center;"><font><font>文件夹</font></font></th>
							<th style="text-align: center;"><font><font>个数</font></font></th>
							<th style="text-align: center;"><font><font>记录最新的一天</font></font></th>
							<th style="text-align: center;"><font><font>日志类型</font></font></th>
							<th style="text-align: center;"><font><font>存储路径</font></font></th>
							<th style="text-align: center;"><font><font>最后上传时间</font></font></th>
							<th style="text-align: center;"><font><font>状态</font></font></th>  									  
						</tr>
					</thead>   
					<tbody>
						<?php if(is_array($log_list) || $log_list instanceof \think\Collection || $log_list instanceof \think\Paginator): if( count($log_list)==0 ) : echo "" ;else: foreach($log_list as $key=>$vo): ?>
						<tr>
							<td style="text-align: center;"><?php if($vo['status'] == 0): ?><label class="checkbox inline">
								<input type="checkbox" class ="inlineCheckbox1" value="<?php echo $vo['id']; ?>"><?php endif; ?><?php echo $vo['id']; ?>
							</label></td>
							<td style="text-align: center;"><font><font><?php echo $vo['file_name']; ?></font></font></td>
							<td style="text-align: center;"><font><font><?php echo $vo['num']; ?></font></font></td>
							<td style="text-align: center;"><font><font><?php echo $vo['new_date']; ?></font></font></td>
							<td style="text-align: center;"><font><font><?php switch($vo['type']): case "1": ?>Apache<?php break; case "2": ?>Ngnix<?php break; case "3": ?>IIS<?php break; endswitch; ?></font></font></td>
							<td style="text-align: center;"><font><font><?php echo $vo['path']; ?></font></font></td>
							<td style="text-align: center;"><font><font><?php echo $vo['upload_date']; ?></font></font></td>
							<td style="text-align: center;"><?php if($vo['status'] == 1): ?> 
								<span style="cursor:pointer;" class="label label-success"><font><font>已分析</font></font></span>
								<?php else: ?>
								<span style="cursor:pointer;" class="label label-important"><font><font>未分析</font></font></span>
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
		$('.list .action').html('选择目录');
		$('.file .action').html('选择文件');
		$('#selectError_chzn').css('width','140px');
		$('#selectErrors_chzn').css('width','140px');

		$('#selectError').change(function(){

			var val = $(this).val();
			if (val==0)
			{
				$('.file').css('display','none');
				$('.list').css('display','block');	
			}else
			{
				$('.file').css('display','block');
				$('.list').css('display','none');
			}


		})
			//全选
			$('.cursor').click(function(){

				$('.inlineCheckbox1').each(function(index, element){
					$(this).attr('checked',"checked");
					$(this).parent('span').addClass('checked');
				})

				$("input[name='analysis_id']").val('all');
			})
			$('.inlineCheckbox1').change(function(){
				var checked ='';
				$('.inlineCheckbox1').each(function(index, element){
					if($(this).prop('checked')==true)
					{
						checked+=$(this).val()+'|';
					}
				})
				$("input[name='analysis_id']").val(checked);
			})
			var progress = $(".progress"); 
			var progress_bar = $(".progress-bar");
			var percent = $('.percent');

			$(document).on('click','.upload',function(){
				var type = $('#selectErrors').val();
				if (type==0)
				{
					$('.alert-error').find('strong').html("请选择日志类型");
					$('.alert-error').css('display','block')
					$('.alert-error').fadeOut(3000)
					return false;
				}
				var _this = $(this);
				$("#myupload").ajaxSubmit({     
					dataType:"json",    
                	beforeSend: function() { //开始上传 
                		progress.show();
                		var percentVal = '0%';
                		progress_bar.width(percentVal);
                		percent.html(percentVal);
                		_this.removeClass('upload');
                	},
                	uploadProgress: function(event, position, total, percentComplete) { 
			  			var percentVal = percentComplete + '%'; //获得进度 
			  			progress_bar.width(percentVal); //上传进度条宽度变宽 
			  			percent.html(percentVal); //显示上传进度百分比 
			  		}, 
			  		success:function(data)
			  		{
			  			_this.addClass('upload');
			  			progress.hide();
			  			if (data.status!=200)
			  			{
			  				$('.alert-error').find('strong').html(data.message);
			  				$('.alert-error').css('display','block')
			  				$('.alert-error').fadeOut(3000)			  				
			  				return false;
			  			}else
			  			{
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
			        	$('.alert-error').find('strong').html('上传失败');
			        	$('.alert-error').css('display','block')
			        	$('.alert-error').fadeOut(3000)
			        	progress.hide(); 
			        } 	

			    });


			})

			$('.analysis').click(function(){	
				var type = $('.analysis_id').val();
				if (type=='')
				{
					$('.alert-error').find('strong').html("请选择需要分析的日志");
					$('.alert-error').css('display','block')
					$('.alert-error').fadeOut(3000)
					return false;
				}
				var _this =$(this);		
				//$("#analysis").submit();	
				$("#analysis").ajaxSubmit({     
					dataType:"json",    
                	beforeSend: function() { //开始上传 
                		progress.show();
                		var percentVal = '0%';
                		progress_bar.width(percentVal);
                		percent.html(percentVal);
                		_this.html('分析中');
                		_this.removeClass('btn-primary');
                		_this.unbind('click');
                	},
                	uploadProgress: function(event, position, total, percentComplete) {
			  			var percentVal = percentComplete + '%'; //获得进度 
			  			progress_bar.width(percentVal); //上传进度条宽度变宽 
			  			percent.html(percentVal); //显示上传进度百分比 
			  		}, 
			  		success:function(data)
			  		{
			  			_this.html('分析日志');
			  			_this.addClass('btn-primary');
			  			_this.bind('click');
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
			  				$('.alert-success').fadeOut(3000)
			        	 	setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
							window.location.reload();//页面刷新
						},3000); 
			        	 }
			        	},
			        error:function(xhr){ //上传失败 
			        	$('.alert-error').find('strong').html("分析失败,请联系技术人员");
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
