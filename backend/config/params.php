<?php
return [
    'appid' => 'wxce8bdf437aaefbc6',
    'secret' => '278da00d4b7a53e73e6fa928fc39409f',
    'uploadPath' => getcwd().'/uploads/',
    'picPath' => 'http://7ac53ba4.ngrok.io/uploads/',//$_SERVER['SERVER_NAME'].
    //获取微信token
    'tokenpath' => 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=',
    //生成自定义菜单
    'wxmenupath' => 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=',
    //添加微信客服
    'addcustomservice' => 'https://api.weixin.qq.com/customservice/kfaccount/add?access_token=',
    //修改微信客服
    'updcustomservice' => 'https://api.weixin.qq.com/customservice/kfaccount/update?access_token=ACCESS_TOKEN',
    //删除微信客服
    'delcustomservice' => 'https://api.weixin.qq.com/customservice/kfaccount/del?access_token=ACCESS_TOKEN',
    //获取所有微信客服账号
    'getcustomservice' => 'https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token=ACCESS_TOKEN',
];
