<?php
	function captcha_create($count=4){
		$code='';
		$charset='QWERTYUIOPASDFGHJKLZXCVBNM';
		for($i=0;$i<$count;$i++)
		{
			$code.=$charset[rand(0,strlen($charset)-1)];
			
		}
		return $code;
	}
	
 	
	function captcha_show($code){
		$img=imagecreate(200, 60);
		imagecolorallocate($img, rand(50, 200), rand(0,100), rand(50, 200));
		$fontcolor=imagecolorallocate($img, 255,255, 255);
		$fontstyle="./myttf.TTF";
		for($i=0;$i<4;$i++){
			imagettftext($img,
			 25,//字体大小
			 rand(10,40),//角度 
			 10+$i*35, 
			 rand(30, 40),
			 $fontcolor,
			 $fontstyle,
			 $code[$i]);
		}
		//绘制干扰线
		for($i=0;$i<8;$i++){
		$linecolor=imagecolorallocate($img, 178, 200, 255);
		imageline($img, rand(50, 100), 0,rand(0, 255), 50,$linecolor);
		}
		//干扰线
		for($i=0;$i<80;$i++){
		$pixelcolor=imagecolorallocate($img, 178, 200, 255);
		imagesetpixel($img,rand(0, 200), rand(0, 50), $pixelcolor);
		}
		//设置验证码图片格式
		header('content-type:image/png');
		imagepng($img);
	}
	$code=captcha_create();
	session_start();
	$_SESSION['captcha']=$code;
	captcha_show($code)
	?>