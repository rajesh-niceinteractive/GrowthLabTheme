const $ = jQuery;
function toggleMenu() { jQuery('.mobinav').toggleClass('open'); }
function stickyNav() {
    if (window.scrollY > 10) {
        document.querySelector('.header-sec').classList.add("f-nav");
    } else {
        document.querySelector('.header-sec').classList.remove("f-nav");
    }
};

/*
// Animate any element with .animatetext class when in view (no textillate)
const objobserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        entry.target.classList.toggle('in-view', entry.isIntersecting);
    });
}, { threshold: 0.2 });

$(document).ready(() => {
    document.querySelectorAll('.animatetext').forEach(item => objobserver.observe(item));
});
*/

document.addEventListener("DOMContentLoaded", function () {
  const userAgent = navigator.userAgent.toLowerCase();
  const body = document.body;
 
  if (userAgent.indexOf("chrome") > -1 && userAgent.indexOf("edg") === -1) {
    body.classList.add("browser-chrome");
  } else if (userAgent.indexOf("firefox") > -1) {
    body.classList.add("browser-firefox");
  } else if (userAgent.indexOf("safari") > -1 && userAgent.indexOf("chrome") === -1) {
    body.classList.add("browser-safari");
  } else if (userAgent.indexOf("edg") > -1) {
    body.classList.add("browser-edge");
  } else if (userAgent.indexOf("opera") > -1 || userAgent.indexOf("opr") > -1) {
    body.classList.add("browser-opera");
  } else {
    body.classList.add("browser-unknown");
  }
});

jQuery(document).ready(function($) {
  const observer = new MutationObserver(function(mutations, obs) {
    const el = $('#g-recaptcha-response');
    if (el.length) {
      el.attr('aria-hidden', 'true');
      obs.disconnect();
    }
  });
  observer.observe(document.body, { childList: true, subtree: true });
});

jQuery(document).ready(function() {
    stickyNav();
    jQuery(window).scroll(function () {stickyNav();});
});

jQuery('.mobinav .menu-item-has-children').append('<span class="drop close" href="javascript:void(0)"></span>');
jQuery('.mobinav .menu-item-has-children ul.sub-menu').hide();
jQuery(document).delegate(".mobinav .menu-item-has-children span.drop", "click", function () {
    jQuery(this).siblings('.sub-menu').slideToggle('slow');
    jQuery(this).parent('li').siblings('li').find('.drop').addClass('close').removeClass('open');
    jQuery(this).parent('li').siblings('li').find('.sub-menu').slideUp('slow');
    if (jQuery(this).hasClass('close')) {
        jQuery(this).addClass('open').removeClass('close');
    } else {
        jQuery(this).addClass('close').removeClass('open');
    }
});

/* Accordion */

jQuery('.accordion-heading').on('click', function () {
        let parent = jQuery(this).parent();
        parent.children('.accordion-section-content').slideToggle(300);
        parent.siblings('.accordion-section').children('.accordion-section-content').slideUp(300);
        parent.toggleClass('accordien-active');
        parent.siblings('.accordion-section').removeClass('accordien-active');
    });

/* common page toggle menu */

jQuery('#menu-header-menu-2').find('li.menu-item-has-children').append('<button class="subMenuToggle" type="button"></button>');
jQuery('.subMenuToggle').on('click', function() {
    jQuery(this).parent().siblings('li').find('.sub-menu').slideUp();
    jQuery(this).parent().siblings('li').find('.subMenuToggle').removeClass('submenuopen');
    jQuery(this).toggleClass('submenuopen');
    jQuery(this).siblings('.sub-menu').slideToggle();
});

/*
    * Tabs Section script
    */
jQuery('.tab-btn-group .tab-btn').on('click', function () {
    const _t = jQuery(this);
    _t.addClass('tab-btn-active');
    _t.siblings('.tab-btn').removeClass('tab-btn-active');
    let index = _t.index();
    let tabcontent = _t.parent('.tab-btn-group').siblings('.tab-content-area').children('.tab-pane').eq(index);
    tabcontent.addClass('tab-pane-active');
    tabcontent.siblings('.tab-pane').removeClass('tab-pane-active');
});

