<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:34:"./static/index\replace_rolues.html";i:1510387404;s:24:"./static/index\base.html";i:1508923826;s:23:"./static/index\top.html";i:1508923826;s:23:"./static/index\nav.html";i:1508923826;s:26:"./static/index\footer.html";i:1508923826;}*/ ?>
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
        <li>
            <i class="icon-edit"></i>
            <a href="JavaScript:void(0);"><?php echo $title; ?></a>
        </li>
    </ul>
    <div class="row-fluid">
        <!--<form class="box span12">-->
            <div class="box-content">
                <div class="alert alert-success" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong></strong>
                </div>
                <div class="alert alert-error" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong></strong>
                </div>
                <form class="url" method="POST" action=""   enctype="multipart/form-data">
                    <fieldset>
                        <div class="controls file" style="float: left;margin-left: 10px;">
                            <input type="file" name="url"  >
                        </div>
                        <a class="btn resour btn-primary upload"  style="padding: 3px 12px;margin-left: 6px;">上传</a>
                        <a class="btn" style="padding: 3px 12px;margin-left: 6px;">预览</a>
            </div>

                </fieldset>
                </form>

                <!--主题表单-->
                <form class="form-horizontal subject " method="POST" action=""   enctype="multipart/form-data">
                <fieldset>
                    <div class="box-header" data-original-title>
                        <h2><i class="halflings-icon white edit"></i><span class="break"></span>主题内容</h2>
                    </div>

                    <div class="control-group" style="border-bottom:1px solid #eee">
                        <label class="control-label">特征标签：</label>
                        <div class="controls">
                            <input type="file" name="feature">
                            <a class="btn features btn-primary upload"  style="padding: 3px 12px;margin-left: 6px;">上传</a>
                            <span class="help-inline">请在原来的基础上增加(上传格式TXT)</span>
                        </div>
                    </div>

                    <div class="control-group" style="border-bottom:1px solid #eee">
                        <label class="control-label"  >标题:</label>
                        <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                            <input type="text" placeholder="输入标题标签" value="<?php echo $subject_list['title']; ?>" name="title">
                        </div>
                        <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                        <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                            <input type="text" placeholder="输入自定义标签例：{\:article_title}" value="<?php echo $subject_list['replace_title']; ?>" name="replace_title">
                        </div>
                        <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                        <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                            <input type="text" placeholder="只能输入数字" value="<?php echo $subject_list['replace_title_num']; ?>" name="replace_title_num">
                        </div>
                    </div>
                    <div class="control-group" style="border-bottom:1px solid #eee">
                        <label class="control-label"  >文本内容:</label>
                        <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                            <input type="text" placeholder="输入文本内容标签" value="<?php echo $subject['content']; ?>" name="content">
                        </div>
                        <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                        <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                            <input type="text" placeholder="输入自定义标签例：{\:dd_assureText}" value="<?php echo $subject_list['replace_content']; ?>" name="replace_content">
                        </div>
                        <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                        <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                            <input type="text" placeholder="只能输入数字" value="<?php echo $subject_list['replace_content_num']; ?>" name="replace_content_num">
                        </div>
                    </div>
                    <div class="control-group" style="border-bottom:1px solid #eee">
                        <label class="control-label"  >图片标签(SRC替换):</label>
                        <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                            <input type="text" placeholder="输入图片SRC标签"  readonly  value="<?php echo $subject_list['img_src']; ?>" name="img_src">
                        </div>
                        <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                        <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                            <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $subject_list['replace_img_src']; ?>" name="replace_img_src">
                        </div>
                        <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                        <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                            <input type="text" placeholder="只能输入数字" value="<?php echo $subject_list['replace_img_src_num']; ?>" name="replace_img_src_num">
                        </div>
                    </div>
                    <div class="control-group" style="border-bottom:1px solid #eee">
                        <label class="control-label"  >图片优化标签属性增加:</label>
                        <div class="controls">
                            <input type="text" style="width: 50%" placeholder='alt="自定义标签"      例： <img src="http://baidu.com"  alt="凤凰网资讯">' value="<?php echo $subject_list['img_property']; ?>" name="img_property">
                        </div>
                    </div>
                    <div class="control-group" style="border-bottom:1px solid #eee">
                        <label class="control-label">优化标签：</label>
                        <div class="controls">
                            <input type="file" name="tag_files">

                            <span class="help-inline">请在原来的基础上增加(上传格式TXT)</span>
                        </div>
                    </div>
                    <div class="form-actions" style="margin-bottom: 20px;">
                        <a type="submit" class="btn btn-primary subject_sub">Save</a>
                    </div>
                    </fieldset>
                    </form>
                <!--右侧表单-->
                <form class="form-horizontal right" method="POST" action=""   enctype="multipart/form-data">
                  <fieldset>
                    <div class="box-header" data-original-title>
                        <h2><i class="halflings-icon white edit"></i><span class="break"></span>右侧推荐</h2>
                    </div>
                    <div class="control-group" style="border-bottom:1px solid #eee;margin-top: 50px;">
                        <label class="control-label">特征标签：</label>
                        <div class="controls">
                            <input type="file" name="right_feature">
                            <a class="btn r_features btn-primary upload"  style="padding: 3px 12px;margin-left: 6px;">上传</a>
                            <span class="help-inline">请在原来的基础上增加(上传格式TXT)</span>
                        </div>
                    </div>
                    <div class="right">
                       <?php if(is_array($right_list) || $right_list instanceof \think\Collection || $right_list instanceof \think\Paginator): if( count($right_list)==0 ) : echo "" ;else: foreach($right_list as $key=>$vo): ?>
                        <div class="control-group" style="border-bottom:1px solid #eee;">
                            <label class="control-label">模块：<?php echo $vo['model_flag']; ?></label>
                        </div>

                        <div class="control-group" style="border-bottom:1px solid #eee">
                            <label class="control-label"  >图片标签(SRC替换):</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="输入图片SRC标签" readonly  value="<?php echo $vo['right_img_src']; ?>" name="right_img_src[]">
                            </div>
                            <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_right_img_src']; ?>" name="replace_right_img_src[]">
                            </div>
                            <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_right_img_src_num']; ?>" name="replace_right_img_src_num[]">
                            </div>
                        </div>
                        <div class="control-group" style="border-bottom:1px solid #eee">
                            <label class="control-label"  >图片优化标签属性:</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="输入A标签标签属性" readonly  value="<?php echo $vo['right_img_title']; ?>" name="right_img_title[]">
                            </div>
                            <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_right_img_title']; ?>" name="replace_right_img_title[]">
                            </div>
                            <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_right_img_title_num']; ?>" name="replace_right_img_title_num[]">
                            </div>
                        </div>
                        <div class="control-group" style="border-bottom:1px solid #eee">
                            <label class="control-label"  ></label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="alt" readonly  value="<?php echo $vo['right_img_alt']; ?>" name="right_img_alt[]">
                            </div>
                            <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_right_img_alt']; ?>" name="replace_right_img_alt[]">
                            </div>
                            <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_right_img_alt_num']; ?>" name="replace_right_img_alt_num[]">
                            </div>
                        </div>
                        <div class="control-group" style="border-bottom:1px solid #eee">
                            <label class="control-label"  >A标签(href替换):</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="输入A标签(href替换)" readonly  value="<?php echo $vo['right_a_href']; ?>" name="right_a_href[]" >
                            </div>
                            <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_right_a_href']; ?>" name="replace_right_a_href[]">
                            </div>
                            <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_right_a_href_num']; ?>" name="replace_right_a_href_num[]">
                            </div>
                        </div>
                        <div class="control-group" style="border-bottom:1px solid #eee">
                            <label class="control-label"  >A标签内容替换标签：:</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_right_a_content']; ?>"  name="replace_right_a_content[]">
                            </div>
                            <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_right_a_content_num']; ?>" name="replace_right_a_content_num[]">
                            </div>
                        </div>
                        <div class="control-group" style="border-bottom:1px solid #eee">
                            <label class="control-label"  >优化标签属性:</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="输入A标签标签属性" readonly  value="<?php echo $vo['right_a_title']; ?>" name="right_a_title[]">
                            </div>
                            <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_right_a_title']; ?>" name="replace_right_a_title[]">
                            </div>
                            <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_right_a_title_num']; ?>" name="replace_right_a_title_num[]">
                            </div>
                        </div>
                        <div class="control-group" style="border-bottom:1px solid #eee">
                            <label class="control-label"  ></label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="输入A标签标签属性" readonly  value="<?php echo $vo['right_a_alt']; ?>" name="right_a_alt[]">
                            </div>
                            <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_right_a_alt']; ?>" name="replace_right_a_alt[]">
                            </div>
                            <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                            <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_right_a_alt_num']; ?>" name="replace_right_a_alt_num[]">
                            </div>
                        </div>
                    </div>
                      <?php endforeach; endif; else: echo "" ;endif; ?>
                    <div class="form-actions" style="margin-bottom: 20px;">
                        <a class="btn right_module" href="JavaScript:void(0);">添加</a>
                        <a type="submit" class="btn btn-primary right_sub">Save</a>
                    </div>
                </fieldset>
            </form>
                <!--左侧表单-->
                <form class="form-horizontal left" method="POST" action=""   enctype="multipart/form-data">
                    <fieldset>
                        <div class="box-header" data-original-title>
                            <h2><i class="halflings-icon white edit"></i><span class="break"></span>左侧推荐</h2>
                        </div>
                        <div class="control-group" style="border-bottom:1px solid #eee;margin-top: 50px;">
                            <label class="control-label">特征标签：</label>
                            <div class="controls">
                                <input type="file" name="left_feature">
                                <a class="btn l_features btn-primary upload"  style="padding: 3px 12px;margin-left: 6px;">上传</a>
                                <span class="help-inline">请在原来的基础上增加(上传格式TXT)</span>
                            </div>
                        </div>
                        <div class="left">
                            <?php if(is_array($left_list) || $left_list instanceof \think\Collection || $left_list instanceof \think\Paginator): if( count($left_list)==0 ) : echo "" ;else: foreach($left_list as $key=>$vo): ?>
                            <div class="control-group" style="border-bottom:1px solid #eee;">
                                <label class="control-label">模块<?php echo $vo['model_flag']; ?>：</label>
                            </div>

                            <div class="control-group" style="border-bottom:1px solid #eee">
                                <label class="control-label"  >图片标签(SRC替换):</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入图片SRC标签" readonly  value="<?php echo $vo['left_img_src']; ?>" name="left_img_src[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_left_img_src']; ?>" name="replace_left_img_src[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_left_img_src_num']; ?>" name="replace_left_img_src_num[]">
                                </div>
                            </div>
                            <div class="control-group" style="border-bottom:1px solid #eee">
                                <label class="control-label"  >图片优化标签属性:</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入A标签标签属性" readonly  value="<?php echo $vo['left_img_title']; ?>" name="left_img_title[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_left_img_title']; ?>" name="replace_left_img_title[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_left_img_title_num']; ?>" name="replace_left_img_title_num[]">
                                </div>
                            </div>
                            <div class="control-group" style="border-bottom:1px solid #eee">
                                <label class="control-label"  ></label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入A标签标签属性" readonly  value="<?php echo $vo['left_img_alt']; ?>" name="left_img_alt[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_left_img_alt']; ?>" name="replace_left_img_alt[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_left_img_alt_num']; ?>" name="replace_left_img_alt_num[]">
                                </div>
                            </div>
                            <div class="control-group" style="border-bottom:1px solid #eee">
                                <label class="control-label"  >A标签(href替换):</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入A标签(href替换)" readonly  value="<?php echo $vo['left_a_href']; ?>"  name="left_a_href[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_left_a_href']; ?>" name="replace_left_a_href[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_left_a_href_num']; ?>" name="replace_left_a_href_num[]">
                                </div>
                            </div>
                            <div class="control-group" style="border-bottom:1px solid #eee">
                                <label class="control-label"  >A标签内容替换标签：:</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_left_a_content']; ?>"  name="replace_left_a_content[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_left_a_content_num']; ?>" name="replace_left_a_content_num[]">
                                </div>
                            </div>
                            <div class="control-group" style="border-bottom:1px solid #eee">
                                <label class="control-label"  >优化标签属性:</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入A标签标签属性" readonly  value="<?php echo $vo['left_a_title']; ?>" name="left_a_title[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_left_a_title']; ?>" name="replace_left_a_title[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_left_a_title_num']; ?>" name="replace_left_a_title_num[]">
                                </div>
                            </div>
                            <div class="control-group" style="border-bottom:1px solid #eee">
                                <label class="control-label"  ></label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入A标签标签属性" readonly  value="<?php echo $vo['left_a_alt']; ?>" name="left_a_alt[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_left_a_alt']; ?>" name="replace_left_a_alt[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_left_a_alt_num']; ?>" name="replace_left_a_alt_num[]">
                                </div>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div class="form-actions" style="margin-bottom: 20px;">
                            <a class="btn left_module" href="JavaScript:void(0);">添加</a>
                            <a type="submit" class="btn btn-primary left_sub">Save</a>
                        </div>
                    </fieldset>
                </form>
                <!--底部表单-->
                <form class="form-horizontal foot" method="POST" action=""   enctype="multipart/form-data">
                    <fieldset>
                        <div class="box-header" data-original-title>
                            <h2><i class="halflings-icon white edit"></i><span class="break"></span>底部推荐</h2>
                        </div>
                        <div class="control-group" style="border-bottom:1px solid #eee;margin-top: 50px;">
                            <label class="control-label">特征标签：</label>
                            <div class="controls">
                                <input type="file" name="foot_feature">
                                <a class="btn f_features btn-primary upload"  style="padding: 3px 12px;margin-left: 6px;">上传</a>
                                <span class="help-inline">请在原来的基础上增加(上传格式TXT)</span>
                            </div>
                        </div>
                        <div class="footer">
                            <?php if(is_array($foot_list) || $foot_list instanceof \think\Collection || $foot_list instanceof \think\Paginator): if( count($foot_list)==0 ) : echo "" ;else: foreach($foot_list as $key=>$vo): ?>
                            <div class="control-group" style="border-bottom:1px solid #eee;">
                                <label class="control-label">模块<?php echo $vo['model_flag']; ?>：</label>
                            </div>
                            <div class="control-group" style="border-bottom:1px solid #eee">
                                <label class="control-label"  >图片标签(SRC替换):</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入图片SRC标签" readonly  value="<?php echo $vo['footer_img_src']; ?>" name="footer_img_src[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_footer_img_src']; ?>" name="replace_footer_img_src[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_footer_img_src_num']; ?>" name="replace_footer_img_src_num[]">
                                </div>
                            </div>
                            <div class="control-group" style="border-bottom:1px solid #eee">
                                <label class="control-label"  >图片优化标签属性:</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入A标签标签属性" readonly  value="<?php echo $vo['foot_img_title']; ?>" name="foot_img_title[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_foot_img_title']; ?>" name="replace_foot_img_title[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_foot_img_title_num']; ?>" name="replace_foot_img_title_num[]">
                                </div>
                            </div>
                            <div class="control-group" style="border-bottom:1px solid #eee">
                                <label class="control-label"  ></label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入A标签标签属性" readonly  value="<?php echo $vo['foot_img_alt']; ?>" name="foot_img_alt[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_foot_img_alt']; ?>" name="replace_foot_img_alt[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_foot_img_alt_num']; ?>" name="replace_foot_img_alt_num[]">
                                </div>
                            </div>
                            <div class="control-group" style="border-bottom:1px solid #eee">
                                <label class="control-label"  >A标签(href替换):</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入A标签(href替换)" readonly  value="<?php echo $vo['footer_a_href']; ?>" name="footer_a_href[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_footer_a_href']; ?>" name="replace_footer_a_href[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_footer_a_href_num']; ?>" name="replace_footer_a_href_num[]">
                                </div>
                            </div>
                            <div class="control-group" style="border-bottom:1px solid #eee">
                                <label class="control-label"  >A标签内容替换标签：:</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_footer_a_content']; ?>"  name="replace_footer_a_content[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_footer_a_content_num']; ?>" name="replace_footer_a_content_num[]">
                                </div>
                            </div>
                            <div class="control-group" style="border-bottom:1px solid #eee">
                                <label class="control-label"  >优化标签属性:</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入A标签标签属性" readonly  value="<?php echo $vo['footer_a_title']; ?>" name="footer_a_title[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_footer_a_title']; ?>" name="replace_footer_a_title[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_footer_a_title_num']; ?>" name="replace_footer_a_title_num[]">
                                </div>
                            </div>
                            <div class="control-group" style="border-bottom:1px solid #eee">
                                <label class="control-label"  ></label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入A标签标签属性" readonly  value="<?php echo $vo['footer_a_alt']; ?>" name="footer_a_alt[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="<?php echo $vo['replace_footer_a_alt']; ?>" name="replace_footer_a_alt[]">
                                </div>
                                <label class="control-label" style="float: left;margin-left: 50px;">个数：</label>
                                <div class="controls" style="width: 160px;float: left;margin-left: 16px;">
                                    <input type="text" placeholder="只能输入数字" value="<?php echo $vo['replace_footer_a_alt_num']; ?>" name="replace_footer_a_alt_num[]">
                                </div>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div class="form-actions" style="margin-bottom: 20px;">
                            <a class="btn footer_module" href="JavaScript:void(0);">添加</a>
                            <a type="submit" class="btn btn-primary foot_sub">Save</a>
                        </div>
                        <!--<div class="form-actions" style="margin-bottom: 20px;">-->
                        <!--<a type="submit" class="btn btn-primary sub">Save</a>-->
                        <!--</div>-->
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
<script src="__INDEX__js/jquery.form.js"></script>

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

<script src="__INDEX__js/replace_rolues.js"></script>
<script>
    $(function(){
        $('.right_module').click(function(){
            var indexs = 0;
            $('.right').each(function(index,evlemt){
                indexs = index;
            })
            var html = '<div class="right"><div class="control-group" style="border-bottom:1px solid #eee;">';
            html+='<label class="control-label">模块'+(indexs+2)+'(特征标识)：</label>';
            html+='<div class="controls">';
            html+='<input type="file" name="right_module[]">';
            html+='<span class="help-inline">请在原来的基础上增加(上传格式TXT)</span>';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  >图片标签(SRC替换):</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入图片SRC标签" readonly  value="img" name="right_img_src[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_right_img_src[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_right_img_src_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  >图片优化标签属性:</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入A标签标签属性" readonly  value="title" name="right_img_title[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_right_img_title[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_right_img_title_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  ></label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入A标签标签属性" readonly  value="alt" name="right_img_alt[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_right_img_alt[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_right_img_alt_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  >A标签(href替换):</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入A标签(href替换)" readonly  value="href" name="right_a_href[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_right_a_href[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_right_a_href_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  >A标签内容替换标签：:</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}"  name="replace_right_a_content[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_right_a_content_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  >优化标签属性:</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入A标签标签属性" readonly  value="title" name="right_a_title[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_right_a_title[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_right_a_title_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  ></label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入A标签标签属性" readonly  value="alt" name="right_a_alt[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_right_a_alt[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_right_a_alt_num[]">';
            html+='</div>';
            html+='</div></div>';
            $(this).parent('.form-actions').before(html);
        })
        $('.left_module').click(function(){
            var indexs = 0;
            $('.left').each(function(index,evlemt){
                indexs = index;
            })
            var html = '<div class="left">';
            html+='<div class="control-group" style="border-bottom:1px solid #eee;">';
            html+='<label class="control-label">模块'+(indexs+2)+'(特征标识)：</label>';
            html+='<div class="controls">';
            html+='<input type="file" name="left_module[]">';
            html+='<span class="help-inline">请在原来的基础上增加(上传格式TXT)</span>';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  >图片标签(SRC替换):</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入图片SRC标签" readonly  value="img" name="left_img_src[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_left_img_src[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_left_img_src_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  >图片优化标签属性:</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入A标签标签属性" readonly  value="title" name="left_img_title[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_left_img_title[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_left_img_title_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  ></label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入A标签标签属性" readonly  value="alt" name="left_img_alt[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+=' <div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_left_img_alt[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_left_img_alt_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  >A标签(href替换):</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入A标签(href替换)" readonly  value="href" name="left_a_href[]" >';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_left_a_href[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_left_a_href_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  >A标签内容替换标签：:</label>';
            html+='	<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}"  name="replace_left_a_content[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='	<input type="text" placeholder="只能输入数字" value="" name="replace_left_a_content_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  >优化标签属性:</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入A标签标签属性" readonly  value="title" name="left_a_title[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_left_a_title[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_left_a_title_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  ></label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入A标签标签属性" readonly  value="alt" name="left_a_alt[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_left_a_alt[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='	<input type="text" placeholder="只能输入数字" value="" name="replace_left_a_alt_num[]">';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            $(this).parent('.form-actions').before(html);
        })
        $('.footer_module').click(function(){
            var indexs = 0;
            $('.footer').each(function(index,evlemt){
                indexs = index;
            })
            var html = '<div class="footer">';
            html+='<div class="control-group" style="border-bottom:1px solid #eee;">';
            html+='<label class="control-label">模块'+(indexs+2)+'(特征标识)：</label>';
            html+='<div class="controls">';
            html+='<input type="file" name="footer_module[]">';
            html+='<span class="help-inline">请在原来的基础上增加(上传格式TXT)</span>';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  >图片标签(SRC替换):</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入图片SRC标签" readonly  value="img" name="footer_img_src[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_footer_img_src[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_footer_img_src_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  >图片优化标签属性:</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入A标签标签属性" readonly  value="title" name="foot_img_title[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_foot_img_title[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_foot_img_title_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  ></label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入A标签标签属性" readonly  value="alt" name="foot_img_alt[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_foot_img_alt[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_foot_img_alt_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  >A标签(href替换):</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入A标签(href替换)" readonly  value="href"  name="footer_a_href[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_footer_a_href[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_footer_a_href_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  >A标签内容替换标签：:</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}"  name="replace_footer_a_content[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_footer_a_content_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  >优化标签属性:</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入A标签标签属性" readonly  value="title" name="footer_a_title[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_footer_a_title[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_footer_a_title_num[]">';
            html+='</div>';
            html+='</div>';
            html+='<div class="control-group" style="border-bottom:1px solid #eee">';
            html+='<label class="control-label"  ></label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入A标签标签属性" readonly  value="alt" name="footer_a_alt[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">替换标签：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="输入自定义标签例：{\:dd_articleimg}" value="" name="replace_footer_a_alt[]">';
            html+='</div>';
            html+='<label class="control-label" style="float: left;margin-left: 50px;">个数：</label>';
            html+='<div class="controls" style="width: 160px;float: left;margin-left: 16px;">';
            html+='<input type="text" placeholder="只能输入数字" value="" name="replace_footer_a_alt_num[]">';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            $(this).parent('.form-actions').before(html);
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
