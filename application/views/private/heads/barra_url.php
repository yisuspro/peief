<!-- barra de dreccionamiento barra_url.php-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span><?php echo $this->uri->segment(1); ?></span><i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span><?php if($this->uri->segment(2)){
                echo $this->uri->segment(2); 
                ?></span><i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span><?php echo $this->uri->segment(3);} ?></span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Actions
                                    <i class="fa fa-angle-down"></i>
                                </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="#"><i class="icon-bell"></i> Action</a>
                </li>
                <li>
                    <a href="#"><i class="icon-shield"></i> Another action</a>
                </li>
                <li>
                    <a href="#"><i class="icon-user"></i> Something else here</a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a href="#"><i class="icon-bag"></i> Separated link</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- end barra de dreccionamiento barra_url.php-->