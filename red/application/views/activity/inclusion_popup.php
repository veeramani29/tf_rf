<div class="col-md-12">
    <div class="container">
                        
                            <ul class="col-md-8 nav nav-tabs">
                                <li class="active" style="padding-left:0px;"><a data-toggle="tab" href="#inclusion">Inclusions</a></li>
                                <li><a data-toggle="tab" href="#cancelation">Cancellation</a></li>
                                
                            </ul>
                            <div class="col-md-8 tab-content" style="padding-bottom:20px; padding-top:10px;">
                                <div role="tabpanel" class="tab-pane active" id="inclusion">
                                    <?php
                                        echo $details->ActivityInclusive;
                                    ?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="cancelation">
                                    <?php
                                        echo $details->CancellationPolicy;
                                    ?>
                                </div>
                            </div>
    </div>
</div>