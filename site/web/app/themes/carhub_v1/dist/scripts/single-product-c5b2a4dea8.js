jQuery(function(e){if("undefined"==typeof wc_single_product_params)return!1;e("body").on("init",".wc-tabs-wrapper, .woocommerce-tabs",function(){e(".wc-tab, .woocommerce-tabs .panel:not(.panel .panel)").hide();var i=window.location.hash,t=window.location.href,o=e(this).find(".wc-tabs, ul.tabs").first();i.toLowerCase().indexOf("comment-")>=0||"#reviews"===i||"#tab-reviews"===i?o.find("li.reviews_tab a").click():t.indexOf("comment-page-")>0||t.indexOf("cpage=")>0?o.find("li.reviews_tab a").click():o.find("li:first a").click()}).on("click",".wc-tabs li a, ul.tabs li a",function(i){i.preventDefault();var t=e(this),o=t.closest(".wc-tabs-wrapper, .woocommerce-tabs");o.find(".wc-tabs, ul.tabs").find("li").removeClass("active"),o.find(".wc-tab, .panel:not(.panel .panel)").hide(),t.closest("li").addClass("active"),o.find(t.attr("href")).show()}).on("click","a.woocommerce-review-link",function(){return e(".reviews_tab a").click(),!0}).on("init","#rating",function(){e("#rating").hide().before('<p class="stars"><span><a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a></span></p>')}).on("click","#respond p.stars a",function(){var i=e(this),t=e(this).closest("#respond").find("#rating"),o=e(this).closest(".stars");return t.val(i.text()),i.siblings("a").removeClass("active"),i.addClass("active"),o.addClass("selected"),!1}).on("click","#respond #submit",function(){var i=e(this).closest("#respond").find("#rating"),t=i.val();if(i.length>0&&!t&&"yes"===wc_single_product_params.review_rating_required)return window.alert(wc_single_product_params.i18n_required_rating_text),!1}),e(".wc-tabs-wrapper, .woocommerce-tabs, #rating").trigger("init");var i=function(i,t){if(this.$target=i,this.$images=e(".woocommerce-product-gallery__image",i),0===this.$images.length)return void this.$target.css("opacity",1);i.data("product_gallery",this),this.flexslider_enabled=e.isFunction(e.fn.flexslider)&&wc_single_product_params.flexslider_enabled,this.zoom_enabled=e.isFunction(e.fn.zoom)&&wc_single_product_params.zoom_enabled,this.photoswipe_enabled="undefined"!=typeof PhotoSwipe&&wc_single_product_params.photoswipe_enabled,t&&(this.flexslider_enabled=!1!==t.flexslider_enabled&&this.flexslider_enabled,this.zoom_enabled=!1!==t.zoom_enabled&&this.zoom_enabled,this.photoswipe_enabled=!1!==t.photoswipe_enabled&&this.photoswipe_enabled),this.initFlexslider=this.initFlexslider.bind(this),this.initZoom=this.initZoom.bind(this),this.initPhotoswipe=this.initPhotoswipe.bind(this),this.onResetSlidePosition=this.onResetSlidePosition.bind(this),this.getGalleryItems=this.getGalleryItems.bind(this),this.openPhotoswipe=this.openPhotoswipe.bind(this),this.flexslider_enabled?(this.initFlexslider(),i.on("woocommerce_gallery_reset_slide_position",this.onResetSlidePosition)):this.$target.css("opacity",1),this.zoom_enabled&&(this.initZoom(),i.on("woocommerce_gallery_init_zoom",this.initZoom)),this.photoswipe_enabled&&this.initPhotoswipe()};i.prototype.initFlexslider=function(){var i=this.$images,t=this.$target;t.flexslider({selector:".woocommerce-product-gallery__wrapper > .woocommerce-product-gallery__image",animation:wc_single_product_params.flexslider.animation,smoothHeight:wc_single_product_params.flexslider.smoothHeight,directionNav:wc_single_product_params.flexslider.directionNav,controlNav:wc_single_product_params.flexslider.controlNav,slideshow:wc_single_product_params.flexslider.slideshow,animationSpeed:wc_single_product_params.flexslider.animationSpeed,animationLoop:wc_single_product_params.flexslider.animationLoop,start:function(){t.css("opacity",1);var o=0;i.each(function(){var i=e(this).height();i>o&&(o=i)}),i.each(function(){e(this).css("min-height",o)})}})},i.prototype.initZoom=function(){var i=this.$images,t=this.$target.width(),o=!1;if(this.flexslider_enabled||(i=i.first()),e(i).each(function(i,s){if(e(s).find("img").data("large_image_width")>t)return o=!0,!1}),o){var s={touch:!1};"ontouchstart"in window&&(s.on="click"),i.trigger("zoom.destroy"),i.zoom(s)}},i.prototype.initPhotoswipe=function(){this.zoom_enabled&&this.$images.length>0&&(this.$target.prepend('<a href="#" class="woocommerce-product-gallery__trigger">🔍</a>'),this.$target.on("click",".woocommerce-product-gallery__trigger",this.openPhotoswipe)),this.$target.on("click",".woocommerce-product-gallery__image a",this.openPhotoswipe)},i.prototype.onResetSlidePosition=function(){this.$target.flexslider(0)},i.prototype.getGalleryItems=function(){var i=this.$images,t=[];return i.length>0&&i.each(function(i,o){var s=e(o).find("img"),a=s.attr("data-large_image"),r=s.attr("data-large_image_width"),n=s.attr("data-large_image_height"),l={src:a,w:r,h:n,title:s.attr("title")};t.push(l)}),t},i.prototype.openPhotoswipe=function(i){i.preventDefault();var t,o=e(".pswp")[0],s=this.getGalleryItems(),a=e(i.target);t=a.is(".woocommerce-product-gallery__trigger")?this.$target.find(".flex-active-slide"):a.closest(".woocommerce-product-gallery__image");var r={index:e(t).index(),shareEl:!1,closeOnScroll:!1,history:!1,hideAnimationDuration:0,showAnimationDuration:0};new PhotoSwipe(o,PhotoSwipeUI_Default,s,r).init()},e.fn.wc_product_gallery=function(e){return new i(this,e),this},e(".woocommerce-product-gallery").each(function(){e(this).wc_product_gallery()})});