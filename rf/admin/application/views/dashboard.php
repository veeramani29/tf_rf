<!DOCTYPE html>
<html>
<head>
    <title>Dashboard | <?php echo PROJECT_NAME;?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    <link href='<?=base_url();?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
    <!-- / START - page related stylesheets [optional] -->
    <link href="<?=base_url();?>assets/stylesheets/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/fullcalendar/fullcalendar.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/common/bootstrap-wysihtml5.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / END - page related stylesheets [optional] -->
    <!-- / bootstrap [required] -->
    <link href="<?=base_url();?>assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / theme file [required] -->
    <link href="<?=base_url();?>assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="<?=base_url();?>assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / demo file [not required!] -->
    <link href="<?=base_url();?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
      <script src="<?=base_url();?>assets/javascripts/ie/html5shiv.js" type="text/javascript"></script>
      <script src="<?=base_url();?>assets/javascripts/ie/respond.min.js" type="text/javascript"></script>
    <![endif]-->
  </head>
  <body class='contrast-dark fixed-header'>
    <?php $this->load->view('header');?>
    <div id='wrapper'>
      <div id='main-nav-bg'></div>
      <?php $this->load->view('side-menu');?>
      <section id='content'>
        <div class='container'>
          <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              
              <div class='page-header page-header-with-buttons'>
                <h1 class='pull-left'>
                  <i class='icon-dashboard'></i>
                  <span>Dashboard</span>
                </h1>
              </div>

              <?php $this->load->view('top-menu');?>
              
              <div class="chartdiv" style="width: 50%; float: left">
                <span class="hedgraph">B2C User Registration Stats</span>
                <div id="stats-chart2"></div>
              </div>

              <!--<div class="chartdiv" style="width: 50%; float: left">
                <span class="hedgraph">B2B User Registration Stats</span>
                <div id="stats-chart1"></div>
              </div>-->
              
              <div class="chartdiv" style="">
                <span class="hedgraph">Booking Stats</span>
                <div id="stats-chart3"></div>
              </div>

            </div>
          </div>
          <?php $this->load->view('footer');?>
        </div>
      </section>
    </div>
    <!-- / jquery [required] -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
    <!-- / jquery mobile (for touch events) -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery.mobile.custom.min.js" type="text/javascript"></script>
    <!-- / jquery migrate (for compatibility with new jquery) [required] -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery-migrate.min.js" type="text/javascript"></script>
    <!-- / jquery ui -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
    <!-- / jQuery UI Touch Punch -->
    <script src="<?=base_url();?>assets/javascripts/plugins/jquery_ui_touch_punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
    <!-- / bootstrap [required] -->
    <script src="<?=base_url();?>assets/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
    <!-- / modernizr -->
    <script src="<?=base_url();?>assets/javascripts/plugins/modernizr/modernizr.min.js" type="text/javascript"></script>
    <!-- / retina -->
    <script src="<?=base_url();?>assets/javascripts/plugins/retina/retina.js" type="text/javascript"></script>
    <!-- / theme file [required] -->
    <script src="<?=base_url();?>assets/javascripts/theme.js" type="text/javascript"></script>
    <!-- / demo file [not required!] -->
    <script src="<?=base_url();?>assets/javascripts/demo.js" type="text/javascript"></script>
    <!-- / START - page related files and scripts [optional] -->
    <script src="<?=base_url();?>assets/javascripts/plugins/flot/excanvas.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/flot/flot.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/flot/flot.resize.js" type="text/javascript"></script>
    
    <script src="<?=base_url();?>assets/javascripts/plugins/common/moment.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/timeago/jquery.timeago.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/common/wysihtml5.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/common/bootstrap-wysihtml5.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/flot/flot_time_plugin.js" type="text/javascript"></script>
    <script>
      (function() {
        var cal, calendarDate, d, m, y;
      
        this.setDraggableEvents = function() {
          return $("#events .external-event").each(function() {
            var eventObject;
            eventObject = {
              title: $.trim($(this).text())
            };
            $(this).data("eventObject", eventObject);
            return $(this).draggable({
              zIndex: 999,
              revert: true,
              revertDuration: 0
            });
          });
        };
      
        setDraggableEvents();
      
        calendarDate = new Date();
      
        d = calendarDate.getDate();
      
        m = calendarDate.getMonth();
      
        y = calendarDate.getFullYear();
      
        cal = $(".full-calendar-demo").fullCalendar({
          header: {
            center: "title",
            left: "basicDay,basicWeek,month",
            right: "prev,today,next"
          },
          buttonText: {
            prev: "<span class=\"icon-chevron-left\"></span>",
            next: "<span class=\"icon-chevron-right\"></span>",
            today: "Today",
            basicDay: "Day",
            basicWeek: "Week",
            month: "Month"
          },
          droppable: true,
          editable: true,
          selectable: true,
          select: function(start, end, allDay) {
            return bootbox.prompt("Event title", function(title) {
              if (title !== null) {
                cal.fullCalendar("renderEvent", {
                  title: title,
                  start: start,
                  end: end,
                  allDay: allDay
                }, true);
                return cal.fullCalendar('unselect');
              }
            });
          },
          eventClick: function(calEvent, jsEvent, view) {
            return bootbox.dialog({
              message: $("<form class='form'><label>Change event name</label></form><input id='new-event-title' class='form-control' type='text' value='" + calEvent.title + "' /> "),
              buttons: {
                "delete": {
                  label: "<i class='icon-trash'></i> Delete Event",
                  className: "pull-left",
                  callback: function() {
                    return cal.fullCalendar("removeEvents", function(ev) {
                      return ev._id === calEvent._id;
                    });
                  }
                },
                success: {
                  label: "<i class='icon-save'></i> Save",
                  className: "btn-success",
                  callback: function() {
                    calEvent.title = $("#new-event-title").val();
                    return cal.fullCalendar('updateEvent', calEvent);
                  }
                }
              }
            });
          },
          drop: function(date, allDay) {
            var copiedEventObject, eventClass, originalEventObject;
            originalEventObject = $(this).data("eventObject");
            originalEventObject.id = Math.floor(Math.random() * 99999);
            eventClass = $(this).attr('data-event-class');
            console.log(originalEventObject);
            copiedEventObject = $.extend({}, originalEventObject);
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;
            if (eventClass) {
              copiedEventObject["className"] = [eventClass];
            }
            $(".full-calendar-demo").fullCalendar("renderEvent", copiedEventObject, true);
            if ($("#calendar-remove-after-drop").is(":checked")) {
              return $(this).remove();
            }
          },
          events: [
            {
              id: "event1",
              title: "All Day Event",
              start: new Date(y, m, 1),
              className: 'event-orange'
            }, {
              id: "event2",
              title: "Long Event",
              start: new Date(y, m, d - 5),
              end: new Date(y, m, d - 2),
              className: "event-red"
            }, {
              id: 999,
              id: "event3",
              title: "Repeating Event",
              start: new Date(y, m, d - 3, 16, 0),
              allDay: false,
              className: "event-blue"
            }, {
              id: 999,
              id: "event3",
              title: "Repeating Event",
              start: new Date(y, m, d + 4, 16, 0),
              allDay: false,
              className: "event-green"
            }, {
              id: "event4",
              title: "Meeting",
              start: new Date(y, m, d, 10, 30),
              allDay: false,
              className: "event-orange"
            }, {
              id: "event5",
              title: "Lunch",
              start: new Date(y, m, d, 12, 0),
              end: new Date(y, m, d, 14, 0),
              allDay: false,
              className: "event-red"
            }, {
              id: "event6",
              title: "Birthday Party",
              start: new Date(y, m, d + 1, 19, 0),
              end: new Date(y, m, d + 1, 22, 30),
              allDay: false,
              className: "event-purple"
            }
          ]
        });
      
      }).call(this);
    </script>
    <script>
      $(".chat .new-message").live('submit', function(e) {
        var chat, date, li, message, months, reply, scrollable, sender, timeago;
        date = new Date();
        months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        chat = $(this).parents(".chat");
        message = $(this).find("#message_body").val();
        $(this).find("#message_body").val("");
        if (message.length !== 0) {
          li = chat.find("li.message").first().clone();
          li.find(".body").text(message);
          timeago = li.find(".timeago");
          timeago.removeClass("in");
          var month = (date.getMonth() + 1);
          var date_day = (date.getDate());
          timeago.attr("title", "" + (date.getFullYear()) + "-" + (month<10 ? '0' : '') + month + "-" + (date_day<10 ? '0' : '' ) + date_day + " " + (date.getHours()) + ":" + (date.getMinutes()) + ":" + (date.getSeconds()) + " +0200");
          timeago.text("" + months[date.getMonth()] + " " + (date.getDate()) + ", " + (date.getFullYear()) + " " + (date.getHours()) + ":" + (date.getMinutes()));
          setTimeAgo(timeago);
          sender = li.find(".name").text().trim();
          chat.find("ul").append(li);
          scrollable = li.parents(".scrollable");
          $(scrollable).slimScroll({
            scrollTo: scrollable.prop('scrollHeight') + "px"
          });
          li.effect("highlight", {}, 500);
          reply = scrollable.find("li").not(":contains('" + sender + "')").first().clone();
          setTimeout((function() {
            date = new Date();
            timeago = reply.find(".timeago");
            timeago.attr("title", "" + (date.getFullYear()) + "-" + (month<10 ? '0' : '') + month + "-" + (date_day<10 ? '0' : '' ) + date_day + " " + (date.getHours()) + ":" + (date.getMinutes()) + ":" + (date.getSeconds()) + " +0200");
            timeago.text("" + months[date.getMonth()] + " " + (date.getDate()) + ", " + (date.getFullYear()) + " " + (date.getHours()) + ":" + (date.getMinutes()));
            setTimeAgo(timeago);
            scrollable.find("ul").append(reply);
            $(scrollable).slimScroll({
              scrollTo: scrollable.prop('scrollHeight') + "px"
            });
            return reply.effect("highlight", {}, 500);
          }), 1000);
        }
        return e.preventDefault();
      });
    </script>
    <script>
      $(".recent-activity .ok").live("click", function(e) {
        $(this).tooltip("hide");
        $(this).parents("li").fadeOut(500, function() {
          return $(this).remove();
        });
        return e.preventDefault();
      });
      $(".recent-activity .remove").live("click", function(e) {
        $(this).tooltip("hide");
        $(this).parents("li").fadeOut(500, function() {
          return $(this).remove();
        });
        return e.preventDefault();
      });
      $("#comments-more-activity").live("click", function(e) {
        $(this).button("loading");
        setTimeout((function() {
          var list;
          list = $("#comments-more-activity").parent().parent().find("ul");
          list.append(list.find("li:not(:first)").clone().effect("highlight", {}, 500));
          return $("#comments-more-activity").button("reset");
        }), 1000);
        e.preventDefault();
        return false;
      });
      $("#users-more-activity").live("click", function(e) {
        $(this).button("loading");
        setTimeout((function() {
          var list;
          list = $("#users-more-activity").parent().parent().find("ul");
          list.append(list.find("li:not(:first)").clone().effect("highlight", {}, 500));
          return $("#users-more-activity").button("reset");
        }), 1000);
        e.preventDefault();
        return false;
      });
    </script>
    <script>
      (function() {
        $("#daterange").daterangepicker({
          ranges: {
            Yesterday: [moment().subtract("days", 1), moment().subtract("days", 1)],
            "Last 30 Days": [moment().subtract("days", 29), moment()],
            "This Month": [moment().startOf("month"), moment().endOf("month")]
          },
          startDate: moment().subtract("days", 29),
          endDate: moment(),
          opens: "left",
          cancelClass: "btn-danger",
          buttonClasses: ['btn', 'btn-sm']
        }, function(start, end) {
          return $("#daterange span").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
        });
      
      }).call(this);
    </script>
    <script>
      $(".todo-list .new-todo").live('submit', function(e) {
        var li, todo_name;
        todo_name = $(this).find("#todo_name").val();
        $(this).find("#todo_name").val("");
        if (todo_name.length !== 0) {
          li = $(this).parents(".todo-list").find("li.item").first().clone();
          li.find("input[type='checkbox']").attr("checked", false);
          li.removeClass("important").removeClass("done");
          li.find("label.todo span").text(todo_name);
          $(".todo-list ul").first().prepend(li);
          li.effect("highlight", {}, 500);
        }
        return e.preventDefault();
      });
      
      $(".todo-list .actions .remove").live("click", function(e) {
        $(this).tooltip("hide");
        $(this).parents("li").fadeOut(500, function() {
          return $(this).remove();
        });
        e.stopPropagation();
        e.preventDefault();
        return false;
      });
      
      $(".todo-list .actions .important").live("click", function(e) {
        $(this).parents("li").toggleClass("important");
        e.stopPropagation();
        e.preventDefault();
        return false;
      });
      
      $(".todo-list .check").live("click", function() {
        var checkbox;
        checkbox = $(this).find("input[type='checkbox']");
        if (checkbox.is(":checked")) {
          return $(this).parents("li").addClass("done");
        } else {
          return $(this).parents("li").removeClass("done");
        }
      });
    </script>
    <!-- / END - page related files and scripts [optional] -->

    <?php  
    $b2c_data_array = array();
    foreach($get_b2c_stats as $stats_key) {
      $date = strtotime($stats_key->reg_date)*1000;
      $stats_b2c_key_array = array($date, $stats_key->reg_count);
      array_push($b2c_data_array, $stats_b2c_key_array);
    }

    $b2b_data_array = array();
   
    $flight_stats = array();
    foreach($get_flight_booking_stats as $flight_key) {
      $flight_key_array = array(strtotime($flight_key->book_date)*1000, $flight_key->flight_count);
      array_push($flight_stats, $flight_key_array);  
    }

    $hotel_stats = array();
    foreach($get_hotel_booking_stats as $hotel_key) {
      $hotel_key_array = array(strtotime($hotel_key->book_date)*1000, $hotel_key->hotel_count);
      array_push($hotel_stats, $hotel_key_array);  
    }

    $apt_stats = array();
    foreach($get_car_booking_stats as $apt_key) {
      $apt_key_array = array(strtotime($apt_key->book_date)*1000, $apt_key->car_count);
      array_push($apt_stats, $apt_key_array);  
    }

    ?>
    <script>
      var options = {
                      series: {
                                lines: { show: true },
                                points: { show: true }
                      },
                      xaxis: {
                                mode: "time"
                      },
                      grid: {
                                hoverable: true,
                                clickable: true
                      },
                      
      };
      
      var d1 = <?php echo json_encode($b2c_data_array); ?>;
     // var d2 = <?php echo json_encode($b2b_data_array); ?>;
      
      var d3 = <?php echo json_encode($flight_stats); ?>;
      var d4 = <?php echo json_encode($hotel_stats); ?>;
      var d5 = <?php echo json_encode($apt_stats); ?>;

      var d3 =  [{label: 'Flights', data: d3},
                 {label: 'Hotels', data: d4},
                 {label: 'Cars', data: d5}
                ];

      $.plot("#stats-chart3", d3  , options);
      options.colors = ["#0087b9"];
      $.plot("#stats-chart2", [d1], options);
      $.plot("#stats-chart1", [d2], options);
      



      $("<div id='tooltip'></div>").css({
          position: "absolute",
          display: "none",
          border: "1px solid #fdd",
          padding: "2px",
          "background-color": "#fee",
          opacity: 1
      }).appendTo("body");


      $("#stats-chart2, #stats-chart1").bind("plothover", function (event, pos, item) {
        if (item) {
          var x = item.datapoint[0].toFixed(2),
              y = item.datapoint[1].toFixed(2);
          
          m  = ~~y; //math.floor
          r = new Date(x/1000*1000);
          dt = r.getDate() + '/'+ r.getMonth() + '/' + r.getFullYear();

          $("#tooltip").html(m + " registered on "+dt)
            .css({top: item.pageY-15, left: item.pageX-40})
            .fadeIn(200);
        } else {
          $("#tooltip").hide();
        }
      
      });

      $("#stats-chart3").bind("plothover", function (event, pos, item) {
        if (item) {
          var x = item.datapoint[0].toFixed(2),
              y = item.datapoint[1].toFixed(2);
          
          if(item.seriesIndex == 0) {
            bType = "flight";
          } else if(item.seriesIndex == 1) {
            bType = "hotel";
          } else if(item.seriesIndex == 2) {
            bType = "apartment";
          } else {
            bType = "";
          }

          r = new Date(x/1000*1000);
          dt = r.getDate()-1 + '/'+ parseInt(r.getMonth()+1) + '/' + r.getFullYear();
          m = ~~y;
          $("#tooltip").html(m + " "+bType + " bookings on "+dt)
            .css({top: item.pageY-15, left: item.pageX-40})
            .fadeIn(200);
        } else {
          $("#tooltip").hide();
        }
      
      });

    </script>

  </body>


</html>
