<?php $__env->startSection('title', trans('messages.display.display')); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/js/plugins/data-tables/css/jquery.dataTables.min.css')); ?>" type="text/css" rel="stylesheet" media="screen,projection">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div id="callarea" class="row" style="line-height:1.23">
        <div class="col s12 m3">
            <div class="card">
                <div class="card-content" style="font-size:14px">
                    <span class="card-title" style="line-height:0;font-size:22px"><strong><?php echo e(trans('QUEUE')); ?></strong></span>
                    <div class="divider" style="margin:15px 0 10px 0"></div>
                    <table id="call-table" class="display" cellspacing="0">
                        <thead style="display:none;">
                            <tr>
                                <th>#</th>
                                <th><?php echo e(trans('messages.mainapp.menu.department')); ?></th>
                                <th><?php echo e(trans('messages.call.number')); ?></th>
                                
                                <!--hidden from display queue-->
                                <!--<th><?php echo e(trans('messages.call.called')); ?></th>-->
                                <!--<th><?php echo e(trans('messages.mainapp.menu.counter')); ?></th>-->
                                <!--<th><?php echo e(trans('messages.call.recall')); ?></th>-->
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col m3">
            <div class="card-panel center-align" style="margin-bottom:0">
                <span style="font-size:2rem;"><?php echo e(trans('messages.display.token')); ?> <?php echo e(trans('messages.call.number')); ?></span><br>
                <span id="num0" style="font-size:8rem;color:red;font-weight:bold;line-height:1.5"><?php echo e($data[0]['number']); ?></span><br>
                <span style="font-size:1.5rem;"><?php echo e(trans('messages.display.please')); ?> <?php echo e(trans('messages.display.proceed_to')); ?></span><br>
                
                <span id="dname0" style="font-size:3rem; color:green;line-height:1.5"><?php echo e($data[0]['dname']); ?></span>
                <span id="cou0" style="font-size:3rem; color:red;line-height:1.5"><?php echo e($data[0]['counter']); ?></span>
            </div>
        </div>
        <div class="col m3">
            <div class="card-panel center-align" style="margin-bottom:0">
                <span style="font-size:2rem;"><?php echo e(trans('messages.display.token')); ?> <?php echo e(trans('messages.call.number')); ?></span><br>
                <span id="num1" style="font-size:8rem;color:red;font-weight:bold;line-height:1.5"><?php echo e($data[1]['number']); ?></span><br>
                <span style="font-size:1.5rem"><?php echo e(trans('messages.display.please')); ?> <?php echo e(trans('messages.display.proceed_to')); ?></span><br>
                
                <span id="dname1" style="font-size:3rem; color:green;line-height:1.5"><?php echo e($data[1]['dname']); ?></span>
                <span id="cou1" style="font-size:3rem; color:red;line-height:1.5"><?php echo e($data[1]['counter']); ?></span>
            </div>
        </div>
        <div class="col m3">
            <div class="card-panel center-align" style="margin-bottom:0">
                <span style="font-size:2rem;"><?php echo e(trans('messages.display.token')); ?> <?php echo e(trans('messages.call.number')); ?></span><br>
                <span id="num2" style="font-size:8rem;color:red;font-weight:bold;line-height:1.5"><?php echo e($data[2]['number']); ?></span><br>
                <span style="font-size:1.5rem"><?php echo e(trans('messages.display.please')); ?> <?php echo e(trans('messages.display.proceed_to')); ?></span><br>
                
                <span id="dname2" style="font-size:3rem; color:green;line-height:1.5"><?php echo e($data[2]['dname']); ?></span>
                <span id="cou2" style="font-size:3rem; color:red;line-height:1.5"><?php echo e($data[2]['counter']); ?></span>

            </div>
        </div>
    </div>
    <div class="row" style="margin-bottom:0;font-size:<?php echo e($settings->size); ?>px;color:<?php echo e($settings->color); ?>">
        <marquee><?php echo e($settings->notification); ?></marquee>
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
                  return $("<embed src='"+arguments[0]+".mp3' hidden='true' autostart='true' loop='false' class='playSound'>" + "<audio autoplay='autoplay' style='display:none;' controls='controls'><source src='"+arguments[0]+".mp3' /><source src='"+arguments[0]+".ogg' /></audio>").appendTo('body');
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
                            $("#dname0").html(s[0].dname);
                            $("#cou0").html(s[0].counter);
                            $('#num1').html(s[1].number);
                            $("#dname1").html(s[1].dname);
                            $("#cou1").html(s[1].counter);
                            $('#num2').html(s[2].number);
                            $("#cou2").html(s[2].counter);
                            $("#dname2").html(s[2].dname);
                            $('#num3').html(s[3].number);
                            $("#dname3").html(s[3].dname);
                            $("#cou3").html(s[3].counter);
                            
                        });
                        $("#callarea").fadeIn();
                        if (curr!=0) {
                            var bleep = new Audio();
                            bleep.src = '<?php echo e(url('assets/sound/sound1.mp3')); ?>';
                            bleep.play();

                            window.setTimeout(function() {
                                msg1 = '<?php echo trans('messages.display.token'); ?> '+s[0].call_number+' <?php echo trans('messages.display.please'); ?> <?php echo trans('messages.display.proceed_to'); ?> '+s[0].counter;
                                responsiveVoice.speak(msg1, "<?php echo e($settings->language->display); ?>", {rate: 0.85});
                            }, 800);
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