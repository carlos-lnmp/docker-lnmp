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

// function curl_get($url){
 
//    $header = array(
//        'Accept: application/json',
//     );
//     $curl = curl_init();
//     //设置抓取的url
//     curl_setopt($curl, CURLOPT_URL, $url);
//     //设置头文件的信息作为数据流输出
//     curl_setopt($curl, CURLOPT_HEADER, 0);
//     // 超时设置,以秒为单位
//     curl_setopt($curl, CURLOPT_TIMEOUT, 1);
 
//     // 超时设置，以毫秒为单位
//     // curl_setopt($curl, CURLOPT_TIMEOUT_MS, 500);
 
//     // 设置请求头
//     curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
//     //设置获取的信息以文件流的形式返回，而不是直接输出。
//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//     curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
//     //执行命令
//     $data = curl_exec($curl);
 
//     // 显示错误信息
//     if (curl_error($curl)) {
//         print "Error: " . curl_error($curl);
//     } else {
//         // 打印返回的内容
//         var_dump($data);
//         curl_close($curl);
//     }
// }
// curl_get('http://api.sopei.cn/api/openservice/v1.0/partskus/vincode?brand_category_code=car_battery_part&ten_brand_flag=156560086716df83&vin_code=LVZA42F96EC526816');
// echo '运行前内存：'.round(memory_get_usage()/1024/1024, 2).'MB', '<br/>';
// $hit = 23;
// echo "设置概率{$hit}%<br/>循环10000次后实际概率为：<br/>";
// $hit = $hit * 100;
// $arr = [];
// $z = 0;
// for ($i=0; $i < 10000; $i++) { 
//     # code...
//     $n = mt_rand(1,10000);
//     if (1<= $n && $n <= $hit) {
//         # code...
//         array_push($arr, 1); //中
//         $z++;
//     }else{
//         array_push($arr, 2);
//     }
// }
// $count = count($arr);
// echo (round($z/$count,2)*100).'%<br/>';
// echo '运行后内存：'.round(memory_get_usage()/1024/1024, 2).'MB', '';

// $arr = [
// 	"status"=>1,
// 	"orderno"=>"TF202009071103559578AM",
// 	"money"=>4900,
// 	"merorderno"=>"xwx_order_47",
// 	"time"=>time(),
// ];
// $arr['sign'] = md5("mhzf342".$arr['orderno'].$arr['money'].$arr['merorderno'].$arr['time']."arcoIJzQvB79mIirzAxrhHy2yYAaW1gL");

// echo json_encode($arr);

// echo date("Y-m-d",strtotime("+31 days",strtotime("2020-02-28")));
// $str = "抽奖好看";
// echo mb_substr($str, 0, 3);
function getChar($num, $str = '')  // $num为生成汉字的数量
{
    $num = intval($num);
    $str = trim($str);
    $l = iconv_strlen($str);
    if ($l > 1) {
        # code...
        $num = ($num - $l) + 1;
    }
    $b = '';
    $r = rand(0,($num - 1));
    for ($i=0; $i<$num; $i++) {
        // 使用chr()函数拼接双字节汉字，前一个chr()为高位字节，后一个为低位字节
        if ($r === $i) {
        	# code...
        	$b .= $str;
        }else {
	        $a = chr(mt_rand(0xB0,0xD0)).chr(mt_rand(0xA1, 0xF0));
        	$b .= iconv('GB2312', 'UTF-8', $a);
        }
        // 转码
    }
    echo "num:{$num};r:{$r};<br/>";
    return $b;
}


// for ($i=0; $i < 200; $i++) { 
// 	# code...
//     echo getChar(4,'安新').'<br/>';
// }
// echo mt_rand(0xA1,0xF9).'<br/>';
// echo floatval('0.1321313');
// echo mb_strlen("多福多寿");

// $n = bcdiv('6','100',2);
// $n = ceil(floatval('0.32'));
// var_dump($n);

$arr = [];

if (isset($arr['is']) && $arr['is'] !== null) {
    # code...
    echo "isset arr['is']";
}else{
    echo "empty arr['is']";
}