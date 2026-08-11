function checkReadMore() {
    document.querySelectorAll('.testi-item').forEach(container => {
        const review = container.querySelector('.showcontent');
        const button = container.querySelector('.sd-testi-item-btn');
 
        if (!review || !button) return;
 
        // Show / Hide button
        if (review.scrollHeight > review.clientHeight + 2) {
            button.style.display = 'inline-block';
        } else {
            button.style.display = 'none';
        }
 
        // 🔥 IMPORTANT: click event
        button.onclick = function () {
            review.classList.toggle('expanded');
 
            button.textContent = review.classList.contains('expanded')
                ? 'Read less'
                : 'Read more';
        };
    });
}
 
jQuery(document).ready(function ($) {
    $('.sidebar-testi').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        items: 1,
        autoplay: false,
		autoplayHoverPause: true,
        onInitialized: function () {
            checkReadMore();
        },
        onChanged: function () {
            $('.showcontent').removeClass('expanded');
            $('.sd-testi-item-btn').text('Read more');
 
            setTimeout(() => {
                checkReadMore();
            }, 100);
        }
    });
 
    checkReadMore();
});