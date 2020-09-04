<?php

return [

    //模板参数替换
    'view_replace_str'       => array(
        '__ACSS__'    => '/public/static/admin/css',
        '__AJS__'     => '/public/static/admin/js',
        '__AIMG__' => '/public/static/admin/img',
        '__ICSS__' => '/public/static/index/css',
        '__IJS__' => '/public/static/index/js',
        '__IIMG__' => '/public/static/index/image',
   ),
    "user_status" => array(
        0 => '禁用',
        1 => '可用'
        
    ),
    "user_leave"=>array(
        1=>'在职',
        2=>'离职'
    ),
    "type"=>array(
        1=>'周报',
        2=>'月报'
    ),
    //时间格式模板，false不自动转换时间格式
    'datetime_format'=>false,
    
    "is_check"=>array(         //员工请假审核状态  0待审核，1审核通过，2审核失败
        0=>'待审核',
        1=>'审核通过',
        2=>'审核未通过'     )
];


?>
