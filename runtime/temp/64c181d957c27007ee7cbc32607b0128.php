<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:25:"./static/index\login.html";i:1508923826;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>ASO优化管理系统--登录</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Brooks">
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
	
			<style type="text/css">
			body { background: url(__INDEX__img/bg-login.jpg) !important; }
		</style>
		
		
		
</head>

<body>
		<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<!-- <a href="index.html"><i class="halflings-icon home"></i></a>
						<a href="#"><i class="halflings-icon cog"></i></a> -->
					</div>
					<h2>登录</h2>
					<form class="form-horizontal">
						<fieldset>
							
							<div class="input-prepend" title="用户名">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input class="input-large span10" name="username" id="username" type="text" placeholder="用户名"/>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="密码">
								<span class="add-on"><i class="halflings-icon lock"></i></span>
								<input class="input-large span10" name="password" id="password" type="password" placeholder="密码"/>
							</div>
							<div class="clearfix"></div>
							
							<!-- <label class="remember" for="remember"><input type="checkbox" id="remember" />记住密码</label> -->

							<div class="button-login">	
								<button type="button" class="btn btn-primary">Login</button>
							</div>
							<div class="clearfix"></div>
					</form>
				</div><!--/span-->
			</div><!--/row-->
			

	</div><!--/.fluid-container-->
	
		</div><!--/fluid-row-->

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
		<script type="text/javascript">
		function Login()
		{
			var username = $('#username').val();
				var password = $('#password').val();
				if (username=='') 
				{
					alert('请输入用户名！');
					return false;
				}
				if (password=='') 
				{
					alert('请输入密码！');
					return false;
				}

				$.ajax({    
                  	type: 'POST',    
                  	url: "<?php echo url('index/index/index'); ?>",
                  	dataType:"json",    
                	data:{
						"username":username,
						"password":password
						},
					success:function(data)
					{
			        	if(data.status==0)
			        	{
			        		
			        		window.location.href=data.url;
			        	}else
			        	{
			        		alert(data.message);
			        	}    
			        }	

				});

		}	
		$(function(){

			$('.btn-primary').click(function(){
				Login();
			})
			document.onkeydown = function(e){
		    var ev = document.all ? window.event : e;
		    if(ev.keyCode==13) {
		    	Login();
		     }
			}
		})
		</script>
	<!-- end: JavaScript-->
	
</body>
</html>
