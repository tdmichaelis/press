/* Copyright (C) YOOtheme GmbH, http://www.gnu.org/licenses/gpl.html GNU/GPL */

jQuery(function($) {

    var config = $('html').data('config') || {};

    // Social buttons
    $('article[data-permalink]').socialButtons(config);


    UIkit.on('afterready.uk.dom', function() {

        // Overlay Menu hover
        var overlayMenu = $('.tm-overlay-menu ul.uk-nav');

        if (overlayMenu.length) {

            overlayMenu.off('click.uikit.nav').on('mouseenter', '>li.uk-parent', function() {

                if (!this.classList.contains('uk-open')) {
                    overlayMenu.data('nav').open(this);
                }
            });
        }

        // Footer at page bottom
        var wrapper = $('.tm-page > div');

        if (wrapper.outerHeight() < $.UIkit.$win.height()) {
            $('.tm-page').css('height', '100%');
            wrapper.css({'position':'relative', 'height': '100%'});

            $('.tm-footer').css({'position': 'absolute', 'bottom': '0', 'width': '100%'});
        }

    });

    UIkit.$win.on('load', UIkit.Utils.debounce(function() {
        UIkit.$win.trigger('resize');
    }, 100));

});
