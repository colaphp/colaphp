<!DOCTYPE html>
<html lang="zh-Hans">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $page_title ?? '' }}会员中心</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ skin('css/common.css') }}">
    <link rel="stylesheet" href="{{ skin('css/login.css') }}">
</head>
<body>
<div class="m-login-header">
    <div class="m-header-content g-wrapper">
        <a href="/" class="header-item">
            <img src="{{ skin('img/login/login_logo.png') }}">
        </a>
        <div class="header-item theme">欢迎登录</div>
        <div class="login-header-right">
            <a href="javascript:void 0;" class="zhiCustomBtn">点击咨询</a>
            <img src="{{ skin('img/login/tel@2x.png') }}">
        </div>
    </div>
</div>

<div class="m-login-contain business">
    <div class="g-wrapper g-clearfix">
        <div class="m-login-panel ">
            <div class="qr-tip" clstag="h|keycount|pc_login_1630638727960|change_qr_code">扫码登录更便捷</div>
            <a class="qr-code"></a>
            <div class="pc-login-wrap">
                <div class="header">
                    <span class="J_ht active" data-cname="J_personUrl">个人登录</span>
                </div>
                <div class="iframe-wrap">
                    <div class="J_personUrl m-login-iframe active">
                    </div>
                    <a class="register" href="/register">免费注册</a>
                </div>
                <div class="bottom-tip b-tip">
                    提示：请使用用户名+密码登录
                </div>
                <div class="bottom-tip c-tip hide">
                    提示：请使用用户名+密码登录
                </div>
            </div>
            <div class="qr-login-wrap hide">
                <div class="header" style="padding-bottom: 20px;">
                    App扫码，安全登录
                </div>
                <div class="scan-wrap">
                    <div class="scan-code">
                        <img id="jdQR" src="">
                        <div class="out-time hide">
                            <p>二维码已失效</p>
                            <div class="refresh">刷新</div>
                        </div>
                    </div>
                    <div class="scan-tip">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAARGVYSWZNTQAqAAAACAABh2kABAAAAAEAAAAaAAAAAAADoAEAAwAAAAEAAQAAoAIABAAAAAEAAADAoAMABAAAAAEAAADAAAAAAE07OcoAAAPBSURBVHic7Z1dcqMwDMclaEgmxZ32Gj1J7kCP19whJ+k1OlOgD3xY+xCy29lJ2tqRkR30m+EtOLL/BlsWshEAEBQxMmkDlo4KIIwKIIwKIIwKIIwKIIwKIIwKIMydxz2hHTcKXH5U9iO4G7SoBvLAyX5XAXC325XGmCCNVNc1HQ6HBsI1UnT2/1YABABbVdXDOI5vAGAAgIiIpSKISNN/1HmeP+/3+w84jk9cQkRrv9MY0HUdZln2lOf5logAka8jISKM43jXdV2wV1CM9jsPwojY0wTwva/pWDT2TOVdJDb7nQUgIsR/XYeztyLXK+E7YrNf/QBhfPyAn/AZOAng72AWlOk/TpdXEYzm8AuAfiMbIiJYa1fc9vwPEa2yLPPxf073s9rDLQARUUOOViIiTe/muiiKYE9BURQ0juO7tXYAj2no1LlKYHwKuAQgRERrbdN13fN2u/1omiZzbcwvjgwCrzNGAID7/b7Z7XbPro5Y13VYlqX9/Px8KIriLcsywzWLYn8C7u/v319fX9srygg5E6LD4fDhe/PLy8vY9z3rE8o+BtR1vYJjI/p6sqEHYp+ZHwKAret6tdlsWI1hF2B67Vw70wiJr00UYnxSP0AYFUAYFUAYFUAYFUAYn+XoczOc2dZypOGuv89y9Lm1lNnWcqThrr+TAJfWUuZay5EmRP1Zg/IzBNWlYa9/iM9Sbj3hg7X+PgL89Ptb7f0nWOvvHZhQeFA/QBgVQBgVQBgVQBgVQJgY8wNSJ/n8gNRJNz8gdZLND0idm8gPSJ3U8wNS5ybyA1JH8wNShCsmvHTEY8JLRzYmvHSiiQkvnVhiwktHPCa8dDQmnBLqBwijAgijAgijAgijAggTIiZ8636C+KeJ+nHu98jFhPXzdKGY8Ax7vkkTrP5sMeE59nyTJkT9uWLCs+35Jg13/Z2nodNjd/ZaQnyAu/7qBwijAgijAgijAgijAgjDLsA0D77mCo23bSF8HPYty4wxPRznxaNnEaFFsL43GmP6vud1dbgFwLZtn6qqyq/ctjLk+QHGd9vKtm0fiqJg7SBcAuDkmpfr9fptGAZy2V3wtJby+PhYV1UV8vwA45PfsNlsYBgGWK/XCADltC8tixDsTwAiGp+8gVTOD4h962Jw3bb4dBvMtJbEkN8Q5SvoK74Gpn5+gBfqBwgTS35ASucHnCP5/IBkzg+4QNr5AamcH3CJm8kP0IPcfkdURwF6EJX9MeYHRNVAHmh+QEqoHyCMCiCMCiCMCiCMCiCMCiCMCiCMCiDMH+AZv65LhWLzAAAAAElFTkSuQmCC"
                            style="width: 48px;height: 48px;">
                        <div class="stp">打开手机<span style="color: #E1251B">App</span>扫描二维码</div>
                    </div>
                </div>
                <div class="scan-success hide">
                    <div class="success-icon"></div>
                    <div class="st1">扫描成功</div>
                    <div class="st2">请勿刷新本页面，按手机提示操作。</div>
                </div>
                <div class="bottom-btn">
                    <a class="vbtn btn-pclogin" style="margin-right: 38px;cursor: pointer;"
                       clstag="h|keycount|pc_login_1630638727960|pwd_login">密码登录</a>
                    <a class="vbtn a-register" href="/register"
                       clstag="h|keycount|pc_login_1630638727960|register">免费注册</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="m-aside-tool pms-common-container" module=fixed-aside>
    <div class=m-aside-tool-wrap>
        <div class=aside-body>
            <div class=tool-list><a id=user href=/buyer/order class="tool-btn loginSt" alt=我的
                                    data-t1=right_shortcut_menu data-t2=click data-v1=我的 data-v2=/buyer/order
                                    clickfunc=clickLog>
                    <div class=icon><img src="{{ skin('img/aside/float_user.png') }}"></div>
                    <p class=name>我的</p></a><a class="tool-btn show-btn-collection unloginSt" alt=登录 id=aside_login
                                               href=/login data-t1=right_shortcut_menu data-t2=click data-v1=登录
                                               data-v2=/login clickfunc=clickLog>
                    <div class=icon><img src="{{ skin('img/aside/float_user.png') }}"></div>
                    <p class=name>登录</p>
                    <div class=show-collection>登录</div>
                </a><a class="tool-btn show-btn-collection unloginSt" alt=注册 id=aside_register href=/register
                       data-t1=right_shortcut_menu data-t2=click data-v1=注册 data-v2=/register clickfunc=clickLog>
                    <div class=icon><img src="{{ skin('img/aside/float_register.png') }}"></div>
                    <p class=name>注册</p>
                    <div class=show-collection>注册</div>
                </a><a id=asideConsult
                       href="https://wpa.b.qq.com/cgi/wpa.php?ln=1&key=DAwMT"
                       target=_blank class=tool-btn alt=咨询 data-t1=right_shortcut_menu data-t2=click data-v1=咨询
                       data-v2="https://wpa.b.qq.com/cgi/wpa.php?ln=1&key=DAwMT"
                       clickfunc=clickLog>
                    <div class=icon><img src="{{ skin('img/aside/float_consult.png') }}"></div>
                    <p class=name>咨询</p></a><a href=/shopcart class="tool-btn loginSt" alt=购物车
                                               data-t1=right_shortcut_menu data-t2=click data-v1=购物车 data-v2=/shopcart
                                               clickfunc=clickLog id=shopcart>
                    <div class=icon><img src="{{ skin('img/aside/float_shopcart.png') }}"></div>
                    <p class=name>购<br>物<br>车</p>
                    <div class=sign id=CartNum>0</div>
                </a><a href=/buyer/saleCoupon class="tool-btn loginSt" alt=优惠券 data-t1=right_shortcut_menu data-t2=click
                       data-v1=优惠券 data-v2=/buyer/saleCoupon clickfunc=clickLog id=coupon>
                    <div class=icon><img src="{{ skin('img/aside/float_coupon.png') }}"></div>
                    <p class=name>优<br>惠<br>券</p>
                    <div class=sign id=couponSign>0</div>
                </a><a href=/buyer/likestore class="tool-btn show-btn-collection" alt=我的收藏 data-t1=right_shortcut_menu
                       data-t2=click data-v1=我的收藏 data-v2=/buyer/likestore clickfunc=clickLog>
                    <div class=icon><img src="{{ skin('img/aside/float_collection.png') }}"></div>
                    <div class=show-collection>我的收藏</div>
                </a><a href="javascript:void 0;" class="tool-btn show-btn-side">
                    <div class=icon><img src="{{ skin('img/aside/float_qrcode.png') }}"></div>
                    <div class=show-content><img src="{{ skin('img/aside/wxQrCode.png') }}">
                    </div>
                </a></div>
        </div>
        <div class=aside-bottom>
            <div class=tool-list><a href=# class="tool-btn show-btn-collection" alt=回顶部 data-t1=right_shortcut_menu
                                    data-t2=click data-v1=回到顶部 data-v2="" clickfunc=clickLog>
                    <div class=icon><img src="{{ skin('img/aside/float_top.png') }}"></div>
                    <p class=name>顶部</p>
                    <div class=show-collection>回到顶部</div>
                </a></div>
        </div>
    </div>
</div>
<div class="m-footer pms-common-container" module=menu-footer>
    <div class="footer-menu g-wrapper g-clearfix">
        <ul class="menu-list g-clearfix">
            <li class=menu-item><a href=/help/shopstep class=menu-title target=_blank>购物指南</a>
                <div class=sub-list><a href=/help/shopstep target=_blank>购物流程 </a><a href=/register
                                                                                     target=_blank>免费注册 </a><a
                        href=/help/bill target=_blank>发票须知 </a><a href=/help/pays target=_blank>支付方式 </a><a
                        href=/help/cproblem target=_blank>常见问题</a></div>
            </li>
            <li class=menu-item><a href=/help/explans class=menu-title target=_blank>配送政策</a>
                <div class=sub-list><a href=/help/explans target=_blank>配送说明 </a><a href=/help/notice
                                                                                    target=_blank>配送须知 </a><a
                        href=/help/sign target=_blank>验货签收 </a><a href=/help/answer target=_blank>配送答疑</a></div>
            </li>
            <li class=menu-item><a href=/help/range class=menu-title target=_blank>售后服务</a>
                <div class=sub-list><a href=/help/range target=_blank>退换货范围 </a><a href=/help/rule
                                                                                   target=_blank>退换货细则</a> <a
                        href=/help/refundment target=_blank>退款说明</a> <a href=/help/way target=_blank>售后流程</a></div>
            </li>
            <li class=menu-item><a href=/help/introduce class=menu-title target=_blank>关于我们</a>
                <div class=sub-list><a href=/help/introduce target=_blank>公司介绍</a></div>
            </li>
        </ul>
        <div class=footer-contact><p class=menu-title>客服服务</p>
            <div class="item contact"><p class=tit>400-049-0000</p>
                <p>传真 0512-62960000</p></div>
            <div class="item worktime"><p class=tit>工作时间</p>
                <p>周一到周六 9:00-18:00</p></div>
        </div>
        <div class=footer-qrcode>
            <p class=menu-title>扫码下载客户端</p>
            <a class=img-box target=_blank>
                <img src={{ skin('img/appQrCode.jpg') }}"></a>
        </div>
    </div>
</div>
<div class="m-bottom pms-common-container">
    <div class="footer-feature g-wrapper">
        <div class=feature-item><img src="{{ skin('img/footer01.png') }}" class=icon></div>
        <div class=feature-item><img src="{{ skin('img/footer02.png') }}" class=icon></div>
        <div class=feature-item><img src="{{ skin('img/footer03.png') }}" class=icon></div>
        <div class=feature-item><img src="{{ skin('img/footer04.png') }}" class=icon></div>
    </div>
    <div class=g-wrapper>
        <div class=bottom-info>
            Copyright &copy; 2022 <a href=/ target=_blank>xxx科技有限公司</a> 版权所有.
            <a target=_blank href=/sitemap>网站地图</a>
        </div>
        <div class=bottom-cert>
            <a href="#" target=_blank><img src="{{ skin('img/cert.png') }}"> </a>
            <a href="#" class=ebs><img src="{{ skin('img/icon_ebs.png') }}"></a>
        </div>
    </div>
</div>
</body>
</html>
