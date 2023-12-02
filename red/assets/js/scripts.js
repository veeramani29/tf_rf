! function(e) {
    "use strict";

    function n() {
        var a = ['<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>'];
        e(".product-slider").length && (e(".product-slider").owlCarousel({
            autoPlay: !1,
            slideSpeed: 500,
            navigation: !0,
            pagination: !1,
            singleItem: !0,
            autoHeight: !0,
            navigationText: a,
            afterAction: o
        }), e(".product-slider-thumb").owlCarousel({
            slideSpeed: 500,
            items: 5,
            itemsCustom: [
                [320, 3],
                [480, 4],
                [768, 4],
                [992, 5],
                [1200, 5]
            ],
            pagination: !1,
            navigation: !1,
            navigationText: a,
            mouseDrag: !1,
            afterInit: function(e) {
                e.find(".owl-item").eq(0).addClass("synced")
            }
        }), e(".product-slider-thumb").on("click", ".owl-item", function(a) {
            if (a.preventDefault(), e(this).hasClass("synced")) return !1;
            var t = e(this).data("owlItem");
            e(".product-slider").trigger("owl.goTo", t)
        }))
    }

    function o(a) {
        var t = this.currentItem;
        e(".product-slider-thumb").find(".owl-item").removeClass("synced").eq(t).addClass("synced"), void 0 !== e(".product-slider-thumb").data("owlCarousel") && r(t)
    }

    function r(a) {
        var t = e(".product-slider-thumb").data("owlCarousel").owl.visibleItems,
            i = a,
            n = !1;
        for (var o in t)
            if (i == t[o]) var n = !0;
        0 == n ? i > t[t.length - 1] ? e(".product-slider-thumb").trigger("owl.goTo", i - t.length + 2) : (i - 1 == -1 && (i = 0), e(".product-slider-thumb").trigger("owl.goTo", i)) : i == t[t.length - 1] ? e(".product-slider-thumb").trigger("owl.goTo", t[1]) : i == t[0] && e(".product-slider-thumb").trigger("owl.goTo", i - 1)
    }
}(jQuery);