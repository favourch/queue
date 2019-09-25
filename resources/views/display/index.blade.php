
@extends('layouts.mainappqueue')

@section('title', trans('messages.display.display'))

@section('css')
    <link href="{{ asset('assets/js/plugins/data-tables/css/jquery.dataTables.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
@endsection

@section('content')

    <div id="callarea" class="row" style="line-height:1.23">
        <div class="col s12 m3">
            <div class="card">
                <div class="card-content" style="font-size:14px">
                    <span class="card-title" style="line-height:0;font-size:22px"><strong>{{ trans('QUEUE') }}</strong></span>
                    <div class="divider" style="margin:15px 0 10px 0"></div>
                    <table id="call-table" class="display" cellspacing="0">
                        <thead style="display:none;">
                            <tr>
                                <th>#</th>
                                <th>{{ trans('messages.mainapp.menu.department') }}</th>
                                <th>{{ trans('messages.call.number') }}</th>
                                
                                <!--hidden from display queue-->
                                <!--<th>{{ trans('messages.call.called') }}</th>-->
                                <!--<th>{{ trans('messages.mainapp.menu.counter') }}</th>-->
                                <!--<th>{{ trans('messages.call.recall') }}</th>-->
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col m3">
            <div class="card-panel center-align" style="margin-bottom:0">
                <span style="font-size:2rem;">{{ trans('messages.display.token') }} {{ trans('messages.call.number') }}</span><br>
                <span id="num0" style="font-size:8rem;color:red;font-weight:bold;line-height:1.5">{{ $data[0]['number'] }}</span><br>
                <span style="font-size:1.5rem;">{{ trans('messages.display.please') }} {{ trans('messages.display.proceed_to') }}</span><br>
                
                <span id="dname0" style="font-size:3rem; color:green;line-height:1.5">{{ $data[0]['dname'] }}</span>
                <span id="cou0" style="font-size:3rem; color:red;line-height:1.5">{{ $data[0]['counter'] }}</span>
            </div>
        </div>
        <div class="col m3">
            <div class="card-panel center-align" style="margin-bottom:0">
                <span style="font-size:2rem;">{{ trans('messages.display.token') }} {{ trans('messages.call.number') }}</span><br>
                <span id="num1" style="font-size:8rem;color:red;font-weight:bold;line-height:1.5">{{ $data[1]['number'] }}</span><br>
                <span style="font-size:1.5rem">{{ trans('messages.display.please') }} {{ trans('messages.display.proceed_to') }}</span><br>
                
                <span id="dname1" style="font-size:3rem; color:green;line-height:1.5">{{ $data[1]['dname'] }}</span>
                <span id="cou1" style="font-size:3rem; color:red;line-height:1.5">{{ $data[1]['counter'] }}</span>
            </div>
        </div>
        <div class="col m3">
            <div class="card-panel center-align" style="margin-bottom:0">
                <span style="font-size:2rem;">{{ trans('messages.display.token') }} {{ trans('messages.call.number') }}</span><br>
                <span id="num2" style="font-size:8rem;color:red;font-weight:bold;line-height:1.5">{{ $data[2]['number'] }}</span><br>
                <span style="font-size:1.5rem">{{ trans('messages.display.please') }} {{ trans('messages.display.proceed_to') }}</span><br>
                
                <span id="dname2" style="font-size:3rem; color:green;line-height:1.5">{{ $data[2]['dname'] }}</span>
                <span id="cou2" style="font-size:3rem; color:red;line-height:1.5">{{ $data[2]['counter'] }}</span>

            </div>
        </div>
    </div>
    <div class="row" style="margin-bottom:0;font-size:{{ $settings->size }}px;color:{{ $settings->color }}">
        <marquee>{{ $settings->notification }}</marquee>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('assets/js/plugins/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/voice.min.js') }}"></script>
    
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
                url: "{{ url('assets/files/display') }}",
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
                            bleep.src = '{{ url('assets/sound/sound1.mp3') }}';
                            bleep.play();

                            window.setTimeout(function() {
                                msg1 = '{!! trans('messages.display.token') !!} '+s[0].call_number+' {!! trans('messages.display.please') !!} {!! trans('messages.display.proceed_to') !!} '+s[0].counter;
                                responsiveVoice.speak(msg1, "{{ $settings->language->display }}", {rate: 0.85});
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
                url: "{{ url('assets/files/display') }}",
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
                "ajax": "{{ url('assets/files/call2') }}",
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
@endsection
