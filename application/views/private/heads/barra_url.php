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

</div>
<!-- end barra de dreccionamiento barra_url.php-->