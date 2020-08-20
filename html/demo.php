<?php 

// $str = '2020-07-04 00:31:15';
// $php_date  = getdate($str);
// echo "<pre>";
// print_r($php_date);
// echo "<pre>";
// echo "before 14 days ago:".strtotime('-14 days');
// echo "<br/>";
// echo "now:".time();
// var_dump( bcadd(1.10, 2.22,2) );
// echo mb_strlen("渝C125D7");
// echo time();
// echo "<br/>";
// echo strtotime('+14 days');
// ini_set('display_errors', 0);
// echo $a;
// echo 0;
// date();
// echo 1;
// interface A{
// 	public function a();
// }

// /**
// * 
// */
// class B implements A
// {
	
// 	public function __construct()
// 	{
// 		# code...
// 	}
// 	public function a()
// 	{
// 		# code...
// 		echo "this is class B function a";
// 	}

// 	public function b()
// 	{
// 		# code...
// 		echo "this is class B function b";
// 	}
// }

// echo (new B())->b();

function curl_get($url){
 
   $header = array(
       'Accept: application/json',
    );
    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $url);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 0);
    // 超时设置,以秒为单位
    curl_setopt($curl, CURLOPT_TIMEOUT, 1);
 
    // 超时设置，以毫秒为单位
    // curl_setopt($curl, CURLOPT_TIMEOUT_MS, 500);
 
    // 设置请求头
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    //执行命令
    $data = curl_exec($curl);
 
    // 显示错误信息
    if (curl_error($curl)) {
        print "Error: " . curl_error($curl);
    } else {
        // 打印返回的内容
        var_dump($data);
        curl_close($curl);
    }
}
curl_get('http://api.sopei.cn/api/openservice/v1.0/partskus/vincode?brand_category_code=car_battery_part&ten_brand_flag=156560086716df83&vin_code=LVZA42F96EC526816');