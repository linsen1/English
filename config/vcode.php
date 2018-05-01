<?php
/**
 * Created by PhpStorm.
 * User: linsen
 * Date: 2018/3/22
 * Time: 下午2:56
 */
return[
    'aliYiYun'=>[
        'AppKey'=>'24718248',
        'AppSecret'=>'edcd06839d66790f8a6aed596e852239',
        'AppCode'=>'2c6cdb80423b47f8928b8bbd4da7a4cb',
        'host'=>'http://ali-make-mark.showapi.com',
        'method'=>'GET',
        'path'=>'/make-mark-img',
        'querys'=>'border=yes&border_color=105%2C179%2C90&border_thickness=1&image_height=50&image_width=200&noise_color=black&obscurificator_impl=com.google.code.kaptcha.impl.WaterRipple&textproducer_char_length=5&textproducer_char_space=2&textproducer_char_string=abcde2345678gfynmnpwx&textproducer_font_color=black&textproducer_font_names=Arial%2C+Courier&textproducer_font_size=40'
    ],
    'txYun'=>[
        'COS_REGION'=>'ap-beijing',
        'AppID'=>'1252522393',
        'COS_KEY'=>'AKIDRgkZ8SXKsBD0XovQlriJflbCZgXKm31k',
        'COS_SecretKey'=>'e4E7mCLErELDoEPK9lBNK2ZswlLhogKk',
        'EnglishWX'=>'englishwechat'
    ],
    'alifile'=>[
        'accessKeyId'=>'LTAIbNCfgdtwAsAv',
        'accessKeySecret'=>'KjkKOo62e1u5z59BDoQbuxziopyqUf',
        'endpoint'=>'http://oss-cn-qingdao.aliyuncs.com',
        'bucket'=> "englishapp",
        'filesite'=>'https://alifile.weipinpai.wang/'
    ],
    'baiduTranslate'=>[
        'CURL_TIMEOUT'=>'10',
        'URL'=>'http://api.fanyi.baidu.com/api/trans/vip/translate',
        'APP_ID'=>'20171228000109947',
        'SEC_KEY'=>'XmTTt7ThLBHcuiaxGvWN'
    ],
    'baiduSpeech'=>[
        'speech_APP_ID'=>'10727556',
        'speech_API_KEY'=>'v7oCEgYO4wOQNIi7g1tRp1UC',
        'speech_SECRET_KEY'=>'oxDcTwrL1MmNGFzVLLtzxViz0Oi8ChUa'
    ]
];