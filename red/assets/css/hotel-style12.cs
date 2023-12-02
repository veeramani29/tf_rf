html {
	font-family:sans-serif;
	-webkit-text-size-adjust: 100%;
	-ms-text-size-adjust:     100%;
}

.header-bg-color {
    background-color: rgb(38, 106, 165);
}

input[type="search"],
input[type="text"],
input[type="url"],
input[type="number"],
input[type="password"],
input[type="email"],
input[type="file"] {
    background: none;
    border: 1px solid #d4d4d4;
    background-color: #fff;
  
    padding: 0 12px;
    color: #666;
    font-size: 14px;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none
}

code,
kbd,
pre,
samp {
    font-size: inherit;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    -ms-border-radius: 0;
    -o-border-radius: 0;
    border-radius: 0
}
code {
    background-color: eee;
    letter-spacing: 0.015em
}
img {
    max-width: 100%;
    height: auto;
    vertical-align: middle;
    border: 0
}
::-moz-selection {
    color: #fff;
    background-color: #194e91
}
::selection {
    color: #fff;
    background-color: #194e91
}
.list li {
    margin: 8px 0 0
}
#page-wrap {
    overflow: hidden;
    z-index: 9;
    background-color: #f7f7f7
}
.container {
    position: relative
}
.awe-parallax {
    color: #fff;
    background-position: 50% 50%;
    background-attachment: fixed;
    background-repeat: no-repeat;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover
}
.awe-static {
    color: #fff;
    background-position: 50% 50%;
    background-attachment: scroll;
    background-repeat: no-repeat;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover
}
.awe-color {
    position: absolute;
    top: 0;
    left: 0;
    z-index: -3;
    width: 100%;
    height: 100%;
    background-color: #194e91
}
.awe-overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: transparent;
    top: 0;
    left: 0;
    z-index: -2
}
.awe-btn {
    display: inline-block;
    background: #f74623;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -ms-border-radius: 2px;
    -o-border-radius: 2px;
    border-radius: 2px;
    white-space: nowrap;
    cursor: pointer;
    line-height: normal;
    padding: 8px 10px;
    text-align: center;
    font-size: 16px;
    color: #fff;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.awe-btn.awe-btn-style2 {
    border: 0;
    background-color: #ddd;
    color: #666
}
.awe-btn.awe-btn-style3 {
    border: 0;
    background-color: #194e91;
    color: #fff
}
.awe-btn.awe-btn-style3:focus,
.awe-btn.awe-btn-style3:hover {
    background-color: #d02200;
    color: #fff
}
.awe-btn:focus,
.awe-btn:hover {
    background-color: #d02200;
    color: #fff
}
section {
    position: relative
}
.tb {
    display: table;
    width: 100%
}
.tb-cell {
    display: table-cell;
    vertical-align: middle
}
.db {
    display: block
}
h1,
.h1,
h2,
.h2,
h3,
.h3,
h4,
.h4,
h5,
.h5,
h6,
.h6 {
    line-height: 1.5em;
    color: #262626
}
h1 a,
.h1 a,
h2 a,
.h2 a,
h3 a,
.h3 a,
h4 a,
.h4 a,
h5 a,
.h5 a,
h6 a,
.h6 a {
    color: inherit
}

abbr {
    background-color: #A1D71A;
    color: #111;
    border-width: 2px
}
mark,
.mark {
    background-color: #194e91
}
dfn {
    border-bottom: 1px dashed
}
blockquote {
    border: 0;
    font-size: 15px;
    color: #999;
    padding: 0;
    padding-left: 30px;
    text-align: left;
    border-left: 3px solid #d4d4d4
}
blockquote cite,
blockquote footer {
    display: inline-block;
    font-family: Lato-Light;
    font-size: 12px;
    font-style: normal;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    color: #666;
    margin-top: 5px;
    margin-bottom: 5px
}
pre {
    font-family: Lato-Light;
    line-height: 1.8em;
    padding: 15px;
    border: 1px solid #E4E4E4
}
span.dropcap {
    display: block;
    float: left;
    font-size: 44px;
    line-height: 34px;
    margin: 6px 8px 0 0;
    color: #666
}
.icon {
    display: inline-block;
    font-style: normal
}
.image-cover {
    position: relative;
    overflow: hidden;
    padding-top: 100%;
    -webkit-transform: translateZ(0);
    -moz-transform: translateZ(0);
    -ms-transform: translateZ(0);
    -o-transform: translateZ(0);
    transform: translateZ(0)
}
.image-cover img {
    position: absolute;
    width: auto;
	height: 100%;
    max-width: none !important;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%)
}
.fl {
    float: left
}
.fr {
    float: right
}
.owl-carousel .owl-controls {
    margin: 0
}
.owl-carousel .owl-controls .owl-buttons {
    position: absolute;
    right: 5px;
    bottom: 5px;
    z-index: 999
}
.owl-carousel .owl-controls .owl-buttons > div {
    display: inline-block
}
.owl-carousel .owl-controls .owl-buttons > div .fa {
    width: 36px;
    height: 36px;
    text-align: center;
    line-height: 36px;
    background-color: #fff;
    font-size: 16px;
    color: #666;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.owl-carousel .owl-controls .owl-buttons > div.owl-prev {
    margin-right: 3px
}
.owl-carousel .owl-controls .owl-buttons > div.owl-next {
    margin-left: 3px
}
.owl-carousel .owl-controls .owl-buttons > div:hover .fa {
    color: #194e91
}
.awe-select-wrapper {
    position: relative;
    display: inline-block
}
.awe-select-wrapper .fa {
    position: absolute;
    width: 35px;
    background-color: #fff;
    text-align: right;
    top: 1px;
    bottom: 1px;
    right: 1px;
    font-size: 14px;
    color: #666;
    pointer-events: none
}
.awe-select-wrapper .fa:before {
    position: absolute;
    top: 50%;
    right: 12px;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%)
}
.fix-background-ios {
    -webkit-background-size: auto 150% !important;
    background-attachment: scroll !important
}
.price-slider {
    display: block;
    border: 0;
    background: none;
    background: none;
    height: 6px;
    border-radius: 0;
    width: calc(100% - 8px);
    z-index: 9
}
.price-slider:after {
    content: '';
    display: block;
    position: absolute;
    left: 0;
    right: -8px;
    top: 0;
    height: 100%;
    background-color: #D4D4D4;
    z-index: -1
}
.price-slider .ui-slider-range {
    background: none;
    background-color: #194e91;
    border-radius: 0
}
.price-slider .ui-slider-handle {
    height: 20px;
    width: 8px;
    background: none;
    background-color: #194e91;
    border-radius: 0;
    border: 0;
    top: 50%;
    margin: 0;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    -webkit-transition: none;
    -moz-transition: none;
    -ms-transition: none;
    -o-transition: none;
    transition: none
}
.accordion {
    font-family: Lato-Light;
    font-size: 14px
}
.accordion .ui-accordion-header {
    background: none;
    border: 0;
    background-color: #fff;
    margin-top: 0;
    margin-bottom: 10px;
    padding: 0 20px;
    line-height: 40px;
    font-size: 14px;
    font-weight: 600;
    color: #707070;
    border-radius: 0;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none
}
.accordion .ui-accordion-header .ui-accordion-header-icon {
    margin-top: 0;
    right: 20px;
    left: auto;
    width: 0;
    height: 0;
    background: none;
    border: 8px solid transparent;
    border-top-color: #666;
    margin-top: 4px;
    -webkit-transform-origin: 50% 4px;
    -moz-transform-origin: 50% 4px;
    -ms-transform-origin: 50% 4px;
    -o-transform-origin: 50% 4px;
    transform-origin: 50% 4px;
    -webkit-transform: translateY(-50%) rotate(0) scaleX(0.6);
    -moz-transform: translateY(-50%) rotate(0) scaleX(0.6);
    -ms-transform: translateY(-50%) rotate(0) scaleX(0.6);
    -o-transform: translateY(-50%) rotate(0) scaleX(0.6);
    transform: translateY(-50%) rotate(0) scaleX(0.6);
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.accordion .ui-state-active,
.accordion .ui-widget-content .ui-state-active {
    color: #194e91
}
.accordion .ui-state-active .ui-icon,
.accordion .ui-widget-content .ui-state-active .ui-icon {
    -webkit-transform: translateY(-50%) rotate(180deg) scaleX(0.6);
    -moz-transform: translateY(-50%) rotate(180deg) scaleX(0.6);
    -ms-transform: translateY(-50%) rotate(180deg) scaleX(0.6);
    -o-transform: translateY(-50%) rotate(180deg) scaleX(0.6);
    transform: translateY(-50%) rotate(180deg) scaleX(0.6)
}
.con_review_list ul{float:left; width:100%; margin:0px; padding:0px;}
.con_review_list li{float:left; list-style-type:none; margin:0px;font-family: arial; padding:0px ; padding-right:10px; color:#94C2F1;font-size:12px; }
.con_review_list li i.fa-circle{color:#94C2F1;font-size:6px;}
.cont-start-common{float:left; width:100%;}
.item-hotel-star{float:left; width:auto;}
.con_review_list{float:left; width:auto; padding-left:30px;}
.con-location-city-name{float:left; width:100%;}
.con-location-city-name p{font-size:17px; color:#616161; font-family:arial; padding:0px; margin-bottom:0px;}
.con-location-city-icons{float:left;width:100%; padding-top:5px;}
.con-location-city-review{ float:left; width:100%;}
.con-location-city-review p{font-size:17px; color:#000; font-family:arial; padding:0px; margin-bottom:0px;}
.con-location-city-icons i.awe-icon{color:#4767B2; padding-right:10px; font-size:14px;}
.price .amount-sec{color:#194e91;}
.amount-first{color:#E21111!important; text-decoration:line-through; }
a.see-all-txt{font-size:12px; font-family:arial; color:#E21111;float:right;}
.content_rgt-precent{float:right;background-color:#E21111;padding: 4px;border-top-left-radius:5px;border-bottom-left-radius:5px;position:absolute;right:0px;/* top:10px; */}
.item-heading-img-txt{float:left; background-color:#194e91; padding:7px;  position:absolute;  left:0px; top:20px;}
.item-heading-img-txt p{font-size:17px; font-weight:normal;color:#fff; font-family:arial; padding:0px;float:left; width:100%; text-align:center;}
.content_rgt-precent p{font-size: 12px;font-weight:bold;color:#fff;font-family:arial;padding:0px;float:left;width:100%;text-align:center;}
.content_rgt-precent span{font-size: 12px;color:#fff;font-weight:bold;font-family:arial;padding:0px;width:100%;float:left;text-align:center;}

.accordion .ui-widget-content {
    background: none;
    border: 0;
    border-radius: 0;
    color: #A6A6A6;
    padding: 20px 0 30px 0
}
.accordion.trip-schedule-accordion .ui-widget-content {
    color: #666
}
.ui-datepicker {
    background: none;
    background-color: #fff;
    border-radius: 0;
    border: 1px solid #d4d4d4;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    font-family: Lato-Light;
    width: 290px
}
.ui-datepicker .ui-datepicker-header {
    background: none;
    background-color: #d4d4d4;
    border-radius: 0;
    border: 0
}
.ui-datepicker .ui-datepicker-header .ui-datepicker-title {
    line-height: 40px;
    color: #111
}
.ui-datepicker .ui-datepicker-header .ui-datepicker-prev,
.ui-datepicker .ui-datepicker-header .ui-datepicker-next {
    width: 34px;
    height: 34px;
    margin: auto;
    top: 0;
    bottom: 0;
    background: none;
    border: 0 !important;
    border-radius: 0;
    background-color: rgba(0, 0, 0, 0.1);
    cursor: pointer
}
.ui-datepicker .ui-datepicker-header .ui-datepicker-prev:hover,
.ui-datepicker .ui-datepicker-header .ui-datepicker-next:hover {
    background-color: #194e91
}
.ui-datepicker .ui-datepicker-header .ui-datepicker-prev {
    left: 5px
}
.ui-datepicker .ui-datepicker-header .ui-datepicker-next {
    right: 5px
}
.ui-datepicker .ui-datepicker-header .ui-icon {
    position: absolute;
    background: none;
    width: 0;
    height: 0;
    border: 6px solid transparent;
    margin: auto;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0
}
.ui-datepicker .ui-datepicker-header .ui-icon-circle-triangle-w {
    border-right-color: #111;
    -webkit-transform: translateX(-30%);
    -moz-transform: translateX(-30%);
    -ms-transform: translateX(-30%);
    -o-transform: translateX(-30%);
    transform: translateX(-30%)
}
.ui-datepicker .ui-datepicker-header .ui-icon-circle-triangle-e {
    border-left-color: #111;
    -webkit-transform: translateX(30%);
    -moz-transform: translateX(30%);
    -ms-transform: translateX(30%);
    -o-transform: translateX(30%);
    transform: translateX(30%)
}
.ui-datepicker .ui-datepicker-calendar {
    table-layout: fixed
}
.ui-datepicker .ui-datepicker-calendar thead tr th span {
    font-weight: 600;
    color: #333
}
.ui-datepicker .ui-datepicker-calendar tbody tr td a {
    display: block;
    padding: 0;
    line-height: 36px;
    text-align: center;
    background: none;
    background-color: #d4d4d4;
    border: 0;
    color: #111
}
.ui-datepicker .ui-datepicker-calendar tbody tr td a:hover {
    background-color: #194e91;
    color: #fff
}
.ui-datepicker .ui-datepicker-calendar .ui-state-active,
.ui-datepicker .ui-datepicker-calendar .ui-widget-content .ui-state-active,
.ui-datepicker .ui-datepicker-calendar .ui-widget-header .ui-state-active {
    background-color: #194e91;
    color: #fff
}
.autoHeight {
    -webkit-transition: all 0.3s linear;
    -moz-transition: all 0.3s linear;
    -ms-transition: all 0.3s linear;
    -o-transition: all 0.3s linear;
    transition: all 0.3s linear
}
.pt-80 {
    padding-top: 80px
}
.pb-80 {
    padding-bottom: 80px
}
.bg-border {
    border-bottom: 1px solid #E4E4E4
}
.map-demo {
    height: 300px
}
.preloader {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: #fff;
    z-index: 999999999;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden
}
.preloader:after {
    content: '';
    display: block;
    position: absolute;
    z-index: 9;
    background-color: #FF007F;
    width: 30px;
    height: 30px;
    margin: auto;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    border-radius: 50%;
    -webkit-animation: preloader 5s linear infinite;
    -moz-animation: preloader 5s linear infinite;
    animation: preloader 5s linear infinite
}
@-webkit-keyframes "preloader" {
    0% {
        background-color: #FF007F;
        -webkit-transform: scale(0);
        opacity: 1;
    }
    20% {
        background-color: #FF007F;
        -webkit-transform: scale(3);
        opacity: 0;
    }
    20.00001% {
        background-color: #3EA7F3;
        -webkit-transform: scale(0);
        opacity: 1;
    }
    40% {
        background-color: #3EA7F3;
        -webkit-transform: scale(3);
        opacity: 0;
    }
    40.00001% {
        background-color: #79C742;
        -webkit-transform: scale(0);
        opacity: 1;
    }
    60% {
        background-color: #79C742;
        -webkit-transform: scale(3);
        opacity: 0;
    }
    60.00001% {
        background-color: #F57B3D;
        -webkit-transform: scale(0);
        opacity: 1;
    }
    80% {
        background-color: #F57B3D;
        -webkit-transform: scale(3);
        opacity: 0;
    }
    80.00001% {
        background-color: #04D9D9;
        -webkit-transform: scale(0);
        opacity: 1;
    }
    100% {
        background-color: #04D9D9;
        -webkit-transform: scale(3);
        opacity: 0;
    }
}
@-moz-keyframes "preloader" {
    0% {
        background-color: #FF007F;
        -moz-transform: scale(0);
        opacity: 1;
    }
    20% {
        background-color: #FF007F;
        -moz-transform: scale(3);
        opacity: 0;
    }
    20.00001% {
        background-color: #3EA7F3;
        -moz-transform: scale(0);
        opacity: 1;
    }
    40% {
        background-color: #3EA7F3;
        -moz-transform: scale(3);
        opacity: 0;
    }
    40.00001% {
        background-color: #79C742;
        -moz-transform: scale(0);
        opacity: 1;
    }
    60% {
        background-color: #79C742;
        -moz-transform: scale(3);
        opacity: 0;
    }
    60.00001% {
        background-color: #F57B3D;
        -moz-transform: scale(0);
        opacity: 1;
    }
    80% {
        background-color: #F57B3D;
        -moz-transform: scale(3);
        opacity: 0;
    }
    80.00001% {
        background-color: #04D9D9;
        -moz-transform: scale(0);
        opacity: 1;
    }
    100% {
        background-color: #04D9D9;
        -moz-transform: scale(3);
        opacity: 0;
    }
}
@keyframes "preloader" {
    0% {
        background-color: #FF007F;
        transform: scale(0);
        opacity: 1;
    }
    20% {
        background-color: #FF007F;
        transform: scale(3);
        opacity: 0;
    }
    20.00001% {
        background-color: #3EA7F3;
        transform: scale(0);
        opacity: 1;
    }
    40% {
        background-color: #3EA7F3;
        transform: scale(3);
        opacity: 0;
    }
    40.00001% {
        background-color: #79C742;
        transform: scale(0);
        opacity: 1;
    }
    60% {
        background-color: #79C742;
        transform: scale(3);
        opacity: 0;
    }
    60.00001% {
        background-color: #F57B3D;
        transform: scale(0);
        opacity: 1;
    }
    80% {
        background-color: #F57B3D;
        transform: scale(3);
        opacity: 0;
    }
    80.00001% {
        background-color: #04D9D9;
        transform: scale(0);
        opacity: 1;
    }
    100% {
        background-color: #04D9D9;
        transform: scale(3);
        opacity: 0;
    }
}
#header-page {
    position: relative;
    height: 80px;
    z-index: 99999;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none
}
#header-page .container {
    height: 100%
}
#header-page .header-page__inner {
    width: 100%;
    height: 80px;
    background-color: #fff;
    -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.15);
    -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.15);
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.15)
}
#header-page .header-page__inner.header-page__fixed {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 9999
}


.awe-navigation {
    position: relative;
    text-align: right;
    /* padding-right: 65px; */
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden
}
.awe-navigation .menu-list {
    font-size: 0;
    list-style: none;
    margin: 0;
    padding: 0
}
.awe-navigation .menu-list li {
    position: relative;
    display: inline-block;
    padding: 0 15px
}
.awe-navigation .menu-list li a {
    display: block;
    font-family: Lato-Light;
    font-weight: 600;
    font-size: 14px;
    color: #67728A;
    line-height: 80px;	
}
.awe-navigation .menu-list li:hover > a,
.awe-navigation .menu-list li.current-menu-parent > a,
.awe-navigation .menu-list li.current-menu-item > a {
    color: #194e91
}
.awe-navigation .menu-list li .sub-menu {
    position: absolute;
    width: 210px;
    list-style: none;
    padding: 0;
    top: 110%;
    left: 0;
    background-color: #fff;
    text-align: left;
    border: 1px solid #d4d4d4;
    opacity: 0;
    visibility: hidden;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.awe-navigation .menu-list li .sub-menu li {
    display: block;
    margin: 0;
    padding: 0 15px
}
.awe-navigation .menu-list li .sub-menu li a {
    line-height: 40px;
    border-bottom: 1px solid #eee
}
.awe-navigation .menu-list li .sub-menu li:last-child > a {
    border-bottom: 0
}
.awe-navigation .menu-list li .sub-menu .sub-menu {
    top: 0;
    right: auto;
    left: -100%
}
.awe-navigation .menu-list li:hover > .sub-menu {
    opacity: 1;
    visibility: visible;
    top: 100%
}
.awe-navigation .menu-list li:hover > .sub-menu .sub-menu {
    top: 0
}
.awe-navigation-responsive {
    position: fixed;
    text-align: left;
    overflow-x: hidden;
    overflow-y: auto;
    top: 0%;
    right: 0;
    padding-top: 60px;
    background-color: #fff;
    max-width: 320px;
    width: 100%;
    border: 1px solid #d4d4d4;
    border-right: 0;
    border-bottom: 0;
    z-index: 99999;
    -webkit-box-shadow: 0 100px 0 0 white;
    -moz-box-shadow: 0 100px 0 0 white;
    box-shadow: 0 100px 0 0 white;
    -webkit-transform: translateX(100%);
    -moz-transform: translateX(100%);
    -ms-transform: translateX(100%);
    -o-transform: translateX(100%);
    transform: translateX(100%);
    -webkit-transition: all 0.5s cubic-bezier(0, 0.67, 0.35, 0.94) 0.3s;
    -moz-transition: all 0.5s cubic-bezier(0, 0.67, 0.35, 0.94) 0.3s;
    -ms-transition: all 0.5s cubic-bezier(0, 0.67, 0.35, 0.94) 0.3s;
    -o-transition: all 0.5s cubic-bezier(0, 0.67, 0.35, 0.94) 0.3s;
    transition: all 0.5s cubic-bezier(0, 0.67, 0.35, 0.94) 0.3s
}
.awe-navigation-responsive.awe-navigation-responsive-active {
    -webkit-transform: translateX(0);
    -moz-transform: translateX(0);
    -ms-transform: translateX(0);
    -o-transform: translateX(0);
    transform: translateX(0)
}
.awe-navigation-responsive .menu-list {
    font-size: 0;
    list-style: none;
    margin: 0;
    padding: 0;
    overflow: hidden
}
.awe-navigation-responsive .menu-list li {
    padding: 0 22px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1)
}
.awe-navigation-responsive .menu-list li:first-child {
    border-top: 1px solid rgba(0, 0, 0, 0.1)
}
.awe-navigation-responsive .menu-list li a {
    display: block;
    font-family: Lato-Light;
    font-weight: 600;
    font-size: 13px;
    color: #67728A;
    line-height: 56px
}
.awe-navigation-responsive .menu-list li a:hover {
    color: #194e91
}
.awe-navigation-responsive .menu-list li.current-menu-parent > a,
.awe-navigation-responsive .menu-list li.current-menu-item > a {
    color: #194e91
}
.awe-navigation-responsive .menu-list li .sub-menu {
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: #fff;
    top: 0;
    left: 0;
    list-style: none;
    padding: 0;
    padding-top: 60px;
    overflow-x: hidden;
    overflow-y: auto;
    -webkit-transform: translateX(100%);
    -moz-transform: translateX(100%);
    -ms-transform: translateX(100%);
    -o-transform: translateX(100%);
    transform: translateX(100%);
    -webkit-transition: all 0.5s cubic-bezier(0, 0.67, 0.35, 0.94);
    -moz-transition: all 0.5s cubic-bezier(0, 0.67, 0.35, 0.94);
    -ms-transition: all 0.5s cubic-bezier(0, 0.67, 0.35, 0.94);
    -o-transition: all 0.5s cubic-bezier(0, 0.67, 0.35, 0.94);
    transition: all 0.5s cubic-bezier(0, 0.67, 0.35, 0.94)
}
.awe-navigation-responsive .menu-list li .sub-menu.sub-menu-active {
    -webkit-transform: translateX(0);
    -moz-transform: translateX(0);
    -ms-transform: translateX(0);
    -o-transform: translateX(0);
    transform: translateX(0);
    z-index: 999
}
.awe-navigation-responsive .menu-list .submenu-toggle {
    position: absolute;
    right: 0;
    width: 56px;
    height: 56px;
    text-align: center;
    cursor: pointer;
    border-left: 1px solid #eee;
    -webkit-transform: translateY(-56px);
    -moz-transform: translateY(-56px);
    -ms-transform: translateY(-56px);
    -o-transform: translateY(-56px);
    transform: translateY(-56px)
}
.awe-navigation-responsive .menu-list .submenu-toggle .fa {
    font-size: 18px;
    line-height: 56px
}
.awe-navigation-responsive .menu-list .submenu-toggle:hover .fa {
    color: #194e91
}
.awe-navigation-responsive .menu-list .back-mb .fa {
    margin-right: 5px
}

.search-box {
    position: absolute;
    top: 0;
    right: 15px;
    white-space: nowrap;
    display: inline-block;
    z-index: 9
}
.search-box .searchtoggle {
    display: inline-block;
    width: 60px;
    height: 60px;
    line-height: 60px;
    font-size: 14px;
    color: #67728A;
    text-align: center;
    border-left: 1px solid #D4D4D4;
    border-right: 1px solid #D4D4D4;
    cursor: pointer;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.search-box .searchtoggle.searchtoggle-active,
.search-box .searchtoggle:hover {
    color: #194e91
}
.search-box .form-search {
    position: absolute;
    width: 200px;
    right: 0;
    top: 110%;
    opacity: 0;
    visibility: hidden;
    -webkit-transition: all 0.3s ease 0.2s;
    -moz-transition: all 0.3s ease 0.2s;
    -ms-transition: all 0.3s ease 0.2s;
    -o-transition: all 0.3s ease 0.2s;
    transition: all 0.3s ease 0.2s
}
.search-box .form-search .form-item input {
    width: 100%;
    height: 80px;
    line-height: 80px;
    font-size: 20px;
    font-weight: 700;
    padding: 0 50px
}
.search-box .form-search.form-active {
    top: 100%;
    opacity: 1;
    visibility: visible;
    z-index: 99;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.toggle-menu-responsive {
    position: absolute;
    display: block;
    width: 60px;
    height: 80px;
    cursor: pointer;
    top: 0;
    right: 0px;
    overflow: hidden;
    border-right: 1px solid #D4D4D4;
    z-index: 9999;
    -webkit-transform: translateZ(0);
    -moz-transform: translateZ(0);
    -ms-transform: translateZ(0);
    -o-transform: translateZ(0);
    transform: translateZ(0)
}
.toggle-menu-responsive .hamburger {
    position: absolute;
    width: 60px;
    height: 16px;
    margin: auto;
    top: 0;
    bottom: 0;
    left: 0;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.toggle-menu-responsive .item {
    position: absolute;
    display: block;
    font-size: 0;
    width: 20px;
    height: 2px;
    background-color: #67728A;
    margin: auto;
    left: 0;
    right: 0;
    overflow: hidden;
    z-index: 1;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden
}
.toggle-menu-responsive .item-1 {
    top: 0;
    -webkit-transform-origin: 0 50%;
    -moz-transform-origin: 0 50%;
    -ms-transform-origin: 0 50%;
    -o-transform-origin: 0 50%;
    transform-origin: 0 50%;
    -webkit-transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26);
    -moz-transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26);
    -ms-transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26);
    -o-transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26);
    transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26)
}
.toggle-menu-responsive .item-2 {
    top: 0;
    bottom: 0;
    -webkit-transition: all 0.4s cubic-bezier(0.28, -0.24, 0.8, -0.13) 0.2s;
    -moz-transition: all 0.4s cubic-bezier(0.28, -0.24, 0.8, -0.13) 0.2s;
    -ms-transition: all 0.4s cubic-bezier(0.28, -0.24, 0.8, -0.13) 0.2s;
    -o-transition: all 0.4s cubic-bezier(0.28, -0.24, 0.8, -0.13) 0.2s;
    transition: all 0.4s cubic-bezier(0.28, -0.24, 0.8, -0.13) 0.2s
}
.toggle-menu-responsive .item-3 {
    bottom: 0;
    -webkit-transform-origin: 0 50%;
    -moz-transform-origin: 0 50%;
    -ms-transform-origin: 0 50%;
    -o-transform-origin: 0 50%;
    transform-origin: 0 50%;
    -webkit-transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26);
    -moz-transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26);
    -ms-transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26);
    -o-transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26);
    transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26)
}
.toggle-menu-responsive.toggle-active .hamburger {
    left: 2px
}
.toggle-menu-responsive.toggle-active .item {
    background-color: #194e91
}
.toggle-menu-responsive.toggle-active .item-1 {
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    transform: rotate(45deg);
    -webkit-transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26) 0.3s;
    -moz-transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26) 0.3s;
    -ms-transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26) 0.3s;
    -o-transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26) 0.3s;
    transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26) 0.3s
}
.toggle-menu-responsive.toggle-active .item-3 {
    -webkit-transform: rotate(-45deg);
    -moz-transform: rotate(-45deg);
    -ms-transform: rotate(-45deg);
    -o-transform: rotate(-45deg);
    transform: rotate(-45deg);
    -webkit-transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26) 0.3s;
    -moz-transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26) 0.3s;
    -ms-transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26) 0.3s;
    -o-transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26) 0.3s;
    transition: all 0.4s cubic-bezier(0.29, 1.2, 0.68, 1.26) 0.3s
}
.toggle-menu-responsive.toggle-active .item-2 {
    -webkit-transform: translateX(-250%);
    -moz-transform: translateX(-250%);
    -ms-transform: translateX(-250%);
    -o-transform: translateX(-250%);
    transform: translateX(-250%);
    -webkit-transition: all 0.4s cubic-bezier(0.28, -0.24, 0.8, -0.13);
    -moz-transition: all 0.4s cubic-bezier(0.28, -0.24, 0.8, -0.13);
    -ms-transition: all 0.4s cubic-bezier(0.28, -0.24, 0.8, -0.13);
    -o-transition: all 0.4s cubic-bezier(0.28, -0.24, 0.8, -0.13);
    transition: all 0.4s cubic-bezier(0.28, -0.24, 0.8, -0.13)
}
.awe-navigation-hamburger .toggle-menu-responsive:hover .item {
    background-color: #194e91
}
.heading-content {
    color: #fff;
    padding: 100px 0 154px 0
}
.heading-content h2 {
    font-size: 36px;
    font-weight: 700;
    text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.3);
    margin-top: 0;
    margin-bottom: 8px;
    color: inherit
}
.heading-content p {
    font-size: 24px;
    margin-bottom: 0
}
.ui-datepicker {
    z-index: 999999999999 !important
}
.tabs {
    font-family: Lato-Light;
    font-size: 14px;
    border: 0;
    padding: 0;
    background: none
}
.tabs .ui-tabs-nav {
    position: relative;
    -webkit-border-radius: 6px 6px 0 0;
    -moz-border-radius: 6px 6px 0 0;
    -ms-border-radius: 6px 6px 0 0;
    -o-border-radius: 6px 6px 0 0;
    border-radius: 6px 6px 0 0;
    overflow: hidden;
    background: none;
    margin-bottom: 22px;
    padding: 0;
    overflow: hidden;
    border: 0;
    z-index: 9
}
.tabs .ui-tabs-nav:after {
    content: '';
    display: block;
    position: absolute;
    width: 100%;
    height: 0;
    left: 0;
    bottom: 0;
    border-bottom: 3px solid #D4D4D4;
    z-index: -1
}
.tabs .ui-tabs-nav li {
    background: none;
    border: 0;
    margin: 0 46px 0 0;
    
}
.tabs .ui-tabs-nav li .ui-tabs-anchor {
    position: relative;
    font-weight: 600;
    font-size: 18px;
    color: #444;
    padding: 0;
    border-bottom: 3px solid transparent;
    line-height: 58px;
    z-index: 9
}
.tabs .ui-tabs-nav li.ui-tabs-active .ui-tabs-anchor {
    color: #194e91;
    border-bottom-color: #194e91
}
.tabs .ui-tabs-panel {
    padding: 0
}
.ui-widget input,
.ui-widget select,
.ui-widget textarea,
.ui-widget button {
    font-family: Lato-Light
}
.tabs__content .ui-tabs-panel {
    padding: 0
}
.ui-widget-content {
    color: #777
}
.awe-search-tabs {
    position: relative;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    -ms-border-radius: 6px;
    -o-border-radius: 6px;
    border-radius: 6px;
    margin-top: -475px;
    z-index: 9999;
	
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
filter: alpha(opacity=80);
-moz-opacity: 0.80;
-khtml-opacity: 0.8;
opacity: 0.8;
}
.awe-search-tabs .ui-tabs-nav {
    position: relative;
    padding: 0 32px;
    height: 55px;
    -webkit-border-radius: 6px 6px 0 0;
    -moz-border-radius: 6px 6px 0 0;
    -ms-border-radius: 6px 6px 0 0;
    -o-border-radius: 6px 6px 0 0;
    border-radius: 6px 6px 0 0;
    overflow: hidden;
    background: none;
    margin: 0;
    border: 0;
    z-index: 9
}
.awe-search-tabs .ui-tabs-nav:after {
    display: none
}
.awe-search-tabs .ui-tabs-nav:before {
    content: '';
    display: block;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: #194e91;
    opacity: .9;
    z-index: -1
}
.awe-search-tabs .ui-tabs-nav li {
    background: none;
    border: 0;
    margin: 0 !important
}
.awe-search-tabs .ui-tabs-nav li .ui-tabs-anchor {
    color: #fff;
    font-size: 18px;
    border-bottom: 0;
    border-left: 1px solid rgba(255, 255, 255, 0.15)
}
.awe-search-tabs .ui-tabs-nav li .ui-tabs-anchor .awe-icon {
    width: 60px;
    height: 55px;
    line-height: 55px;
    text-align: center
}
.awe-search-tabs .ui-tabs-nav li:last-child .ui-tabs-anchor {
    border-right: 1px solid rgba(255, 255, 255, 0.15)
}
.awe-search-tabs .ui-tabs-nav li.ui-tabs-active .ui-tabs-anchor {
    background-color: #fff;
    border-color: #fff;
    color: #194e91
}
.awe-search-tabs .ui-tabs-nav li.ui-tabs-active + li .ui-tabs-anchor {
    border-left-color: #fff
}
.trip-flight-hotel__table {
    min-width: 680px
}
.awe-search-tabs__content {
    background: #fff;
    padding: 32px
}
.awe-search-tabs__content .ui-tabs-panel {
    padding: 0
}
.awe-search-tabs__content .ui-tabs-panel h2 {
    font-weight: 400;
    font-size: 32px;
    color: #666;
    margin: 0
}
.awe-search-tabs__content .ui-tabs-panel label {
    display: block;
    font-size: 16px;
    font-weight: 600;
    color: #666;
    margin-bottom: 8px
}
.awe-search-tabs__content .ui-tabs-panel select,
.awe-search-tabs__content .ui-tabs-panel input {
    border: 1px solid #d4d4d4;
    font-weight: 400;
    color: #68738A;
    height: 36px;
    line-height: 36px;
    width: 100%
}
.awe-search-tabs__content .ui-tabs-panel form:after {
    content: '';
    display: table;
    clear: both
}
.awe-search-tabs__content .ui-tabs-panel .form-group {
    float: left
}
.awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(1) {
    width: 33.2%;
    padding-right: 64px
}
.awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(2) {
    width: 36.5%;
    padding-right: 100px
}
.awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(2) .form-elements {
    width: 50%;
    float: left
}
.awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(2) .form-elements:nth-child(odd) {
    padding-right: 15px
}
.awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(2) .form-elements:nth-child(even) {
    padding-left: 15px
}
.awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(3) {
    width: 18.1%;
    padding-right: 64px
}
.awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(4) {
    width: 80.1%;
    padding-right: 64px
}
.awe-search-tabs__content .ui-tabs-panel .form-elements {
    margin-top: 24px
}
.awe-search-tabs__content .ui-tabs-panel .form-elements .form-item {
    position: relative
}
.awe-search-tabs__content .ui-tabs-panel .form-elements span {
    display: inline-block;
    font-size: 11px;
    font-weight: 600;
    color: #A5A5A5;
    margin-top: 8px
}
.awe-search-tabs__content .ui-tabs-panel .form-elements .awe-icon {
    position: absolute;
    width: 36px;
    height: 34px;
    background-color: #fff;
    line-height: 34px;
    text-align: right;
    top: 1px;
    right: 1px;
    padding-right: 12px;
    font-size: 16px;
    color: #666;
    pointer-events: none
}
.awe-search-tabs__content .ui-tabs-panel .form-elements .awe-select-wrapper {
    width: 100%
}
.awe-search-tabs__content .ui-tabs-panel .form-elements .awe-select-wrapper .fa {
    top: 1px;
    bottom: 1px;
    right: 1px
}
.awe-search-tabs__content .ui-tabs-panel .form-actions {
    width: 12.2%;
    float: left;
    margin-top: 55px
}
.awe-search-tabs__content .ui-tabs-panel .form-actions input {
    position: relative;
    display: block;
    background-color: #194e91;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    border: 0;
    line-height: normal;
    padding: 8px 15px;
    padding-bottom: 10px;
    -webkit-box-shadow: inset 0 -2px 0 0 rgba(0, 0, 0, 0.3);
    -moz-box-shadow: inset 0 -2px 0 0 rgba(0, 0, 0, 0.3);
    box-shadow: inset 0 -2px 0 0 rgba(0, 0, 0, 0.3);
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    -o-border-radius: 3px;
    border-radius: 3px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.awe-search-tabs__content .ui-tabs-panel.search-bus .form-group:nth-child(1),
.awe-search-tabs__content .ui-tabs-panel.search-car .form-group:nth-child(1) {
    width: 40%
}
.awe-search-tabs__content .ui-tabs-panel.search-bus .form-group:nth-child(2),
.awe-search-tabs__content .ui-tabs-panel.search-car .form-group:nth-child(2) {
    width: 45%;
    padding-right: 64px
}
.awe-search-tabs-2 {
    position: absolute;
    z-index: 9999;
    left: 15px;
    right: 15px;
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    transform: translateY(-100%)
}
.awe-search-tabs-2 .awe-search-tabs__content {
    background: none;
    background-color: rgba(0, 0, 0, 0.8);
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    -ms-border-radius: 0;
    -o-border-radius: 0;
    border-radius: 0
}
.awe-search-tabs-2 .ui-tabs-nav {
    margin-bottom: 0;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    -ms-border-radius: 0;
    -o-border-radius: 0;
    border-radius: 0
}
.awe-search-tabs-2 .ui-tabs-nav:after {
    display: none
}
.awe-search-tabs-2 .ui-tabs-nav li {
    margin: 0 1px 0 0 !important;
    padding: 0 !important
}
.awe-search-tabs-2 .ui-tabs-nav li .ui-tabs-anchor {
    padding: 0 15px;
    min-width: 120px;
    text-align: center;
    font-size: 14px;
    font-weight: 600;
    color: #666;
    background-color: #fff;
    line-height: 43px !important;
    border: 0
}
.awe-search-tabs-2 .ui-tabs-nav li.ui-tabs-active .ui-tabs-anchor {
    background-color: rgba(0, 0, 0, 0.8);
    color: #fff
}
.awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-elements,
.awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-actions {
    margin: 0
}
.awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(1) {
    width: 40%;
    padding-right: 0
}
.awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(1) .form-elements {
    width: calc(50% - 30px);
    float: left;
    margin-right: 30px
}
.awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(2) {
    width: 30%;
    padding-right: 18px
}
.awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(2) .form-elements:nth-child(odd) {
    padding-right: 1px
}
.awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(2) .form-elements:nth-child(even) {
    padding-left: 1px
}
.awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(3) {
    width: 16.5%;
    padding-right: 18px
}
.awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel.search-hotel .form-group:nth-child(1) {
    padding-right: 30px
}
.awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel.search-hotel .form-group:nth-child(1) .form-elements {
    width: 100%;
    margin-right: 0
}
.awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel.search-car .form-group:nth-child(1) {
    width: 57%
}
.awe-services {
    margin-bottom: 10px
}
.awe-services h2 {
    font-weight: 400;
    font-size: 32px;
    color: #194e91;
    line-height: 1.3em;
    margin-top: 0
}
.awe-services .video-wrapper {
    margin-top: 30px
}
.awe-services__list {
    list-style: none;
    margin: 0;
    padding: 0
}
.awe-services__list li {
    position: relative;
    font-family: Lato-Light;
    font-weight: 700;
    font-size: 16px;
    color: #666;
    padding: 24px 40px 24px 54px;
    border-bottom: 2px dotted #A1ADB9
}
.awe-services__list li:last-child {
    border: 0
}
.awe-services__list li .awe-icon-check {
    position: absolute;
    width: 34px;
    height: 34px;
    text-align: center;
    line-height: 30px;
    border: 2px solid #D4D4D4;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
    font-size: 12px;
    left: 0;
    color: #194e91;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.awe-services__list li .awe-icon-arrow-right {
    position: absolute;
    height: 34px;
    line-height: 34px;
    right: 0;
    font-size: 12px;
    color: #A6A6A6;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.awe-services__list li span {
    display: block;
    font-weight: 400;
    font-size: 13px;
    color: #ABABAB;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap
}
.awe-services__list li a {
    display: block;
    color: inherit;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap
}
.awe-services__list li:hover .awe-icon-check {
    background-color: #194e91;
    border-color: #194e91;
    color: #fff
}
.awe-services__list li:hover .awe-icon-arrow-right {
    color: #194e91
}
.destination-grid-content .section-title {
    text-align: center;
    margin-bottom: 30px
}
.destination-grid-content .section-title h3 {
    font-size: 24px;
    font-weight: 400;
    color: #2C4661;
    line-height: 1.8em;
    margin-top: 0
}
.destination-grid-content .section-title h3 a {
    display: inline-block;
    color: #194e91;
    border-bottom: 1px dashed
}
.destination-grid-content .row {
    margin: -15px
}
.destination-grid-content .more-destination {
    position: relative;
    z-index: 9;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    -ms-border-radius: 4px;
    -o-border-radius: 4px;
    border-radius: 4px;
    overflow: hidden;
    margin-top: 30px;
    background-position: 50% 50%;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -ms-background-size: cover;
    -o-background-size: cover;
    background-size: cover
}
.destination-grid-content .more-destination:before {
    content: '';
    display: block;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: #194e91;
    opacity: .9;
    z-index: -2
}
.destination-grid-content .more-destination:after {
    content: '';
    display: block;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: -1;
    opacity: .6;
    background: -moz-linear-gradient(top, transparent 0%, rgba(0, 0, 0, 0.4) 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, transparent), color-stop(100%, rgba(0, 0, 0, 0.4)));
    background: -webkit-linear-gradient(top, transparent 0%, rgba(0, 0, 0, 0.4) 100%);
    background: -o-linear-gradient(top, transparent 0%, rgba(0, 0, 0, 0.4) 100%);
    background: -ms-linear-gradient(top, transparent 0%, rgba(0, 0, 0, 0.4) 100%);
    background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.4) 100%);
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.destination-grid-content .more-destination a {
    display: block;
    text-align: center;
    line-height: 60px;
    font-size: 20px;
    color: #fff
}
.destination-grid-content .more-destination:hover:after {
    opacity: 1
}
.awe-masonry .awe-masonry__item {
    position: relative;
    width: 25%;
    z-index: 9
}
.awe-masonry .awe-masonry__item:nth-child(3) {
    width: 50%
}
.awe-masonry .awe-masonry__item:nth-child(3) .item-title {
    top: 45px;
    left: 45px
}
.awe-masonry .awe-masonry__item:nth-child(3) .item-available {
    bottom: 45px;
    right: 45px
}
.awe-masonry .awe-masonry__item > a {
    position: relative;
    display: block;
    overflow: hidden
}
.awe-masonry .awe-masonry__item > a:after {
    content: '';
    display: block;
    position: absolute;
    width: 100%;
    height: 100%;
    background: url(../images/overlay-gallery.png) no-repeat;
    background-color: transparent;
    background-size: 100% 100%;
    border: 15px solid #f7f7f7;
    top: 0;
    left: 0;
    -webkit-transition: all 0.3s linear;
    -moz-transition: all 0.3s linear;
    -ms-transition: all 0.3s linear;
    -o-transition: all 0.3s linear;
    transition: all 0.3s linear
}
.awe-masonry .awe-masonry__item:hover > a:after {
    background-color: rgba(0, 0, 0, 0.6)
}
.awe-masonry .awe-masonry__item .item-title {
    position: absolute;
    top: 30px;
    left: 30px
}
.awe-masonry .awe-masonry__item .item-title h2 {
    font-size: 32px;
    font-weight: 400;
    color: #fff;
    margin: 0;
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3)
}
.awe-masonry .awe-masonry__item .item-title h2 a:hover {
    color: #194e91
}
.awe-masonry .awe-masonry__item .item-cat ul {
    list-style: none;
    padding: 0;
    margin: 0;
    font-size: 0
}
.awe-masonry .awe-masonry__item .item-cat ul li {
    display: inline-block;
    margin-top: 5px;
    margin-right: 5px
}
.awe-masonry .awe-masonry__item .item-cat ul li a {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #68738A;
    background-color: rgba(255, 255, 255, 0.7);
    padding: 2px 6px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -ms-border-radius: 2px;
    -o-border-radius: 2px;
    border-radius: 2px
}
.awe-masonry .awe-masonry__item .item-cat ul li a:hover {
    background-color: #194e91;
    color: #fff
}
.awe-masonry .awe-masonry__item .item-available {
    position: absolute;
    color: #fff;
    font-size: 12px;
    text-align: right;
    bottom: 30px;
    right: 30px
}
.awe-masonry .awe-masonry__item .item-available .count {
    display: block;
    font-weight: 700;
    font-size: 24px
}
.awe-masonry.item-1 .awe-masonry__item {
    width: 100%
}
.awe-masonry.item-1 .awe-masonry__item .item-title {
    top: 45px;
    left: 45px
}
.awe-masonry.item-1 .awe-masonry__item .item-available {
    bottom: 45px;
    right: 45px
}
.awe-masonry.item-2 .awe-masonry__item {
    width: 50%
}
.awe-masonry.item-3 .awe-masonry__item {
    width: 33.3333333333%
}
.awe-masonry.item-3 .awe-masonry__item:nth-child(2) {
    width: 66.6666666666%
}
.awe-masonry.item-3 .awe-masonry__item:nth-child(2) .item-title {
    top: 45px;
    left: 45px
}
.awe-masonry.item-3 .awe-masonry__item:nth-child(2) .item-available {
    bottom: 45px;
    right: 45px
}
.awe-masonry.item-4 .awe-masonry__item:nth-child(3) {
    width: 50%
}
.awe-masonry.item-4 .awe-masonry__item:nth-child(4) {
    width: 50%
}
.awe-masonry.item-4 .awe-masonry__item:nth-child(4) .item-title {
    top: 45px;
    left: 45px
}
.awe-masonry.item-4 .awe-masonry__item:nth-child(4) .item-available {
    bottom: 45px;
    right: 45px
}
.awe-masonry.item-4 .awe-masonry__item:nth-child(4) .image-wrap {
    padding-top: 50%
}
.awe-masonry.item-5 .awe-masonry__item:nth-child(3) {
    width: 50%
}
.awe-masonry.item-5 .awe-masonry__item:nth-child(3) .item-title {
    top: 45px;
    left: 45px
}
.awe-masonry.item-5 .awe-masonry__item:nth-child(3) .item-available {
    bottom: 45px;
    right: 45px
}
.awe-masonry.item-6 .awe-masonry__item:nth-child(4),
.awe-masonry.item-6 .awe-masonry__item:nth-child(5),
.awe-masonry.item-6 .awe-masonry__item:nth-child(6) {
    width: 50%
}
.awe-masonry.item-6 .awe-masonry__item:nth-child(4) .item-title,
.awe-masonry.item-6 .awe-masonry__item:nth-child(5) .item-title,
.awe-masonry.item-6 .awe-masonry__item:nth-child(6) .item-title {
    top: 45px;
    left: 45px
}
.awe-masonry.item-6 .awe-masonry__item:nth-child(4) .item-available,
.awe-masonry.item-6 .awe-masonry__item:nth-child(5) .item-available,
.awe-masonry.item-6 .awe-masonry__item:nth-child(6) .item-available {
    bottom: 45px;
    right: 45px
}
.awe-masonry.item-6 .awe-masonry__item:nth-child(4) .image-wrap,
.awe-masonry.item-6 .awe-masonry__item:nth-child(5) .image-wrap,
.awe-masonry.item-6 .awe-masonry__item:nth-child(6) .image-wrap {
    padding-top: 50%
}
.awe-masonry.item-7 .awe-masonry__item:nth-child(3) {
    width: 50%
}
.awe-masonry.item-7 .awe-masonry__item:nth-child(6),
.awe-masonry.item-7 .awe-masonry__item:nth-child(7) {
    width: 50%
}
.awe-masonry.item-7 .awe-masonry__item:nth-child(6) .item-title,
.awe-masonry.item-7 .awe-masonry__item:nth-child(7) .item-title {
    top: 45px;
    left: 45px
}
.awe-masonry.item-7 .awe-masonry__item:nth-child(6) .item-available,
.awe-masonry.item-7 .awe-masonry__item:nth-child(7) .item-available {
    bottom: 45px;
    right: 45px
}
.awe-masonry.item-7 .awe-masonry__item:nth-child(6) .image-wrap,
.awe-masonry.item-7 .awe-masonry__item:nth-child(7) .image-wrap {
    padding-top: 50%
}
.awe-masonry.item-8 .awe-masonry__item:nth-child(3) {
    width: 50%
}
.awe-masonry.item-8 .awe-masonry__item:nth-child(6) {
    width: 50%
}
.awe-masonry.item-8 .awe-masonry__item:nth-child(6) .item-title {
    top: 45px;
    left: 45px
}
.awe-masonry.item-8 .awe-masonry__item:nth-child(6) .item-available {
    bottom: 45px;
    right: 45px
}
.awe-masonry.item-8 .awe-masonry__item:nth-child(6) .image-wrap {
    padding-top: 50%
}
.awe-masonry.item-9 .awe-masonry__item:nth-child(3) {
    width: 50%
}
.awe-masonry.item-9 .awe-masonry__item:nth-child(3) .item-title {
    top: 45px;
    left: 45px
}
.awe-masonry.item-9 .awe-masonry__item:nth-child(3) .item-available {
    bottom: 45px;
    right: 45px
}
.sale-flights-tabs__content .ui-tabs-panel {
    overflow: hidden;
    overflow-x: auto
}
.sale-flights-tabs__table {
    width: 100%;
    min-width: 650px;
    overflow: hidden
}
.sale-flights-tabs__table tr {
    display: block;
    background-color: #fff;
    border: 0 !important;
    margin-bottom: 10px;
    -webkit-box-shadow: inset 0 0 0 2px transparent;
    -moz-box-shadow: inset 0 0 0 2px transparent;
    box-shadow: inset 0 0 0 2px transparent;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.sale-flights-tabs__table tr td {
    vertical-align: top;
    padding: 28px 10px;
    min-width: 98px
}
.sale-flights-tabs__table tr td .title {
    margin-top: -4px
}
.sale-flights-tabs__table tr td .title h3 {
    margin: 0;
    font-size: 20px;
    color: #194e91;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap
}
.sale-flights-tabs__table tr td ul {
    list-style: none;
    padding: 0;
    margin: 0
}
.sale-flights-tabs__table tr td ul li {
    padding: 4px 0;
    font-size: 13px
}
.sale-flights-tabs__table tr td ul li .from .awe-icon {
    font-size: 9px;
    margin: 0 5px
}
.sale-flights-tabs__table tr .sale-flights-tabs__item-flight {
    position: relative;
    padding-left: 24px;
    width: 290px
}
.sale-flights-tabs__table tr .sale-flights-tabs__item-flight .image-wrap {
    width: 40px;
    height: 40px;
    overflow: hidden;
    border: 1px solid #DDDDDD;
    float: left;
    margin-right: 14px
}
.sale-flights-tabs__table tr .sale-flights-tabs__item-flight .td-content {
    overflow: hidden
}
.sale-flights-tabs__table tr .sale-flights-tabs__item-depart h4,
.sale-flights-tabs__table tr .sale-flights-tabs__item-arrive h4,
.sale-flights-tabs__table tr .sale-flights-tabs__item-duration h4 {
    font-size: 13px;
    color: #222;
    margin-top: 0
}
.sale-flights-tabs__table tr .sale-flights-tabs__item-choose {
    position: relative;
    padding-left: 30px;
    padding-right: 24px;
    width: 170px
}
.sale-flights-tabs__table tr .sale-flights-tabs__item-choose:after {
    content: '';
    display: block;
    position: absolute;
    left: 0;
    top: 15px;
    bottom: 15px;
    border-left: 2px dotted #ddd;
    width: 0
}
.sale-flights-tabs__table tr .sale-flights-tabs__item-choose .amount {
    display: block;
    font-size: 24px;
    font-weight: 700;
    color: #194e91;
    margin-top: -10px;
    margin-bottom: 15px
}
.sale-flights-tabs__table tr:hover {
    -webkit-box-shadow: inset 0 0 0 2px #194e91;
    -moz-box-shadow: inset 0 0 0 2px #194e91;
    box-shadow: inset 0 0 0 2px #194e91
}
.trip-flight-hotel-tabs {
    margin-bottom: 7px
}
.trip-flight-hotel-tabs .ui-tabs-nav:after {
    display: none
}
.trip-flight-hotel-tabs .ui-tabs-nav li .ui-tabs-anchor {
    border-bottom: 0;
    color: #67728A;
    font-size: 14px;
    font-weight: 400;
    line-height: 34px
}
.trip-flight-hotel-tabs .ui-tabs-panel {
    overflow: hidden;
    overflow-x: auto
}
.trip-flight-hotel__table {
    min-width: 680px
}
.trip-flight-hotel__table tbody tr {
    background-color: #fff;
    border-bottom: 5px solid #f7f7f7
}
.trip-flight-hotel__table tbody tr .item-media {
    position: relative;
    width: 190px;
    padding: 12px 18px 12px 12px
}
.trip-flight-hotel__table tbody tr .item-media .image-cover {
    padding-top: 63.52%
}
.trip-flight-hotel__table tbody tr .item-media .sale {
    display: inline-block;
    position: absolute;
    font-weight: 600;
    font-size: 12px;
    color: #fff;
    padding: 0 5px;
    line-height: 18px;
    -webkit-border-radius: 0 3px 3px 0;
    -moz-border-radius: 0 3px 3px 0;
    -ms-border-radius: 0 3px 3px 0;
    -o-border-radius: 0 3px 3px 0;
    border-radius: 0 3px 3px 0;
    top: 20px;
    left: 0;
    background-color: #72BF4E
}
.trip-flight-hotel__table tbody tr .item-media .item-format {
    position: absolute;
    font-size: 16px;
    color: #fff;
    width: 30px;
    height: 30px;
    text-align: center;
    line-height: 30px;
    margin: auto;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    opacity: 0;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.trip-flight-hotel__table tbody tr .item-media .item-format a {
    color: inherit
}
.trip-flight-hotel__table tbody tr .item-body {
    padding: 12px 33px 12px 12px;
    vertical-align: top
}
.trip-flight-hotel__table tbody tr .item-title {
    margin-bottom: 4px
}
.trip-flight-hotel__table tbody tr .item-title h2 {
    font-size: 18px;
    margin: 0
}
.trip-flight-hotel__table tbody tr .item-title h2 a {
    color: #667287
}
.trip-flight-hotel__table tbody tr .item-description {
    font-weight: 600;
    font-size: 12px;
    color: #A5A5A5
}
.trip-flight-hotel__table tbody tr .item-description p {
    line-height: 1.5em
}
.trip-flight-hotel__table tbody tr .item-body-inner {
    position: relative;
    padding-right: 100px
}
.trip-flight-hotel__table tbody tr .item-price {
    min-width: 130px;
    padding: 15px;
    text-align: center;
    background-color: transparent;
    border-left: 2px dotted #E2E2E2;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.trip-flight-hotel__table tbody tr .item-price .price {
    font-style: italic;
    font-size: 13px;
    color: #68738C;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.trip-flight-hotel__table tbody tr .item-price .price .amount {
    display: block;
    font-weight: 600;
    font-style: normal;
    font-size: 24px
}
.trip-flight-hotel__table tbody tr .item-price a {
    display: inline-block;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    -o-border-radius: 3px;
    border-radius: 3px;
    background-color: #E2E2E2;
    padding: 0 18px;
    line-height: 24px;
    margin-top: 15px;
    font-size: 12px;
    font-weight: 600
}
.trip-flight-hotel__table tbody tr .item-rate {
    position: absolute;
    font-weight: 600;
    font-size: 16px;
    color: #68738A;
    top: 0;
    right: 0;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.trip-flight-hotel__table tbody tr:hover .item-title h2 a {
    color: #194e91
}
.trip-flight-hotel__table tbody tr:hover .item-rate {
    color: #194e91
}
.trip-flight-hotel__table tbody tr:hover .item-price {
    background-color: #194e91
}
.trip-flight-hotel__table tbody tr:hover .item-price .price {
    color: #fff
}
.trip-flight-hotel__table tbody tr:hover .item-price a {
    background-color: #fff;
    color: #194e91
}
.breadcrumb {
    position: relative;
    border-radius: 0;
    margin: 0;
    padding: 10px 0;
    background: none;
    z-index: 9
}
.breadcrumb:after {
    content: '';
    display: block;
    position: absolute;
    width: 20000px;
    height: 100%;
    top: 0;
    left: 50%;
    background-color: rgba(255, 255, 255, 0.8);
    -webkit-transform: translateX(-50%);
    -moz-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    -o-transform: translateX(-50%);
    transform: translateX(-50%);
    z-index: -1
}
.breadcrumb ul {
    font-size: 0;
    list-style: none;
    padding: 0;
    margin: 0
}
.breadcrumb ul li {
    display: inline-block;
    font-weight: 600;
    font-size: 13px
}
.breadcrumb ul li a {
    position: relative;
    display: block;
    color: #666;
    margin-right: 32px
}
.breadcrumb ul li a:after {
    content: '';
    display: inline-block;
    position: absolute;
    width: 0;
    height: 0;
    border: 6px solid transparent;
    border-left-color: #ddd;
    -webkit-transform: scaleY(0.6);
    -moz-transform: scaleY(0.6);
    -ms-transform: scaleY(0.6);
    -o-transform: scaleY(0.6);
    transform: scaleY(0.6);
    margin: auto;
    top: 0;
    bottom: 0;
    right: -25px
}
.breadcrumb ul li a:hover {
    color: #194e91
}
.breadcrumb ul li:last-child a:after {
    display: none
}
.breadcrumb ul li span {
    color: #194e91
}
.category-heading-content {
    padding-top: 280px;
    padding-bottom: 30px
}
.category-heading-content.category-heading-content__2 {
    padding-top: 140px
}
.category-heading-content > h3 {
    display: inline-block;
    font-weight: 400;
    font-size: 16px;
    color: #fff;
    background-color: #194e91;
    padding: 0 16px;
    line-height: 1.8em;
    margin: 0;
    letter-spacing: 0.05em
}
.category-heading-content > h2 {
    position: relative;
    display: inline-block;
    background-color: #fff;
    color: #194e91;
    font-weight: 400;
    font-size: 24px;
    line-height: normal;
    padding: 0 94px 0 24px;
    line-height: 70px;
    margin: 0;
    letter-spacing: 0.25em
}
.category-heading-content > h2 .awe-icon {
    position: absolute;
    top: 0;
    right: 0;
    width: 70px;
    height: 70px;
    text-align: center;
    line-height: 70px;
    background-color: #eee
}
.category-heading-content .breadcrumb {
    position: absolute;
    top: 0;
    left: 15px;
    right: 15px;
    background: none;
    z-index: 9
}
.category-heading-content .find {
    text-transform: none
}
.category-heading-content .find h2 {
    font-size: 48px;
    font-weight: 700;
    color: #fff;
    text-transform: capitalize;
    text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.3);
    margin-top: 0;
    margin-bottom: 0
}
.category-heading-content .find form {
    margin-top: 38px;
    padding: 30px 40px;
    background-color: rgba(0, 0, 0, 0.8)
}
.category-heading-content .find .form-group {
    overflow: hidden;
    margin-bottom: 0
}
.category-heading-content .find .form-elements {
    float: left
}
.category-heading-content .find .form-elements:nth-child(1) {
    width: 25%;
    padding-right: 32px
}
.category-heading-content .find .form-elements:nth-child(2) {
    width: 25%;
    padding-right: 32px
}
.category-heading-content .find .form-elements:nth-child(3) {
    width: 16.5%;
    padding-right: 30px
}
.category-heading-content .find .form-elements:nth-child(4) {
    width: 16.5%;
    padding-right: 40px
}
.category-heading-content .find .form-elements:nth-child(5) {
    width: 21.3%;
    padding-right: 40px
}
.category-heading-content .find .form-elements label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    margin-bottom: 8px
}
.category-heading-content .find .form-elements input,
.category-heading-content .find .form-elements select {
    line-height: 36px;
    height: 36px;
    width: 100%
}
.category-heading-content .find .form-elements .form-item {
    position: relative
}
.category-heading-content .find .form-elements span {
    display: inline-block;
    font-size: 11px;
    font-weight: 600;
    color: #A5A5A5;
    margin-top: 8px
}
.category-heading-content .find .form-elements .awe-icon {
    position: absolute;
    width: 36px;
    height: 34px;
    background-color: #fff;
    line-height: 34px;
    text-align: right;
    top: 1px;
    right: 1px;
    padding-right: 12px;
    font-size: 16px;
    color: #666;
    pointer-events: none
}
.category-heading-content .find .form-elements .awe-select-wrapper {
    width: 100%
}
.category-heading-content .find .form-actions {
    margin-top: 28px
}
.category-heading-content .find .form-actions input {
    position: relative;
    display: block;
    background-color: #194e91;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    padding: 8px 15px;
    border: 0;
    min-width: 170px;
    text-align: center;
    line-height: normal;
    padding-bottom: 10px;
    -webkit-box-shadow: inset 0 -2px 0 0 rgba(0, 0, 0, 0.3);
    -moz-box-shadow: inset 0 -2px 0 0 rgba(0, 0, 0, 0.3);
    box-shadow: inset 0 -2px 0 0 rgba(0, 0, 0, 0.3);
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    -o-border-radius: 3px;
    border-radius: 3px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
#footer-page {
    background-color: #1E1E1F;
    padding-top: 10px;
    font-size: 13px;
    color: #EDEDED
}
#footer-page .widget {
    margin-bottom: 15px;
margin-top:10px;
}
#footer-page .widget h3 {
    font-weight: 700;
    font-size: 18px;
    color: #194e91;
    margin-top: 0;
    margin-bottom: 15px
}
#footer-page .widget ul {
    list-style: none;
    margin: 0;
    padding: 0
}
#footer-page .widget_rss ul li a,
#footer-page .widget_meta ul li a,
#footer-page .widget_pages ul li a,
#footer-page .widget_nav_menu ul li a,
#footer-page .widget_categories ul li a,
#footer-page .widget_recent_entries ul li a,
#footer-page .widget_archive ul li a {
    font-size: 13px;
    color: #EDEDED;
    line-height: 1.8em
}

.widget_categories ul li a{
    font-weight:normal;
}

.widget_recent_entries ul li a{
    font-weight:normal;
}

#footer-page .widget_rss ul li a:hover,
#footer-page .widget_meta ul li a:hover,
#footer-page .widget_pages ul li a:hover,
#footer-page .widget_nav_menu ul li a:hover,
#footer-page .widget_categories ul li a:hover,
#footer-page .widget_recent_entries ul li a:hover,
#footer-page .widget_archive ul li a:hover {
    color: #194e91
}
#footer-page .widget_rss ul ul,
#footer-page .widget_meta ul ul,
#footer-page .widget_pages ul ul,
#footer-page .widget_nav_menu ul ul,
#footer-page .widget_categories ul ul,
#footer-page .widget_recent_entries ul ul,
#footer-page .widget_archive ul ul {
    margin-left: 8px
}
#footer-page .widget_recent_comments ul li span {
    font-size: 13px;
    color: #EDEDED;
    line-height: 1.8em
}
#footer-page .widget_recent_comments ul li span a {
    color: inherit
}
#footer-page .widget_recent_comments ul li span a:hover {
    color: #194e91
}
#footer-page .widget_follow_us .widget_content p {
    font-size: 15px
}
#footer-page .widget_follow_us .widget_content .phone {
    font-family: "Oswald", sans-serif;
    font-size: 22px;
    font-weight: 400;
    color: #194e91;
    letter-spacing: 0.02em
}
#footer-page .awe-social {
    font-size: 0;
    margin-left: -7px;
    margin-right: -7px;
    margin-top: 35px
}
#footer-page .awe-social a {
    display: inline-block;
    margin: 7px
}
#footer-page .awe-social a .fa {
    width: 34px;
    height: 34px;
    text-align: center;
    line-height: 34px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
    color: #fff;
    font-size: 16px
}
#footer-page .awe-social a:hover {
    opacity: 1 !important
}
#footer-page .awe-social:hover a {
    opacity: .5
}
#footer-page .awe-social .fa-twitter {
    background-color: #77CBEF
}
#footer-page .awe-social .fa-pinterest {
    background-color: #E95554
}
#footer-page .awe-social .fa-facebook {
    background-color: #537ABC
}
#footer-page .awe-social .fa-youtube-play {
    background-color: #E96349
}
#footer-page .widget_contact_info {
    position: relative;
    z-index: 9;
    padding: 46px 30px 20px 30px;
    margin-top: -50px;
    margin-right: 30px
}
#footer-page .widget_contact_info:before,
#footer-page .widget_contact_info:after {
    content: '';
    display: block;
    position: absolute;
    width: 0;
    height: 0;
    border: solid transparent;
    border-width: 20px 10px;
    border-left-color: #194e91;
    border-bottom-color: #194e91;
    top: 0;
    right: 1px;
    -webkit-transform: translateX(100%);
    -moz-transform: translateX(100%);
    -ms-transform: translateX(100%);
    -o-transform: translateX(100%);
    transform: translateX(100%);
    z-index: -4
}
#footer-page .widget_contact_info:after {
    border-left-color: rgba(0, 0, 0, 0.3) !important;
    border-bottom-color: rgba(0, 0, 0, 0.3) !important;
    z-index: -3
}
#footer-page .widget_contact_info .widget_background {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    overflow: hidden;
    z-index: -1
}
#footer-page .widget_contact_info .widget_background__half {
    position: absolute;
    width: 50%;
    height: 105%;
    overflow: hidden;
    top: -10%;
    left: 0;
    z-index: -1;
    -webkit-transform: skewY(10deg);
    -moz-transform: skewY(10deg);
    -ms-transform: skewY(10deg);
    -o-transform: skewY(10deg);
    transform: skewY(10deg)
}
#footer-page .widget_contact_info .widget_background__half .bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 200%;
    height: 100%;
    background-position: 50% 50%;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -ms-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    -webkit-transform: skewY(-10deg);
    -moz-transform: skewY(-10deg);
    -ms-transform: skewY(-10deg);
    -o-transform: skewY(-10deg);
    transform: skewY(-10deg)
}
#footer-page .widget_contact_info .widget_background__half:after {
    content: '';
    display: block;
    position: absolute;
    width: 100%;
    height: 102%;
    top: 0;
    left: 0;
    background-color: #194e91;
    opacity: .85;
    z-index: 9
}
#footer-page .widget_contact_info .widget_background__half:nth-child(2) {
    left: auto;
    right: 0;
    -webkit-transform: skewY(-10deg);
    -moz-transform: skewY(-10deg);
    -ms-transform: skewY(-10deg);
    -o-transform: skewY(-10deg);
    transform: skewY(-10deg)
}
#footer-page .widget_contact_info .widget_background__half:nth-child(2) .bg {
    top: 0;
    left: auto;
    right: 0;
    -webkit-transform: skewY(10deg);
    -moz-transform: skewY(10deg);
    -ms-transform: skewY(10deg);
    -o-transform: skewY(10deg);
    transform: skewY(10deg)
}
#footer-page .widget_contact_info .widget_content {
    color: #fff;
    /* margin-top: 50px */
}
#footer-page .widget_contact_info .widget_content p {
    margin-bottom: 25px
}
#footer-page .widget_contact_info .widget_content a {
    color: inherit
}
#footer-page .widget_contact_info .widget_content a:hover {
    color: inherit;
    text-decoration: underline
}
#footer-page .copyright {
    text-align: center;
    padding: 10px 0
}
.blog-heading-content {
    padding-top: 116px;
    padding-bottom: 68px
}
.blog-heading-content h2 {
    display: inline-block;
    background-color: #194e91;
    color: #fff;
    padding: 19px 28px;
    margin: 0;
    line-height: normal;
    font-weight: 400;
    font-size: 24px;
    letter-spacing: 0.25em
}
.blog-page {
    margin-top: 47px
}
.related-post,
.blog-page__content {
    margin-top: 37px;
    margin-bottom: 84px
}
.related-post .post,
.blog-page__content .post {
    padding-bottom: 35px;
    margin-bottom: 35px;
    border-bottom: 1px solid #d4d4d4;
    overflow: hidden
}
.related-post .post .post-media,
.blog-page__content .post .post-media {
    width: 270px;
    float: left;
    margin-right: 30px
}
.related-post .post .post-media .image-style,
.blog-page__content .post .post-media .image-style {
    position: relative;
    overflow: hidden;
    padding-top: 67%;
    -webkit-transform: translateZ(0);
    -moz-transform: translateZ(0);
    -ms-transform: translateZ(0);
    -o-transform: translateZ(0);
    transform: translateZ(0)
}
.related-post .post .post-media .image-style img,
.blog-page__content .post .post-media .image-style img {
    position: absolute;
    width: 100%;
    max-width: none !important;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%)
}
.related-post .post .post-body,
.blog-page__content .post .post-body {
    overflow: hidden
}
.related-post .post .post-meta,
.blog-page__content .post .post-meta {
    font-style: italic;
    font-size: 0
}
.related-post .post .post-meta > div,
.blog-page__content .post .post-meta > div {
    display: inline-block;
    font-size: 13px
}
.related-post .post .post-meta > div + div:before,
.blog-page__content .post .post-meta > div + div:before {
    content: '\//';
    display: inline-block;
    margin-left: 5px;
    margin-right: 5px
}
.related-post .post .post-meta .cat ul,
.blog-page__content .post .post-meta .cat ul {
    display: inline-block;
    list-style: none;
    padding: 0;
    margin: 0
}
.related-post .post .post-meta .cat ul li a:after,
.blog-page__content .post .post-meta .cat ul li a:after {
    content: '\, '
}
.related-post .post .post-meta .cat ul li:last-child a:after,
.blog-page__content .post .post-meta .cat ul li:last-child a:after {
    display: none
}
.related-post .post .post-meta a,
.blog-page__content .post .post-meta a {
    color: inherit
}
.related-post .post .post-meta a:hover,
.blog-page__content .post .post-meta a:hover {
    color: #194e91
}
.related-post .post .post-title h2,
.blog-page__content .post .post-title h2 {
    font-size: 24px;
    color: #194e91;
    margin-top: 0;
    margin-bottom: 5px
}
.related-post .post .post-title h2 a,
.blog-page__content .post .post-title h2 a {
    display: block;
    color: inherit;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap
}
.related-post .post .post-title h2 a:hover,
.blog-page__content .post .post-title h2 a:hover {
    color: inherit;
    opacity: .6
}
.related-post .post .post-title h1,
.blog-page__content .post .post-title h1 {
    font-size: 40px;
    font-weight: 600;
    color: #262626;
    margin-top: 0;
    margin-bottom: 18px
}
.related-post .post .post-content,
.blog-page__content .post .post-content {
    margin-bottom: 32px;
    color: #666
}
.page__pagination {
    font-size: 0;
    margin-left: -6px;
    margin-right: -6px
}
.page__pagination span,
.page__pagination a {
    display: inline-block;
    font-size: 13px;
    font-weight: 600;
    color: #666;
    min-width: 36px;
    height: 36px;
    line-height: 36px;
    text-align: center;
    padding: 0 10px;
    background-color: #fff;
    border-radius: 1px;
    margin: 6px
}
.page__pagination .pagination-prev,
.page__pagination .pagination-next {
    font-size: 16px
}
.page__pagination .current,
.page__pagination a:hover {
    background-color: #194e91;
    color: #fff
}
.awe-social {
    font-size: 0
}
.awe-social a {
    display: inline-block;
    font-size: 14px;
    margin-right: 15px;
    margin-bottom: 5px
}
.awe-social a .fa {
    width: 34px;
    height: 34px;
    text-align: center;
    line-height: 34px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
    color: #fff
}
.awe-social a:hover {
    opacity: 0.6
}
.fa.fa-twitter {
}
.fa.fa-pinterest {
    background-color: #E95554
}
.fa.fa-facebook {
}
.fa.fa-youtube-play {
    background-color: #E96349
}
.fa.fa-google-plus {
}
body.single-post .blog-page__content > .post .post-media {
    width: 100%;
    float: none
}
body.single-post .blog-page__content > .post .post-content {
    margin-top: 25px
}
.post-footer {
    margin-left: -15px;
    margin-right: -15px
}
.post-footer > div {
    width: 33.3333333333%;
    float: left;
    padding-left: 15px;
    padding-right: 15px
}
.post-footer > div h4 {
    font-size: 16px;
    color: #333
}
.post-footer .share-box .share {
    font-size: 0;
    margin-left: -8px;
    margin-right: -8px
}
.post-footer .share-box .share a {
    display: inline-block;
    margin: 4px 8px
}
.post-footer .share-box .share a .fa {
    display: block;
    width: 30px;
    height: 30px;
    text-align: center;
    line-height: 30px;
    font-size: 14px;
    color: #fff;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.post-footer .share-box .share a .count {
    display: block;
    font-size: 14px;
    color: #666;
    text-align: center;
    margin-top: 5px
}
.post-footer .share-box .share a:hover .fa {
    opacity: .6
}
.post-footer .cat-box .cat,
.post-footer .tag-box .tag {
    font-size: 0;
    margin-left: -4px;
    margin-right: -4px
}
.post-footer .cat-box .cat a,
.post-footer .tag-box .tag a {
    display: inline-block;
    font-weight: 600;
    font-size: 12px !important;
    color: #666;
    padding: 3px 10px;
    background-color: #ddd;
    margin: 4px
}
.post-footer .cat-box .cat a:hover,
.post-footer .tag-box .tag a:hover {
    color: #fff;
    background-color: #194e91
}
.about-author {
    position: relative;
    border-bottom: 1px solid #D4D4D4;
    overflow: hidden;
    padding-bottom: 35px;
    margin-bottom: 35px
}
.about-author .image-thumb {
    width: 70px;
    overflow: hidden
}
.about-author .image-thumb .image-cover {
    overflow: hidden;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    -ms-border-radius: 6px;
    -o-border-radius: 6px;
    border-radius: 6px
}
.about-author .author-title h4 {
    font-size: 16px;
    color: #262626;
    margin-top: 0;
    text-shadow: none;
    line-height: 1.2em
}
.about-author .author-name {
    margin-top: 4px
}
.about-author .author-name h3 {
    font-size: 24px;
    font-weight: 400;
    color: #262626;
    margin-top: 0;
    text-shadow: none;
    line-height: 1.2em
}
.about-author .author-info {
    margin-left: 100px
}
.about-author .author-social {
    margin-left: -8px;
    margin-right: -8px
}
.about-author .author-social a {
    display: inline-block;
    margin: 4px 8px
}
.about-author .author-social a .fa {
    display: block;
    width: 30px;
    height: 30px;
    text-align: center;
    line-height: 30px;
    font-size: 14px;
    color: #fff;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.about-author .author-social a:hover .fa {
    opacity: .6
}
.related-post {
    margin-top: 0;
    margin-bottom: 35px;
    padding-bottom: 35px;
    border-bottom: 1px solid #D4D4D4
}
.related-post h4 {
    font-weight: 700;
    font-size: 24px;
    margin-top: 0
}
.related-post .post {
    border: 0;
    margin: 0;
    padding: 0
}
.related-post .owl-carousel .owl-controls {
    margin: 0
}
.related-post .owl-carousel .owl-controls .owl-buttons {
    bottom: auto;
    top: -12px;
    right: 0;
    -webkit-transform: translateY(-100%);
    -moz-transform: translateY(-100%);
    -ms-transform: translateY(-100%);
    -o-transform: translateY(-100%);
    transform: translateY(-100%)
}
#respond {
    margin-bottom: 50px
}
#respond .row {
    margin-left: -15px;
    margin-right: -15px
}
#respond .reply-title h4 {
    font-weight: 700;
    font-size: 24px;
    margin-top: 0;
    margin-bottom: 0
}
#respond .form-item {
    margin: 15px 0;
    display: inline-block;
    width: 100%
}
#respond .form-item textarea {
    width: 100%;
    height: 120px
}
#respond .form-item input {
    width: 100%
}
#respond .form-actions {
    margin: 15px 0
}
#respond .form-actions input {
    width: 100%;
    text-align: center;
    font-weight: 600;
    color: #fff;
    background-color: #194e91;
    border: 0;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    -o-border-radius: 3px;
    border-radius: 3px;
    padding: 0 20px;
    height: 40px;
    line-height: 40px;
    z-index: 9;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
#respond .form-actions input:hover {
    opacity: .7
}
#comments {
    margin-bottom: 30px
}
#comments a {
    color: inherit
}
#comments .commentlist {
    margin: 0;
    padding: 0;
    list-style: none
}
#comments .commentlist > .comment .comment-box {
    border-bottom: 1px solid #d4d4d4
}
#comments .commentlist > .comment:last-child .comment-box {
    border-bottom: 0
}
#comments .commentlist .comment-author {
    float: left;
    width: 40px;
    height: 40px;
    overflow: hidden;
    margin-right: 26px
}
#comments .commentlist .comment-author img {
    width: 100%
}
#comments .commentlist .comment-body {
    position: relative;
    overflow: hidden;
    font-size: 13px;
    color: #666
}
#comments .commentlist .comment-body p {
    margin-top: 5px;
    margin-bottom: 0
}
#comments .commentlist .children {
    margin: 0;
    padding: 0;
    list-style: none;
    margin-left: 70px
}
#comments cite.fn {
    display: block;
    font-size: 18px;
    font-weight: 600;
    margin-top: 0
}
#comments cite.fn a {
    color: #333
}
#comments cite.fn a:hover {
    color: #194e91
}
#comments cite.fn .byauthor {
    display: inline-block;
    font-family: "Lato", sans-serif;
    font-size: 12px;
    font-weight: 700;
    color: #a6a6a6;
    margin-left: 24px
}
#comments .comment-meta {
    margin-top: 12px;
    font-size: 14px;
    color: #a6a6a6
}
#comments .comment-box {
    position: relative;
    padding-top: 30px;
    padding-bottom: 30px
}
#comments .comment-abs {
    position: absolute;
    display: inline-block;
    font-size: 0;
    bottom: -4px;
    right: 0
}
#comments .comment-abs a {
    display: inline-block;
    font-weight: 600;
    font-size: 12px !important;
    color: #666;
    padding: 3px 10px;
    background-color: #ddd;
    margin: 4px
}
#comments .comment-abs a:hover {
    color: #fff;
    background-color: #194e91
}
.login-register-page__content {
    max-width: 390px;
    width: 100%;
    float: right;
    padding: 63px 0 135px 0
}
.register-page{
	max-width: 890px;	
}
.login-register-page__content .content-title span {
    font-size: 24px;
    color: #fff;
    line-height: 1.1em;
        font-weight:bold;
}
.login-register-page__content .content-title h2 {
    margin: 0;
    font-weight: 700;
    font-size: 60px;
    line-height: 1.1em
}
.login-register-page__content form {
    position: relative;
    overflow: hidden;
    margin-top: 22px;
    padding: 34px 50px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    -ms-border-radius: 5px;
    -o-border-radius: 5px;
    border-radius: 5px;
    z-index: 9
}
.login-register-page__content form:after {
    content: '';
    display: block;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: #fff;
    opacity: .8;
    z-index: -1
}
.login-register-page__content form .form-item {
    margin-bottom: 12px
}
.login-register-page__content form .form-item label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #666
}
.login-register-page__content form .form-item input {
    width: 100%
}
.login-register-page__content form .terms-conditions,
.login-register-page__content form .forgot-password {
    float: left;
    margin-top: 30px;
    font-size: 12px;
    font-weight: 600;
    color: #666;
    text-decoration: underline;
    max-width: 160px;
	    margin-left: -90px;
}
.login-register-page__content form .terms-conditions:hover,
.login-register-page__content form .forgot-password:hover {
    color: #194e91
}
.login-register-page__content form .terms-conditions {
    margin-top: 18px
}
.login-register-page__content form .form-actions {
    margin-top: 18px;
    float: right
}
.login-register-page__content form .form-actions input {
    width: 100%;
    text-align: center;
    font-weight: 600;
    color: #fff;
    background-color: #194e91;
    border: 0;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    -ms-border-radius: 4px;
    -o-border-radius: 4px;
    border-radius: 4px;
    padding: 0 20px;
    height: 40px;
    line-height: 40px;
    z-index: 9;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.login-register-page__content form .form-actions input:hover {
    opacity: .7
}
.login-register-page__content .login-register-link {
    background-color: #262626;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    -ms-border-radius: 6px;
    -o-border-radius: 6px;
    border-radius: 6px;
    font-size: 14px;
    color: #f2f2f2;
    text-align: center;
    padding: 16px 0;
    margin-top: 20px
}
.login-register-page__content .login-register-link a {
    color: inherit
}
.login-register-page__content .login-register-link a:hover {
    color: #194e91
}
.contact-page__form {
    padding-top: 82px;
    padding-bottom: 120px
}
.contact-page__form .title span {
    font-size: 24px;
    color: #8f8f8f
}
.contact-page__form .title h2 {
    color: #194e91;
    font-weight: 700;
    font-size: 60px;
    line-height: 1.1em;
    margin-top: 5px
}
.contact-page__form .descriptions {
    color: #666
}
.contact-form {
    margin-left: -15px;
    margin-right: -15px;
    overflow: hidden
}
.contact-form .form-item {
    width: 50%;
    padding: 15px;
    float: left
}
.contact-form .form-item input {
    width: 100%;
    border: 1px solid #eee;
    background-color: #eee
}
.contact-form .form-textarea-wrapper {
    width: 100%;
    padding: 15px;
    float: left
}
.contact-form .form-textarea-wrapper textarea {
    width: 100%;
    border: 1px solid #eee;
    background-color: #eee
}
.contact-form .form-captcha {
    position: relative
}
.contact-form .form-captcha .wpcf7-captchac {
    position: absolute;
    padding: 15px 0;
    top: 8px;
    left: 22px
}
.contact-form .form-captcha .wpcf7-form-control-wrap {
    display: block
}
.contact-form .form-captcha input {
    padding-left: 90px
}
.contact-form .form-actions {
    width: 100%;
    padding: 15px;
    float: left
}
.contact-form .form-actions input {
    width: 100%;
    max-width: 100px;
    text-align: center;
    font-weight: 600;
    color: #fff;
    background-color: #194e91;
    border: 0;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    -o-border-radius: 3px;
    border-radius: 3px;
    padding: 0 20px;
    height: 40px;
    line-height: 40px;
    z-index: 9;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.contact-form .form-actions input:hover {
    opacity: .7
}
.contact-page__map {
    min-height: 300px
}
.travelling-block {
    background-color: rgba(255, 255, 255, 0.9);
    padding: 45px;
    margin: 70px 0;
    min-height: 410px;
    -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1)
}
.travelling-block .title h2 {
    margin: 0;
    font-weight: 400;
    font-size: 36px
}
.travelling-tabs {
    margin-top: 10px
}
.travelling-tabs .ui-tabs-nav:after {
    display: none
}
.travelling-tabs .ui-tabs-nav li {
    float: none;
    display: inline-block;
    margin: 10px 8px 0
}
.travelling-tabs .ui-tabs-nav li .ui-tabs-anchor {
    -webkit-border-radius: 16px;
    -moz-border-radius: 16px;
    -ms-border-radius: 16px;
    -o-border-radius: 16px;
    border-radius: 16px;
    border: 2px solid #D4D4D4;
    line-height: 30px;
    padding: 0 18px;
    font-size: 14px;
    font-weight: 600;
    color: #A6A6A6
}
.travelling-tabs .ui-tabs-nav li.ui-tabs-active .ui-tabs-anchor {
    color: #fff !important;
    border-color: #194e91;
    background-color: #194e91
}
.travelling-tabs .ui-tabs-nav li.ui-state-hover .ui-tabs-anchor {
    border-color: #666;
    color: #666
}
.travelling-tabs .ui-tabs-panel {
    overflow: hidden;
    overflow-x: auto
}
.purpose-slider {
    padding: 0 95px
}
.purpose-slider .item {
    text-align: center;
    padding: 30px 15px 25px
}
.purpose-slider .item > a {
    display: block
}
.purpose-slider .item .awe-icon {
    position: relative;
    width: 70px;
    height: 70px;
    text-align: center;
    line-height: 70px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
    background-color: #fff;
    font-size: 30px;
    color: #194e91;
    margin-bottom: 8px;
    z-index: 9;
    -webkit-transition: all 0.4s ease;
    -moz-transition: all 0.4s ease;
    -ms-transition: all 0.4s ease;
    -o-transition: all 0.4s ease;
    transition: all 0.4s ease
}
.purpose-slider .item .awe-icon:after {
    content: '';
    display: block;
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: #194e91;
    top: 0;
    left: 0;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
    z-index: -1;
    opacity: 0;
    -webkit-transform: scale(1.2);
    -moz-transform: scale(1.2);
    -ms-transform: scale(1.2);
    -o-transform: scale(1.2);
    transform: scale(1.2);
    -webkit-transition: all 0.4s ease;
    -moz-transition: all 0.4s ease;
    -ms-transition: all 0.4s ease;
    -o-transition: all 0.4s ease;
    transition: all 0.4s ease
}
.purpose-slider .item span {
    display: block;
    font-weight: 600;
    font-size: 13px;
    color: #262626
}
.purpose-slider .item:hover .awe-icon {
    color: #fff
}
.purpose-slider .item:hover .awe-icon:after {
    opacity: 1;
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1)
}
.purpose-slider .owl-controls .owl-buttons {
    position: static
}
.purpose-slider .owl-controls .owl-buttons > div {
    position: absolute;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%)
}
.purpose-slider .owl-controls .owl-buttons > div .fa {
    background: none;
    font-size: 22px
}
.purpose-slider .owl-controls .owl-buttons > div.owl-prev {
    left: 0
}
.purpose-slider .owl-controls .owl-buttons > div.owl-next {
    right: 0
}
.travelling-tabs__region {
    padding-top: 22px;
    padding-bottom: 15px
}
.travelling-tabs__region .item {
    display: inline-block;
    text-align: center;
    padding: 10px 20px
}
.travelling-tabs__region .item > a {
    display: inline-block
}
.travelling-tabs__region .item .awe-icon {
    font-size: 80px;
    opacity: .5;
    color: #666;
    margin-bottom: 18px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.travelling-tabs__region .item span {
    display: block;
    font-weight: 600;
    font-size: 13px;
    color: #666;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.travelling-tabs__region .item:hover .awe-icon {
    color: #194e91;
    opacity: 1
}
.travelling-tabs__region .item:hover span {
    color: #194e91
}
.travelling-tabs__price {
    max-width: 570px;
    margin: auto;
    text-align: left;
    overflow: hidden;
    padding-top: 32px;
    padding-bottom: 25px
}
.travelling-tabs__price .budget-level {
    width: 64%;
    float: left;
    padding-right: 35px
}
.travelling-tabs__price .currency {
    width: 36%;
    float: left;
    padding-left: 35px
}
.travelling-tabs__price .currency .awe-select-wrapper {
    width: 100%;
    margin-top: -8px
}
.travelling-tabs__price .currency .awe-select-wrapper select {
    width: 100%;
    height: 34px;
    line-height: 34px;
    color: #a5a5a5
}
.travelling-tabs__price .currency span {
    display: block;
    font-size: 13px;
    color: #666;
    margin-top: 5px
}
.travelling-tabs__price .budget-level label,
.travelling-tabs__price .currency label {
    display: block;
    font-weight: 600;
    font-size: 16px;
    color: #666;
    margin-top: 0;
    margin-bottom: 18px
}
.travelling-tabs__price .budget-level {
    position: relative
}
.travelling-tabs__price .budget-level .range-slider-wrapper {
    margin-top: 24px
}
.travelling-tabs__price .price_slider_amount {
    position: absolute;
    top: 0;
    right: 35px;
    font-weight: 600;
    font-size: 16px;
    color: #666
}
.travelling-tabs__time {
    max-width: 730px;
    min-width: 645px;
    margin: auto;
    padding-top: 5px
}
.travelling-tabs__time .season .item {
    display: inline-block;
    text-align: center;
    padding: 0 40px
}
.travelling-tabs__time .season .item a {
    display: inline-block
}
.travelling-tabs__time .season .item a .awe-icon {
    width: 70px;
    height: 70px;
    text-align: center;
    line-height: 70px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
    color: #194e91;
    font-size: 32px;
    background-color: #fff;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.travelling-tabs__time .season .item a span {
    display: block;
    font-weight: 600;
    font-size: 13px;
    color: #262626;
    margin-top: 12px
}
.travelling-tabs__time .season .item.hover-active a .awe-icon {
    background-color: #194e91;
    color: #fff
}
.travelling-tabs__time .month {
    margin-top: 28px;
    overflow: hidden
}
.travelling-tabs__time .month .item {
    position: relative;
    display: inline-block;
    text-align: center;
    float: left;
    width: 8.3333333333%
}
.travelling-tabs__time .month .item:after {
    content: '';
    display: block;
    position: absolute;
    width: calc(100% - 15px);
    height: 0;
    border-top: 3px dotted #194e91;
    opacity: .3;
    top: 3px;
    left: 60%
}
.travelling-tabs__time .month .item:last-child:after {
    display: none
}
.travelling-tabs__time .month .item a {
    position: relative;
    display: block;
    font-weight: 600;
    font-size: 13px;
    color: #262626;
    padding-top: 24px
}
.travelling-tabs__time .month .item a:before {
    content: '';
    display: block;
    position: absolute;
    width: 10px;
    height: 10px;
    border: 2px solid #194e91;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
    margin: auto;
    top: 0;
    left: 0;
    right: 0;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.travelling-tabs__time .month .item.hover-active a {
    color: #194e91
}
.travelling-tabs__time .month .item.hover-active a:before {
    background-color: #194e91
}
.travelling-tabs__advance-filter {
    text-align: left
}
.travelling-tabs__advance-filter .form-group {
    width: 33.3333333333%;
    float: left;
    padding-left: 25px;
    padding-right: 25px
}
.travelling-tabs__advance-filter .form-elements {
    padding-top: 12px;
    padding-bottom: 12px
}
.travelling-tabs__advance-filter label {
    display: block;
    font-weight: 600;
    font-size: 14px;
    color: #262626;
    margin-top: 0;
    margin-bottom: 8px
}
.travelling-tabs__advance-filter .currency .awe-select-wrapper {
    width: 100%;
    max-width: 138px
}
.travelling-tabs__advance-filter .currency .awe-select-wrapper select {
    width: 100%;
    height: 34px;
    line-height: 34px;
    color: #a5a5a5
}
.travelling-tabs__advance-filter .currency span {
    display: block;
    font-size: 13px;
    color: #666;
    margin-top: 5px
}
.travelling-tabs__advance-filter .budget-level {
    position: relative
}
.travelling-tabs__advance-filter .budget-level .range-slider-wrapper {
    margin-top: 24px
}
.travelling-tabs__advance-filter .price-slider-wrapper {
    padding-top: 15px;
    padding-bottom: 15px
}
.travelling-tabs__advance-filter .price_slider_amount {
    position: absolute;
    top: 0;
    right: 0;
    font-weight: 600;
    font-size: 13px;
    color: #444
}
.travelling-tabs__advance-filter .form-elements select,
.travelling-tabs__advance-filter .form-elements input {
    width: 100%;
    height: 36px;
    line-height: 36px
}
.travelling-tabs__advance-filter .form-elements .form-item {
    position: relative
}
.travelling-tabs__advance-filter .form-elements.form-checkin,
.travelling-tabs__advance-filter .form-elements.form-checkout {
    width: 43%;
    float: left
}
.travelling-tabs__advance-filter .form-elements.form-checkin {
    margin-right: 7%
}
.travelling-tabs__advance-filter .form-elements.form-checkout {
    margin-left: 7%
}
.travelling-tabs__advance-filter .form-elements.form-references {
    clear: both
}
.travelling-tabs__advance-filter .form-elements .awe-icon {
    position: absolute;
    width: 34px;
    height: 34px;
    background-color: #fff;
    line-height: 34px;
    text-align: right;
    top: 1px;
    right: 1px;
    padding-right: 12px;
    font-size: 16px;
    color: #666;
    pointer-events: none
}
.travelling-tabs__advance-filter .form-elements .awe-select-wrapper {
    width: 100%
}
.your-destinations .your-destionations__top {
    overflow: hidden;
    margin-bottom: 38px
}
.your-destinations .title {
    float: left
}
.your-destinations .title h2 {
    font-weight: 400;
    font-size: 24px;
    color: #444;
    margin: 0
}
.your-destinations .your-destinations__bar {
    float: right
}
.your-destinations .your-destinations__bar .view-switcher {
    float: left;
    padding: 0 10px
}
.your-destinations .your-destinations__bar .view-switcher .view-item {
    float: left;
    padding: 10px
}
.your-destinations .your-destinations__bar .view-switcher .view-item a {
    color: #666
}
.your-destinations .your-destinations__bar .view-switcher .view-item a:hover {
    color: #194e91
}
.your-destinations .your-destinations__bar .view-switcher .view-item.view-active a {
    color: #194e91
}
.your-destinations .your-destinations__bar .order {
    float: left
}
.your-destinations .your-destinations__bar .order select {
    width: 170px;
    height: 36px;
    line-height: 36px;
    color: #A5A5A5;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -ms-border-radius: 2px;
    -o-border-radius: 2px;
    border-radius: 2px
}
.your-destinations .page__pagination {
    margin-top: 31px
}
.your-destinations .page__pagination span,
.your-destinations .page__pagination a {
    background-color: #fff
}
.your-destinations .page__pagination .current,
.your-destinations .page__pagination a:hover {
    background-color: #194e91;
    color: #fff
}
.destination-list__content {
    width: 100%
}
.destination-list__content .destinations-item {
    background-color: #fff;
    overflow: hidden;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    margin-bottom: 20px
}
.destination-list__content .destinations-item .item-media {
    position: relative;
    width: 24%;
    float: left
}
.destination-list__content .destinations-item .item-media .image-cover {
    padding-top: 62.96%;
    overflow: hidden
}
.destination-list__content .destinations-item .item-media .item-cat {
    position: absolute;
    top: 5px;
    left: 10px
}
.destination-list__content .destinations-item .item-media .item-cat ul {
    list-style: none;
    padding: 0;
    margin: 0;
    font-size: 0
}
.destination-list__content .destinations-item .item-media .item-cat ul li {
    display: inline-block;
    margin-top: 5px;
    margin-right: 5px
}
.destination-list__content .destinations-item .item-media .item-cat ul li a {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #fff;
    background-color: rgba(38, 38, 38, 0.8);
    padding: 2px 6px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -ms-border-radius: 2px;
    -o-border-radius: 2px;
    border-radius: 2px
}
.destination-list__content .destinations-item .item-media .item-cat ul li a:hover {
    background-color: #194e91;
    color: #fff
}
.destination-list__content .destinations-item .item-body {
    padding: 18px 34px;
    width: 61%;
    float: left
}
.destination-list__content .destinations-item .item-body .item-title h2 {
    margin: 0;
    font-size: 24px;
    font-weight: 400
}
.destination-list__content .destinations-item .item-body .item-title h2 a {
    display: block;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    color: #666
}
.destination-list__content .destinations-item .item-body .item-title h2 a:hover {
    color: #194e91
}
.destination-list__content .destinations-item .item-body .item-description {
    font-size: 13px;
    font-weight: 400;
    color: #444
}
.destination-list__content .destinations-item .item-body .item-footer {
    margin-top: 18px
}
.destination-list__content .destinations-item .item-body .item-footer ul {
    list-style: none;
    padding: 0;
    margin: 0
}
.destination-list__content .destinations-item .item-body .item-footer ul li {
    display: inline-block;
    margin-right: 60px
}
.destination-list__content .destinations-item .item-body .item-footer ul li h6 {
    font-size: 12px;
    font-weight: 700;
    color: #444;
    margin-top: 0;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.destination-list__content .destinations-item .item-body .item-footer ul li > p {
    font-size: 18px;
    color: #444;
    margin-bottom: 0
}
.destination-list__content .destinations-item .item-body .item-footer ul li > p .awe-icon {
    font-size: 20px;
    margin-right: 2px
}
.destination-list__content .destinations-item .item-price-more {
    position: relative;
    padding: 20px 30px;
    width: 15%;
    float: left
}
.destination-list__content .destinations-item .item-price-more:after {
    content: '';
    display: block;
    position: absolute;
    width: 0;
    top: 22px;
    bottom: 22px;
    left: 0;
    border-left: 2px dotted #D4D4D4
}
.destination-list__content .destinations-item .item-price-more .price {
    font-style: italic;
    font-size: 14px;
    color: #444;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.destination-list__content .destinations-item .item-price-more .price ins {
    text-decoration: none
}
.destination-list__content .destinations-item .item-price-more .price .amount {
    display: block;
    font-weight: 700;
    font-style: normal;
    font-size: 24px;
    color: #666;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.destination-list__content .destinations-item .item-price-more a {
    margin-top: 36px
}
.destination-list__content .destinations-item:hover {
    -webkit-box-shadow: 0 0 0 2px #194e91;
    -moz-box-shadow: 0 0 0 2px #194e91;
    box-shadow: 0 0 0 2px #194e91
}
.destination-list__content .destinations-item:hover .item-body .item-title h2 a {
    color: #194e91
}
.destination-list__content .destinations-item:hover .item-body .item-footer ul li h6 {
    color: #194e91
}
.destination-list__content .destinations-item:hover .item-price-more .price {
    color: #194e91
}
.destination-list__content .destinations-item:hover .item-price-more .price .amount {
    color: #194e91
}
.page-top {
    overflow: hidden;
    margin-top: 40px
}
.page-top .list-link {
    float: left;
    font-size: 0;
    list-style: none;
    margin: 0 -10px;
    padding: 0
}
.page-top .list-link li {
    display: inline-block;
    margin: 8px 10px
}
.page-top .list-link li a {
    position: relative;
    display: block;
    font-size: 14px;
    font-weight: 400;
    color: #666;
    padding-left: 23px
}
.page-top .list-link li a:before {
    content: '';
    display: block;
    position: absolute;
    width: 14px;
    height: 14px;
    border: 2px solid #A6A6A6;
    margin: auto;
    left: 0;
    top: 0;
    bottom: 0
}
.page-top .list-link li a:hover {
    color: #194e91
}
.page-top .list-link li a:hover:before {
    border-color: #194e91
}
.page-top .list-link li.current a {
    color: #194e91
}
.page-top .list-link li.current a:before {
    border-color: #194e91
}
.page-top .list-link li.current a:after {
    content: '';
    display: block;
    position: absolute;
    width: 6px;
    height: 6px;
    background-color: #194e91;
    margin: auto;
    top: 0;
    bottom: 0;
    left: 4px
}
.page-top .awe-select-wrapper {
    float: right
}
.page-top .awe-select-wrapper .awe-select {
    min-width: 170px;
    line-height: 36px;
    height: 36px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -ms-border-radius: 2px;
    -o-border-radius: 2px;
    border-radius: 2px
}
.filter-page {
    margin-bottom: 0px
}
.filter-page__content {
    margin-bottom: 150px
}
.filter-item-wrapper {
    width: 99.8%;
    margin-top: 0;
}
.flight-item,
.trip-item,
.attraction-item,
.hotel-item {
    background-color: #fff;
    overflow: hidden;
    margin-bottom: 9px;
    min-height: 169px; position:relative;
    
    margin-top: 2px;
        border: 1px solid #f5f5f5;
    -webkit-box-shadow: 3px 3px 5px 0px rgb(241, 241, 241);
    -moz-box-shadow: 3px 3px 5px 0px rgb(241, 241, 241);
    box-shadow: 3px 3px 5px 0px rgb(241, 241, 241);
}
.flight-item .item-media,
.trip-item .item-media,
.attraction-item .item-media,
.hotel-item .item-media {
    position: relative;
    width: 30%;
    float: left
}
.flight-item .item-media .image-cover,
.trip-item .item-media .image-cover,
.attraction-item .item-media .image-cover,
.hotel-item .item-media .image-cover {
    padding-top: 66.66%;
    overflow: hidden
}
.flight-item .item-media .trip-icon,
.trip-item .item-media .trip-icon,
.attraction-item .item-media .trip-icon,
.hotel-item .item-media .trip-icon {
    position: absolute;
    width: 40px;
    height: 40px;
    overflow: hidden;
    top: 0;
    left: 14px
}
.flight-item .item-body,
.trip-item .item-body,
.attraction-item .item-body,
.hotel-item .item-body {
    position: relative;
    padding: 5px 15px;
        
    width: 48%;
    float: left;
    overflow: hidden;
    overflow-x: auto
}
.flight-item .item-body .item-title h2,
.trip-item .item-body .item-title h2,
.attraction-item .item-body .item-title h2,
.hotel-item .item-body .item-title h2 {
    margin: 0;
    font-size: 20px;
    font-weight: 600
}
.flight-item .item-body .item-title h2 a,
.trip-item .item-body .item-title h2 a,
.attraction-item .item-body .item-title h2 a,
.hotel-item .item-body .item-title h2 a {
    display: block;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    color: #222
}
.flight-item .item-body .item-title h2 a:hover,
.trip-item .item-body .item-title h2 a:hover,
.attraction-item .item-body .item-title h2 a:hover,
.hotel-item .item-body .item-title h2 a:hover {
    color: #194e91
}
.flight-item .item-body .item-hotel-star,
.trip-item .item-body .item-hotel-star,
.attraction-item .item-body .item-hotel-star,
.hotel-item .item-body .item-hotel-star {
    font-size: 11px;
    color: #FFD34E;
    padding-bottom:7px;
}
.flight-item .item-body .item-address,
.trip-item .item-body .item-address,
.attraction-item .item-body .item-address,
.hotel-item .item-body .item-address {
    font-weight: 600;
    font-size: 13px;
    color: #666;
    margin-top: 0px
}
.flight-item .item-body .item-list ul,
.trip-item .item-body .item-list ul,
.attraction-item .item-body .item-list ul,
.hotel-item .item-body .item-list ul {
    margin: 5px 0 0;
    padding-left: 16px;
    color: #666
}
.flight-item .item-body .item-table,
.trip-item .item-body .item-table,
.attraction-item .item-body .item-table,
.hotel-item .item-body .item-table {
    width: 100%;
    min-width: 440px;
    font-weight: 600;
    font-size: 13px;
    margin-top: 14px
}
.flight-item .item-body .item-table thead tr th,
.trip-item .item-body .item-table thead tr th,
.attraction-item .item-body .item-table thead tr th,
.hotel-item .item-body .item-table thead tr th {
    font-weight: 600;
    color: #666
}
.flight-item .item-body .item-table thead tr th.depart,
.flight-item .item-body .item-table thead tr th.arrive,
.flight-item .item-body .item-table thead tr th.duration,
.trip-item .item-body .item-table thead tr th.depart,
.trip-item .item-body .item-table thead tr th.arrive,
.trip-item .item-body .item-table thead tr th.duration,
.attraction-item .item-body .item-table thead tr th.depart,
.attraction-item .item-body .item-table thead tr th.arrive,
.attraction-item .item-body .item-table thead tr th.duration,
.hotel-item .item-body .item-table thead tr th.depart,
.hotel-item .item-body .item-table thead tr th.arrive,
.hotel-item .item-body .item-table thead tr th.duration {
    width: 90px;
    padding-left: 20px
}
.flight-item .item-body .item-table tbody tr td,
.trip-item .item-body .item-table tbody tr td,
.attraction-item .item-body .item-table tbody tr td,
.hotel-item .item-body .item-table tbody tr td {
    font-weight: 600;
    vertical-align: top;
    padding: 6px 0
}
.flight-item .item-body .item-table tbody tr td.depart,
.flight-item .item-body .item-table tbody tr td.arrive,
.flight-item .item-body .item-table tbody tr td.duration,
.trip-item .item-body .item-table tbody tr td.depart,
.trip-item .item-body .item-table tbody tr td.arrive,
.trip-item .item-body .item-table tbody tr td.duration,
.attraction-item .item-body .item-table tbody tr td.depart,
.attraction-item .item-body .item-table tbody tr td.arrive,
.attraction-item .item-body .item-table tbody tr td.duration,
.hotel-item .item-body .item-table tbody tr td.depart,
.hotel-item .item-body .item-table tbody tr td.arrive,
.hotel-item .item-body .item-table tbody tr td.duration {
    width: 90px;
    padding-left: 20px
}
.flight-item .item-body .item-table tbody tr td ul,
.trip-item .item-body .item-table tbody tr td ul,
.attraction-item .item-body .item-table tbody tr td ul,
.hotel-item .item-body .item-table tbody tr td ul {
    list-style: none;
    margin: 0;
    padding: 0
}
.flight-item .item-body .item-table tbody tr td ul li,
.trip-item .item-body .item-table tbody tr td ul li,
.attraction-item .item-body .item-table tbody tr td ul li,
.hotel-item .item-body .item-table tbody tr td ul li {
    display: inline-block
}
.flight-item .item-body .item-table tbody tr td ul li .awe-icon,
.trip-item .item-body .item-table tbody tr td ul li .awe-icon,
.attraction-item .item-body .item-table tbody tr td ul li .awe-icon,
.hotel-item .item-body .item-table tbody tr td ul li .awe-icon {
    font-size: 10px;
    margin-left: 5px;
    margin-right: 5px
}
.flight-item .item-body .item-table tbody tr td ul li:last-child .awe-icon,
.trip-item .item-body .item-table tbody tr td ul li:last-child .awe-icon,
.attraction-item .item-body .item-table tbody tr td ul li:last-child .awe-icon,
.hotel-item .item-body .item-table tbody tr td ul li:last-child .awe-icon {
    display: none
}
.flight-item .item-body .item-table tbody tr td .date,
.trip-item .item-body .item-table tbody tr td .date,
.attraction-item .item-body .item-table tbody tr td .date,
.hotel-item .item-body .item-table tbody tr td .date {
    display: block;
    font-size: 11px;
    color: #666
}
.flight-item .item-body .item-footer,
.trip-item .item-body .item-footer,
.attraction-item .item-body .item-footer,
.hotel-item .item-body .item-footer {
    margin-top: 35px;
    overflow: hidden
}
.flight-item .item-body .item-footer .item-rate,
.trip-item .item-body .item-footer .item-rate,
.attraction-item .item-body .item-footer .item-rate,
.hotel-item .item-body .item-footer .item-rate {
    float: left;
    font-size: 18px;
    font-weight: 700;
    color: #B1B1B1
}
.flight-item .item-body .item-footer .item-icon,
.trip-item .item-body .item-footer .item-icon,
.attraction-item .item-body .item-footer .item-icon,
.hotel-item .item-body .item-footer .item-icon {
    float: right;
    color: #666
}
.flight-item .item-body .item-footer .item-icon .awe-icon,
.trip-item .item-body .item-footer .item-icon .awe-icon,
.attraction-item .item-body .item-footer .item-icon .awe-icon,
.hotel-item .item-body .item-footer .item-icon .awe-icon {
    font-size: 13px;
    margin-left: 15px
}
.flight-item .item-price-more,
.trip-item .item-price-more,
.attraction-item .item-price-more,
.hotel-item .item-price-more {
    position: relative;
    padding: 0 0px;
    margin: 10px 0 0 0;
    width: 22%;
    border-left: 1px dotted #ccc;
    float: right;
    overflow: hidden
}
.flight-item .item-price-more:after,
.trip-item .item-price-more:after,
.attraction-item .item-price-more:after,
.hotel-item .item-price-more:after {
    content: '';
    display: block;
    position: absolute;
    width: 0;
    top: 0;
    bottom: 0;
    left: 0;
  
}
.flight-item .item-price-more .price,
.trip-item .item-price-more .price,
.attraction-item .item-price-more .price,
.hotel-item .item-price-more .price {
    position: relative;
    font-style: italic;
    font-size: 14px;
    color: #B1B1B1;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.flight-item .item-price-more .price ins,
.trip-item .item-price-more .price ins,
.attraction-item .item-price-more .price ins,
.hotel-item .item-price-more .price ins {
    text-decoration: none
}
.flight-item .item-price-more .price .amount,
.trip-item .item-price-more .price .amount,
.attraction-item .item-price-more .price .amount,
.hotel-item .item-price-more .price .amount {
    display: block;
    font-weight: bold;
    font-style: normal;
    font-size: 15px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.flight-item .item-price-more .price del,
.trip-item .item-price-more .price del,
.attraction-item .item-price-more .price del,
.hotel-item .item-price-more .price del {
    position: absolute;
    display: block;
    color: #B1B1B1
}
.flight-item .item-price-more .price del .amount,
.trip-item .item-price-more .price del .amount,
.attraction-item .item-price-more .price del .amount,
.hotel-item .item-price-more .price del .amount {
    font-size: 14px;
    font-weight: 600;
    color: #B1B1B1
}
.flight-item .item-price-more a,
.trip-item .item-price-more a,
.attraction-item .item-price-more a,
.hotel-item .item-price-more a {
    margin-top:5px
}
.flight-item:hover,
.trip-item:hover,
.attraction-item:hover
{
    -webkit-box-shadow: 0 0 0 2px #194e91;
    -moz-box-shadow: 0 0 0 2px #194e91;
    box-shadow: 0 0 0 2px #194e91
}
.flight-item:hover .item-body .item-title h2 a,
.trip-item:hover .item-body .item-title h2 a,
.attraction-item:hover .item-body .item-title h2 a,
.hotel-item:hover .item-body .item-title h2 a {
    color: #194e91
}
.flight-item:hover .item-body .item-footer ul li h6,
.trip-item:hover .item-body .item-footer ul li h6,
.attraction-item:hover .item-body .item-footer ul li h6,
.hotel-item:hover .item-body .item-footer ul li h6 {
    color: #194e91
}
.flight-item:hover .item-price-more .price,
.trip-item:hover .item-price-more .price,
.attraction-item:hover .item-price-more .price,
.hotel-item:hover .item-price-more .price {
    color: #194e91
}
.flight-item:hover .item-price-more .price .amount,
.trip-item:hover .item-price-more .price .amount,
.attraction-item:hover .item-price-more .price .amount,
.hotel-item:hover .item-price-more .price .amount {
    color: #194e91
}
.flight-item:hover .item-price-more .price del .amount,
.trip-item:hover .item-price-more .price del .amount,
.attraction-item:hover .item-price-more .price del .amount,
.hotel-item:hover .item-price-more .price del .amount {
    color: #B1B1B1
}
.flight-item .item-media {
    width: 20%
}
.flight-item .item-media .image-cover {
    padding-top: 100%
}
.flight-item .item-media .image-cover img {
    width: auto !important;
    height: auto !important;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%)
}
.flight-item .item-body {
    width: 60%
}
.flight-item .item-price-more {
    padding: 10px 30px
}
.flight-item .item-price-more .price {
    font-style: normal;
    font-size: 11px;
    color: #666
}
.mfp-container {
    padding: 0 15px
}
.flight-popup {
    position: relative;
    background-color: #fff;
    max-width: 970px;
    margin: 50px auto
}
.flight-popup:after {
    content: '';
    display: table;
    clear: both
}
.flight-popup .mfp-close {
    width: 31px;
    height: 31px;
    text-align: center;
    line-height: 31px;
    background-color: #194e91;
    color: #fff;
    opacity: 1;
    -webkit-transform: translate(50%, -50%);
    -moz-transform: translate(50%, -50%);
    -ms-transform: translate(50%, -50%);
    -o-transform: translate(50%, -50%);
    transform: translate(50%, -50%);
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.flight-popup .mfp-close:hover {
    background-color: #fff;
    color: #333
}
.flight-popup .flight-popup__content {
    width: 62%;
    float: left;
    padding: 30px 12px 30px 30px
}
.flight-popup .flight-popup__map-info {
    position: absolute !important;
    width: 38%;
    height: 100%;
    top: 0;
    right: 0
}
.flight-popup-tabs .ui-tabs-nav {
    margin-right: 18px
}
.flight-popup-tabs .ui-tabs-nav:after {
    border-bottom-width: 1px
}
.flight-popup-tabs .ui-tabs-nav li .ui-tabs-anchor {
    font-size: 16px;
    font-weight: 400;
    color: #A6A6A6
}
.flight-popup-tabs .ui-tabs-nav li.ui-tabs-active .ui-tabs-anchor {
    color: #262626
}
.flight-popup-tabs .flight-popup__scrollbar {
    position: relative;
    overflow: hidden;
    height: 460px;
    padding-right: 18px
}
.flight-popup-tabs .flight-popup__scrollbar.ps-container > .ps-scrollbar-y-rail {
    position: absolute;
    top: 0;
    right: 0;
    background-color: transparent;
    width: 3px
}
.flight-popup-tabs .flight-popup__scrollbar.ps-container > .ps-scrollbar-y-rail > .ps-scrollbar-y {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 3px;
    opacity: 0;
    visibility: hidden;
    z-index: 9999999;
    background-color: #D4D4D4;
    -webkit-transition: opacity 0.4s linear;
    -moz-transition: opacity 0.4s linear;
    -ms-transition: opacity 0.4s linear;
    -o-transition: opacity 0.4s linear;
    transition: opacity 0.4s linear
}
.flight-popup-tabs .flight-popup__scrollbar.ps-container > .ps-scrollbar-x-rail {
    display: none;
    opacity: 0;
    position: absolute
}
.flight-popup-tabs .flight-popup__scrollbar.ps-container:active > .ps-scrollbar-y-rail > .ps-scrollbar-y,
.flight-popup-tabs .flight-popup__scrollbar.ps-container:hover > .ps-scrollbar-y-rail > .ps-scrollbar-y {
    opacity: 1;
    visibility: visible
}
.flight-popup-tabs .flight-popup__overview .flight-popup__slider {
    margin-bottom: 26px
}
.flight-popup-tabs .flight-popup__overview .flight-popup__slider .item img {
    width: 100%
}
.flight-popup-tabs .flight-popup__overview .flight-popup__slider .owl-controls .owl-buttons {
    position: static
}
.flight-popup-tabs .flight-popup__overview .flight-popup__slider .owl-controls .owl-buttons > div {
    position: absolute;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    z-index: 999
}
.flight-popup-tabs .flight-popup__overview .flight-popup__slider .owl-controls .owl-buttons > div .fa {
    width: 38px;
    height: 38px;
    line-height: 38px;
    font-size: 20px
}
.flight-popup-tabs .flight-popup__overview .flight-popup__slider .owl-controls .owl-buttons .owl-prev {
    left: 0
}
.flight-popup-tabs .flight-popup__overview .flight-popup__slider .owl-controls .owl-buttons .owl-next {
    right: 0
}
.flight-popup-tabs .flight-popup__overview .flight-popup__descriptions {
    font-size: 14px;
    color: #666
}
.flight-popup-tabs .flight-popup__history {
    position: relative;
    margin-left: 26px
}
.flight-popup-tabs .flight-popup__history .item {
    position: relative;
    padding-left: 40px;
    padding-bottom: 36px
}
.flight-popup-tabs .flight-popup__history .item:after {
    content: '';
    display: block;
    position: absolute;
    width: 0;
    height: 100%;
    top: 0;
    left: 4px;
    border-left: 2px solid #D4D4D4
}
.flight-popup-tabs .flight-popup__history .item .year {
    font-size: 14px;
    font-weight: 700;
    color: #666;
    margin-top: 0;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.flight-popup-tabs .flight-popup__history .item .descriptions {
    font-size: 14px;
    color: #666
}
.flight-popup-tabs .flight-popup__history .item .icon-active {
    position: absolute;
    display: inline-block;
    width: 11px;
    height: 11px;
    border: 2px solid #D4D4D4;
    background-color: #fff;
    border-radius: 50%;
    top: 0;
    left: 0;
    z-index: 9;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.flight-popup-tabs .flight-popup__history .item .icon-active:after {
    content: '';
    display: block;
    position: absolute;
    width: 5px;
    height: 5px;
    border-radius: 50%;
    margin: auto;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-color: #194e91;
    opacity: 0;
    z-index: 1;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.flight-popup-tabs .flight-popup__history .item:hover .year {
    color: #262626
}
.flight-popup-tabs .flight-popup__history .item:hover .icon-active {
    border-color: #194e91
}
.flight-popup-tabs .flight-popup__history .item:hover .icon-active:after {
    opacity: 1
}
.flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list {
    list-style: none;
    padding: 0;
    margin: 0
}
.flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item {
    position: relative;
    background-color: #eee;
    border: 2px solid #eee;
    padding: 12px 90px 12px 72px;
    cursor: pointer;
    margin-bottom: 12px;
    counter-increment: listcountmap;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item:before {
    content: counter(listcountmap);
    position: absolute;
    display: block;
    font-size: 14px;
    font-weight: 700;
    color: #A5A5A5;
    width: 72px;
    text-align: center;
    top: 50%;
    left: 0;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%)
}
.flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item .item-media {
    width: 70px;
    height: 70px;
    overflow: hidden;
    float: left;
    margin-right: 30px
}
.flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item .item-media img {
    width: 100%
}
.flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item .item-title h2 {
    font-size: 18px;
    font-weight: 400;
    color: #262626;
    margin: 0;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item .item-star .fa {
    font-size: 11px;
    color: #666;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item .item-address {
    font-size: 13px;
    font-weight: 600;
    color: #A6A6A6;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap
}
.flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item .item-rate {
    position: absolute;
    top: 10px;
    right: 12px
}
.flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item .item-rate span {
    font-weight: 700;
    font-size: 14px;
    color: #B1B1B1
}
.flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item.map-active,
.flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item:hover {
    background-color: transparent;
    border-color: #194e91
}
.flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item.map-active .item-title h2,
.flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item:hover .item-title h2 {
    color: #194e91
}
.flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item.map-active .item-star .fa,
.flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item:hover .item-star .fa {
    color: #FFD34E
}
.flight-popup-tabs .flight-popup__gallery-row {
    margin: -5px
}
.flight-popup-tabs .flight-popup__grid-wrapper .grid-item {
    padding: 0
}
.flight-popup-tabs .flight-popup__grid-wrapper .grid-item .image-wrap {
    position: relative;
    z-index: 9
}
.flight-popup-tabs .flight-popup__grid-wrapper .grid-item .image-wrap:before {
    content: '';
    display: block;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    border: 5px solid #fff;
    z-index: 9;
    pointer-events: none
}
.widget ul {
    list-style: none;
    padding: 0
}
.widget ul li > label {
    font-size: 12px;
    font-weight: 600;
    color: #666
}
.widget select {
    width: 100%
}
.page-sidebar {
    margin-top: 37px;
    margin-bottom: 84px
}
.page-sidebar .sidebar-title {
    position: relative;
    overflow: hidden;
    border-top: 5px solid #194e91;
    border-bottom: 1px solid #DFDFDF;
    margin-bottom: 15px;
    padding: 18px 0
}
.page-sidebar .sidebar-title h2 {
    font-weight: 400;
    font-size: 20px;
    color: #194e91;
    float: left;
    margin: 0
}
.page-sidebar .sidebar-title .clear-filter {
    float: right;
    padding-top: 3px
}
.page-sidebar .sidebar-title .clear-filter a {
    font-weight: 600;
    font-size: 12px;
    color: #7D7D7D
}
.page-sidebar .sidebar-title .clear-filter a:after {
    content: '×';
    display: inline-block;
    font-size: 20px;
    vertical-align: middle;
    margin-left: 5px
}
.page-sidebar .sidebar-title .clear-filter a:hover {
    color: #194e91
}
.page-sidebar .widget {
    border-bottom: 1px solid #DFDFDF;
    margin-bottom: 15px
}
.page-sidebar .widget h3 {
    position: relative;
    font-size: 14px;
    font-weight: 700;
    color: #194e91;
    margin-top: 0;
    margin-bottom: 10px;
    text-transform: uppercase
}
.page-sidebar .widget:last-child {
    border: 0
}
.page-sidebar .widget_search form {
    margin-bottom: 16px
}
.page-sidebar .widget_search input {
    width: 100%;
    border: 1px solid #E7E7E7;
    background: none
}
.page-sidebar .widget_follow_us .awe-social {
    margin-bottom: 16px
}
.page-sidebar .widget_has_thumbnail ul li {
    margin-bottom: 20px
}
.page-sidebar .widget_has_thumbnail .image-wrap {
    padding-top: 30%
}
.page-sidebar .widget_has_thumbnail .content {
    margin-top: 5px
}
.page-sidebar .widget_has_thumbnail .content a {
    font-family: "Lato", sans-serif;
    font-weight: 700;
    font-size: 14px;
    color: #666
}
.page-sidebar .widget_has_thumbnail .content a:hover {
    color: #194e91
}
.page-sidebar .widget_latest_post ul li,
.page-sidebar .widget_rss ul li,
.page-sidebar .widget_meta ul li,
.page-sidebar .widget_pages ul li,
.page-sidebar .widget_nav_menu ul li,
.page-sidebar .widget_categories ul li,
.page-sidebar .widget_archive ul li {
    font-family: "Lato", sans-serif;
    font-weight: 700;
    font-size: 14px;
    color: #666;
    margin-left: 12px
}
.page-sidebar .widget_latest_post ul li:before,
.page-sidebar .widget_rss ul li:before,
.page-sidebar .widget_meta ul li:before,
.page-sidebar .widget_pages ul li:before,
.page-sidebar .widget_nav_menu ul li:before,
.page-sidebar .widget_categories ul li:before,
.page-sidebar .widget_archive ul li:before {
    content: '';
    font-size: 24px;
    font-weight: 400;
    display: inline-block;
    margin-right: 10px;
    width: 8px;
    height: 8px;
    background-color: #ddd;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
    position: relative;
    top: 0px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.page-sidebar .widget_latest_post ul li a,
.page-sidebar .widget_rss ul li a,
.page-sidebar .widget_meta ul li a,
.page-sidebar .widget_pages ul li a,
.page-sidebar .widget_nav_menu ul li a,
.page-sidebar .widget_categories ul li a,
.page-sidebar .widget_archive ul li a {
    display: inline-block;
    color: inherit;
    padding-top: 8px;
    padding-bottom: 8px
}
.page-sidebar .widget_latest_post ul li:last-child,
.page-sidebar .widget_rss ul li:last-child,
.page-sidebar .widget_meta ul li:last-child,
.page-sidebar .widget_pages ul li:last-child,
.page-sidebar .widget_nav_menu ul li:last-child,
.page-sidebar .widget_categories ul li:last-child,
.page-sidebar .widget_archive ul li:last-child {
    border: 0
}
.page-sidebar .widget_latest_post ul li ul li,
.page-sidebar .widget_rss ul li ul li,
.page-sidebar .widget_meta ul li ul li,
.page-sidebar .widget_pages ul li ul li,
.page-sidebar .widget_nav_menu ul li ul li,
.page-sidebar .widget_categories ul li ul li,
.page-sidebar .widget_archive ul li ul li {
    margin-left: 18px
}
.page-sidebar .widget_latest_post ul li:hover:before,
.page-sidebar .widget_rss ul li:hover:before,
.page-sidebar .widget_meta ul li:hover:before,
.page-sidebar .widget_pages ul li:hover:before,
.page-sidebar .widget_nav_menu ul li:hover:before,
.page-sidebar .widget_categories ul li:hover:before,
.page-sidebar .widget_archive ul li:hover:before {
    background-color: #194e91
}
.page-sidebar .widget_latest_post ul li:hover > a,
.page-sidebar .widget_rss ul li:hover > a,
.page-sidebar .widget_meta ul li:hover > a,
.page-sidebar .widget_pages ul li:hover > a,
.page-sidebar .widget_nav_menu ul li:hover > a,
.page-sidebar .widget_categories ul li:hover > a,
.page-sidebar .widget_archive ul li:hover > a {
    color: #194e91
}
.page-sidebar .widget_recent_comments ul li {
    font-weight: 700;
    font-size: 14px;
    color: #666;
    margin-left: 12px
}
.page-sidebar .widget_recent_comments ul li span {
    display: inline-block;
    color: inherit;
    padding-top: 8px;
    padding-bottom: 8px
}
.page-sidebar .widget_recent_comments ul li span a {
    color: inherit
}
.page-sidebar .widget_recent_comments ul li:last-child {
    border: 0
}
.page-sidebar .widget_recent_comments ul li ul li {
    margin-left: 18px
}
.page-sidebar .widget_recent_comments ul li:hover > a {
    color: #194e91
}
.tagcloud {
    font-size: 0;
    margin-left: -4px;
    margin-right: -4px;
    margin-bottom: 16px
}
.tagcloud a {
    display: inline-block;
    font-weight: 600;
    font-size: 12px !important;
    color: #666;
    padding: 3px 10px;
    background-color: #ddd;
    margin: 4px
}
.tagcloud a:hover {
    color: #fff;
    background-color: #194e91
}
.widget_has_radio_checkbox ul li {
    padding: 6px 0
}
.widget_has_radio_checkbox ul li label {
    position: relative;
    display: block;
    margin: 0;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none
}
.widget_has_radio_checkbox ul li label .awe-icon-check {
    position: relative;
    font-size: 7px;
    width: 15px;
    height: 15px;
    line-height: 11px;
    text-align: center;
    border: 2px solid #A6A6A6;
    color: transparent;
    top: -2px;
    margin-right: 8px
}
.widget_has_radio_checkbox ul li label > input[type="radio"],
.widget_has_radio_checkbox ul li label > input[type="checkbox"] {
    display: none
}
.widget_has_radio_checkbox ul li label > input[type="radio"]:checked ~ .awe-icon-check,
.widget_has_radio_checkbox ul li label > input[type="checkbox"]:checked ~ .awe-icon-check {
    color: #194e91
}
.widget_has_radio_checkbox ul li label .rating {
    font-size: 12px;
    color: #666
}
.widget_has_radio_checkbox ul li label .rating .fa {
    font-size: 11px;
    color: #B1B1B1
}
.widget_price_filter .price-slider-wrapper {
    padding-top: 5px;
    margin-bottom: 16px
}
.widget_price_filter .price-slider {
    height: 3px
}
.widget_price_filter .price-slider .ui-slider-handle {
    height: 10px
}
.widget_price_filter .price_slider_amount {
    font-weight: 600;
    font-size: 16px;
    color: #A5A5A5;
    margin-top: 15px
}
.widget_has_radio_checkbox_text .widget_content {
    margin-bottom: 32px
}
.widget_has_radio_checkbox_text .widget_content label {
    position: relative;
    display: inline-block;
    margin: 0;
    font-size: 12px;
    font-weight: 600;
    color: #666;
    padding: 6px 0;
    margin-right: 24px;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none
}
.widget_has_radio_checkbox_text .widget_content label .awe-icon-check {
    position: relative;
    font-size: 7px;
    width: 15px;
    height: 15px;
    line-height: 11px;
    text-align: center;
    border: 2px solid #A6A6A6;
    color: transparent;
    top: -2px;
    margin-right: 8px
}
.widget_has_radio_checkbox_text .widget_content label > input[type="radio"],
.widget_has_radio_checkbox_text .widget_content label > input[type="checkbox"] {
    display: none
}
.widget_has_radio_checkbox_text .widget_content label > input[type="radio"]:checked ~ .awe-icon-check,
.widget_has_radio_checkbox_text .widget_content label > input[type="checkbox"]:checked ~ .awe-icon-check {
    color: #194e91
}
.widget_has_radio_checkbox_text .widget_content label.from,
.widget_has_radio_checkbox_text .widget_content label.to {
    margin-right: 0;
    width: 100%;
    font-size: 13px;
    margin-top: 5px
}
.widget_has_radio_checkbox_text .widget_content label .form-item {
    position: relative;
    margin-top: 8px
}
.widget_has_radio_checkbox_text .widget_content label .form-item input {
    height: 36px;
    line-height: 36px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -ms-border-radius: 2px;
    -o-border-radius: 2px;
    border-radius: 2px;
    width: 100%;
    padding-right: 32px
}
.widget_has_radio_checkbox_text .widget_content label .form-item .awe-icon {
    position: absolute;
    font-size: 14px;
    color: #A6A6A6;
    top: 10px;
    right: 10px
}
.checkout-page__top {
    margin-bottom: 34px;
    overflow: hidden
}
.checkout-page__top .title {
    float: left
}
.checkout-page__top .title h1 {
    font-size: 32px;
    font-weight: 700;
    color: #666;
    margin: 0
}
.checkout-page__top .phone {
    display: block;
    float: right;
    font-size: 16px;
    font-weight: 600;
    color: #666;
    margin-top: 5px
}
.checkout-page__sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0
}
.checkout-page__sidebar ul li {
    position: relative;
    counter-increment: count;
    margin-bottom: 5px
}
.checkout-page__sidebar ul li:before {
    content: counter(count);
    display: block;
    position: absolute;
    width: 34px;
    height: 34px;
    line-height: 30px;
    margin: auto;
    top: 0;
    bottom: 0;
    left: 15px;
    text-align: center;
    font-size: 14px;
    font-weight: 700;
    border: 2px solid #D4D4D4;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.checkout-page__sidebar ul li a {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #A5A5A5;
    background-color: #fff;
    line-height: 60px;
    white-space: nowrap;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -ms-border-radius: 2px;
    -o-border-radius: 2px;
    border-radius: 2px;
    padding: 0 15px 0 60px
}
.checkout-page__sidebar ul li:hover:before {
    border-color: #194e91;
    color: #194e91
}
.checkout-page__sidebar ul li:hover a {
    color: #194e91
}
.checkout-page__sidebar ul li.current:before {
    border-color: #fff;
    background-color: #fff
}
.checkout-page__sidebar ul li.current a {
    background-color: #194e91;
    color: #fff
}
.woocommerce-error,
.woocommerce-info,
.woocommerce-message {
    border: 0;
    margin-top: 0px !important;
    margin-bottom: 20px !important;
    box-shadow: none;
    background: none;
    background-color: #eee;
    border-left: 4px solid #194e91;
    border-radius: 0 !important;
    font-weight: 400;
    font-size: 14px;
    color: #68738B;
    padding: 14px 30px !important
}
.woocommerce-error:before,
.woocommerce-error:after,
.woocommerce-info:before,
.woocommerce-info:after,
.woocommerce-message:before,
.woocommerce-message:after {
    display: none !important
}
.woocommerce-error a,
.woocommerce-info a,
.woocommerce-message a {
    color: inherit;
    text-decoration: underline
}
.woocommerce-error a:hover,
.woocommerce-info a:hover,
.woocommerce-message a:hover {
    color: #194e91
}
.checkout-page__content {
    overflow: hidden;
    overflow-x: auto
}
.checkout-page__content .yourcart-content,
.checkout-page__content .customer-content,
.checkout-page__content .complete-content {
    background-color: #fff;
    padding: 32px 30px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    -ms-border-radius: 4px;
    -o-border-radius: 4px;
    border-radius: 4px;
    min-width: 620px;
    width: 100%
}
.checkout-page__content .yourcart-content {
    min-width: 720px
}
.checkout-page__content .content-title {
    border-bottom: 1px dashed #D4D4D4;
    margin-bottom: 20px
}
.checkout-page__content .content-title h2 {
    font-weight: 700;
    font-size: 18px;
    color: #666;
    margin: 0;
    padding: 14px 0
}
.checkout-page__content .content-title h2 .awe-icon {
    color: #194e91;
    margin-right: 12px;
    vertical-align: middle
}
.checkout-page__content .coupon {
    padding: 10px 0
}
.checkout-page__content .coupon form {
    overflow: hidden
}
.checkout-page__content .coupon .form-row {
    float: left
}
.checkout-page__content .coupon .form-row.form-row-first {
    max-width: 350px;
    width: 100%;
    padding-right: 30px
}
.checkout-page__content .coupon .form-row.form-row-first input {
    width: 100%;
    background-color: #eee
}
.checkout-page__content .coupon .form-row.form-row-last .button {
    border: 0;
    background-color: #403F3F;
    border-radius: 4px;
    text-align: center;
    line-height: 40px;
    height: 40px;
    white-space: nowrap;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    padding: 0 20px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.checkout-page__content .coupon .form-row.form-row-last .button:hover {
    background-color: #194e91
}
.checkout-page__content .woocommerce-billing-fields {
    margin-top: 36px
}
.checkout-page__content .woocommerce-billing-fields h3 {
    font-weight: 700;
    font-size: 18px;
    color: #666;
    margin: 0;
    padding: 14px 0;
    border-bottom: 1px solid #D4D4D4
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address,
.checkout-page__content .woocommerce-billing-fields {
    overflow: hidden
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address .form-row,
.checkout-page__content .woocommerce-billing-fields .form-row {
    margin-top: 20px;
    float: left
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address .form-row label,
.checkout-page__content .woocommerce-billing-fields .form-row label {
    font-weight: 600;
    font-size: 14px;
    color: #666;
    margin-bottom: 10px
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address .form-row input,
.checkout-page__content .woocommerce-billing-fields .form-row input {
    width: 100%;
    background-color: #eee
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address #shipping_first_name_field,
.checkout-page__content .woocommerce-shipping-fields .shipping_address #billing_first_name_field,
.checkout-page__content .woocommerce-billing-fields #shipping_first_name_field,
.checkout-page__content .woocommerce-billing-fields #billing_first_name_field {
    width: 22%;
    margin-right: 3%
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address #shipping_last_name_field,
.checkout-page__content .woocommerce-shipping-fields .shipping_address #billing_last_name_field,
.checkout-page__content .woocommerce-billing-fields #shipping_last_name_field,
.checkout-page__content .woocommerce-billing-fields #billing_last_name_field {
    width: 22%;
    margin-left: 1%;
    margin-right: 2%
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address #billing_email,
.checkout-page__content .woocommerce-billing-fields #billing_email {
    width: 48%;
    margin-left: 2%
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address #shipping_company_field,
.checkout-page__content .woocommerce-shipping-fields .shipping_address #billing_company_field,
.checkout-page__content .woocommerce-billing-fields #shipping_company_field,
.checkout-page__content .woocommerce-billing-fields #billing_company_field {
    width: 48%;
    margin-right: 2%
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address #shipping_country_field,
.checkout-page__content .woocommerce-shipping-fields .shipping_address #billing_country_field,
.checkout-page__content .woocommerce-billing-fields #shipping_country_field,
.checkout-page__content .woocommerce-billing-fields #billing_country_field {
    clear: both;
    width: 48%;
    margin-right: 2%
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address #shipping_country_field .country_select a,
.checkout-page__content .woocommerce-shipping-fields .shipping_address #billing_country_field .country_select a,
.checkout-page__content .woocommerce-billing-fields #shipping_country_field .country_select a,
.checkout-page__content .woocommerce-billing-fields #billing_country_field .country_select a {
    display: block;
    background-color: #eee;
    border: 1px solid #d4d4d4;
    height: 40px;
    line-height: 40px;
    padding: 0 12px;
    color: #666;
    font-size: 14px
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address #shipping_postcode_field,
.checkout-page__content .woocommerce-shipping-fields .shipping_address #shipping_city_field,
.checkout-page__content .woocommerce-shipping-fields .shipping_address #billing_postcode_field,
.checkout-page__content .woocommerce-shipping-fields .shipping_address #billing_city_field,
.checkout-page__content .woocommerce-billing-fields #shipping_postcode_field,
.checkout-page__content .woocommerce-billing-fields #shipping_city_field,
.checkout-page__content .woocommerce-billing-fields #billing_postcode_field,
.checkout-page__content .woocommerce-billing-fields #billing_city_field {
    width: 22%;
    margin-left: 2%;
    margin-right: 1%
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address #shipping_phone_field,
.checkout-page__content .woocommerce-shipping-fields .shipping_address #shipping_state_field,
.checkout-page__content .woocommerce-shipping-fields .shipping_address #billing_phone_field,
.checkout-page__content .woocommerce-shipping-fields .shipping_address #billing_state_field,
.checkout-page__content .woocommerce-billing-fields #shipping_phone_field,
.checkout-page__content .woocommerce-billing-fields #shipping_state_field,
.checkout-page__content .woocommerce-billing-fields #billing_phone_field,
.checkout-page__content .woocommerce-billing-fields #billing_state_field {
    width: 22%;
    margin-left: 3%
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address #shipping_address_1_field,
.checkout-page__content .woocommerce-shipping-fields .shipping_address #billing_address_1_field,
.checkout-page__content .woocommerce-billing-fields #shipping_address_1_field,
.checkout-page__content .woocommerce-billing-fields #billing_address_1_field {
    width: 48%;
    margin-right: 2%
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address #order_comments_field,
.checkout-page__content .woocommerce-billing-fields #order_comments_field {
    width: 48%;
    margin-left: 2%
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address #order_comments_field textarea,
.checkout-page__content .woocommerce-billing-fields #order_comments_field textarea {
    background-color: #eee;
    width: 100%;
    height: 130px
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address .create-account,
.checkout-page__content .woocommerce-billing-fields .create-account {
    margin-top: 40px
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address .create-account input[type="checkbox"],
.checkout-page__content .woocommerce-billing-fields .create-account input[type="checkbox"] {
    width: auto
}
.checkout-page__content .woocommerce-shipping-fields #ship-to-different-address {
    display: inline-block;
    overflow: hidden;
    position: relative;
    margin-top: 0;
    padding-left: 20px;
    margin: 0
}
.checkout-page__content .woocommerce-shipping-fields #ship-to-different-address label {
    font-weight: 600;
    font-size: 14px;
    color: #666;
    margin: 0
}
.checkout-page__content .woocommerce-shipping-fields #ship-to-different-address input[type="checkbox"] {
    position: absolute;
    left: 0;
    top: 50%;
    margin: 0;
    margin-top: 2px;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%)
}
.checkout-page__content .woocommerce-shipping-fields .shipping_address #shipping_company_field {
    margin-top: -70px
}
.checkout-page__content #payment {
    margin-top: 42px;
    background: none
}
.checkout-page__content #payment h3 {
    font-weight: 700;
    font-size: 18px;
    color: #666;
    margin: 0;
    padding: 14px 0;
    border-bottom: 1px solid #D4D4D4
}
.checkout-page__content #payment > .payment_methods {
    list-style: none;
    margin: 0;
    padding: 16px 70px
}
.checkout-page__content #payment > .payment_methods li label {
    position: relative;
    font-size: 14px;
    font-weight: 600;
    color: #666;
    margin-left: 26px
}
.checkout-page__content #payment > .payment_methods li label:before {
    content: '';
    display: block;
    position: absolute;
    width: 12px;
    height: 12px;
    padding: 2px;
    background-color: transparent;
    border: 2px solid #194e91;
    -webkit-background-clip: content-box;
    -moz-background-clip: content-box;
    -ms-background-clip: content-box;
    -o-background-clip: content-box;
    background-clip: content-box;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
    top: 4px;
    left: -26px
}
.checkout-page__content #payment > .payment_methods li input[type="radio"] {
    display: none
}
.checkout-page__content #payment > .payment_methods li input[type="radio"]:checked ~ label:before {
    background-color: #194e91
}
.checkout-page__content #payment > .payment_methods li .payment_box {
    color: #A6A6A6;
    margin-left: 26px
}
.checkout-page__content #payment > .payment_methods .payment_method_paypal label:before {
    top: 20px
}
.checkout-page__content #payment > .payment_methods .payment_method_paypal img {
    max-height: 52px
}
.checkout-page__content #payment > .payment_methods .payment_method_paypal .about_paypal {
    display: inline-block;
    margin-left: 15px
}
.checkout-page__content #payment .place-order {
    border-top: 2px solid #C2C5CD;
    padding: 20px 0;
    text-align: right
}
.checkout-page__content #payment .place-order input {
    border: 0;
    background-color: #194e91;
    border-radius: 4px;
    text-align: center;
    line-height: 40px;
    height: 40px;
    white-space: nowrap;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    padding: 0 20px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.checkout-page__content #payment .place-order input:hover {
    background-color: #403F3F
}
.your-order {
    overflow: hidden
}
.your-order h2 {
    font-weight: 700;
    font-size: 24px;
    color: #666;
    border-bottom: 1px solid #D4D4D4;
    margin: 0;
    padding: 7px 0
}
.order-table {
    margin-top: 20px;
    margin-bottom: 46px;
    width: 100%
}
.order-table thead tr th {
    font-weight: 700;
    font-size: 12px;
    color: #666;
    padding: 5px 0
}
.order-table tbody tr td {
    font-weight: 400;
    font-size: 18px;
    color: #A5A5A5;
    padding: 5px 0
}
.cart-detail h3,
.billing-info h3 {
    font-weight: 700;
    font-size: 18px;
    color: #666;
    margin: 0;
    padding: 14px 0;
    border-bottom: 1px solid #D4D4D4
}
.billing-info {
    width: calc(60% - 95px);
    float: left;
    margin-right: 95px
}
.billing-info .billing-table td {
    padding-top: 25px
}
.billing-info .billing-table td:nth-child(odd) {
    padding-right: 15px
}
.billing-info .billing-table td:nth-child(even) {
    padding-left: 15px
}
.billing-info .billing-table td h4 {
    font-weight: 600;
    font-size: 12px;
    color: #666;
    margin-top: 0;
    margin-bottom: 0px
}
.billing-info .billing-table td a,
.billing-info .billing-table td p {
    font-size: 14px;
    color: #A5A5A5;
    margin: 0
}
.billing-info .billing-table td a:hover {
    color: #194e91
}
.cart-detail {
    width: 40%;
    float: left
}
.cart-detail .cart-detail-table {
    width: 100%
}
.cart-detail .cart-detail-table tbody th {
    color: #194e91
}
.cart-detail .cart-detail-table th,
.cart-detail .cart-detail-table td {
    font-weight: 700;
    font-size: 14px;
    color: #666;
    padding: 18px 0
}
.cart-detail .cart-detail-table th:nth-child(even),
.cart-detail .cart-detail-table td:nth-child(even) {
    text-align: right
}
.cart-detail .cart-detail-table tbody tr {
    border-bottom: 1px dashed #D4D4D4
}
.cart-detail .cart-detail-table tbody tr:last-child {
    border-bottom-style: solid
}
.cart-detail .cart-detail-table tfoot .order-total th,
.cart-detail .cart-detail-table tfoot .order-total td {
    font-size: 24px;
    font-weight: 600;
    color: #194e91
}
.your-cart-footer {
    clear: both;
    padding: 25px 0
}
.your-cart-footer a {
    text-transform: none;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    -ms-border-radius: 4px;
    -o-border-radius: 4px;
    border-radius: 4px;
    padding: 11px 16px;
    min-width: 160px;
    font-size: 14px
}
.cart-content .cart-table {
    width: 100%;
    border-bottom: 1px dashed #D4D4D4
}
.cart-content .cart-table .product-subtotal {
    text-align: right
}
.cart-content .cart-table thead th {
    font-weight: 700;
    font-size: 14px;
    color: #194e91;
    padding: 14px 0
}
.cart-content .cart-table tbody td {
    font-weight: 700;
    font-size: 12px;
    color: #A5A5A5;
    padding: 0 0 10px 0
}
.cart-content .cart-table tbody td.product-remove {
    width: 12.6%;
    padding-left: 74px
}
.cart-content .cart-table tbody td.product-remove a {
    font-size: 14px;
    color: #666
}
.cart-content .cart-table tbody td.product-remove a:hover {
    color: #FF6666
}
.cart-content .cart-table tbody td.product-name {
    width: 31%;
    padding-right: 20px
}
.cart-content .cart-table tbody td.product-price,
.cart-content .cart-table tbody td.product-quantity {
    width: 23%;
    padding-right: 20px
}
.cart-content .cart-table tbody td.product-subtotal {
    width: 33.4%
}
.cart-content .cart-table tbody td .quantity {
    position: relative;
    padding-left: 14px
}
.cart-content .cart-table tbody td .quantity .plus,
.cart-content .cart-table tbody td .quantity .minus {
    position: absolute;
    background: none;
    border: 0;
    color: #666;
    left: 0;
    font-size: 0
}
.cart-content .cart-table tbody td .quantity .plus .fa,
.cart-content .cart-table tbody td .quantity .minus .fa {
    font-size: 13px
}
.cart-content .cart-table tbody td .quantity .plus:hover,
.cart-content .cart-table tbody td .quantity .minus:hover {
    color: #194e91
}
.cart-content .cart-table tbody td .quantity .minus {
    top: 0
}
.cart-content .cart-table tbody td .quantity .plus {
    bottom: 0
}
.cart-content .cart-table tbody td .quantity .qty {
    font-size: 12px;
    color: #A5A5A5;
    line-height: 26px;
    height: 26px;
    max-width: 100px;
    border: 0
}
.cart-footer .cart-subtotal {
    border-bottom: 1px solid #D4D4D4;
    padding: 30px 0
}
.cart-footer .cart-subtotal .subtotal-title {
    float: left
}
.cart-footer .cart-subtotal .subtotal-title h5 {
    font-weight: 600;
    font-size: 14px;
    color: #194e91;
    margin: 0
}
.cart-footer .cart-subtotal .subtotal {
    position: relative;
    font-weight: 700;
    font-size: 14px;
    color: #194e91;
    float: right
}
.cart-footer .cart-subtotal .subtotal .sale {
    position: absolute;
    right: 0;
    bottom: -36px
}
.cart-footer .cart-subtotal .coupon-code {
    clear: both;
    padding-top: 10px;
    overflow: hidden
}
.cart-footer .cart-subtotal .coupon-code label {
    display: block;
    font-weight: 600;
    font-size: 14px;
    color: #194e91;
    margin-bottom: 15px
}
.cart-footer .cart-subtotal .coupon-code .form-item {
    display: inline-block;
    float: left;
    width: 50%;
    padding-right: 30px
}
.cart-footer .cart-subtotal .coupon-code input#coupon {
    background-color: #eee;
    width: 100%
}
.cart-footer .cart-subtotal .coupon-code .form-submit {
    display: inline-block;
    float: left
}
.cart-footer .cart-subtotal .coupon-code .button {
    border: 0;
    background-color: #403F3F;
    border-radius: 4px;
    text-align: center;
    line-height: 40px;
    height: 40px;
    white-space: nowrap;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    padding: 0 20px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.cart-footer .cart-subtotal .coupon-code .button:hover {
    background-color: #194e91
}
.cart-footer .shipping-handling {
    padding: 30px 0
}
.cart-footer .shipping-handling .title {
    font-weight: 600;
    font-size: 14px;
    color: #194e91;
    float: left;
    margin: 0
}
.cart-footer .shipping-handling .amount {
    font-weight: 700;
    font-size: 14px;
    color: #194e91;
    float: right
}
.cart-footer .shipping-handling .check-shipping-rate {
    padding-top: 24px;
    clear: both;
    overflow: hidden
}
.cart-footer .shipping-handling .check-shipping-rate h4 {
    font-weight: 600;
    font-size: 14px;
    color: #403F3F
}
.cart-footer .shipping-handling .check-shipping-rate .form-row.form-country {
    width: 50%;
    padding-right: 30px
}
.cart-footer .shipping-handling .check-shipping-rate .form-row.form-country .awe-select-wrapper,
.cart-footer .shipping-handling .check-shipping-rate .form-row.form-country select {
    width: 100%
}
.cart-footer .shipping-handling .check-shipping-rate .form-row.form-country select {
    background-color: #eee
}
.cart-footer .shipping-handling .check-shipping-rate .form-row.form-country .awe-select-wrapper .fa {
    background-color: #eee
}
.cart-footer .shipping-handling .check-shipping-rate .form-row {
    float: left;
    margin-bottom: 20px
}
.cart-footer .shipping-handling .check-shipping-rate .form-row.form-state {
    clear: both;
    width: 25%;
    padding-right: 30px
}
.cart-footer .shipping-handling .check-shipping-rate .form-row.form-postal {
    width: 25%;
    padding-right: 30px
}
.cart-footer .shipping-handling .check-shipping-rate .form-row input {
    width: 100%;
    background-color: #eee
}
.cart-footer .shipping-handling .check-shipping-rate .form-submit {
    float: left;
    margin-bottom: 20px
}
.cart-footer .shipping-handling .check-shipping-rate .form-submit .button {
    border: 0;
    background-color: #403F3F;
    border-radius: 4px;
    text-align: center;
    line-height: 40px;
    height: 40px;
    white-space: nowrap;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    padding: 0 20px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.cart-footer .shipping-handling .check-shipping-rate .form-submit .button:hover {
    background-color: #194e91
}
.cart-footer .order-total {
    overflow: hidden;
    border-top: 2px solid #D4D4D4;
    padding: 28px 0
}
.cart-footer .order-total .title {
    float: left;
    font-size: 24px;
    font-weight: 600;
    color: #194e91;
    margin: 0
}
.cart-footer .order-total .amount {
    float: right;
    font-size: 24px;
    font-weight: 600;
    color: #194e91
}
.cart-footer .cart-submit {
    text-align: right
}
.cart-footer .cart-submit .update-cart {
    border: 0;
    background-color: #403F3F;
    border-radius: 4px;
    text-align: center;
    line-height: 40px;
    height: 40px;
    white-space: nowrap;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    padding: 0 20px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.cart-footer .cart-submit .update-cart:hover {
    background-color: #194e91
}
.cart-footer .cart-submit .checkout {
    border: 0;
    background-color: #194e91;
    border-radius: 4px;
    text-align: center;
    line-height: 40px;
    height: 40px;
    white-space: nowrap;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    padding: 0 20px;
    margin-left: 8px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.cart-footer .cart-submit .checkout:hover {
    background-color: #403F3F
}
.product-detail {
    padding-top: 20px;
    padding-bottom: 30px
}
.product-detail__info .product-title h2 {
    display: inline-block;
    font-size: 32px;
    font-weight: 600;
    color: #194e91;
    margin: 0
}
.product-detail__info .product-title .hotel-star {
    display: inline-block;
    font-size: 10px;
    color: #194e91;
    margin-left: 10px
}
.product-detail__info .product-address {
    font-size: 14px;
    color: #666;
    margin-bottom: 7px
}
.product-detail__info .product-email .fa {
    color: #194e91;
    font-size: 15px;
    margin: 0 5px 0 2px
}
.product-detail__info .product-email a {
    color: #666
}
.product-detail__info .product-email a:hover {
    color: #194e91
}
.product-detail__info .property-highlights {
    margin-top: 25px
}
.product-detail__info .property-highlights .property-highlights__content {
    overflow: hidden;
    margin-left: -10px;
    margin-right: -10px
}
.product-detail__info .property-highlights h3 {
    font-size: 20px;
    font-weight: 600;
    color: #194e91;
    border-bottom: 2px solid #D4D4D4;
    padding: 8px 0;
    margin-top: 0
}
.product-detail__info .property-highlights .item {
    width: 33.3333333333%;
    float: left;
    color: #666;
    padding: 9px 10px
}
.product-detail__info .property-highlights .item .awe-icon {
    float: left;
    font-size: 18px;
    margin-top: 1px
}
.product-detail__info .property-highlights .item span {
    display: block;
    margin-left: 36px
}
.product-detail__info .rating-trip-reviews {
    margin: 12px -10px;
    overflow: hidden
}
.product-detail__info .rating-trip-reviews .item {
    width: 33.3333333333%;
    float: left;
    padding: 0 10px;
    margin-top: 10px
}
.product-detail__info .rating-trip-reviews .item .count {
    display: inline-block;
    width: 40px;
    height: 40px;
    text-align: center;
    line-height: 40px;
    border-radius: 4px;
    font-weight: 600;
    font-size: 16px;
    color: #fff;
    float: left;
    margin-right: 10px
}
.product-detail__info .rating-trip-reviews .item.good .count {
    background-color: #55A649
}
.product-detail__info .rating-trip-reviews .item.fine .count {
    background-color: #F27C38
}
.product-detail__info .rating-trip-reviews .item h6 {
    font-size: 12px;
    font-weight: 700;
    color: #666;
    margin: 0
}
.product-detail__info .rating-trip-reviews .item p {
    font-size: 16px;
    color: #A6A6A6;
    margin-bottom: 0
}
.product-detail__info .product-descriptions {
    font-size: 14px;
    color: #666;
    margin-top: 30px
}
.product-detail__info .trips {
    overflow: hidden;
    margin-top: 32px;
    margin-left: -15px;
    margin-right: -15px
}
.product-detail__info .trips .item {
    padding: 13px 15px;
    float: left;
    width: 33.3333333333%
}
.product-detail__info .trips .item h6 {
    font-weight: 700;
    font-size: 12px;
    color: #262626;
    margin-top: 0;
    margin-bottom: 5px
}
.product-detail__info .trips .item p {
    font-size: 16px;
    color: #666;
    margin-bottom: 0;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap
}
.product-detail__info .trips .item p .fa,
.product-detail__info .trips .item p .awe-icon {
    margin-right: 8px;
    font-size: 18px;
    color: #A6A6A6
}
.ticket-price {
    margin-top: 45px
}
.ticket-price th,
.ticket-price td {
    width: 33.3333333333%;
    padding: 10px 25px;
    border-right: 2px dotted #A6A6A6
}
.ticket-price th:last-child,
.ticket-price td:last-child {
    border-right: 0
}
.ticket-price .ticket-price {
    padding-left: 0
}
.ticket-price .kid {
    padding-right: 0
}
.ticket-price thead th p {
    font-size: 20px;
    font-weight: 600;
    color: #194e91;
    margin: 0
}
.ticket-price thead th span {
    font-size: 12px;
    font-weight: 600;
    color: #666
}
.ticket-price tbody tr {
    border-top: 2px solid #A6A6A6
}
.ticket-price tbody tr td {
    vertical-align: top
}
.ticket-price tbody tr td em {
    font-style: normal;
    font-size: 12px;
    color: #666
}
.ticket-price tbody tr td ins {
    display: block;
    text-decoration: none
}
.ticket-price tbody tr td ins .amount {
    font-size: 20px;
    color: #194e91
}
.ticket-price tbody tr td del .amount {
    font-size: 14px;
    color: #606060
}
.trip-schedule-accordion .ui-accordion-content ol li,
.trip-schedule-accordion .ui-accordion-content ul li {
    padding-top: 4px;
    padding-bottom: 4px
}
.trip-schedule-accordion .trips .item {
    max-width: 190px;
    display: inline-block;
    padding-right: 30px
}
.trip-schedule-accordion .trips .item h6 {
    font-size: 12px;
    font-weight: 700;
    color: #666;
    margin-top: 0;
    margin-bottom: 5px
}
.trip-schedule-accordion .trips .item p {
    font-size: 16px;
    color: #666;
    margin-bottom: 0;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap
}
.trip-schedule-accordion .trips .item p .fa,
.trip-schedule-accordion .trips .item p .awe-icon {
    margin-right: 8px;
    font-size: 18px;
    color: #A6A6A6
}
.trip-schedule-accordion .tour-map-wrapper {
    overflow: hidden
}
.trip-schedule-accordion .tour-map-wrapper h6 {
    font-size: 12px;
    font-weight: 700;
    color: #666;
    margin-top: 0;
    margin-bottom: 5px
}
.product-slider-wrapper {
    overflow: hidden
}
.product-slider .item img {
    width: 100%
}
.product-slider .owl-controls .owl-buttons {
    position: static
}
.product-slider .owl-controls .owl-buttons .owl-prev {
    position: absolute;
    top: 50%;
    left: -30px;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    z-index: 999;
    opacity: 0;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.product-slider .owl-controls .owl-buttons .owl-next {
    position: absolute;
    top: 50%;
    right: -30px;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    z-index: 999;
    opacity: 0;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.product-slider:hover .owl-controls .owl-buttons .owl-prev {
    left: 5px;
    opacity: 1
}
.product-slider:hover .owl-controls .owl-buttons .owl-next {
    right: 5px;
    opacity: 1
}
.product-slider-thumb-row {
    margin-left: -8px;
    margin-right: -8px
}
.product-slider-thumb {
    padding: 8px 0
}
.product-slider-thumb .owl-item {
    padding: 8px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.product-slider-thumb .owl-item.synced {
    opacity: .4
}
.product-slider-thumb .item {
    cursor: pointer;
    background-color: #ddd
}
.product-slider-thumb .item img {
    display: block;
    width: 100%
}
.product-tabs {
    margin-top: 62px;
    font-family: Roboto, Sans-Serif;
}
.product-tabs__content .ui-tabs-panel {
    overflow: hidden;
    overflow-x: auto;
    min-height: 500px
}
.product-tabs__content .ui-tabs-panel .check-availability {
    background-color: #fff;
    padding: 20px;
    overflow: hidden;
    margin-bottom: 22px
}
.product-tabs__content .ui-tabs-panel .check-availability label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #666;
    margin-bottom: 8px
}
.product-tabs__content .ui-tabs-panel .check-availability .form-elements {
    float: left
}
.product-tabs__content .ui-tabs-panel .check-availability .form-elements input,
.product-tabs__content .ui-tabs-panel .check-availability .form-elements select {
    background-color: #eee;
    width: 100%;
    height: 36px;
    line-height: 36px
}
.product-tabs__content .ui-tabs-panel .check-availability .form-elements.form-checkin {
    width: 16%;
    margin-right: 2%
}
.product-tabs__content .ui-tabs-panel .check-availability .form-elements.form-checkout {
    width: 16%;
    margin-right: 4%
}
.product-tabs__content .ui-tabs-panel .check-availability .form-elements.form-adult {
    width: 16%;
    margin-right: 2%
}
.product-tabs__content .ui-tabs-panel .check-availability .form-elements.form-kids {
    width: 16%;
    margin-right: 2%
}
.product-tabs__content .ui-tabs-panel .check-availability .form-elements .form-item {
    position: relative
}
.product-tabs__content .ui-tabs-panel .check-availability .form-elements span {
    display: inline-block;
    font-size: 10px;
    font-weight: 600;
    color: #666;
    margin-top: 6px
}
.product-tabs__content .ui-tabs-panel .check-availability .form-elements .awe-icon {
    position: absolute;
    width: 36px;
    height: 34px;
    background-color: #eee;
    line-height: 34px;
    text-align: right;
    top: 1px;
    right: 1px;
    padding-right: 12px;
    font-size: 16px;
    color: #666;
    pointer-events: none
}
.product-tabs__content .ui-tabs-panel .check-availability .form-elements .fa {
    background-color: #eee
}
.product-tabs__content .ui-tabs-panel .check-availability .form-elements .awe-select-wrapper {
    width: 100%
}
.product-tabs__content .ui-tabs-panel .check-availability .form-actions {
    float: left;
    width: 22%;
    margin-left: 4%;
    margin-top: 26px
}
.product-tabs__content .ui-tabs-panel .check-availability .form-actions .awe-btn {
    font-size: 13px;
    font-weight: 600;
    width: 100%;
    padding: 9px 16px
}
.initiative {
    min-width: 680px
}
.room-type-table {
    width: 100%;
    min-width: 650px
}
.room-type-table .room-type {
    width: 53%;
    padding-right: 30px
}
.room-type-table .room-people {
    width: 11.5%;
    padding-right: 30px
}
.room-type-table .room-condition {
    width: 20%;
    padding-right: 30px
}
.room-type-table .room-price {
    width: 14.5%;
    padding-right: 30px
}
.room-type-table thead th {
    font-size: 14px;
    font-weight: 600;
    color: #666;
    border-bottom: 2px solid #A6A6A6;
    padding: 8px 0
}
.room-type-table tbody td {
    vertical-align: top;
    padding-top: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #dcdcdc
}
.room-type-table tbody td.room-type .room-thumb {
    width: 140px;
    float: left;
    margin-right: 30px
}
.room-type-table tbody td.room-type .room-thumb img {
    width: 100%
}
.room-type-table tbody td.room-type .room-title h4 {
    font-weight: 700;
    font-size: 16px;
    margin: 0
}
.room-type-table tbody td.room-type .room-title h4 a {
    color: #262626
}
.room-type-table tbody td.room-type .room-title h4 a:hover {
    color: #194e91
}
.room-type-table tbody td.room-type .room-descriptions {
    font-weight: 600;
    font-size: 13px;
    color: #666
}
.room-type-table tbody td.room-type .room-descriptions p {
    line-height: 1.6em
}
.room-type-table tbody td.room-type .room-type-footer .awe-icon {
    font-size: 11px;
    color: #666;
    margin-right: 14px
}
.room-type-table tbody td.room-people .awe-icon {
    font-size: 20px;
    color: #666
}
.room-type-table tbody td.room-condition .list-condition {
    margin: 0;
    padding-left: 20px
}
.room-type-table tbody td.room-condition .list-condition li {
    font-weight: 600;
    font-size: 13px;
    color: #666;
    padding-bottom: 6px
}
.room-type-table tbody td.room-price .price .amount {
    display: block;
    font-weight: 700;
    font-size: 24px;
    color: #666;
    line-height: normal
}
.room-type-table tbody td.room-price .price em {
    display: block;
    font-weight: 600;
    font-size: 13px;
    font-style: normal;
    color: #666;
    line-height: 1.5em
}
.room-type-table tbody td.room-price .price .full-price-open-popup {
    display: inline-block;
    font-size: 13px;
    color: #194e91;
    text-decoration: underline;
    margin-top: 8px
}
.room-type-table tbody td.room-price .price .full-price-open-popup:hover {
    color: #333
}
.good-to-know-table,
.facilities-freebies-table {
    min-width: 644px
}
.good-to-know-table tbody tr,
.facilities-freebies-table tbody tr {
    border-bottom: 1px solid #D4D4D4
}
.good-to-know-table tbody tr p,
.facilities-freebies-table tbody tr p {
    margin-bottom: 0
}
.good-to-know-table tbody tr p em,
.facilities-freebies-table tbody tr p em {
    display: inline-block;
    color: #194e91;
    margin-left: 20px
}
.good-to-know-table tbody tr th,
.facilities-freebies-table tbody tr th {
    font-size: 13px;
    font-weight: 600;
    color: #262626;
    padding: 18px 0;
    width: 35%;
    padding-right: 20px
}
.good-to-know-table tbody tr th p,
.facilities-freebies-table tbody tr th p {
    position: relative;
    padding-left: 20px
}
.good-to-know-table tbody tr th p:before,
.facilities-freebies-table tbody tr th p:before {
    content: '';
    display: inline-block;
    position: absolute;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background-color: #194e91;
    left: 0;
    top: 8px
}
.good-to-know-table tbody tr td,
.facilities-freebies-table tbody tr td {
    font-size: 13px;
    font-weight: 600;
    color: #777;
    padding: 18px 0;
    width: 65%
}
.good-to-know-table tbody tr td .light,
.facilities-freebies-table tbody tr td .light {
    display: inline-block;
    background-color: #55A649;
    color: #fff;
    padding: 0 10px;
    line-height: 1.8em;
    margin-top: 4px;
    margin-bottom: 4px;
    margin-right: 12px
}
#reviews .rating-info {
    overflow: hidden;
    margin-bottom: 50px
}
#reviews .rating-info .average-rating-review {
    display: inline-block;
    overflow: hidden;
    min-width: 290px;
    float: left
}
#reviews .rating-info .average-rating-review .count {
    display: inline-block;
    width: 70px;
    height: 70px;
    border-radius: 4px;
    line-height: 70px;
    text-align: center;
    font-size: 32px;
    font-weight: 700;
    color: #fff;
    float: left;
    margin-right: 30px
}
#reviews .rating-info .average-rating-review.good .count {
    background-color: #55A649
}
#reviews .rating-info .average-rating-review.fine .count {
    background-color: #F27C38
}
#reviews .rating-info .average-rating-review em {
    display: block;
    font-size: 12px;
    font-weight: 700;
    font-style: normal;
    color: #194e91;
    margin-top: 15px
}
#reviews .rating-info .average-rating-review span {
    display: block;
    font-size: 16px;
    color: #666
}
#reviews .rating-info .rating-review {
    display: inline-block;
    list-style: none;
    padding: 0;
    margin: 0;
    margin-top: 15px
}
#reviews .rating-info .rating-review li {
    display: inline-block;
    padding: 0 20px
}
#reviews .rating-info .rating-review li em {
    display: block;
    font-weight: 700;
    font-size: 12px;
    font-style: normal;
    color: #194e91
}
#reviews .rating-info .rating-review li span {
    display: block;
    font-size: 16px;
    color: #666
}
#reviews .rating-info .write-review {
    display: inline-block;
    font-size: 12px;
    font-weight: 600;
    color: #fff;
    background-color: #194e91;
    line-height: 30px;
    padding: 0 12px;
    white-space: nowrap;
    border-radius: 3px;
    float: right;
    margin-top: 15px
}
#reviews .rating-info .write-review.write-review-active,
#reviews .rating-info .write-review:hover {
    background-color: #444
}
#reviews #add_review {
    background-color: #fff;
    border-radius: 4px;
    padding: 20px;
    display: none
}
#reviews #add_review .comment-reply-title {
    font-size: 18px;
    font-weight: 600;
    color: #444;
    margin-top: 0
}
#reviews #add_review form > div label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #666;
    margin-bottom: 8px
}
#reviews #add_review form > div label .required {
    color: #FF6666
}
#reviews #add_review form .comment-form-author,
#reviews #add_review form .comment-form-email {
    width: 50%;
    margin-bottom: 20px
}
#reviews #add_review form .comment-form-author input,
#reviews #add_review form .comment-form-email input {
    width: 100%;
    background-color: #eee
}
#reviews #add_review form .comment-form-rating {
    width: 50%;
    padding-top: 10px
}
#reviews #add_review form .comment-form-rating h4 {
    border: 0;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 10px
}
#reviews #add_review form .comment-form-rating .comment-form-rating__content {
    overflow: hidden;
    margin-left: -10px;
    margin-right: -10px
}
#reviews #add_review form .comment-form-rating .item {
    width: 25%;
    display: inline-block;
    float: left;
    padding: 0 10px;
    margin-bottom: 15px
}
#reviews #add_review form .comment-form-rating .item label {
    color: #194e91
}
#reviews #add_review form .comment-form-rating .item .awe-select-wrapper {
    width: 100%
}
#reviews #add_review form .comment-form-rating .item .awe-select-wrapper select {
    width: 100%;
    background-color: #eee
}
#reviews #add_review form .comment-form-rating .item .awe-select-wrapper .fa {
    background-color: #eee
}
#reviews #add_review form .comment-form-comment textarea {
    width: 100%;
    height: 140px;
    background-color: #eee
}
#reviews #add_review form .form-submit .submit {
    display: inline-block;
    font-size: 13px;
    font-weight: 600;
    color: #fff;
    background-color: #194e91;
    line-height: 36px;
    padding: 0 12px;
    white-space: nowrap;
    border-radius: 3px;
    border: 0;
    margin-top: 15px;
    min-width: 120px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
#reviews #add_review form .form-submit .submit:hover {
    background-color: #444
}
#reviews #comments .commentlist {
    list-style: none;
    margin: 0;
    padding: 0
}
#reviews #comments .commentlist li .comment-box {
    padding: 20px;
    background-color: #fff;
    margin-top: 10px
}
#reviews #comments .commentlist li .comment-box .avatar {
    width: 50px;
    height: 50px;
    overflow: hidden;
    border-radius: 4px;
    float: left;
    margin-right: 30px
}
#reviews #comments .commentlist li .comment-box .comment-body .meta {
    overflow: hidden;
    margin-top: 0
}
#reviews #comments .commentlist li .comment-box .comment-body .meta strong {
    font-size: 16px;
    font-weight: 700;
    color: #666
}
#reviews #comments .commentlist li .comment-box .comment-body .meta .time {
    font-size: 12px;
    color: #A5A5A5;
    float: right
}
#reviews #comments .commentlist li .comment-box .comment-body .description {
    font-size: 14px;
    color: #A6A6A6
}
#reviews #comments .commentlist li .comment-box .comment-body .description p {
    margin: 0
}
#reviews #comments .commentlist li .comment-box .comment-body .rating-info {
    margin-top: 20px;
    margin-bottom: 0
}
#reviews #comments .commentlist li .comment-box .comment-body .rating-info .average-rating-review {
    min-width: 195px
}
#reviews #comments .commentlist li .comment-box .comment-body .rating-info .average-rating-review .count {
    width: 40px;
    height: 40px;
    line-height: 40px;
    font-size: 16px;
    margin-right: 10px;
    color: #fff
}
#reviews #comments .commentlist li .comment-box .comment-body .rating-info .average-rating-review em {
    margin-top: 0;
    color: #666
}
#reviews #comments .commentlist li .comment-box .comment-body .rating-info .average-rating-review span {
    color: #A6A6A6
}
#reviews #comments .commentlist li .comment-box .comment-body .rating-info .rating-review {
    margin-top: 0
}
#reviews #comments .commentlist li .comment-box .comment-body .rating-info .rating-review li em {
    color: #666
}
#reviews #comments .commentlist li .comment-box .comment-body .rating-info .rating-review li span {
    color: #A6A6A6
}
.initiative__item {
    margin-bottom: 50px
}
.initiative__item:last-child {
    margin-bottom: 0
}
.initiative-top {
    overflow: hidden
}
.initiative-top .title {
    float: left
}
.initiative-top .title .from-to {
    font-size: 18px;
    font-weight: 600;
    color: #333
}
.initiative-top .title .from-to .awe-icon {
    font-size: 10px;
    margin-left: 3px;
    margin-right: 3px
}
.initiative-top .title .time {
    font-size: 13px;
    color: #A5A5A5;
    margin-top: 3px
}
.initiative-top .price {
    float: right;
    text-align: right
}
.initiative-top .price .amount {
    display: block;
    font-size: 18px;
    font-weight: 600;
    color: #666
}
.initiative-top .price a {
    display: block;
    font-size: 13px;
    color: #194e91;
    text-decoration: underline
}
.initiative-top .price a:hover {
    color: #444
}
.initiative-table {
    background-color: #fff;
    width: 100%;
    margin-top: 16px;
    margin-bottom: 10px;
    border-radius: 6px
}
.initiative-table tbody tr {
    border-bottom: 2px solid #D4D4D4
}
.initiative-table tbody tr:last-child {
    border: 0
}
.initiative-table tbody tr th,
.initiative-table tbody tr td {
    padding: 20px
}
.initiative-table tbody tr th {
    width: 170px
}
.initiative-table tbody tr .item-thumb {
    position: relative;
    text-align: center
}
.initiative-table tbody tr .item-thumb:after {
    content: '';
    display: block;
    position: absolute;
    width: 0;
    height: 100%;
    border-right: 2px dotted #D4D4D4;
    top: 0;
    right: -20px
}
.initiative-table tbody tr .item-thumb .text {
    margin-top: 8px
}
.initiative-table tbody tr .item-thumb .text span {
    font-size: 12px;
    font-weight: 400;
    color: #A5A5A5
}
.initiative-table tbody tr .item-thumb .text p {
    font-size: 18px;
    font-weight: 700;
    color: #194e91;
    margin: 0
}
.initiative-table tbody tr .item-body {
    padding: 0 30px;
    font-size: 0;
    overflow: hidden
}
.initiative-table tbody tr .item-body .item-from,
.initiative-table tbody tr .item-body .item-time,
.initiative-table tbody tr .item-body .item-to {
    display: inline-block;
    width: 33.3%;
    padding: 0 20px;
    text-align: center;
    vertical-align: middle
}
.initiative-table tbody tr .item-body .item-time .fa {
    display: block;
    font-size: 20px;
    color: #A6A6A6
}
.initiative-table tbody tr .item-body .item-time span {
    display: inline-block;
    font-weight: 600;
    font-size: 14px;
    color: #A5A5A5;
    padding: 8px 6px;
    border-top: 1px dashed #A5A5A5;
    margin-top: 10px
}
.initiative-table tbody tr .item-body .item-from h3,
.initiative-table tbody tr .item-body .item-to h3 {
    font-size: 18px;
    font-weight: 700;
    color: #194e91;
    margin: 0
}
.initiative-table tbody tr .item-body .item-from .time,
.initiative-table tbody tr .item-body .item-to .time {
    display: block;
    font-size: 18px;
    font-weight: 700;
    color: #A5A5A5
}
.initiative-table tbody tr .item-body .item-from .date,
.initiative-table tbody tr .item-body .item-to .date {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: #666;
    margin-top: 4px
}
.initiative-table tbody tr .item-body .item-from .desc,
.initiative-table tbody tr .item-body .item-to .desc {
    font-size: 14px;
    color: #A5A5A5;
    margin-top: 2px
}
.services-on-flight {
    overflow: hidden
}
.services-on-flight .item {
    width: 50%;
    float: left;
    margin: 6px 0
}
.services-on-flight .item label {
    position: relative;
    display: block;
    margin: 0;
    font-size: 14px;
    font-weight: 400;
    color: #666;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none
}
.services-on-flight .item label .awe-icon-check {
    position: relative;
    font-size: 7px;
    width: 15px;
    height: 15px;
    line-height: 11px;
    text-align: center;
    border: 2px solid #A6A6A6;
    color: transparent;
    top: -2px;
    margin-right: 8px
}
.services-on-flight .item label > input[type="radio"],
.services-on-flight .item label > input[type="checkbox"] {
    display: none
}
.services-on-flight .item label > input[type="radio"]:checked ~ .awe-icon-check,
.services-on-flight .item label > input[type="checkbox"]:checked ~ .awe-icon-check {
    color: #194e91
}
.detail-sidebar {
    margin-top: 72px
}
.call-to-book {
    margin-bottom: 18px
}
.call-to-book .awe-icon {
    width: 30px;
    height: 30px;
    line-height: 26px;
    border: 2px solid #666;
    text-align: center;
    font-size: 18px;
    color: #666;
    border-radius: 50%;
    float: left;
    margin-right: 12px;
    margin-top: 2px
}
.call-to-book em {
    display: block;
    font-size: 13px;
    font-style: normal;
    color: #A5A5A5;
    line-height: 1.2em
}
.call-to-book span {
    display: block;
    font-weight: 600;
    font-size: 16px;
    color: #666;
    line-height: 1.4em
}
.booking-info {
    position: relative;
    background-color: #fff;
    border: 2px solid #FF6666;
    border-radius: 3px 3px 3px 0;
    padding: 22px 20px;
    padding-bottom: 0;
    margin-bottom: 100px;
    z-index: 9
}
.booking-info:after {
    content: '';
    display: table;
    clear: both
}
.booking-info .form-group {
    overflow: hidden
}
.booking-info .form-adult,
.booking-info .form-checkin {
    float: left;
    width: 50%;
    padding-right: 5px
}
.booking-info .form-adult span,
.booking-info .form-checkin span {
    font-size: 10px;
    color: #F98718
}
.booking-info .form-kids,
.booking-info .form-checkout {
    float: left;
    width: 50%;
    padding-left: 5px
}
.booking-info .form-kids span,
.booking-info .form-checkout span {
    font-size: 10px;
    color: #F98718
}
.booking-info h3 {
    font-size: 18px;
    font-weight: 700;
    color: #1F2021;
    margin: 0;
    margin-bottom: 18px
}
.booking-info .awe-select-wrapper {
    width: 100%
}
.booking-info input,
.booking-info select {
    background-color: #eee;
    height: 36px;
    line-height: 36px;
    width: 100%;
    padding: 0 10px
}
.booking-info .awe-icon,
.booking-info .fa {
    height: 34px;
    line-height: 34px;
    top: 1px;
    right: 1px;
    background-color: #eee
}
.booking-info label {
    font-weight: 600;
    font-size: 13px;
    color: #1E1E1F;
    margin-bottom: 8px
}
.booking-info .form-room {
    margin-top: 18px
}
.booking-info .form-room .form-group {
    margin-bottom: 10px
}
.booking-info .form-room .form-group .form-item:nth-child(odd) {
    padding-right: 5px
}
.booking-info .form-room .form-group .form-item:nth-child(even) {
    padding-left: 5px
}
.booking-info .form-room .awe-select-wrapper {
    width: 100%
}
.booking-info .form-room .form-item {
    float: left;
    width: 50%
}
.booking-info .form-baggage-weight .form-item {
    margin-bottom: 10px
}
.booking-info .form-baggage-weight span {
    display: block;
    font-size: 10px;
    color: #F98718;
    margin-top: -5px
}
.booking-info .form-select-date {
    margin-bottom: 20px
}
.booking-info .form-select-date span {
    display: block;
    font-size: 10px;
    color: #F98718;
    margin-top: 5px
}
.booking-info .form-select-date .form-item {
    position: relative
}
.booking-info .form-select-date .form-item .awe-icon,
.booking-info .form-select-date .form-item .fa {
    position: absolute;
    width: 36px;
    height: 34px;
    background-color: #eee;
    line-height: 34px;
    text-align: right;
    top: 1px;
    right: 1px;
    padding-right: 12px;
    font-size: 16px;
    color: #666;
    pointer-events: none
}
.booking-info .add-room-type {
    padding: 5px 0
}
.booking-info .add-room-type > a {
    font-weight: 600;
    font-size: 13px;
    color: #666
}
.booking-info .add-room-type > a:hover {
    color: #194e91
}
.booking-info .add-room-type .awe-icon {
    background: none;
    margin-right: 10px
}
.booking-info .price {
    position: relative;
    border-top: 1px dashed #A6A6A6;
    margin-left: -20px;
    margin-right: -20px;
    margin-top: 18px;
    padding: 20px
}
.booking-info .price em {
    display: block;
    font-size: 12px;
    font-style: normal;
    color: #A6A6A6
}
.booking-info .price .amount {
    display: block;
    font-weight: 700;
    font-size: 24px;
    color: #FF6666
}
.booking-info .price .cart-added {
    position: absolute;
    text-align: center;
    top: 50%;
    right: 20px;
    font-size: 12px;
    color: #57A440;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%)
}
.booking-info .price .cart-added .awe-icon {
    display: block;
    width: 22px;
    height: 22px;
    text-align: center;
    line-height: 22px;
    background-color: #55A649;
    font-size: 10px;
    color: #fff;
    border-radius: 50%;
    margin: 0 auto 5px
}
.booking-info .reset {
    position: absolute;
    top: 22px;
    right: 20px;
    font-size: 12px;
    font-weight: 600;
    color: #FF6666
}
.booking-info .reset a {
    color: inherit;
    text-decoration: underline
}
.booking-info .form-submit {
    overflow: hidden;
    position: absolute;
    left: -2px;
    right: -2px;
    top: 100%;
    -webkit-transform: translateY(2px);
    -moz-transform: translateY(2px);
    -ms-transform: translateY(2px);
    -o-transform: translateY(2px);
    transform: translateY(2px)
}
.booking-info .form-submit .add-to-cart {
    float: left
}
.booking-info .form-submit .add-to-cart button {
    font-size: 13px;
    color: #FCF2E5;
    background-color: #FF6666;
    border: 0;
    cursor: pointer;
    line-height: 46px;
    height: 46px;
    padding: 0 26px;
    border-radius: 0 0 5px 5px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.booking-info .form-submit .add-to-cart button:hover {
    background-color: #444
}
.booking-info .form-submit .add-to-cart .awe-icon {
    background: none;
    margin-right: 10px
}
.booking-info .form-submit .view-cart {
    float: right
}
.booking-info .form-submit .view-cart a {
    display: inline-block;
    font-size: 13px;
    color: #FCF2E5;
    background-color: #444444;
    border: 0;
    cursor: pointer;
    line-height: 46px;
    height: 46px;
    padding: 0 10px;
    border-radius: 0 0 5px 5px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.booking-info .form-submit .view-cart a:hover {
    background-color: #FF6666
}
#page-wrap.dark .booking-info .price .cart-added .awe-icon {
    height: 22px
}
.mfp-wrap {
    z-index: 9999999
}
.mfp-bg {
    z-index: 999999
}
.mfp-preloader {
    color: #fff
}
.sale-flights-tabs-wrap {
    overflow: hidden;
    overflow-x: auto
}
.sale-flight-popup {
    position: relative;
    background-color: #fff;
    padding: 46px 86px;
    max-width: 970px;
    margin: 50px auto;
    border-radius: 3px
}
.sale-flight-popup .mfp-close {
    font-size: 14px;
    color: #fff;
    width: auto;
    height: auto;
    line-height: normal;
    top: -30px;
    opacity: 1;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.sale-flight-popup .mfp-close .awe-icon {
    vertical-align: middle;
    font-size: 20px;
    margin-left: 4px;
    pointer-events: none
}
.sale-flight-popup .mfp-close:hover {
    color: #194e91
}
.sale-flight-popup .title {
    margin-bottom: 18px
}
.sale-flight-popup .title .from-to {
    font-size: 18px;
    font-weight: 600;
    color: #333
}
.sale-flight-popup .title .from-to .awe-icon {
    font-size: 10px;
    margin-left: 3px;
    margin-right: 3px
}
.sale-flight-popup .title .time {
    font-size: 13px;
    color: #A5A5A5;
    margin-top: 3px
}
.sale-flight-popup .sale-flights-tabs__table {
    min-width: 700px
}
.sale-flight-popup .sale-flights-tabs__table tr {
    background-color: #f1f1f1;
    -webkit-box-shadow: inset 0 0 0 2px transparent;
    -moz-box-shadow: inset 0 0 0 2px transparent;
    box-shadow: inset 0 0 0 2px transparent
}
.sale-flight-popup .sale-flights-tabs__table tr:hover {
    -webkit-box-shadow: inset 0 0 0 2px #194e91;
    -moz-box-shadow: inset 0 0 0 2px #194e91;
    box-shadow: inset 0 0 0 2px #194e91
}
.sale-flight-popup .sale-flights-tabs__table tr td {
    min-width: 110px
}
.room-type-popup {
    position: relative;
    background-color: #fff;
    max-width: 970px;
    margin: 50px auto;
    border-radius: 3px;
    overflow: hidden;
    overflow-x: auto
}
.room-type-popup .room-type-popup-inner {
    min-width: 950px;
    padding: 46px 86px
}
.room-type-popup .mfp-close {
    font-size: 14px;
    color: #fff;
    width: auto;
    height: auto;
    line-height: normal;
    top: -30px;
    opacity: 1;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
.room-type-popup .mfp-close .awe-icon {
    vertical-align: middle;
    font-size: 20px;
    margin-left: 4px;
    pointer-events: none
}
.room-type-popup .mfp-close:hover {
    color: #194e91
}
.room-type-popup .room-type-popup__top {
    overflow: hidden;
    margin-bottom: 32px
}
.room-type-popup .form-elements label {
    font-weight: 600;
    font-size: 13px;
    color: #666
}
.room-type-popup .form-elements select,
.room-type-popup .form-elements input {
    background-color: #eee;
    width: 100%
}
.room-type-popup .form-elements .form-item {
    position: relative
}
.room-type-popup .form-elements .awe-icon {
    position: absolute;
    width: 36px;
    height: 36px;
    background-color: #eee;
    line-height: 36px;
    text-align: right;
    top: 1px;
    right: 1px;
    padding-right: 12px;
    font-size: 16px;
    color: #666;
    pointer-events: none
}
.room-type-popup .form-room-type {
    width: 46%;
    float: left;
    margin-right: 4%
}
.room-type-popup .form-room-type .awe-select-wrapper {
    width: 100%
}
.room-type-popup .form-room-type .awe-select-wrapper .fa {
    background-color: #eee
}
.room-type-popup .form-room-type select {
    width: 100%
}
.room-type-popup .form-checkin {
    width: 24.5%;
    float: left;
    margin-right: 0.5%
}
.room-type-popup .form-checkout {
    width: 24.5%;
    float: left;
    margin-left: 0.5%
}
.room-type-popup .calendar-header {
    position: relative;
    background-color: #eee;
    text-align: center
}
.room-type-popup .calendar-header h2 {
    font-weight: 600;
    font-size: 14px;
    color: #A5A5A5;
    margin: 0;
    line-height: 30px
}
.room-type-popup .calendar-header .calendar-prev,
.room-type-popup .calendar-header .calendar-next {
    position: absolute;
    display: inline-block;
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    font-size: 16px;
    color: #A5A5A5;
    top: 0;
    z-index: 9
}
.room-type-popup .calendar-header .calendar-prev:hover,
.room-type-popup .calendar-header .calendar-next:hover {
    color: #194e91
}
.room-type-popup .calendar-header .calendar-prev {
    left: 0
}
.room-type-popup .calendar-header .calendar-next {
    right: 0
}
.room-type-popup .calendar-body {
    width: 100%;
    table-layout: fixed
}
.room-type-popup .calendar-body thead tr th {
    padding-top: 15px;
    padding-bottom: 4px
}
.room-type-popup .calendar-body thead tr th span {
    font-size: 14px;
    font-weight: 400;
    color: #666
}
.room-type-popup .calendar-body tbody tr td {
    border: 3px solid #fff
}
.room-type-popup .calendar-body tbody .item-calendar {
    position: relative;
    background-color: #eee;
    height: 84px;
    padding: 8px 10px;
    cursor: pointer
}
.room-type-popup .calendar-body tbody .item-calendar.sat,
.room-type-popup .calendar-body tbody .item-calendar.sun {
    background-color: #D4D4D4
}
.room-type-popup .calendar-body tbody .item-calendar.not-available {
    background-color: #A6A6A6
}
.room-type-popup .calendar-body tbody .item-calendar.not-available .not-available-text {
    position: absolute;
    font-size: 14px;
    color: #fff;
    text-align: center;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%)
}
.room-type-popup .calendar-body tbody .item-calendar.item-active {
    background-color: #194e91
}
.room-type-popup .calendar-body tbody .item-calendar.item-active .date,
.room-type-popup .calendar-body tbody .item-calendar.item-active .price {
    color: #fff
}
.room-type-popup .calendar-body tbody .item-calendar .date {
    font-weight: 600;
    font-size: 14px;
    color: #262626
}
.room-type-popup .calendar-body tbody .item-calendar .date em {
    display: block;
    font-size: 12px;
    font-weight: 400;
    color: #A6A6A6
}
.room-type-popup .calendar-body tbody .item-calendar .price {
    position: absolute;
    font-weight: 700;
    font-size: 18px;
    color: #666;
    bottom: 8px;
    right: 10px
}
.product-map {
    height: 160px;
    margin-top: 12px
}
.tour-map {
    max-width: 100%;
    width: 470px;
    height: 250px;
    float: left;
    margin-right: 30px
}
#page-wrap.dark {
    background-color: #1E1E1F
}
#page-wrap.dark textarea,
#page-wrap.dark input[type="search"],
#page-wrap.dark input[type="text"],
#page-wrap.dark input[type="url"],
#page-wrap.dark input[type="number"],
#page-wrap.dark input[type="password"],
#page-wrap.dark input[type="email"],
#page-wrap.dark input[type="file"] select {
    background-color: #262626;
    border-color: #606060;
    color: #a6a6a6
}
#page-wrap.dark .awe-btn {
    background-color: #444;
    border-color: #444;
    color: #fff
}
#page-wrap.dark .awe-btn.awe-btn-style2 {
    border: 0;
    background-color: #ddd;
    color: #666
}
#page-wrap.dark .awe-btn.awe-btn-style3 {
    border: 0;
    background-color: #194e91;
    color: #fff
}
#page-wrap.dark .awe-btn.awe-btn-style3:focus,
#page-wrap.dark .awe-btn.awe-btn-style3:hover {
    background-color: #575757;
    color: #fff
}
#page-wrap.dark .awe-btn:focus,
#page-wrap.dark .awe-btn:hover {
    background-color: #194e91;
    border-color: #194e91;
    color: #111
}
#page-wrap.dark #header-page {
    background-color: #194e91
}
#page-wrap.dark #header-page .header-page__inner {
    background-color: #194e91
}
#page-wrap.dark .minicart-wrap .toggle-minicart {
    color: #111;
    border-left: 1px solid rgba(0, 0, 0, 0.1)
}
#page-wrap.dark .search-box .searchtoggle {
    color: #111;
    border-left: 1px solid rgba(0, 0, 0, 0.1);
    border-right: 1px solid rgba(0, 0, 0, 0.1)
}
#page-wrap.dark .preloader {
    background-color: #111
}
#page-wrap.dark .awe-navigation .menu-list li a {
    color: #000;
    font-size: 12px;
    text-transform: uppercase
}
#page-wrap.dark .awe-navigation .menu-list li:hover > a,
#page-wrap.dark .awe-navigation .menu-list li.current-menu-parent > a,
#page-wrap.dark .awe-navigation .menu-list li.current-menu-item > a {
    color: #fff
}
#page-wrap.dark .awe-navigation .menu-list li .sub-menu li:hover > a,
#page-wrap.dark .awe-navigation .menu-list li .sub-menu li.current-menu-parent > a,
#page-wrap.dark .awe-navigation .menu-list li .sub-menu li.current-menu-item > a {
    color: #194e91
}
#page-wrap.dark .awe-navigation-responsive {
    background-color: #111;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-right: 0;
    border-bottom: 0
}
#page-wrap.dark .awe-navigation-responsive .menu-list li {
    border-bottom: 1px solid rgba(255, 255, 255, 0.2)
}
#page-wrap.dark .awe-navigation-responsive .menu-list li:first-child {
    border-top: 1px solid rgba(255, 255, 255, 0.2)
}
#page-wrap.dark .awe-navigation-responsive .menu-list li a {
    color: #8F9AB3
}
#page-wrap.dark .awe-navigation-responsive .menu-list li.current-menu-parent > a,
#page-wrap.dark .awe-navigation-responsive .menu-list li.current-menu-item > a {
    color: #fff
}
#page-wrap.dark .awe-navigation-responsive .menu-list li .sub-menu {
    background-color: #111
}
#page-wrap.dark .awe-navigation-responsive .menu-list li .submenu-toggle {
    border-left: 1px solid rgba(255, 255, 255, 0.2)
}
#page-wrap.dark .heading-content h2 {
    color: #194e91
}
#page-wrap.dark .tabs .ui-tabs-nav:after {
    border-bottom-color: #333
}
#page-wrap.dark .tabs .ui-tabs-nav li .ui-tabs-anchor {
    color: #666
}
#page-wrap.dark .tabs .ui-tabs-nav li.ui-tabs-active .ui-tabs-anchor {
    color: #194e91
}
#page-wrap.dark .accordion .ui-accordion-header {
    background-color: #333;
    color: #194e91
}
#page-wrap.dark .accordion .ui-state-active .ui-icon,
#page-wrap.dark .accordion .ui-widget-content .ui-state-active .ui-icon {
    border-top-color: #194e91
}
#page-wrap.dark .accordion .ui-widget-content {
    color: #A5A5A5
}
#page-wrap.dark .accordion .ui-widget-content h1,
#page-wrap.dark .accordion .ui-widget-content h2,
#page-wrap.dark .accordion .ui-widget-content h3,
#page-wrap.dark .accordion .ui-widget-content h4,
#page-wrap.dark .accordion .ui-widget-content h5,
#page-wrap.dark .accordion .ui-widget-content h6 {
    color: #fff
}
#page-wrap.dark .destination-grid-content .section-title h3 {
    color: #fff
}
#page-wrap.dark .destination-grid-content .more-destination a {
    color: #111;
    font-weight: 600
}
#page-wrap.dark .awe-search-tabs .ui-tabs-nav:before {
    background-color: #194e91
}
#page-wrap.dark .accordion h1,
#page-wrap.dark .accordion h2,
#page-wrap.dark .accordion h3,
#page-wrap.dark .accordion h4,
#page-wrap.dark .accordion h5,
#page-wrap.dark .accordion h6 {
    color: #fff
}
#page-wrap.dark .awe-search-tabs .ui-tabs-nav li .ui-tabs-anchor {
    color: #333;
    border-left: 1px solid rgba(0, 0, 0, 0.2)
}
#page-wrap.dark .awe-search-tabs .ui-tabs-nav li:last-child .ui-tabs-anchor {
    border-right: 1px solid rgba(0, 0, 0, 0.2) !important
}
#page-wrap.dark .awe-search-tabs .ui-tabs-nav li.ui-tabs-active .ui-tabs-anchor {
    background-color: #333;
    border-color: #333;
    color: #fff
}
#page-wrap.dark .awe-search-tabs .ui-tabs-nav li.ui-tabs-active + li .ui-tabs-anchor {
    border-color: #333
}
#page-wrap.dark .awe-search-tabs__content {
    background: url("../images/pattern2.png");
    background-repeat: repeat;
    background-color: transparent
}
#page-wrap.dark .awe-search-tabs__content .ui-tabs-panel h2 {
    color: #D4D4D4
}
#page-wrap.dark .awe-search-tabs__content .ui-tabs-panel .form-elements label {
    color: #194e91
}
#page-wrap.dark .awe-search-tabs__content .ui-tabs-panel .form-elements input,
#page-wrap.dark .awe-search-tabs__content .ui-tabs-panel .form-elements select {
    background-color: #444;
    border-color: #606060;
    color: #A6A6A6
}
#page-wrap.dark .awe-search-tabs__content .ui-tabs-panel .form-elements .fa,
#page-wrap.dark .awe-search-tabs__content .ui-tabs-panel .form-elements .awe-icon {
    background-color: #444
}
#page-wrap.dark .awe-search-tabs-2 .awe-search-tabs__content {
    background-image: none;
    background-color: rgba(0, 0, 0, 0.8)
}
#page-wrap.dark .destination-content .section-title h3 {
    color: #fff
}
#page-wrap.dark .awe-masonry .awe-masonry__item > a:after {
    border-color: #1E1E1F
}
#page-wrap.dark .sale-flights-tabs__table tr {
    background-color: #262626
}
#page-wrap.dark .sale-flights-tabs__table tr .sale-flights-tabs__item-flight:before,
#page-wrap.dark .sale-flights-tabs__table tr .sale-flights-tabs__item-flight:after {
    background-color: #262626
}
#page-wrap.dark .sale-flights-tabs__table tr .sale-flights-tabs__item-flight .image-wrap {
    border: 0
}
#page-wrap.dark .sale-flights-tabs__table tr .sale-flights-tabs__item-depart h4,
#page-wrap.dark .sale-flights-tabs__table tr .sale-flights-tabs__item-arrive h4,
#page-wrap.dark .sale-flights-tabs__table tr .sale-flights-tabs__item-duration h4 {
    color: #FDFDFD
}
#page-wrap.dark .sale-flights-tabs__table tr .sale-flights-tabs__item-choose:after {
    border-left-color: #444
}
#page-wrap.dark .widget_has_radio_checkbox_text .widget_content label .awe-icon-check {
    border-color: #444
}
#page-wrap.dark .awe-services__list li {
    color: #194e91;
    border-bottom-color: #666
}
#page-wrap.dark .awe-services__list li .awe-icon-check {
    border-color: #444
}
#page-wrap.dark .awe-services__list li .awe-icon-arrow-right {
    color: #444
}
#page-wrap.dark .awe-services__list li:hover .awe-icon-check {
    border-color: #262626;
    background-color: #262626;
    color: #194e91
}
#page-wrap.dark .awe-services__list li:hover .awe-icon-arrow-right {
    color: #194e91
}
#page-wrap.dark #footer-page {
    position: relative;
    z-index: 9
}
#page-wrap.dark #footer-page:after {
    content: '';
    display: block;
    position: absolute;
    width: 100%;
    height: 0;
    top: 0;
    left: 0;
    border-top: 2px solid #262626;
    z-index: -1
}
#page-wrap.dark .checkout-page__top .title h1 {
    color: #194e91
}
#page-wrap.dark .checkout-page__top .phone {
    color: #A5A5A5
}
#page-wrap.dark .checkout-page__sidebar ul li:before {
    background-color: #262626
}
#page-wrap.dark .checkout-page__sidebar ul li a {
    background-color: #333
}
#page-wrap.dark .checkout-page__sidebar ul li.current:before {
    border-color: transparent
}
#page-wrap.dark .checkout-page__sidebar ul li.current a {
    background-color: #194e91;
    color: #111
}
#page-wrap.dark .checkout-page__content .yourcart-content,
#page-wrap.dark .checkout-page__content .customer-content,
#page-wrap.dark .checkout-page__content .complete-content {
    background-color: #333
}
#page-wrap.dark .checkout-page__content .content-title h2 {
    color: #fff
}
#page-wrap.dark .cart-content .cart-table tbody td .quantity .qty {
    background-color: #333
}
#page-wrap.dark .cart-footer .cart-subtotal .coupon-code input#coupon {
    background-color: #262626;
    border-color: #606060
}
#page-wrap.dark .cart-footer .shipping-handling .check-shipping-rate h4 {
    color: #fff
}
#page-wrap.dark .cart-footer .shipping-handling .check-shipping-rate .form-row input {
    background-color: #262626;
    border-color: #606060
}
#page-wrap.dark .cart-footer .shipping-handling .check-shipping-rate .form-row.form-country select {
    background-color: #262626;
    border-color: #606060
}
#page-wrap.dark .cart-footer .shipping-handling .check-shipping-rate .form-row.form-country .awe-select-wrapper .fa {
    background-color: #262626
}
#page-wrap.dark .woocommerce-error,
#page-wrap.dark .woocommerce-info,
#page-wrap.dark .woocommerce-message {
    background-color: #444;
    color: #fff
}
#page-wrap.dark .checkout-page__content .woocommerce-shipping-fields .shipping_address .form-row input,
#page-wrap.dark .checkout-page__content .woocommerce-billing-fields .form-row input {
    background-color: #262626;
    border-color: #606060;
    color: #a6a6a6
}
#page-wrap.dark .checkout-page__content .coupon .form-row.form-row-first input,
#page-wrap.dark .checkout-page__content .woocommerce-shipping-fields .shipping_address #order_comments_field textarea,
#page-wrap.dark .checkout-page__content .woocommerce-billing-fields #billing_country_field .country_select a,
#page-wrap.dark .checkout-page__content .woocommerce-shipping-fields .shipping_address #billing_country_field .country_select a {
    background-color: #262626;
    border-color: #606060;
    color: #a6a6a6
}
#page-wrap.dark .checkout-page__content .woocommerce-billing-fields h3 {
    border-color: #666;
    color: #fff
}
#page-wrap.dark .checkout-page__content .woocommerce-shipping-fields #ship-to-different-address label,
#page-wrap.dark .checkout-page__content .woocommerce-shipping-fields .shipping_address .form-row label,
#page-wrap.dark .checkout-page__content .woocommerce-billing-fields .form-row label {
    color: #a6a6a6
}
#page-wrap.dark .cart-detail h3,
#page-wrap.dark .billing-info h3,
#page-wrap.dark .your-order h2,
#page-wrap.dark .checkout-page__content #payment h3 {
    border-color: #666;
    color: #fff
}
#page-wrap.dark .checkout-page__content #payment > .payment_methods li label {
    color: #fff
}
#page-wrap.dark .checkout-page__content #payment .place-order {
    border-top-color: #666
}
#page-wrap.dark .billing-info .billing-table td h4,
#page-wrap.dark .order-table thead tr th {
    color: #d4d4d4
}
#page-wrap.dark .cart-detail .cart-detail-table tfoot th,
#page-wrap.dark .cart-detail .cart-detail-table td {
    color: #a6a6a6
}
#page-wrap.dark .cart-detail .cart-detail-table td {
    font-weight: 400
}
#page-wrap.dark .related-post .post,
#page-wrap.dark .blog-page__content .post {
    border-color: #666
}
#page-wrap.dark .related-post .post .post-content,
#page-wrap.dark .blog-page__content .post .post-content {
    color: #d4d4d4
}
#page-wrap.dark .blog-page__content .post .post-content h1,
#page-wrap.dark .blog-page__content .post .post-content h2,
#page-wrap.dark .blog-page__content .post .post-content h3,
#page-wrap.dark .blog-page__content .post .post-content h4,
#page-wrap.dark .blog-page__content .post .post-content h5,
#page-wrap.dark .blog-page__content .post .post-content h6 {
    color: white
}
#page-wrap.dark .page-sidebar .widget_has_thumbnail .content a,
#page-wrap.dark .page-sidebar .widget_latest_post ul li a,
#page-wrap.dark .page-sidebar .widget_rss ul li a,
#page-wrap.dark .page-sidebar .widget_meta ul li a,
#page-wrap.dark .page-sidebar .widget_pages ul li a,
#page-wrap.dark .page-sidebar .widget_nav_menu ul li a,
#page-wrap.dark .page-sidebar .widget_categories ul li a,
#page-wrap.dark .page-sidebar .widget_archive ul li a {
    color: #ddd
}
#page-wrap.dark .page-sidebar .widget_has_thumbnail .content a:hover,
#page-wrap.dark .page-sidebar .widget_latest_post ul li a:hover,
#page-wrap.dark .page-sidebar .widget_rss ul li a:hover,
#page-wrap.dark .page-sidebar .widget_meta ul li a:hover,
#page-wrap.dark .page-sidebar .widget_pages ul li a:hover,
#page-wrap.dark .page-sidebar .widget_nav_menu ul li a:hover,
#page-wrap.dark .page-sidebar .widget_categories ul li a:hover,
#page-wrap.dark .page-sidebar .widget_archive ul li a:hover {
    color: #194e91
}
#page-wrap.dark #comments .comment-abs a,
#page-wrap.dark .post-footer .cat-box .cat a,
#page-wrap.dark .post-footer .tag-box .tag a,
#page-wrap.dark .tagcloud a {
    background-color: #333
}
#page-wrap.dark #comments .comment-abs a:hover,
#page-wrap.dark .post-footer .cat-box .cat a:hover,
#page-wrap.dark .post-footer .tag-box .tag a:hover,
#page-wrap.dark .tagcloud a:hover {
    background-color: #194e91
}
#page-wrap.dark .page__pagination span,
#page-wrap.dark .page__pagination a {
    color: #a6a6a6;
    background-color: #333
}
#page-wrap.dark .page__pagination span.current,
#page-wrap.dark .page__pagination span:hover,
#page-wrap.dark .page__pagination a.current,
#page-wrap.dark .page__pagination a:hover {
    color: #000;
    background-color: #194e91
}
#page-wrap.dark .related-post .post .post-title h1,
#page-wrap.dark .blog-page__content .post .post-title h1 {
    color: #194e91
}
#page-wrap.dark #comments cite.fn a,
#page-wrap.dark .post-footer > div h4 {
    color: #d4d4d4
}
#page-wrap.dark #comments cite.fn a:hover {
    color: #194e91
}
#page-wrap.dark .related-post,
#page-wrap.dark .about-author {
    border-color: #666
}
#page-wrap.dark .about-author .author-title h4 {
    color: #a5a5a5
}
#page-wrap.dark .about-author .author-name h3 {
    color: #194e91
}
#page-wrap.dark #respond .reply-title h4 {
    color: #fff
}
#page-wrap.dark .owl-carousel .owl-controls .owl-buttons > div .fa {
    background-color: #333
}
#page-wrap.dark .awe-navigation .menu-list li .sub-menu,
#page-wrap.dark .minicart-wrap .minicart-body {
    background-color: #333;
    border-color: #4A4A4A
}
#page-wrap.dark .awe-navigation .menu-list li .sub-menu li a {
    color: #ddd;
    border-color: #4A4A4A
}
#page-wrap.dark .minicart-wrap .minicart-body .minicart-footer,
#page-wrap.dark .minicart-wrap .minicart-body .minicart-total,
#page-wrap.dark .minicart-wrap .minicart-body .minicart-list {
    border-color: #4A4A4A
}
#page-wrap.dark .minicart-wrap .minicart-body .minicart-list li .product-name a {
    color: #ddd
}
#page-wrap.dark .minicart-wrap .minicart-body .minicart-list li .product-name a:hover {
    color: #194e91
}
#page-wrap.dark .minicart-wrap .minicart-body .minicart-list li .product-price .amount {
    color: #d4d4d4
}
#page-wrap.dark .minicart-wrap .minicart-body .minicart-list li .product-remove a {
    color: #a6a6a6
}
#page-wrap.dark .minicart-wrap .minicart-body .minicart-list li .product-remove a:hover {
    color: #194e91
}
#page-wrap.dark .blog-heading-content h2 {
    background-color: #1E1E1F;
    color: #194e91
}
#page-wrap.dark .login-register-page__content form:after {
    background-color: #194e91
}
#page-wrap.dark .login-register-page__content form .form-item label {
    color: #333
}
#page-wrap.dark .login-register-page__content form .terms-conditions,
#page-wrap.dark .login-register-page__content form .forgot-password {
    color: #333
}
#page-wrap.dark .login-register-page__content form .terms-conditions:hover,
#page-wrap.dark .login-register-page__content form .forgot-password:hover {
    color: #444
}
#page-wrap.dark .login-register-page__content form .form-item input {
    background-color: #F2F2F2;
    border: 0;
    color: #666
}
#page-wrap.dark .login-register-page__content form .form-actions input {
    background-color: #212122;
    color: #194e91
}
#page-wrap.dark .login-register-page__content form .form-actions input:hover {
    opacity: 1;
    background-color: #fff
}
#page-wrap.dark .contact-page__form .descriptions {
    color: #a6a6a6
}
#page-wrap.dark .travelling-block {
    background-color: rgba(30, 30, 31, 0.9)
}
#page-wrap.dark .travelling-block .title h2 {
    color: #fff
}
#page-wrap.dark .purpose-slider .owl-controls .owl-buttons > div .fa {
    background-color: transparent
}
#page-wrap.dark .travelling-tabs__time .season .item a .awe-icon,
#page-wrap.dark .purpose-slider .item .awe-icon {
    background-color: rgba(255, 255, 255, 0.2);
    color: white !important
}
#page-wrap.dark .travelling-tabs .ui-tabs-nav li .ui-tabs-anchor {
    border-color: #444
}
#page-wrap.dark .travelling-tabs .ui-tabs-nav li.ui-tabs-active .ui-tabs-anchor,
#page-wrap.dark .purpose-slider .item:hover .awe-icon {
    color: #1E1E1F
}
#page-wrap.dark .travelling-tabs .ui-tabs-nav li.ui-state-hover .ui-tabs-anchor {
    color: #888;
    border-color: #666666
}
#page-wrap.dark .travelling-tabs__region .item span,
#page-wrap.dark .purpose-slider .item span {
    color: #fff
}
#page-wrap.dark .travelling-tabs__region .item:hover span,
#page-wrap.dark .purpose-slider .item:hover span {
    color: #194e91
}
#page-wrap.dark .travelling-tabs__region .item .awe-icon {
    color: #fff;
    opacity: .2
}
#page-wrap.dark .travelling-tabs__region .item:hover .awe-icon {
    color: #194e91;
    opacity: 1
}
#page-wrap.dark .travelling-tabs__advance-filter label,
#page-wrap.dark .travelling-tabs__price .budget-level label,
#page-wrap.dark .travelling-tabs__price .currency label {
    color: #194e91
}
#page-wrap.dark .travelling-tabs__price .currency span,
#page-wrap.dark .travelling-tabs__price .price_slider_amount {
    color: #a5a5a5
}
#page-wrap.dark .travelling-tabs__price .currency .awe-select-wrapper .fa,
#page-wrap.dark .travelling-tabs__price .currency .awe-select-wrapper select {
    background-color: #444;
    border: 0;
    color: #a6a6a6
}
#page-wrap.dark .travelling-tabs__time .season .item a span {
    color: #fff;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease
}
#page-wrap.dark .travelling-tabs__time .season .item.hover-active a .awe-icon {
    background-color: #194e91;
    color: #1E1E1F
}
#page-wrap.dark .travelling-tabs__time .season .item.hover-active a span {
    color: #194e91
}
#page-wrap.dark .your-destinations .title h2,
#page-wrap.dark .travelling-tabs__time .month .item a {
    color: #fff
}
#page-wrap.dark .travelling-tabs__time .month .item a:before,
#page-wrap.dark .travelling-tabs__time .month .item:after {
    border-color: #fff
}
#page-wrap.dark .travelling-tabs__time .month .item.hover-active a:before {
    border-color: #194e91
}
#page-wrap.dark .travelling-tabs__time .month .item.hover-active a {
    color: #194e91
}
#page-wrap.dark .travelling-tabs__advance-filter .form-elements .fa,
#page-wrap.dark .travelling-tabs__advance-filter .form-elements .awe-icon,
#page-wrap.dark .travelling-tabs__advance-filter input,
#page-wrap.dark .travelling-tabs__advance-filter select {
    background-color: #444;
    border: 0;
    color: #a6a6a6
}
#page-wrap.dark .flight-item,
#page-wrap.dark .trip-item,
#page-wrap.dark .attraction-item,
#page-wrap.dark .hotel-item,
#page-wrap.dark .destination-list__content .destinations-item {
    background-color: #262626
}
#page-wrap.dark .flight-item .item-price-more .price > .amount,
#page-wrap.dark .flight-item .item-price-more .price ins .amount,
#page-wrap.dark .trip-item .item-price-more .price > .amount,
#page-wrap.dark .trip-item .item-price-more .price ins .amount,
#page-wrap.dark .attraction-item .item-price-more .price > .amount,
#page-wrap.dark .attraction-item .item-price-more .price ins .amount,
#page-wrap.dark .hotel-item .item-price-more .price > .amount,
#page-wrap.dark .hotel-item .item-price-more .price ins .amount,
#page-wrap.dark .flight-item .item-body .item-title h2 a,
#page-wrap.dark .trip-item .item-body .item-title h2 a,
#page-wrap.dark .attraction-item .item-body .item-title h2 a,
#page-wrap.dark .hotel-item .item-body .item-title h2 a,
#page-wrap.dark .destination-list__content .destinations-item .item-price-more .price .amount,
#page-wrap.dark .destination-list__content .destinations-item:hover .item-body .item-footer ul li h6,
#page-wrap.dark .destination-list__content .destinations-item .item-body .item-title h2 a {
    color: #194e91
}
#page-wrap.dark .destination-list__content .destinations-item .item-body .item-footer ul li > p,
#page-wrap.dark .destination-list__content .destinations-item .item-body .item-description {
    color: #a5a5a5
}
#page-wrap.dark .destination-list__content .destinations-item .item-body .item-footer ul li h6 {
    color: #f1f1f1
}
#page-wrap.dark .destination-list__content .destinations-item .item-price-more .price {
    color: #b1b1b1
}
#page-wrap.dark #comments .commentlist > .comment .comment-box,
#page-wrap.dark .page-top .list-link li a:before,
#page-wrap.dark .widget_has_radio_checkbox ul li label .awe-icon-check,
#page-wrap.dark .flight-item .item-price-more:after,
#page-wrap.dark .trip-item .item-price-more:after,
#page-wrap.dark .attraction-item .item-price-more:after,
#page-wrap.dark .hotel-item .item-price-more:after,
#page-wrap.dark .destination-list__content .destinations-item .item-price-more:after {
    border-color: #444
}
#page-wrap.dark .page-top .awe-select-wrapper .fa,
#page-wrap.dark .page-top .awe-select-wrapper .awe-select,
#page-wrap.dark .your-destinations .your-destinations__bar .order .fa,
#page-wrap.dark .your-destinations .your-destinations__bar .order select {
    background-color: #444;
    border: 0;
    color: #a6a6a6
}
#page-wrap.dark .flight-item .item-body .item-address,
#page-wrap.dark .trip-item .item-body .item-address,
#page-wrap.dark .attraction-item .item-body .item-address,
#page-wrap.dark .hotel-item .item-body .item-address {
    color: #A5A5A5
}
#page-wrap.dark .page-sidebar .widget,
#page-wrap.dark .page-sidebar .sidebar-title {
    border-bottom-color: #000
}
#page-wrap.dark .page-top .list-link li.current a:before {
    border-color: #194e91
}
#page-wrap.dark .breadcrumb:after {
    background-color: rgba(0, 0, 0, 0.9)
}
#page-wrap.dark .breadcrumb ul li a::after {
    border-left-color: #333333
}
#page-wrap.dark .category-heading-content > h3 {
    color: #000
}
#page-wrap.dark .category-heading-content > h2 {
    background-color: #1E1E1F
}
#page-wrap.dark .price-slider:after,
#page-wrap.dark .category-heading-content > h2 .awe-icon {
    background-color: #333
}
#page-wrap.dark .related-post h4 {
    color: #fff
}
#page-wrap.dark ~ .ui-datepicker {
    background-color: #333;
    border-color: #666
}
#page-wrap.dark ~ .ui-datepicker .ui-datepicker-header {
    background-color: #222
}
#page-wrap.dark ~ .ui-datepicker .ui-datepicker-header .ui-datepicker-title {
    color: #194e91
}
#page-wrap.dark ~ .ui-datepicker .ui-datepicker-header .ui-datepicker-prev,
#page-wrap.dark ~ .ui-datepicker .ui-datepicker-header .ui-datepicker-next {
    background-color: rgba(255, 255, 255, 0.1);
    cursor: pointer
}
#page-wrap.dark ~ .ui-datepicker .ui-datepicker-header .ui-datepicker-prev:hover,
#page-wrap.dark ~ .ui-datepicker .ui-datepicker-header .ui-datepicker-next:hover {
    background-color: #194e91
}
#page-wrap.dark ~ .ui-datepicker .ui-datepicker-header .ui-icon-circle-triangle-w {
    border-right-color: #fff
}
#page-wrap.dark ~ .ui-datepicker .ui-datepicker-header .ui-icon-circle-triangle-e {
    border-left-color: #fff
}
#page-wrap.dark ~ .ui-datepicker .ui-datepicker-calendar tbody tr td a {
    background-color: #222;
    border: 0;
    color: #a6a6a6
}
#page-wrap.dark ~ .ui-datepicker .ui-datepicker-calendar tbody tr td a:hover {
    background-color: #194e91;
    color: #fff
}
#page-wrap.dark ~ .ui-datepicker .ui-datepicker-calendar .ui-state-active,
#page-wrap.dark ~ .ui-datepicker .ui-datepicker-calendar .ui-widget-content .ui-state-active,
#page-wrap.dark ~ .ui-datepicker .ui-datepicker-calendar .ui-widget-header .ui-state-active {
    background-color: #194e91;
    color: #fff
}
#page-wrap.dark .category-heading-content .find form {
    background-color: rgba(0, 0, 0, 0.8)
}
#page-wrap.dark .category-heading-content .find form .form-item input,
#page-wrap.dark .category-heading-content .find form .form-item select {
    background-color: #444;
    border: 0;
    color: #a6a6a6
}
#page-wrap.dark .category-heading-content .find form .form-item .fa,
#page-wrap.dark .category-heading-content .find form .form-item .awe-icon {
    background-color: #444;
    color: #a6a6a6
}
#page-wrap.dark .product-detail__info .rating-trip-reviews .item h6,
#page-wrap.dark .product-detail__info .property-highlights .item span,
#page-wrap.dark .product-detail__info .product-descriptions {
    color: #eee
}
#page-wrap.dark .product-detail__info .product-address,
#page-wrap.dark .product-detail__info .product-email a {
    color: #a5a5a5
}
#page-wrap.dark .product-detail__info .product-address:hover,
#page-wrap.dark .product-detail__info .product-email a:hover {
    color: #194e91
}
#page-wrap.dark .room-type-table tbody td,
#page-wrap.dark .room-type-table thead th,
#page-wrap.dark .product-detail__info .property-highlights h3 {
    border-color: #333
}
#page-wrap.dark .room-type-table tbody td.room-price .price .full-price-open-popup:hover,
#page-wrap.dark .room-type-table tbody td.room-price .price em,
#page-wrap.dark .room-type-table tbody td.room-condition .list-condition li,
#page-wrap.dark .room-type-table tbody td.room-type .room-descriptions,
#page-wrap.dark .room-type-table tbody td,
#page-wrap.dark .room-type-table thead th {
    color: #a6a6a6
}
#page-wrap.dark .room-type-table tbody td.room-type .room-title h4 {
    color: #194e91
}
#page-wrap.dark .call-to-book span,
#page-wrap.dark .call-to-book .awe-icon,
#page-wrap.dark .room-type-table tbody td.room-price .price .amount,
#page-wrap.dark .room-type-table tbody td.room-people .awe-icon {
    color: #fff
}
#page-wrap.dark .call-to-book .awe-icon {
    border-color: #fff
}
#page-wrap.dark .product-tabs__content .ui-tabs-panel .check-availability {
    background-color: #333
}
#page-wrap.dark .product-tabs__content .ui-tabs-panel .check-availability .form-elements label {
    color: #194e91
}
#page-wrap.dark .product-tabs__content .ui-tabs-panel .check-availability .form-elements .fa,
#page-wrap.dark .product-tabs__content .ui-tabs-panel .check-availability .form-elements .awe-icon,
#page-wrap.dark .product-tabs__content .ui-tabs-panel .check-availability .form-elements input,
#page-wrap.dark .product-tabs__content .ui-tabs-panel .check-availability .form-elements select {
    background-color: #444;
    border: 0;
    color: #a6a6a6
}
#page-wrap.dark .good-to-know-table tbody tr,
#page-wrap.dark .facilities-freebies-table tbody tr {
    border-bottom-color: #666
}
#page-wrap.dark .good-to-know-table tbody tr th,
#page-wrap.dark .facilities-freebies-table tbody tr th {
    color: #fff
}
#page-wrap.dark .good-to-know-table tbody tr td,
#page-wrap.dark .facilities-freebies-table tbody tr td {
    color: #a6a6a6
}
#page-wrap.dark #reviews #comments .commentlist li .comment-box {
    background-color: #262626
}
#page-wrap.dark #reviews #comments .commentlist li .comment-box .comment-body .meta strong {
    color: #fff
}
#page-wrap.dark #reviews #comments .commentlist li .comment-box .comment-body .rating-info .average-rating-review em {
    color: #fff
}
#page-wrap.dark #reviews #comments .commentlist li .comment-box .comment-body .rating-review li em {
    color: #fff
}
#page-wrap.dark #reviews #add_review {
    background-color: #262626
}
#page-wrap.dark #reviews #add_review .comment-reply-title {
    color: #fff
}
#page-wrap.dark #reviews #add_review form > div label {
    color: #fff
}
#page-wrap.dark #reviews #add_review form .comment-form-rating h4 {
    color: #fff
}
#page-wrap.dark #reviews #add_review form .comment-form-author input,
#page-wrap.dark #reviews #add_review form .comment-form-author textarea,
#page-wrap.dark #reviews #add_review form .comment-form-author select,
#page-wrap.dark #reviews #add_review form .comment-form-author .fa,
#page-wrap.dark #reviews #add_review form .comment-form-email input,
#page-wrap.dark #reviews #add_review form .comment-form-email textarea,
#page-wrap.dark #reviews #add_review form .comment-form-email select,
#page-wrap.dark #reviews #add_review form .comment-form-email .fa,
#page-wrap.dark #reviews #add_review form .comment-form-rating input,
#page-wrap.dark #reviews #add_review form .comment-form-rating textarea,
#page-wrap.dark #reviews #add_review form .comment-form-rating select,
#page-wrap.dark #reviews #add_review form .comment-form-rating .fa,
#page-wrap.dark #reviews #add_review form .comment-form-comment input,
#page-wrap.dark #reviews #add_review form .comment-form-comment textarea,
#page-wrap.dark #reviews #add_review form .comment-form-comment select,
#page-wrap.dark #reviews #add_review form .comment-form-comment .fa {
    background-color: #333;
    border: 0;
    color: #a5a5a5
}
#page-wrap.dark .ticket-price tbody tr td del .amount,
#page-wrap.dark .ticket-price tbody tr td em,
#page-wrap.dark .product-detail__info .trips .item p,
#page-wrap.dark .trip-schedule-accordion .trips .item p {
    color: #a5a5a5
}
#page-wrap.dark .product-detail__info .trips .item h6 {
    color: #fff
}
#page-wrap.dark .ticket-price thead th span {
    color: #fff
}
#page-wrap.dark .initiative-top .title .from-to {
    color: #fff
}
#page-wrap.dark .initiative-table {
    background-color: #333
}
#page-wrap.dark .initiative-table tbody tr {
    border-color: #1e1e1f
}
#page-wrap.dark .initiative-table tbody tr .item-thumb:after {
    border-color: #444
}
#page-wrap.dark .services-on-flight .item label {
    color: #a5a5a5
}
#page-wrap.dark .services-on-flight .item label .awe-icon-check {
    border-color: #444
}
#page-wrap.dark .booking-info {
    background-color: #194e91;
    border-color: #194e91
}
#page-wrap.dark .booking-info .price {
    border-color: rgba(0, 0, 0, 0.2)
}
#page-wrap.dark .booking-info .price em,
#page-wrap.dark .booking-info .price .amount {
    color: #1E1E1F
}
#page-wrap.dark .booking-info .price .cart-added {
    color: #444
}
#page-wrap.dark .booking-info .price .cart-added .awe-icon {
    box-shadow: 0 0 0 2px #fff
}
#page-wrap.dark .booking-info .add-room-type > a {
    color: #000
}
#page-wrap.dark .booking-info .form-item .fa,
#page-wrap.dark .booking-info .form-item .awe-icon,
#page-wrap.dark .booking-info .form-item select,
#page-wrap.dark .booking-info .form-item input {
    background-color: #fff;
    border: 0
}
#page-wrap.dark .booking-info .reset {
    color: #1E1E1F
}
#page-wrap.dark .booking-info .form-baggage-weight span,
#page-wrap.dark .booking-info .form-kids span,
#page-wrap.dark .booking-info .form-adult span,
#page-wrap.dark .booking-info .form-checkin span,
#page-wrap.dark .booking-info .form-select-date span {
    color: #fff
}
#page-wrap.dark .booking-info .form-submit .add-to-cart button {
    background-color: #CC1453
}
#page-wrap.dark .booking-info .form-submit .add-to-cart button:hover {
    background-color: #444
}
#page-wrap.dark .booking-info .awe-icon,
#page-wrap.dark .booking-info .fa {
    top: 0;
    right: 0;
    height: 36px
}
#page-wrap.dark .toggle-menu-responsive {
    border-right: 1px solid rgba(0, 0, 0, 0.1)
}
#page-wrap.dark .toggle-menu-responsive .item {
    background-color: #111
}
#page-wrap.dark .toggle-menu-responsive.toggle-active .item {
    background-color: #111
}
#page-wrap.dark .awe-navigation-hamburger .toggle-menu-responsive:hover .item {
    background-color: #fff
}
#page-wrap.dark .trip-flight-hotel__table tbody tr {
    background-color: #262626;
    border-bottom: 5px solid #1E1E1F
}
#page-wrap.dark .trip-flight-hotel__table tbody tr .item-price {
    border-left: 2px dotted #444
}
#page-wrap.dark .trip-flight-hotel__table tbody tr .item-title h2 a {
    color: #fff
}
#page-wrap.dark .trip-flight-hotel__table tbody tr:hover .item-title h2 a {
    color: #194e91
}
.body-dark .awe-btn {
    background-color: #444;
    border-color: #444;
    color: #fff
}
.body-dark .awe-btn.awe-btn-style2 {
    border: 0;
    background-color: #ddd;
    color: #666
}
.body-dark .awe-btn.awe-btn-style3 {
    border: 0;
    background-color: #194e91;
    color: #fff
}
.body-dark .awe-btn.awe-btn-style3:focus,
.body-dark .awe-btn.awe-btn-style3:hover {
    background-color: #575757;
    color: #fff
}
.body-dark .awe-btn:focus,
.body-dark .awe-btn:hover {
    background-color: #194e91;
    border-color: #194e91;
    color: #111
}
.body-dark .room-type-popup {
    background-color: #262626
}
.body-dark .room-type-popup .form-elements label {
    color: #194e91
}
.body-dark .room-type-popup .form-elements .fa,
.body-dark .room-type-popup .form-elements .awe-icon,
.body-dark .room-type-popup .form-elements select,
.body-dark .room-type-popup .form-elements input {
    background-color: #444;
    border: 0;
    color: #a6a6a6
}
.body-dark .room-type-popup .calendar-header h2 {
    background-color: #444
}
.body-dark .room-type-popup .calendar-body thead tr th span {
    color: #a5a5a5
}
.body-dark .room-type-popup .calendar-body tbody tr td {
    border-color: #262626
}
.body-dark .room-type-popup .calendar-body tbody .item-calendar {
    background-color: #444
}
.body-dark .room-type-popup .calendar-body tbody .item-calendar.item-active {
    background-color: #194e91
}
.body-dark .room-type-popup .calendar-body tbody .item-calendar.item-active .date,
.body-dark .room-type-popup .calendar-body tbody .item-calendar.item-active .price {
    color: #000
}
.body-dark .room-type-popup .calendar-body tbody .item-calendar .price {
    color: #fff
}
.body-dark .room-type-popup .calendar-body tbody .item-calendar .date {
    color: #a6a6a6
}
.body-dark .room-type-popup .calendar-body tbody .item-calendar.sat,
.body-dark .room-type-popup .calendar-body tbody .item-calendar.sun {
    background-color: #666
}
.body-dark .room-type-popup .calendar-body tbody .item-calendar.not-available {
    background-color: #111
}
.body-dark .sale-flight-popup {
    background-color: #262626
}
.body-dark .sale-flight-popup .sale-flights-tabs__table tr {
    background: none
}
.body-dark .sale-flight-popup .sale-flights-tabs__table tr .sale-flights-tabs__item-choose:after {
    border-color: #444
}
.body-dark .sale-flight-popup .sale-flights-tabs__table tr .sale-flights-tabs__item-depart h4,
.body-dark .sale-flight-popup .sale-flights-tabs__table tr .sale-flights-tabs__item-arrive h4,
.body-dark .sale-flight-popup .sale-flights-tabs__table tr .sale-flights-tabs__item-duration h4 {
    color: #fff
}
.body-dark .sale-flights-tabs__table tr .sale-flights-tabs__item-flight .image-wrap {
    border: 0
}
.body-dark .flight-popup {
    background-color: #333
}
.body-dark .flight-popup .flight-popup__content .title h2 {
    color: #fff
}
.body-dark .flight-popup-tabs .ui-tabs-nav li.ui-tabs-active .ui-tabs-anchor {
    color: #fff
}
.body-dark .flight-popup-tabs .flight-popup__history .item:after,
.body-dark .flight-popup-tabs .ui-tabs-nav:after {
    border-color: #666
}
.body-dark .flight-popup-tabs .flight-popup__history .item .descriptions,
.body-dark .flight-popup-tabs .flight-popup__overview .flight-popup__descriptions,
.body-dark .flight-popup-tabs .flight-popup__history .item .year {
    color: #a5a5a5
}
.body-dark .flight-popup-tabs .flight-popup__history .item:hover .year {
    color: #fff
}
.body-dark .flight-popup-tabs .flight-popup__history .item .icon-active {
    background-color: #333;
    border-color: #666
}
.body-dark .flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item {
    background-color: #444;
    border-color: #444
}
.body-dark .flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item:hover,
.body-dark .flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item.map-active {
    border-color: #194e91
}
.body-dark .flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item .item-title h2,
.body-dark .flight-popup-tabs .flight-popup__map-content .flight-popup__map-content-list .map-item:before {
    color: #fff
}
.body-dark .flight-popup-tabs .flight-popup__grid-wrapper .grid-item .image-wrap:before {
    border-color: #333
}
.body-dark .sale-flight-popup .title .from-to {
    color: #fff
}
.body-dark .sale-flight-popup .sale-flights-tabs__table tr {
    -webkit-box-shadow: inset 0 0 0 2px #666;
    -moz-box-shadow: inset 0 0 0 2px #666;
    box-shadow: inset 0 0 0 2px #666
}

#slider-revolution ul {
    padding-left: 0;
    list-style: none;
    margin-bottom: 0
}
.slider-caption-sub {
    color: #fff;
    text-transform: uppercase;
    font-size: 20px;
    line-height: 1;
    display: inline-block
}
.slider-caption-sub.slider-caption-sub-1 {
    font-weight: bold;
    font-size: 26px;
    letter-spacing: 28px
}
.slider-caption-sub.slider-caption-sub-3 {
    font-size: 26px;
    font-family: 'Open Sans'
}
.slider-caption {
    font-size: 60px;
    color: #fff;
    text-transform: uppercase;
    font-family: 'Lato';
    line-height: 1
}
.slider-caption small {
    display: inline-block;
    line-height: 1;
    font-weight: 500;
    font-family: 'Hind';
    font-size: 30px;
    color: #fff;
    line-height: 1.15em
}
.slider-caption.slider-caption-1 {
    font-weight: bold
}
.slider-caption.slider-caption-2 {
    font-weight: bold;
    font-size: 80px
}
.slider-caption.slider-caption-3 {
    font-size: 80px
}
.slider-icon {
    padding: 5px 0;
    display: inline-block
}
.awe-btn.awe-btn-slider {
    font-size: 14px;
    padding: 10px 30px;
    -webkit-transition: none;
    -moz-transition: none;
    -ms-transition: none;
    -o-transition: none
}

/* New CSS */
/* Top Left menu */
.top-section {
	width: 100%;    
    background-color: #194e91;
    -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.15);
    -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.15);
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.15)
	z-index: 99999;
}

#top-divsection  { 
		position: relative;
		/* text-align: right; */
		/* padding-right: 65px; */
		-webkit-backface-visibility: hidden;
		backface-visibility: hidden;
	}
#top-divsection span{font-size:16px; font-family: BadScript-Regular;color:#fff;line-height:45px;font-weight: 600;}

#login-divsection  {
margin-right:2%;
    border: 1px solid red;
color:white;
text-align:center;
font-weight:bold;
font-size:16px;
background-color:#E44424;
 position: absolute;
    top: 50%;
    left: 150px;
    z-index: 9;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
     padding:0px 5px 0px 5px;
}
#login-divsection .top-menus {
    font-size: 0;
    list-style: none;
    margin: 0;
    padding: 0;
	background-color:#E44424;
	border-radius: 0px 0px 0px 0px;
}

#login-divsection .top-menus  li {
    position: relative;
    display: inline-block;
    padding: 0 5px;
    height:25px;
}

#login-divsection .top-menus  li a {
    display: block;
    font-family: Lato-Light;
    font-weight: 600;
    font-size: 14px;   
    line-height: 25px;
	color:#fff;
    font-weight:normal;
}

.agent-login  {font-weight:bold;text-align:center;font-size:16px;color:white;background:#194e91;position: absolute;top: 50%;left: 266px;z-index: 9;-webkit-transform: translateY(-50%);-moz-transform: translateY(-50%);-ms-transform: translateY(-50%);-o-transform: translateY(-50%);transform: translateY(-50%);margin-left: 2%;padding: 1px 5px 1px 5px;}
.agent-login .top-menus {
color:white;
    font-size: 0;
    list-style: none;
    margin: 0;
    padding: 0;
	background-color:#194e91;
	border-radius: 0px 0px 0px 0px;
	
}

.agent-login .top-menus  li {
    position: relative;
    display: inline-block;
    padding: 0 5px;
   height:25px;
}

.agent-login .top-menus  li a {
    display: block;
    font-family: Lato-Light;
    font-weight: 600;
    font-size: 14px;   
    line-height: 25px;
	color:#fff;
    padding-bottom:5px;
    font-weight:normal;
}


/* Top Text */
#top-text {
    font-size: 0;
    list-style: none;
    margin: 0;
    padding: 0;
	text-align: right;
	padding-right: 9px;
}

#top-text  li {
    position: relative;
    display: inline-block;
    padding: 0 5px;
}

#top-text  li span {
    display: block;
    font-family: Lato-Light;	
    font-weight: 600;
    font-size: 15px;
    color: #fff;
    line-height: 40px;
}

#top-text  li a {
    display: block;
    font-family: Lato-Light;
    font-weight: 600;
    font-size: 14px;   
    line-height: 40px;
	color:#fff;
} 
#top-text  li a:hover {color: #E44424;}
.top-agent{float:right; padding-right:20px;}
.top-agent  span a {
    display: block;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-weight: 600;
    font-size: 15px;   
    line-height: 42px;
	color:#fff;
} 
.top-agent  span a:hover {color: #E44424;}

/* Menu Secound */
#page-ctop-section{
	background-color: #fff;
}
.page-ctop-menu {
    overflow: hidden;    
}
.page-ctop-menu .page-chtop-list {
    float: left;
    font-size: 0;
    list-style: none;
    margin: 0px;
    padding: 0
}
.page-ctop-menu .page-chtop-list li {
	position: relative;
    display: inline-block;
    margin: 8px 0px
}
.page-ctop-menu .page-chtop-list li a {
    position: relative;
    display: block;
    font-size: 16px;
    font-weight: 500;
    color: #67728A;
    padding-right: 22px;
	line-height:50px;
}
/* .page-ctop-menu .page-chtop-list li a:before {
    content: '';
    display: block;
    position: absolute;
    width: 14px;
    height: 14px;
    border: 2px solid #A6A6A6;
    margin: auto;
    left: 0;
    top: 0;
    bottom: 0
} */
.page-ctop-menu .page-chtop-list li a:hover {
    color: #194e91
}
.page-ctop-menu .page-chtop-list li a:hover:before {
    border-color: #194e91
}
.page-ctop-menu .page-chtop-list li.current a {
    color: #194e91
}
.page-ctop-menu .page-chtop-list li.current a:before {
    border-color: #194e91
}
/* .page-ctop-menu .page-chtop-list li.current a:after {
    content: '';
    display: block;
    position: absolute;
    width: 6px;
    height: 6px;
    background-color: #194e91;
    margin: auto;
    top: 0;
    bottom: 0;
    left: 4px
} */

.padding-left-done{padding-left:0px !important;}




/* .details-bt{    left: 15px;
    position: relative;}
	.open-box {
    width: 96%;
    background: #FFF;
    border: 1px solid #194e91;
    margin-left: 1%;
    margin-top: 3px;
    padding: 0 1%;
    float: left;
    overflow: hidden;
    height: 0;
    display: none;
    margin-bottom: 5px;
}
.openbox-left {
    width: 65%;
    float: left;
}
.full-div {
    width: 100%;
    font-size: 12px;
    line-height: 18px;
	float: left;
}
.bk-flgt-open {
    width: 25%;
    float: left;
}
.flt-lft {
    float: left;
}
.clear {
    clear: both;
}
.spi-col {
    color: #000;
    font-size: 11px;
}
.eco-col {
    color: #616161;
    font-size: 11px;
    padding-top: 5px;
}
.bk-open-pl {
    width: 75%;
    float: right;
}
.bk-flgt-main {
    width: 100%;
}
.open-left {
    width: 37%;
    float: left;
    text-align: right;
    font-size: 11px;
}
.bod {
    width: 100%;
    font-size: 11px;
    text-transform: uppercase;
    color: #1B1B1B;
}
.dt-tm {
    width: 100%;
    color: #525252;
    padding-top: 5px;
    line-height: 18px;
}
.bk-open {
    width: 18%;
    float: left;
    padding: 0 3%;
    text-align: center;
    font-size: 11px;
}
.time-icon {
    background-position: -188px -278px;
    width: 17px;
    height: 16px;
    float: left;
    margin-right: 5px;
}
.open-ma {
    margin-left: 20px;
}
.display-new {
    background: url(/content/images/ak/v1.0/common/flight-sprite.png) no-repeat;
}
.open-right {
    width: 39%;
    float: right;
    text-align: left;
    font-size: 11px;
}
.bod {
    width: 100%;
    font-size: 11px;
    text-transform: uppercase;
    color: #1B1B1B;
}
.dt-tm {
    width: 100%;
    color: #525252;
    padding-top: 5px;
    line-height: 18px;
} */

.car-button{width:100px;}
.car-button a{width: 35px; font-size: 16px;font-weight: 600;color: #fff;background-color: rgba(255, 255, 255, 0.7);padding: 4px 6px; -webkit-border-radius: 4px;-moz-border-radius: 2px;  -ms-border-radius: 2px;-o-border-radius: 2px;border-radius: 2px;cursor: pointer;}
.car-button a:hover {
    background: #194e91;
}



.form-group-car1{width:25%;float:left;padding-right:30px;}
.form-group-car2{width:25%;float:left;padding-right:30px;}
.form-group-car3{width:22%; float:left;padding-right:30px;}
.form-group-car3 .form-elements{float:left;}
.dropup-location{width:100%;float:left;padding-top: 13px;}
.car-button1{ padding-right: 30px; float:left;}
.car-button1 a{width: 35px; font-size: 16px;font-weight: 600;color: #fff;background-color: #222;padding: 4px 6px; -webkit-border-radius: 4px;-moz-border-radius: 2px; -ms-border-radius: 2px;-o-border-radius: 2px;border-radius: 2px;cursor: pointer;}
.dropup-location label{float:left;}

.car-button a:hover {
background: #194e91;
}

.form-group-car4{width:15%; float:left;}
.form-group-car4 .form-elements{float:left;padding-right:30px;}
.dropup-location{width:100%;float:left;}
.car-button1{ padding-right: 30px; float:left;}
.car-button1 a{width: 35px; font-size: 16px;font-weight: 600;color: #fff;background-color: #222;padding: 4px 6px; -webkit-border-radius: 4px;-moz-border-radius: 2px;  -ms-border-radius: 2px;-o-border-radius: 2px;border-radius: 2px;cursor: pointer;}
.dropup-location label{float:left;}

.car-button a:hover {
    background: #194e91;
}

.awe-search-tabs__content .ui-tabs-panel .box{width:100%;float:left;padding-top: 10px;border-top:1px solid #194e91;}
.awe-search-tabs__content .ui-tabs-panel .oneway{width:20%;float:left;font-size:16px;color:#525252}
.awe-search-tabs__content .ui-tabs-panel .round-trip{width:20%;float:left;font-size:16px;color:#525252}
.awe-search-tabs__content .ui-tabs-panel .radiobtn{float:left;position:relative;margin-right:10px; width:100%;}
.awe-search-tabs__content .ui-tabs-panel .radiobtn input{float:left;width: 30% !important;}
.awe-search-tabs__content .ui-tabs-panel .radiobtn label{line-height: 40px;float:left;}



.awe-search-tabs__content .ui-tabs-panel .form-group1 {
    float: left
}
.awe-search-tabs__content .ui-tabs-panel .form-group1:nth-child(1) {
    width: 100%;
    padding-right: 64px
}
.awe-search-tabs__content .ui-tabs-panel .form-group1:nth-child(2) {
    width: 33.2%;
    padding-right: 30px
}
.awe-search-tabs__content .ui-tabs-panel .form-group1:nth-child(3) {
    width: 36.5%;
    padding-right: 64px
}
.awe-search-tabs__content .ui-tabs-panel .form-group1:nth-child(4) {
    width: 18.1%;
    padding-right: 64px
}
.awe-search-tabs__content .ui-tabs-panel .form-group1:nth-child(3) .form-elements {
    width: 50%;
    float: left
}
.awe-search-tabs__content .ui-tabs-panel .form-group1:nth-child(3) .form-elements:nth-child(odd) {
    padding-right: 15px
}
.awe-search-tabs__content .ui-tabs-panel .form-group1:nth-child(3) .form-elements:nth-child(even) {
    padding-left: 15px
}

#footer-page .awe-social .fa-linkedin{background-color:#77CBEF;}

.Remember-me {
    float: left;
    font-size: 12px;
    font-weight: 600;
    color: #666;
}
.Service_content h6{
color: #fff;}

.footer-email {
    font-size: 20px !important;	
}
.color-red{
	color:#E44424 !important;
	
}
.login-register-page__content form .form-item textarea {
width: 100%
}
.login-register-page__content form .form-item select {
width: 100%
}
#footer-page .address_content_center{ text-align: center;}
#footer-page .address_content_right{ text-align: right;}

@media screen and (max-width: 1199px) {
	.awe-navigation-responsive { top: 14.1%; }
	.awe-navigation-responsive .menu-list li .sub-menu { top: 14.1%; }
	
    .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(1),
    .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(2),
    .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(3) {
        padding-right: 30px
    }
	.awe-search-tabs{
		margin-top:-400px!important;		
	}
    .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(1) {
        width: 28%
    }
    .awe-search-tabs__content .ui-tabs-panel .form-actions {
        width: 17.4%
    }
    .awe-search-tabs-2 {
        position: relative;
        left: auto;
        right: auto;
        -webkit-transform: translateY(0);
        -moz-transform: translateY(0);
        -ms-transform: translateY(0);
        -o-transform: translateY(0);
        transform: translateY(0);
        margin-top: -43px
    }
    .filter-item-wrapper {
        overflow: hidden;
        width: auto;
        margin-left: -15px;
        margin-right: -15px
    }
    .flight-item,
    .trip-item,
    .attraction-item,
    .hotel-item {
       
        float: left;
        margin-left: 15px;
        margin-right: 15px;
        margin-bottom: 30px;
        box-shadow: none !important
    }
    .flight-item .item-price-more,
    .trip-item .item-price-more,
    .attraction-item .item-price-more,
    .hotel-item .item-price-more,
    .flight-item .item-body,
    .trip-item .item-body,
    .attraction-item .item-body,
    .hotel-item .item-body,
    .flight-item .item-media,
    .trip-item .item-media,
    .attraction-item .item-media,
    .hotel-item .item-media {
        float: none;
        width: 100%
    }
    .flight-item .item-price-more:after,
    .trip-item .item-price-more:after,
    .attraction-item .item-price-more:after,
    .hotel-item .item-price-more:after {
        display: none
    }
    .flight-item .item-body .item-footer,
    .trip-item .item-body .item-footer,
    .attraction-item .item-body .item-footer,
    .hotel-item .item-body .item-footer {
        margin-top: 20px
    }
    .flight-item .item-price-more,
    .trip-item .item-price-more,
    .attraction-item .item-price-more,
    .hotel-item .item-price-more {
        margin: 10px 0 20px 0
    }
    .travelling-block {
        padding: 35px
    }
    .travelling-tabs__advance-filter .form-group {
        padding-left: 15px;
        padding-right: 15px
    }
    .travelling-tabs__advance-filter .form-elements.form-checkin,
    .travelling-tabs__advance-filter .form-elements.form-checkout {
        width: 47%
    }
    .travelling-tabs__advance-filter .form-elements.form-checkin {
        margin-right: 3%
    }
    .travelling-tabs__advance-filter .form-elements.form-checkout {
        margin-left: 3%
    }
    .destination-list__content .destinations-item .item-media .image-cover {
        padding-top: 84%
    }
    .destination-list__content .destinations-item .item-body {
        width: 59%
    }
    .destination-list__content .destinations-item .item-price-more {
        width: 17%
    }
    .destination-list__content .destinations-item .item-body .item-footer ul li {
        margin-right: 30px
    }
    .category-heading-content .find .form-elements:nth-child(1),
    .category-heading-content .find .form-elements:nth-child(2) {
        width: 21%;
        padding-right: 30px
    }
    .category-heading-content .find .form-elements:nth-child(3) {
        width: 16%
    }
    .category-heading-content .find .form-elements:nth-child(4) {
        width: 20%
    }
    #reviews .rating-info .write-review {
        display: block;
        clear: both;
        float: left
    }
    .flight-item .item-body .item-footer .item-icon,
    .trip-item .item-body .item-footer .item-icon,
    .attraction-item .item-body .item-footer .item-icon,
    .hotel-item .item-body .item-footer .item-icon {
        float: none;
        margin-top: 10px
    }
    .flight-item .item-body .item-footer .item-rate,
    .trip-item .item-body .item-footer .item-rate,
    .attraction-item .item-body .item-footer .item-rate,
    .hotel-item .item-body .item-footer .item-rate {
        float: none
    }
    .flight-item .item-body .item-footer .item-icon .awe-icon,
    .trip-item .item-body .item-footer .item-icon .awe-icon,
    .attraction-item .item-body .item-footer .item-icon .awe-icon,
    .hotel-item .item-body .item-footer .item-icon .awe-icon {
        margin-left: 0;
        margin-right: 10px
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(1) {
        width: 38%;
        padding-right: 0
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(1) .form-elements {
        width: calc(50% - 15px);
        margin-right: 15px
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(2) {
        width: 30%;
        padding-right: 10px
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(2) .form-elements:nth-child(odd) {
        padding-right: 1px
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(2) .form-elements:nth-child(even) {
        padding-left: 1px
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(3) {
        width: 14%;
        padding-right: 10px
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel.search-hotel .form-group:nth-child(1) {
        padding-right: 30px
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel.search-hotel .form-group:nth-child(1) .form-elements {
        width: 100%;
        margin-right: 0
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel.search-car .form-group:nth-child(1) {
        width: 50%
    }
    .product-tabs__content .ui-tabs-panel .check-availability .form-elements.form-kids,
    .product-tabs__content .ui-tabs-panel .check-availability .form-elements.form-adult,
    .product-tabs__content .ui-tabs-panel .check-availability .form-elements.form-checkin,
    .product-tabs__content .ui-tabs-panel .check-availability .form-elements.form-checkout {
        width: 48%;
        margin: 0;
        margin-top: 20px
    }
    .product-tabs__content .ui-tabs-panel .check-availability .form-elements.form-adult,
    .product-tabs__content .ui-tabs-panel .check-availability .form-elements.form-checkin {
        margin-right: 2%
    }
    .product-tabs__content .ui-tabs-panel .check-availability .form-elements.form-kids,
    .product-tabs__content .ui-tabs-panel .check-availability .form-elements.form-checkout {
        margin-left: 2%
    }
    .product-tabs__content .ui-tabs-panel .check-availability .form-actions {
        width: 100%;
        margin-left: 0
    }
    .awe-search-tabs__content .ui-tabs-panel.search-bus .form-group:nth-child(2),
    .awe-search-tabs__content .ui-tabs-panel.search-car .form-group:nth-child(2) {
        width: 42%
    }
	
	.awe-search-tabs__content .ui-tabs-panel .form-group1:nth-child(1) {
		width: 100%;
		padding-right: 64px
	}
	.awe-search-tabs__content .ui-tabs-panel .form-group1:nth-child(2) {
		width: 27.2% !important;
		padding-right: 30px
	}
	.awe-search-tabs__content .ui-tabs-panel .form-group1:nth-child(3) {
		width: 36.5%;
		padding-right: 64px
	}
	.awe-search-tabs__content .ui-tabs-panel .form-group1:nth-child(4) {
		width: 18.1%;
		padding-right: 64px
	}
	.awe-search-tabs__content .ui-tabs-panel .form-group1:nth-child(3) .form-elements {
		width: 50%;
		float: left
	}
	.awe-search-tabs__content .ui-tabs-panel .form-group1:nth-child(3) .form-elements:nth-child(odd) {
		padding-right: 15px
	}
	.awe-search-tabs__content .ui-tabs-panel .form-group1:nth-child(3) .form-elements:nth-child(even) {
		padding-left: 15px
	}
}
@media screen and (max-width: 991px) {
	.awe-navigation-responsive { top: 14.1%; }
	.awe-navigation-responsive .menu-list li .sub-menu { top: 14.1%; }
	
    .awe-search-tabs__content .ui-tabs-panel .form-group,
    .awe-search-tabs__content .ui-tabs-panel .form-actions {
        width: 100% !important;
        padding-right: 0 !important;
        margin-bottom: 0
    }
	.awe-search-tabs{margin-top:-250px!important;}
	
	.awe-search-tabs__content .ui-tabs-panel .form-group1,
    .awe-search-tabs__content .ui-tabs-panel .form-actions {
        width: 100% !important;
        padding-right: 0 !important;
        margin-bottom: 0
    }
	.awe-search-tabs__content .ui-tabs-panel .form-group-car1,
.awe-search-tabs__content .ui-tabs-panel .form-actions {
width: 100% !important;
padding-right: 0 !important;
margin-bottom: 0
}

.awe-search-tabs__content .ui-tabs-panel .form-group-car2,
.awe-search-tabs__content .ui-tabs-panel .form-actions {
width: 100% !important;
padding-right: 0 !important;
margin-bottom: 0
}

.awe-search-tabs__content .ui-tabs-panel .form-group-car3,
.awe-search-tabs__content .ui-tabs-panel .form-actions {
width: 100% !important;
padding-right: 0 !important;
margin-bottom: 0
}

.awe-search-tabs__content .ui-tabs-panel .form-group-car4,
.awe-search-tabs__content .ui-tabs-panel .form-actions {
width: 100% !important;
padding-right: 0 !important;
margin-bottom: 0
}
	
	
	
	.awe-search-tabs__content .ui-tabs-panel .oneway{width:100% !important;float:left;font-size:16px;color:#525252}
	.awe-search-tabs__content .ui-tabs-panel .round-trip{width:100% !important;float:left;font-size:16px;color:#525252}
	
    .awe-search-tabs__content .ui-tabs-panel .form-actions {
        margin-top: 20px !important
    }
    .awe-masonry .awe-masonry__item {
        width: 33.3333333333% !important
    }
    #footer-page .widget_contact_info {
        margin-top: 0;
        padding: 0
    }
    #footer-page .widget_contact_info:before,
    #footer-page .widget_contact_info:after {
        display: none
    }
    #footer-page .widget_contact_info .widget_background {
        display: none
    }
    .cart-content .cart-table tbody td.product-remove {
        padding-left: 40px
    }
    .contact-page__form {
        padding-top: 60px
    }
    .travelling-tabs__advance-filter .form-group {
        width: 100%;
        float: none
    }
    .destination-list__content {
        width: auto;
        overflow: hidden;
        margin-left: -15px;
        margin-right: -15px
    }
    .destination-list__content .destinations-item {
        width: calc(50% - 30px);
        float: left;
        margin-left: 15px;
        margin-right: 15px;
        margin-bottom: 30px
    }
    .destination-list__content .destinations-item .item-price-more,
    .destination-list__content .destinations-item .item-body,
    .destination-list__content .destinations-item .item-media {
        float: none;
        width: 100%
    }
    .destination-list__content .destinations-item .item-price-more {
        padding: 0 25px 25px
    }
    .destination-list__content .destinations-item .item-body {
        padding: 15px 25px
    }
    .destination-list__content .destinations-item .item-price-more:after {
        display: none
    }
    .category-heading-content .find .form-elements {
        width: 100% !important;
        padding: 0 !important;
        margin-bottom: 20px
    }
    .category-heading-content.category-heading-content__2 {
        padding-top: 100px;
        padding-bottom: 60px
    }
    .tabs .ui-tabs-nav li {
        background: none;
        border: 0;
        margin: 0 30px 0 0
    }
    .tabs .ui-tabs-nav li .ui-tabs-anchor {
        font-size: 14px;
        line-height: 46px
    }
    .tour-map {
        width: 100%;
        float: none;
        margin-right: 0
    }
    .tour-map-wrapper .trips {
        margin-top: 25px
    }
    .ticket-price {
        margin-bottom: 30px
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(1) .form-elements {
        width: 50%;
        margin: 0;
        padding-bottom: 20px
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(1) .form-elements:nth-child(odd) {
        padding-right: 15px
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(1) .form-elements:nth-child(even) {
        padding-left: 15px
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(2) {
        padding-right: 0
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(2) .form-elements {
        width: 50%;
        padding-bottom: 20px
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(2) .form-elements:nth-child(odd) {
        padding-right: 15px
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(2) .form-elements:nth-child(even) {
        padding-left: 15px
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel.search-hotel .form-group:nth-child(1) .form-elements {
        padding-right: 0
    }
    .flight-item .item-media .image-cover {
        padding-top: 40%
    }
	.address_content{text-align:center;}
	#footer-page .address_content_right{
    text-align: center;}
}
@media screen and (max-width: 800px) {
	.awe-navigation-responsive { top: 14.1%; }
	.awe-navigation-responsive .menu-list li .sub-menu { top: 14.1%; }
	
    .related-post .post .post-media,
    .blog-page__content .post .post-media {
        width: 100%;
        float: none;
        margin-bottom: 20px
    }
	
	.awe-search-tabs__content .ui-tabs-panel .form-group1,
    .awe-search-tabs__content .ui-tabs-panel .form-actions {
        width: 100% !important;
        padding-right: 0 !important;
        margin-bottom: 0
    }
	
	.awe-search-tabs__content .ui-tabs-panel .form-group1:nth-child(2) {
		width: 100% !important;
		padding-right: 30px
	}
	
    .blog-page__content {
        margin-left: -15px;
        margin-right: -15px
    }
    .blog-page__content .post {
        width: calc(50% - 30px);
        float: left;
        margin-left: 15px;
        margin-right: 15px
    }
    .blog-page__content.blog-single {
        margin-left: 0;
        margin-right: 0
    }
    .blog-page__content.blog-single .post {
        width: 100%;
        float: none;
        margin-left: 0;
        margin-right: 0
    }
	.address_content{text-align:center;}
	#footer-page .address_content_right{
    text-align: center;}
}
@media screen and (max-width: 740px) {
	
    .awe-search-tabs__content {
        padding: 20px
    }
	.awe-search-tabs{
		margin-top:-150px!important;		
	}
    .awe-masonry .awe-masonry__item {
        width: 50% !important
    }
    #reviews #comments .commentlist li .comment-box .comment-body .rating-info .average-rating-review,
    #reviews #comments .commentlist li .comment-box .comment-body .rating-info .rating-review {
        display: block;
        float: none
    }
    #reviews #comments .commentlist li .comment-box .comment-body .rating-info .rating-review {
        margin-left: -20px;
        margin-right: -30px;
        margin-top: 15px
    }
    #reviews .rating-info .rating-review,
    #reviews .rating-info .average-rating-review {
        display: block;
        float: none
    }
    #reviews .rating-info .rating-review {
        margin-left: -20px;
        margin-right: -20px
    }
    .flight-popup-tabs .flight-popup__scrollbar {
        height: 360px
    }
    .flight-popup-tabs .ui-tabs-nav li .ui-tabs-anchor {
        font-size: 12px
    }
    .room-type-popup .room-type-popup-inner,
    .sale-flight-popup {
        padding: 30px
    }
	.address_content{text-align:center;}
	#footer-page .address_content_right{
    text-align: center;}
}
@media screen and (max-width: 720px) {
	.awe-navigation-responsive { top: 14.1%; }
	.awe-navigation-responsive .menu-list li .sub-menu { top: 14.1%; }
	
    .filter-item-wrapper {
        overflow: hidden;
        width: auto;
        margin-left: 0;
        margin-right: 0
    }
    .flight-item,
    .trip-item,
    .attraction-item,
    .hotel-item {
        width: 100%;
        float: none;
        margin-left: 0;
        margin-right: 0
    }
    .cart-detail,
    .billing-info {
        width: 100%;
        float: none
    }
    .cart-detail {
        margin-top: 30px
    }
    .checkout-page__top .title,
    .checkout-page__top .phone {
        float: none
    }
    .destination-list__content {
        margin-left: 0;
        margin-right: 0
    }
    .destination-list__content .destinations-item {
        width: 100%;
        float: none;
        margin-left: 0;
        margin-right: 0
    }
    .your-destinations .title,
    .your-destinations .your-destinations__bar {
        float: none;
        overflow: hidden
    }
    .your-destinations .your-destinations__bar {
        margin-left: -10px;
        margin-right: -10px;
        margin-top: 20px
    }
    .flight-popup .flight-popup__content {
        width: 100%
    }
    .flight-popup .flight-popup__map-info {
        position: relative !important;
        top: auto;
        right: auto;
        width: 100%;
        height: 200px
    }
	.address_content{text-align:center;}
	#footer-page .address_content_right{
    text-align: center;}
}
@media screen and (max-width: 610px) {	
	.awe-navigation-responsive { top: 20.1%; }
	.awe-navigation-responsive .menu-list li .sub-menu { top: 20.1%; }
	
    .blog-page__content {
        margin-left: 0;
        margin-right: 0
    }
    .blog-page__content .post {
        width: 100%;
        float: none;
        margin-left: 0;
        margin-right: 0
    }
    .travelling-tabs__price .currency,
    .travelling-tabs__price .budget-level {
        width: 100%;
        float: none;
        padding: 0
    }
    .travelling-tabs__price .currency {
        margin-top: 30px
    }
    .category-heading-content .find h2 {
        font-size: 36px
    }
    .product-detail__info .property-highlights .item,
    .product-detail__info .trips .item {
        width: 50%
    }
    .awe-search-tabs-2 .ui-tabs-nav li .ui-tabs-anchor {
        min-width: 0
    }
	.address_content{text-align:center;}
	#footer-page .address_content_right{
    text-align: center;}
}
@media screen and (max-width: 570px) {	
	#footer-page .address_content{ text-align: center;}
	.awe-navigation-responsive { top: 29.1%; }
	.awe-navigation-responsive .menu-list li .sub-menu { top: 29.1%; }
	
    .awe-search-tabs__content .ui-tabs-panel .form-group:nth-child(2) .form-elements {
        width: 100%;
        padding: 0 !important
    }
    .awe-masonry .awe-masonry__item {
        width: 100% !important
    }
    .post-footer > div {
        width: 100%;
        float: none
    }
    .services-on-flight .item {
        width: 100%;
        float: none
    }
    #reviews #comments .commentlist li .comment-box .avatar {
        float: none;
        margin-right: 0;
        margin-bottom: 15px
    }
    #reviews .rating-info .rating-review li {
        margin-bottom: 10px
    }
    #reviews #comments .commentlist li .comment-box .comment-body .meta strong {
        display: block
    }
    #reviews #comments .commentlist li .comment-box .comment-body .meta time {
        float: none
    }
    #reviews #comments .commentlist li .comment-box .comment-body .description {
        margin-top: 10px
    }
    .awe-search-tabs {
        margin-top: -38px
    }
    .awe-search-tabs .ui-tabs-nav {
        height: 38px
    }
    .awe-search-tabs .ui-tabs-nav li .ui-tabs-anchor {
        line-height: normal
    }
    .awe-search-tabs .ui-tabs-nav li .ui-tabs-anchor .awe-icon {
        width: 40px;
        height: 38px;
        line-height: 38px
    }
    .awe-search-tabs-2 .ui-tabs-nav li .ui-tabs-anchor {
        font-size: 10px
    }
    .awe-search-tabs-2 .awe-search-tabs__content .ui-tabs-panel .form-group .form-elements {
        width: 100% !important;
        margin: 0;
        padding-left: 0 !important;
        padding-right: 0 !important;
        padding-bottom: 20px !important
    }	
	.address_content{text-align:center;}
	#footer-page .address_content_right{
    text-align: center;}
}
@media screen and (max-width:540px){
	
	#top-divsection{
		padding:0px;
		margin:0px;
		text-align:center;
		font-family:Lato-Light;
		}
	#top-divsection spam{
		
		text-align:center;
		padding:0px;
		margin:0px;
	}	
	#top-text{
		text-align:center;
	}

	.awe-search-tabs__content .ui-tabs-panel h2{
		font-size:22px;
	}		
	.destination-grid-content .select-title h3{
		margin-top: -56px;		
	}
	.tabs .ui-tabs-nav{
		margin-top: -50px;
	}
	.footer_for_media{
		margin-top:-100px !important;
		}
	.menu_for_media{
		
		position:relative;min-height:1px;
		padding-right:15px;
		padding-left:31px;
		text-align:center;
	}
	.page-ctop-menu .page-chtop-list{		
        margin-top: 1px;
        padding-left: 30px;
		min-height: 290px;
	}
	

    /* flight page*/

    .agent-login{
   
    border: 1px solid #194e91;

    }
    .page__pagination span, .page__pagination a{
        min-width: 33px;
    }
    .awe-btn{
    margin-left: 29%;
    }
   
    
    .agent-login-flight{
    margin-left: 26px;
    }
    .login-divsection-flight{
      margin-left: 20px;
    }
   .page-top {
    overflow: hidden;
    margin-top: 40px;
       margin-right: 23%;
}
.flight_detail_alignment{
    margin-left:22%;
}
.page__pagination {
    font-size: 0;
    margin-left: -8px;
    margin-right: -6px;
    
    position: absolute;
}
.page-chtop-list-height{
           height: 284px !important;
          margin-top: 61px;
          padding-left: 30px;
}
.awe-navigation-responsive{
top:45%;
height: 420.8px;
overflow:scroll;
}
.awe-parallax{
     margin-top: -18%;
}

/* hotel*/
.login-divsection-hotel{
    left: 44px !important;
    }
.agent_login_hotel{
   left: 167px !important;
}
    .breadcrumb ul li {
        display: inline-block;
        font-weight: 600;
        font-size: 13px;
        width: 98px;
        padding: 5px;
        margin: 5px;
        text-align: center;
    }
 .page-top .list-link li {
    display: inline-block;
    margin: 8px 10px;
    width: 100px;
    height: 41px;
    padding-left: 27px;
	}
    .page__pagination_hotel {
        position: absolute;
        top: 4560px;
    }
.address_content{text-align:center;}
	#footer-page .address_content_right{
    text-align: center;}
	.hero-section{margin-top:-60px;}
}
@media screen and (max-width: 480px) {
	.awe-navigation-responsive { top: 29.1%; }
	.awe-navigation-responsive .menu-list li .sub-menu { top: 29.1%; }
	
    .blog-heading-content h2 {
        font-size: 20px
    }
    .category-heading-content .find h2 {
        font-size: 32px
    }
    .blog-page__content .post .post-title h1 {
        font-size: 30px;
        line-height: 1.5em
    }
    .about-author .image-thumb {
        float: none
    }
    .about-author .author-info {
        margin-left: 0;
        margin-top: 20px
    }
    #comments .commentlist .comment-author {
        float: none;
        margin-bottom: 10px
    }
    #comments .commentlist .children {
        margin-left: 30px
    }
    #comments .comment-abs {
        position: static;
        margin-left: -4px;
        margin-right: -4px;
        margin-top: 10px
    }
    .travelling-tabs .ui-tabs-nav li {
        width: 100%;
        margin: 10px 0 0
    }
    .travelling-tabs .ui-tabs-nav li a {
        display: block;
        width: 100%
    }
    .travelling-tabs__advance-filter .form-group {
        padding-left: 0;
        padding-right: 0
    }
    .travelling-tabs__advance-filter .form-elements.form-checkin,
    .travelling-tabs__advance-filter .form-elements.form-checkout {
        width: 100%;
        margin: 0
    }
    .travelling-tabs__region .item {
        width: 50%;
        float: left
    }
    .travelling-tabs__region .item .awe-icon {
        font-size: 50px
    }
    .travelling-tabs__region .item span {
        font-size: 12px
    }
    .category-heading-content .find form {
        padding: 20px 30px
    }
    .login-register-page__content .content-title h2 {
        font-size: 40px
    }
    .login-register-page__content form {
        padding: 25px 30px
    }
    .login-register-page__content .login-register-link {
        font-size: 12px
    }
    .product-detail__info .rating-trip-reviews .item {
        width: 100%;
        float: none;
        margin-bottom: 20px
    }
    .category-heading-content > h2 {
        font-size: 20px;
        padding: 0 84px 0 24px;
        line-height: 60px
    }
    .category-heading-content > h2 .awe-icon {
        width: 60px;
        height: 60px;
        line-height: 60px
    }
    .flight-item .item-body,
    .trip-item .item-body,
    .attraction-item .item-body,
    .hotel-item .item-body {
        padding: 15px 24px
    }
    .flight-item .item-price-more,
    .trip-item .item-price-more,
    .attraction-item .item-price-more,
    .hotel-item .item-price-more {
        padding: 0 24px
    }
    .search-box .form-search .form-item input {
        padding: 0 25px;
        line-height: 60px;
        height: 60px;
        font-size: 16px;
        font-weight: 600
    }
    .awe-search-tabs {
        margin-top: -34px
    }
    .awe-search-tabs .ui-tabs-nav {
        height: 34px;
        padding: 0 10px
    }
    .awe-search-tabs .ui-tabs-nav li .ui-tabs-anchor .awe-icon {
        width: 36px;
        height: 34px;
        line-height: 34px
    }
    .heading-content h2 {
        font-size: 24px
    }
    .heading-content p {
        font-size: 18px
    }
    .destination-grid-content .section-title h3 {
        font-size: 18px
    }
    .sale-flight-popup,
    .room-type-popup .room-type-popup-inner {
        padding: 20px
    }
    .product-tabs__content .ui-tabs-panel .check-availability .form-elements.form-kids,
    .product-tabs__content .ui-tabs-panel .check-availability .form-elements.form-adult,
    .product-tabs__content .ui-tabs-panel .check-availability .form-elements.form-checkin,
    .product-tabs__content .ui-tabs-panel .check-availability .form-elements.form-checkout {
        width: 100%;
        float: none;
        margin: 0;
        margin-top: 20px
    }
    .travelling-block .title h2 {
        font-size: 24px
    }
    .travelling-block {
        padding: 15px
    }
    .purpose-slider {
        padding: 0 25px
    }
    .destination-list__content .destinations-item .item-body .item-footer ul li {
        margin-bottom: 10px
    }
	.address_content{text-align:center;}
	#footer-page .address_content_right{
    text-align: center;}
	#login-divsection  { left:147px;}
}
@media screen and (max-width: 450px) {

#header-page .header-page__inner {
    width: 100%;
    height: 150px;
    background-color: #fff;
    -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.15);
    -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.15);
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.15);
}

#page-ctop-section {
   padding-top:70px;
}

 .awe-search-tabs .ui-tabs-nav {
    margin-top: 40px;    
    }


 .agent-login  {font-weight:bold;text-align:center;font-size:16px;color:white;background:#194e91;position: absolute;top: 80%;left: 91px;z-index: 9;-webkit-transform: translateY(-50%);-moz-transform: translateY(-50%);-ms-transform: translateY(-50%);-o-transform: translateY(-50%);transform: translateY(-50%);margin-left: 2%;padding:0px 5px 0px 5px;}
.agent-login .top-menus {
color:white;
    font-size: 0;
    list-style: none;
    margin: 0;
    padding: 0;
	background-color:#194e91;
	border-radius: 0px 0px 0px 0px;
	
}

.agent-login .top-menus  li {
    position: relative;
    display: inline-block;
    padding: 0 5px;
   height:25px;
}

.agent-login .top-menus  li a {
    display: block;
    font-family: Lato-Light;
    font-weight: 600;
    font-size: 14px;   
    line-height: 25px;
	color:#fff;
    padding-bottom:5px;
    font-weight:normal;
}
#login-divsection  {margin-right:2%;border: 1px solid red;color:white;text-align:center;font-weight:bold;font-size:16px;background-color:#E44424;position: absolute;top: 80%;left: 230px;z-index: 9;-webkit-transform: translateY(-50%);-moz-transform: translateY(-50%);-ms-transform: translateY(-50%);-o-transform: translateY(-50%);transform: translateY(-50%);padding:0px 5px 0px 5px;}

#footer-page .address_content_right{
    text-align: center;
}
}

@media screen and (max-width:420px){
	
			#login-divsection{
    left: 68px;
    }
    .agent-login{
          left: 190px;
    }
	#footer-page .address_content_right{
    text-align: center;
}
}
@media screen and (max-width:385px){
			#login-divsection{
    left: 62px;
    }
    .agent-login{
          left: 184px;
    }
	#footer-page .address_content_right{
    text-align: center;
}
}
@media screen and (max-width:360px){
	
	#top-divsection{
		padding:0px;
		margin:0px;
		text-align:center;
		font-family:Lato-Light;
		}
	#top-divsection spam{
		
		text-align:center;
		padding:0px;
		margin:0px;
	}	
	#top-text{
		text-align:center;
	}
	.awe-search-tabs__content .ui-tabs-panel h2{
		font-size:22px;
	}		
	.destination-grid-content .select-title h3{
		margin-top: -56px;		
	}
	.tabs .ui-tabs-nav{
		margin-top: -50px;
	}
	.footer_for_media{
		margin-top:-100px !important;
		}
	.menu_for_media{
		
		position:relative;min-height:1px;
		padding-right:15px;
		padding-left:31px;
		text-align:center;
	}
	.page-ctop-menu .page-chtop-list{
	    min-height: 340px;
        padding-left: 30px;
	}

    /* flight page*/

    .agent-login{
   
    border: 1px solid #194e91;

    }
    .page__pagination span, .page__pagination a{
        min-width: 33px;
    }
    .awe-btn{
    margin-left: 20%;
    }
    #login-divsection{
    left: 46px;
    }
    .agent-login{
          left: 169px;
    }
    .agent-login-flight{
    margin-left: 26px;
    }
    .login-divsection-flight{
      margin-left: 20px;
    }
   .page-top {
    overflow: hidden;
    margin-top: 40px;
       margin-right: 23%;
}
.flight_detail_alignment{
    margin-left:14%;
}
.page__pagination {
    font-size: 0;
    margin-left: -8px;
    margin-right: -6px;
    position: absolute;
}
.page-chtop-list-height{
           height: 284px !important;
          margin-top: 61px;
          padding-left: 30px;
}
.awe-navigation-responsive{
top:46%;
height: 420.8px;
}

/* hotel*/
.login-divsection-hotel{
    left: 44px !important;
    }
.agent_login_hotel{
   left: 167px !important;
}
    .breadcrumb ul li {
        display: inline-block;
        font-weight: 600;
        font-size: 13px;
        width: 98px;
        padding: 5px;
        margin: 5px;
        text-align: center;
    }
 .page-top .list-link li {
    display: inline-block;
    margin: 8px 10px;
    width: 100px;
    height: 41px;
    padding-left: 27px;
	}
    .page__pagination_hotel {
        position: absolute;
        top: 4560px;
    }
	#footer-page .address_content_right{
    text-align: center;
}

}
@media screen and (max-width:320px){
	
			#login-divsection{
    left: 32px;
    }
    .agent-login{
          left: 155px;
    }
	
	#footer-page .address_content_right{
    text-align: center;
}
}



.wrapper-footer {
	z-index:  1;
	position: relative;
}

.wrapper-footer .wrapper-copyright {
	padding-top:    20px;
	padding-bottom: 15px;
}

.wrapper-footer a {
	color: #fff;
}

.wrapper-footer .main-top-footer {
	/* padding:  60px 0 50px 0; */
	padding:  30px 0 50px 0;
	position: relative;
}

.wrapper-footer .main-top-footer .widget-title {
	text-transform: uppercase;
	margin-bottom:  20px;
}

.wrapper-footer ul {
	margin: 0;
}

.wrapper-footer ul li {
	list-style: none;
}

.list-arrow li {
	margin-bottom: 0;
}

.list-arrow li a {
	border-bottom: 1px solid #5b6366;
	position:      relative;
	display:       block;
	padding:       5px 10px 5px 20px;
}

.list-arrow li a:after {
	content:    "\f105";
	display:    block;
	position:   absolute;
	width:      5px;
	height:     7px;
	z-index:    10;
	top:        50%;
	left:       2px;
	margin-top: -6px;
	font:       normal normal normal 14px/1 FontAwesome;
}

.list-arrow li:last-child a {
	border-bottom: none;
}

.wrapper-instagram {
	margin:   0 -5px;
	overflow: hidden;
}

.wrapper-instagram a {
	float:   left;
	width:   33.333%;
	padding: 5px;
}

.form-subscribe {
	padding:    80px 0;
	position:   relative;
	overflow:   hidden;
	text-align: center;
	color:      #fff;
	z-index:    1;
}

.subscribe_shadow {
	width:      100%;
	height:     100%;
	position:   absolute;
	top:        0;
	left:       0;
	background: rgba(0, 0, 0, 0.3);
}

.form-subscribe__title {
	margin-bottom:  5px;
	color:          #fff;
	font-size:      2em;
	text-transform: uppercase;
}

.form-subscribe__description {
	font-size:     1.200em;
	margin-bottom: 20px;
}

.form-subscribe-form-wrap {
	position: relative;
}

.form-subscribe-form-wrap .mc4wp-form, .form-subscribe-form-wrap .epm-sign-up-form {
	display:       inline-block;
	line-height:   50px;
	width:         auto;
	border:        10px solid rgba(0, 0, 0, 0.2);
	border-radius: 3px;
}

.form-subscribe-form-wrap .mc4wp-form label, .form-subscribe-form-wrap .mc4wp-form .epm-form-field, .form-subscribe-form-wrap .epm-sign-up-form label, .form-subscribe-form-wrap .epm-sign-up-form .epm-form-field {
	margin:   0;
	width:    auto;
	position: relative;
	float:    left;
}

.form-subscribe-form-wrap .mc4wp-form .mc4wp-email, .form-subscribe-form-wrap .mc4wp-form .email, .form-subscribe-form-wrap .epm-sign-up-form .mc4wp-email, .form-subscribe-form-wrap .epm-sign-up-form .email {
	display:       inline-block;
	width:         390px;
	height:        50px;
	line-height:   50px;
	margin:        0;
	padding:       0 20px;
	border:        none;
	outline:       0;
	border-radius: 0;
	background:    #fff;
	color:         #333;
	float:         left;
}

.form-subscribe-form-wrap .mc4wp-form .mc4wp-submit-button, .form-subscribe-form-wrap .mc4wp-form .epm-sign-up-button, .form-subscribe-form-wrap .epm-sign-up-form .mc4wp-submit-button, .form-subscribe-form-wrap .epm-sign-up-form .epm-sign-up-button {
	display:        inline-block;
	height:         50px;
	width:          auto;
	margin:         0 0 0 -5px !important;
	padding:        0 30px;
	border:         none;
	border-radius:  0;
	color:          #333;
	text-transform: uppercase;
	font-style:     normal;
	vertical-align: top;
}

.form-subscribe-form-wrap .mc4wp-form .mc4wp-submit-button:focus, .form-subscribe-form-wrap .mc4wp-form .epm-sign-up-button:focus, .form-subscribe-form-wrap .epm-sign-up-form .mc4wp-submit-button:focus, .form-subscribe-form-wrap .epm-sign-up-form .epm-sign-up-button:focus {
	outline: none;
}

.form-subscribe-form-wrap .mc4wp-form .mc4wp-submit-button:hover, .form-subscribe-form-wrap .mc4wp-form .epm-sign-up-button:hover, .form-subscribe-form-wrap .epm-sign-up-form .mc4wp-submit-button:hover, .form-subscribe-form-wrap .epm-sign-up-form .epm-sign-up-button:hover {
	color: #fff;
}

.form-subscribe-form-wrap .epm-sign-up-form .epm-form-field label {
	display: none;
}

.form-subscribe input {
	height:        50px;
	line-height:   50px;
	margin:        0;
	border:        none;
	background:    #fff;
	border-radius: 3px;
}

.form.mc4wp-form input {
	width: auto !important;
}

.contact-info a {
	color: #ccc;
}

#copyright {
	padding-top: 10px;
}

.footer_menu {
	text-align: right;
	margin:     0;
}

.footer_menu li {
	display:     inline-block;
	margin-left: 10px;
	list-style:  none;
}

.lgrayBg1{ background:#fff;}



.txt_number {float:right;}

/*----------------------------hotel details starts---------------------------------------------*/
.hds_h2{    font-size: 20px !important;
    color: #788687 !important;}
.hds_star{font-size: 19px;
    margin-right: 4px;}

.text_fon{font-size: 22px !important;
    }
.welcom{padding-right:5px;color:#555;font-weight:bold;}
.log_ou{cursor:pointer;text-decoration:none;padding-left:5px;padding-right:5px;font-weight:bold;}
.pric{font-weight: normal; margin:10px 0px 0px 15px; font-size: 15px;}
.pr_sl{padding:10px 0px 0px 0px; margin: 0px;}
.so_rt{font-size:21px; margin-left:0px; color:#616161;}
.ro_xl{width:246px;height:161px;}
.st_fr{margin-bottom: 0px;font-size: 16px;}
.p_sy{margin-bottom: 0px;}
.to_prin{text-align: left;font-size: 13px;margin-bottom: 0px;padding-left: 20px;}
.head_text{ text-align:center;}









/*----------------------------hotel details end---------------------------------------------*/

