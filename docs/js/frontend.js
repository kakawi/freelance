$(document).ready(function(){
	var loc = document.location.href; //Ссылка на текущую страница
	var loc2 = loc.split("/"); //Ссылка на текущую страницу в виде массива
	var ref = document.referrer; //Ссылка на предыдущую страницу
	var ref2 = ref.split("/"); //Ссылка на предыдущую страницу в виде массива
    var cur = new Date(); //Текущая дата
	var w = $(window).width();
	var h = $(window).height();

	//Выставляем в футер текущий год
	cur.getFullYear() == 2014 ? $('#copy_date').html("&copy; " + cur.getFullYear() + " ") : $('#copy_date').html("&copy; 2014-" + cur.getFullYear() + " ");
	
	// Отступы для широкоформатных мониторов
	if(w > 1300) $(".container").css({"margin-top" : "25px", "margin-bottom" : "25px"});
	$(window).resize(function() {
	    w = $(window).width();
		h = $(window).height();
        $("#bigimage img").css({
            "max-width" : w - w/10 + "px",
        	"margin-top" : h/10 + "px"
        });
	    $("#bigimage2 iframe").attr("width", w - w/10 + "px").css({
	    	"margin-top" : h/20 + "px"
	    }).attr("height", w - w/2.5 + "px");
		if(w > 1300) {
		    $(".container").css({"margin-top" : "25px", "margin-bottom" : "25px"});
		} else {
		    $(".container").css({"margin-top" : "0px", "margin-bottom" : "0px"});
		}
	});
	
	$("#bigimage img").css({
	    "max-width" : w - w/10 + "px",
		"margin-top" : h/10 + "px"
	});
	
	$("#bigimage2 iframe").attr("width", w - w/10 + "px").css({
		"margin-top" : h/20 + "px"
	}).attr("height", w - w/2.5 + "px");
	
	$("#bigimage").click(function() {
	    $(this).fadeOut(250);
		$('html, body').css({"overflow-y" : "auto"});
	});
	
	$("#bigimage2").click(function() {
        $("#bigimage2 iframe").attr("src", "");
		$(this).fadeOut(250);
		$('html, body').css({"overflow-y" : "auto"});
	});
});

// Наверх!
function go_to_top() {
    $('html, body').animate({scrollTop:0},250);
	return false;
}

function show_big_screen(img) {
    $("#bigimage img").attr("src", img);
	$("#bigimage").fadeIn(250);
	$('html, body').css({"overflow-y" : "hidden"});
}

function show_big_video(vid) {
    $("#bigimage2 iframe").attr("src", "//www.youtube.com/embed/" + vid);
	$("#bigimage2").fadeIn(250);
	$('html, body').css({"overflow-y" : "hidden"});
}

function add_to_cart(value) {
    var in_cart = getCookie('shop');
	var newc = '';
	if(typeof(in_cart) !== "undefined" && in_cart != '' && in_cart !== null) {
	    var inc2 = in_cart.split(",");
		for(i=0;i<inc2.length;i++) {
			if(inc2[i] != '' && parseInt(inc2[i]) != value) newc += inc2[i] + ',';
		}
		document.cookie="'shop'=" + newc + value + "; path=/;";
	} else {
	    document.cookie="'shop'=" + value + "; path=/;";
	}
	return false;
}

function getCookie(name) {
	var cookie = " " + document.cookie;
	var search = " " + name + "=";
	var setStr = null;
	var offset = 0;
	var end = 0;
	if (cookie.length > 0) {
		offset = cookie.indexOf(search);
		if (offset != -1) {
			offset += search.length;
			end = cookie.indexOf(";", offset)
			if (end == -1) {
				end = cookie.length;
			}
			setStr = unescape(cookie.substring(offset, end));
		}
	}
	return(setStr);
}