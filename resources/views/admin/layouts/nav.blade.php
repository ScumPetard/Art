<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->avatar }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="javascript:;"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <form class="sidebar-form">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="不能搜索的搜索框...">
                <span class="input-group-btn">
                <button type="button" name="search" id="search-btn" class="btn btn-flat">
                    <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <ul class="sidebar-menu">
            <li class="header"></li>
            <li class="treeview">
                <a href="/admin/index">
                    <i class="fa fa-home"></i> <span>首页</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>基本设置</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/admin"><i class="fa fa-circle-o"></i> 管理员设置</a></li>
                    <li><a href="/admin/permission"><i class="fa fa-circle-o"></i> 权限设置</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-snowflake-o" aria-hidden="true"></i>
                    <span>内容设置</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/banner"><i class="fa fa-circle-o"></i> 轮播图设置</a></li>
                    <li><a href="/admin/page"><i class="fa fa-circle-o"></i> 单页设置</a></li>
                    <li><a href="/admin/indexpictures"><i class="fa fa-circle-o"></i> 首页信息设置</a></li>
                    <li><a href="/admin/module"><i class="fa fa-circle-o"></i> 模块设置</a></li>
                    <li><a href="/admin/statistical"><i class="fa fa-circle-o"></i> 访问统计设置</a></li>
                    <li><a href="/admin/problem"><i class="fa fa-circle-o"></i> 问题反馈设置</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-text-o"></i>
                    <span>作品设置</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/worktype"><i class="fa fa-circle-o"></i> 作品类型设置</a></li>
                    <li><a href="/admin/workdate"><i class="fa fa-circle-o"></i> 作品分类/时期设置</a></li>
                    <li><a href="/admin/author"><i class="fa fa-circle-o"></i> 作者设置</a></li>
                    <li><a href="/admin/work"><i class="fa fa-circle-o"></i> 作品设置</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-o"></i>
                    <span>用户设置</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/member"><i class="fa fa-circle-o"></i> 个人用户设置</a></li>
                    <li><a href="/admin/client"><i class="fa fa-circle-o"></i> 机构客户设置</a></li>
                    <li><a href="/admin/download"><i class="fa fa-circle-o"></i> 购画记录</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{{ route('admin.logout') }}">
                    <i class="fa fa-sign-out"></i> <span>安全退出</span>
                </a>
            </li>
        </ul>
    </section>
</aside>