<?php
namespace backend\widgets;
use yii\base\Widget;
use Yii;

class LeftMenu extends Widget{
    public $__MESSAGE;
    public $__USER_INFO;
    public function run(){
        $menuHtml = '<div class="page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse collapse">
                <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                    <li class="nav-item start active open">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-home"></i>
                            <span class="title">HOME</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item start active open">
                                <a href="index.html" class="nav-link ">
                                    <i class="icon-bar-chart"></i>
                                    <span class="title">功能1</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <li class="nav-item start ">
                                <a href="dashboard_2.html" class="nav-link ">
                                    <i class="icon-bulb"></i>
                                    <span class="title">功能2</span>
                                    <span class="badge badge-success">1</span>
                                </a>
                            </li>
                            <li class="nav-item start ">
                                <a href="dashboard_3.html" class="nav-link ">
                                    <i class="icon-graph"></i>
                                    <span class="title">功能3</span>
                                    <span class="badge badge-danger">5</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-diamond"></i>
                            <span class="title">UI Features</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item  ">
                                <a href="ui_colors.html" class="nav-link ">
                                    <span class="title">Color Library</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="ui_general.html" class="nav-link ">
                                    <span class="title">General Components</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="ui_buttons.html" class="nav-link ">
                                    <span class="title">Buttons</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>';
        echo $menuHtml;
    }

}
