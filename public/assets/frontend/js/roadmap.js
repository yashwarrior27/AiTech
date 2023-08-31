// Arrow Movement
var interval;

jQuery('.left').mousedown(function(event) {
        var target = jQuery("#timeline_slider");
        var current_x = target.scrollLeft();

        if (target.length) {
            event.preventDefault();
            jQuery(target).animate({
                scrollLeft: current_x - 100
            }, 100, "linear");
        }
        interval = setInterval(function() {
            var target = jQuery("#timeline_slider");
            var current_x = target.scrollLeft();

            if (target.length) {
                event.preventDefault();
                jQuery(target).animate({
                    scrollLeft: current_x - 100
                }, 100, "linear");
            }
        }, 100);
    })
    .mouseup(function() {
        clearInterval(interval);
    });

jQuery('.right').mousedown(function(event) {
        var target = jQuery("#timeline_slider");
        var current_x = target.scrollLeft();

        if (target.length) {
            event.preventDefault();
            jQuery(target).animate({
                scrollLeft: current_x + 100
            }, 100, "linear");
        }
        interval = setInterval(function() {
            var target = jQuery("#timeline_slider");
            var current_x = target.scrollLeft();

            if (target.length) {
                event.preventDefault();
                jQuery(target).animate({
                    scrollLeft: current_x + 100
                }, 100, "linear");
            }
        }, 100);
    })
    .mouseup(function() {
        clearInterval(interval);
    });

// Grab and Move
const container = document.querySelector('#timeline_slider');

let startY;
let startX;
let scrollLeft;
let scrollTop;
let isDown;

container.addEventListener('mousedown', e => mouseIsDown(e));
container.addEventListener('mouseup', e => mouseUp(e))
container.addEventListener('mouseleave', e => mouseLeave(e));
container.addEventListener('mousemove', e => mouseMove(e));

function mouseIsDown(e) {
    isDown = true;
    startY = e.pageY - container.offsetTop;
    startX = e.pageX - container.offsetLeft;
    scrollLeft = container.scrollLeft;
    scrollTop = container.scrollTop;
}

function mouseUp(e) {
    isDown = false;
}

function mouseLeave(e) {
    isDown = false;
}

function mouseMove(e) {
    if (isDown) {
        e.preventDefault();
        //Move vertcally
        const y = e.pageY - container.offsetTop;
        const walkY = y - startY;
        container.scrollTop = scrollTop - walkY;

        //Move Horizontally
        const x = e.pageX - container.offsetLeft;
        const walkX = x - startX;
        container.scrollLeft = scrollLeft - walkX;

    }
}