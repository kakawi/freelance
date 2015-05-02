$(document).ready(function(){
	var loc = document.location.href; //Ссылка на текущую страница
	var loc2 = loc.split("/"); //Ссылка на текущую страницу в виде массива
	var ref = document.referrer; //Ссылка на предыдущую страницу
	var ref2 = ref.split("/"); //Ссылка на предыдущую страницу в виде массива
    var cur = new Date(); //Текущая дата
	var ph = $(window).height();
	var bh = $("body").height();
	var crh = $(".content-right").height();
	var open2 = 0;

	if(crh < bh) $(".content-right").css("min-height", (ph - 125) + "px");

	//Выставляем в футер текущий год
	cur.getFullYear() == 2014 ? $('#copy_date').html("&copy; " + cur.getFullYear() + " ") : $('#copy_date').html("&copy; 2014-" + cur.getFullYear() + " ");

	//Подсветка активного пункта навигационного меню
	if(loc2[4] != '' && loc2[4] != 'login' && loc2[4] != 'settings' && loc2[4] != 'profile')
	{
	    $("#" + loc2[4]).addClass("active-menu");
		$("#" + loc2[4] + " li h2").css("color", "#2b7dbc");
		var img = $("#" + loc2[4] + " li .icon").css("background-image");
		var img2 = img.split("/");
		var img3 = "";
		var txt = $("#" + loc2[4] + " li h2").html();
		var it_class = $("#" + loc2[4] + " li").attr("class");
		for(i=0;i<img2.length;i++)
		{
		    if(i == 6)
			{
			    var imgp = img2[i].split(".");
				img3 += imgp[0] + "-hov." + imgp[1];
			} else {
			    img3 += img2[i] + "/";
			}
		}
		$("#" + loc2[4] + " li .icon").remove();
		$("#" + loc2[4]).html('<li class="' + it_class + '"><div class="icon"></div><h2>' + txt + '</h2><img src="/templates/admin/images/arrow-act.png"/></li>');
	};
	
	//Функционал профиля
	$("#open-user-menu").click(function() {
	    var pos = $(this).attr("data-pos");
		if(pos == '1')
		{
		    $(".profile-window").slideUp(250);
			$(this).attr("data-pos", 0);
		} else {
		    $(".profile-window").slideDown(250);
			$(this).attr("data-pos", 1);
		}
		return false;
	});
	
	//Эффект появления страницы при входе в админ-панель
	if(ref2[4] == 'login')
	{
	    $('html, body').css("display", "none");
        $('html, body').fadeIn(250);
	};
	
	if(loc2[4] == 'settings')
	{
        $(".file").css("width", "310px");
        $(".file h3").css("max-width", "250px");
		$(".file button").css({"width" : "80px", "height" : "24px"});
	};
	
	// Скроллбар для блока создания новой услуги
	if(loc2[4] != 'login' && loc2[4] != 'settings')
	{
		$("#edit_" + loc2[4] + "_scroll").mCustomScrollbar({
	        theme:"dark"
	    });
	};
	
	$(".section_icon").hover(function() {
	    var item = $(this).attr("data-item");
		$("#section_icon_big-" + item).slideDown(250).animate({"opacity" : 1.0},250);
	},function() {
	    var item = $(this).attr("data-item");
		$("#section_icon_big-" + item).animate({"opacity" : 0.7},250).slideUp(250);
	});
});