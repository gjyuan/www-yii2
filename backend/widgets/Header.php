<?php
namespace backend\widgets;
use yii\base\Widget;
use Yii;

class Header extends Widget{
    public $__USER_INFO;
    public function run(){
        $messageHtml = $this->getMessageHtml();
        $logo = Yii::$app->fe->feroot('image/logo.png');
        $userHtml = $this->getUserHtml();
        $headerHtml = '<div class="page-header navbar navbar-fixed-top">
                        <div class="page-header-inner ">
                            <div class="page-logo">
                                <a href="index.html"><img src="'.$logo.'" alt="logo" class="logo-default" /> </a>
                                <div class="menu-toggler sidebar-toggler"><span></span></div>
                            </div>
                            <a href="javascript:void(0);" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"><span></span></a>
                            <div class="top-menu">
                                <ul class="nav navbar-nav pull-right">
                                    '.$messageHtml.'
                                    '.$userHtml.'
                                    <li class="dropdown dropdown-quick-sidebar-toggler">
                                        <a href="javascript:void(0);" class="dropdown-toggle">
                                            <i class="icon-logout"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>';
        echo $headerHtml;
    }
    public function getMessageHtml(){
        $html = ' <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-default"> 7 </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>
                                    <span class="bold">12 pending</span> notifications</h3>
                                <a href="page_user_profile_1.html">view all</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">just now</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-success"><i class="fa fa-plus"></i></span> New user registered.
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">3 mins</span>
                                                <span class="details">
                                                    <span class="label label-sm label-icon label-danger"><i class="fa fa-bolt"></i></span> Server #12 overloaded.
                                                </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">10 mins</span>
                                                <span class="details">
                                                    <span class="label label-sm label-icon label-warning">
                                                        <i class="fa fa-bell-o"></i>
                                                    </span> Server #2 not responding. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">14 hrs</span>
                                                <span class="details">
                                                    <span class="label label-sm label-icon label-info">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </span> Application error. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">2 days</span>
                                                <span class="details">
                                                    <span class="label label-sm label-icon label-danger">
                                                        <i class="fa fa-bolt"></i>
                                                    </span> Database overloaded 68%. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">3 days</span>
                                                <span class="details">
                                                    <span class="label label-sm label-icon label-danger">
                                                        <i class="fa fa-bolt"></i>
                                                    </span> A user IP blocked. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">4 days</span>
                                                <span class="details">
                                                    <span class="label label-sm label-icon label-warning">
                                                        <i class="fa fa-bell-o"></i>
                                                    </span> Storage Server #4 not responding dfdfdfd. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">5 days</span>
                                                <span class="details">
                                                    <span class="label label-sm label-icon label-info">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </span> System Error. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">9 days</span>
                                                <span class="details">
                                                    <span class="label label-sm label-icon label-danger">
                                                        <i class="fa fa-bolt"></i>
                                                    </span> Storage server failed. </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>';
        return $html;
    }
    private function getUserHtml(){
        $avatar = isset($this->__USER_INFO['avatar']) ? $this->__USER_INFO['avatar'] : Yii::$app->fe->feroot('image/avatar.png');
        $userName = isset($this->__USER_INFO['name']) ? $this->__USER_INFO['name'] : "--";
        $html = '<li class="dropdown dropdown-user">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" class="img-circle" src="'.$avatar.'" />
                        <span class="username username-hide-on-mobile">'.$userName.'</span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="#">
                                <i class="icon-user"></i>我的空间</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-calendar"></i>我的日程</a>
                        </li>
                        <li>
                            <a href="app_todo.html">
                                <i class="icon-rocket"></i>我的任务
                                <span class="badge badge-success"> 7 </span>
                            </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="page_user_login_1.html">
                                <i class="icon-key"></i>登出</a>
                        </li>
                    </ul>
                </li>';
        return $html;
    }

}
