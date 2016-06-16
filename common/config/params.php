<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,

    //微信appid
    'appid' => 'wxce8bdf437aaefbc6',

    //微信AppSecret
    'secret' => '278da00d4b7a53e73e6fa928fc39409f',

    //获取微信token
    'tokenpath' => 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=',

    //微信生成自定义菜单
    'wxmenupath' => 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=',

    //创建微信二维码ticket
    'ticketpath' => 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=',

    //获取微信带参数二维码
    'qrcodepath' => 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=',

    //获取微信基本用户信息
    'userinfopath' => 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=',

    //微信长链接转短连接
    'shortUrlpath' => 'https://api.weixin.qq.com/cgi-bin/shorturl?access_token=',

    //微信授权网页获取code
    'codepath' => 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=',
    
    //获取微信授权网页 Accesstoken
    'webaccesstokenpath' => 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=',

    //刷新微信授权网页 Accesstoken
    'refreshtokenpath' => 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=',
    
    //判断网页access_token 是否有效
    'ifaccesstokenpath' => 'https://api.weixin.qq.com/sns/auth?access_token=',
    
    //微信授权网页获取用户基本信息
    'webuserinfopath' => 'https://api.weixin.qq.com/sns/userinfo?access_token=',
];
