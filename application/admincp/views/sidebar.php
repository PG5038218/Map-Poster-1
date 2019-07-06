<div class="leftpanel">
    <div class="media profile-left">
        <div class="pull-left profile-thumb">
            <img class="img-circle" src="<?php echo base_url('assets/images/photos/profile.png'); ?>" alt="">
        </div>
        <div class="media-body">
            <h4 class="media-heading">Admin</h4>
            <small class="text-muted"></small>
        </div>
    </div><!-- media -->		
    <h5 class="leftpanel-title">Navigation</h5>
    <ul class="nav nav-pills nav-stacked">
        <li  class="<?php
        if ($this->uri->segment(1) == "dashboard") {
            echo "active";
        }
        ?>"><a title="Dashboard" href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        
        <li class="parent <?php if($this->uri->segment(1) == "Setting" || $this->uri->segment(1) == "seo" 
                    || $this->uri->segment(1) == "sem" || $this->uri->segment(1) == "emailformat"
                    || $this->uri->segment(1) == "pages" || $this->uri->segment(1) == "faq" ){echo "active";} ?>">
            <a title="Site Settings" href="#"><i class="fa fa-cogs"></i> <span>Site Settings</span></a>
            <ul class="children">
                <li class="<?php if ($this->uri->segment(1) == "Setting"){echo "active";}?>">
                    <a title="General Settings" href="<?php echo site_url('Setting'); ?>">
                        <i class="fa fa-gear"></i>&nbsp;General Settings
                    </a>
                </li>
                <li class="<?php if ($this->uri->segment(1) == "seo"){echo "active";}?>">
                    <a title="SEo Settings" href="<?php echo site_url('seo'); ?>">SEO Settings</a>
                </li>
                <li class="<?php if ($this->uri->segment(1) == "sem"){echo "active";}?>">
                    <a title="SEMs Settings" href="<?php echo site_url('sem'); ?>">
                        <i class="fa fa-support"></i>&nbsp;SEMs Settings
                    </a>
                </li>
                <li class="<?php if ($this->uri->segment(1) == "emailformat"){echo "active";}?>">
                    <a title="Email Formats" href="<?php echo site_url('emailformat'); ?>">
                        <i class="fa fa-envelope"></i>&nbsp;Email Templates
                    </a>
                </li>
                <li class="<?php if ($this->uri->segment(1) == "pages"){echo "active";}?>">
                    <a title="Pages" href="<?php echo site_url('pages'); ?>">
                        <i class="fa fa-book"></i>&nbsp;Pages
                    </a>
                </li>
                <li  class="<?php if ($this->uri->segment(1) == "faq") {echo "active";}?>">
                    <a title="FAQs" href="<?php echo base_url('faq'); ?>">
                        <i class="fa fa-question-circle"></i> <span>FAQs</span>
                    </a>
                </li>
            </ul>
        </li>
        
        <li  class="<?php
        if ($this->uri->segment(1) == "poster") {
            echo "active";
        }
        ?>"><a title="Poster" href="<?php echo base_url('poster'); ?>"><i class="fa fa-file"></i> <span>Posters</span></a></li>
        
        <li  class="<?php
        if ($this->uri->segment(1) == "posterstyle") {
            echo "active";
        }
        ?>"><a title="Poster Style" href="<?php echo base_url('posterstyle'); ?>"><i class="fa fa-file"></i> <span>Posters Style</span></a></li>
        
        
        <li  class="<?php
        if ($this->uri->segment(1) == "style") {
            echo "active";
        }
        ?>"><a title="Style" href="<?php echo base_url('style'); ?>"><i class="fa fa-css3"></i> <span>Map Styles</span></a></li>
        
        <li  class="<?php
        if ($this->uri->segment(1) == "coupon") {
            echo "active";
        }
        ?>"><a title="Coupon" href="<?php echo base_url('coupon'); ?>"><i class="fa fa-qrcode"></i> <span>Coupon Codes</span></a></li>

        <li  class="<?php
        if ($this->uri->segment(1) == "order") {
            echo "active";
        }
        ?>"><a title="Order" href="<?php echo base_url('order'); ?>"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
        
        <li  class="<?php
        if ($this->uri->segment(1) == "subscribers") {
            echo "active";
        }
        ?>"><a title="Subscribers" href="<?php echo base_url('subscribers'); ?>"><i class="fa fa-shopping-cart"></i><span>Subscribers</span></a></li>
    </ul>
</div><!-- leftpanel -->
