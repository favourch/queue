<?php $__env->startSection('title', trans('messages.display.display')); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/js/plugins/data-tables/css/jquery.dataTables.min.css')); ?>" type="text/css" rel="stylesheet" media="screen,projection">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div id="callarea" class="row" style="line-height:1.23;">
        

        <div class="col s12 m7">
            <!--<img src="assets/images/sample-ads.jpg" style="width:100%;">-->

           <!-- <iframe id="existing-iframe-example"
          width="960" height="540"
          src="https://www.youtube.com/embed/1Q1cZYhobhc?autoplay=1&mute=1&enablejsapi=1&controls=0&loop=1&playlist=1Q1cZYhobhc"
          frameborder="0"></iframe>-->

          <video onloadstart="this.volume=0.05" width="960" loop="true" autoplay="autoplay">
            <source src="assets/images/compilation1.mp4" type="video/mp4" />
            
        </div>
            
            


<div class="col m3 offset-m2 center-align" >
        <div class="row">
            <div class="card-panel center-align" style="margin-bottom:0">
                <!--<span style="font-size:0.25rem"><?php echo e(trans('messages.display.qn')); ?></span><br>-->
                <span id="num0" style="font-size:3rem;color:red;font-weight:bold;line-height:1.5"><?php echo e($data[0]['number']); ?></span><br>
                <!--<span style="font-size:0.75rem"><?php echo e(trans('messages.display.please')); ?> <?php echo e(trans('messages.display.proceed_to')); ?></span><br>-->
                <span id="dname0" style="font-size:1.50rem; color:green;line-height:1.5;font-weight:bold"><?php echo e($data[0]['name']); ?></span><br>
                <span id="cou0" style="font-size:1rem; color:black;line-height:1.5;font-weight:bold"><?php echo e($data[0]['counter']); ?></span>
            </div>
        </div>

        <div class="row">
            <div class="card-panel center-align" style="margin-bottom:0">
                <!--<span style="font-size:0.25rem"><?php echo e(trans('messages.display.qn')); ?></span><br>-->
                <span id="num1" style="font-size:3rem;color:red;font-weight:bold;line-height:1.5"><?php echo e($data[1]['number']); ?></span><br>
                <!--<span style="font-size:0.75rem"><?php echo e(trans('messages.display.please')); ?> <?php echo e(trans('messages.display.proceed_to')); ?></span><br>-->
                <span id="dname1" style="font-size:1.50rem; color:green;line-height:1.5;font-weight:bold"><?php echo e($data[1]['name']); ?></span><br>
                <span id="cou1" style="font-size:1rem; color:black;line-height:1.5;font-weight:bold"><?php echo e($data[1]['counter']); ?></span>
            </div>
        </div>

        <div class="row">
            <div class="card-panel center-align" style="margin-bottom:0">
                <!--<span style="font-size:0.25rem"><?php echo e(trans('messages.display.qn')); ?></span><br>-->
                <span id="num2" style="font-size:3rem;color:red;font-weight:bold;line-height:1.5"><?php echo e($data[2]['number']); ?></span><br>
                <!--<span style="font-size:0.75rem"><?php echo e(trans('messages.display.please')); ?> <?php echo e(trans('messages.display.proceed_to')); ?></span><br>-->
                <span id="dname2" style="font-size:1.50rem; color:green;line-height:1.5;font-weight:bold"><?php echo e($data[2]['name']); ?></span><br>
                <span id="cou2" style="font-size:1rem; color:black;line-height:1.5;font-weight:bold"><?php echo e($data[2]['counter']); ?></span>
            </div>
        </div>

        <!--<div class="col m3">
            <div class="card-panel center-align" style="margin-bottom:0">
                <span style="font-size:1.25rem"><?php echo e(trans('messages.display.qn')); ?></span><br>
                <span id="num3" style="font-size:5rem;color:red;font-weight:bold;line-height:1.5"><?php echo e($data[3]['number']); ?></span><br>
                <span style="font-size:0.75rem"><?php echo e(trans('messages.display.please')); ?> <?php echo e(trans('messages.display.proceed_to')); ?></span><br>
                <span id="dname3" style="font-size:2.25rem; color:green;line-height:1.5;font-weight:bold"><?php echo e($data[3]['name']); ?></span><br>
                <span id="cou3" style="font-size:2rem; color:black;line-height:1.5;font-weight:bold"><?php echo e($data[3]['counter']); ?></span>
            </div>
        </div>-->
</div>

<div class="row align-self-center" style="font-size:<?php echo e($settings->size); ?>px;color:<?php echo e($settings->color); ?>">
        <marquee><?php echo e($settings->notification); ?></marquee>
    </div>
    
    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/plugins/data-tables/js/jquery.dataTables.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/voice.min.js')); ?>"></script>
    
    <script>
        $(function() {
            $('#main').css({'min-height': $(window).height()-114+'px'});
        });
        $(window).resize(function() {
            $('#main').css({'min-height': $(window).height()-114+'px'});
        });

        (function($){
            $.extend({
                playSound: function(){
                  return $("<embed src='sound1.mp3' hidden='true' autostart='true' loop='false' class='playSound'>" + "<audio autoplay='autoplay' style='display:none;' controls='controls'><source src='sound1.mp3' /><source src='"+arguments[0]+".ogg' /></audio>").appendTo('body');
                }
            });
        })(jQuery);

        function checkcall() {
            $.ajax({
                type: "GET",
                url: "<?php echo e(url('assets/files/display')); ?>",
                cache: false,
                success: function(response) {
                    s = JSON.parse(response);
                    if (curr!=s[0].call_id) {
                        $("#callarea").fadeOut(function(){
                            $('#num0').html(s[0].number);
                            $("#dname0").html(s[0].name);
                            $("#cou0").html(s[0].counter);
                            $('#num1').html(s[1].number);
                            $("#dname1").html(s[1].name);
                            $("#cou1").html(s[1].counter);
                            $('#num2').html(s[2].number);
                            $("#dname2").html(s[2].name);
                            $("#cou2").html(s[2].counter);
                            $('#num3').html(s[3].number);
                            $("#dname3").html(s[3].name);
                            $("#cou3").html(s[3].counter);
                        });
                        $("#callarea").fadeIn();
                        if (curr!=0) {
                            var bleep = new Audio();
                            bleep.src = '<?php echo e(url('assets/sound/sound1.mp3')); ?>';
                            bleep.play();

                            //window.setTimeout(function() {
                                //msg1 = '<?php echo trans('messages.display.token'); ?> '+s[0].call_number+' <?php echo trans('messages.display.please'); ?> <?php echo trans('messages.display.proceed_to'); ?> '+s[0].counter;
                                //responsiveVoice.speak(msg1, "<?php echo e($settings->language->display); ?>", {rate: 0.85});
                           // }, 800);
                        }
                        curr = s[0].call_id;
                    }
                }
            });
        }

        window.setInterval(function() {
            checkcall();
        }, 3000);

        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "<?php echo e(url('assets/files/display')); ?>",
                cache: false,
                success: function(response) {
                    s = JSON.parse(response);
                    curr = s[0].call_id;
                }
            });
            checkcall();
        });

        $(function() {
            var calltable = $('#call-table').dataTable({
                "order": [ '0', "desc" ],
                'sDom': 't',
                "pageLength": 5,
                "bFilter": false,
                "bInfo": false,
                "bLengthChange": true,
                "oLanguage": {
                "sLengthMenu": "_MENU_",
                "sSearch": "Search"
                },
                "columnDefs": [{
                    "targets": [ 0 ],
                    "searchable": false,
                    "visible": false
                }],
                "ajax": "<?php echo e(url('assets/files/call2')); ?>",
                "columns": [
                    { "data": "id" },
                    { "data": "department" },
                    { "data": "number" },

                    //no need to be seen on queue display
                    //{ "data": "called" }, 
                    //{ "data": "counter" },
                    //{ "data": "recall" }
                ]
            });

            setInterval(function(){
                calltable.api().ajax.reload(null,false);
            }, 3000);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainappqueue', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>