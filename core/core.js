//公用函数定义
function sleep(fun,ms)
{
    setTimeout(fun,ms);
}

function loop(fun,ms)
{
	fun();
    setInterval(fun,ms);
}

addEventListener(
    "load",
    function() {
        setTimeout(hideURLbar, 0);
    },
    false
);

function hideURLbar()
{
    window.scrollTo(0, 1);
}

//核心函数
$(document).ready(function(){
    // wow.js预加载
    wow = new WOW({　　
        animateClass: 'animated',
    });         
    wow.init();

})