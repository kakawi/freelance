/*
 *   XXXXXXXXX   XXX   XXX   XXXXXXXXX   XXX   XXX
 *   XXX   XXX   XXX   XXX      XXX      XXX   XXX
 *   XXX   XXX   XXX   XXX      XXX      XXXXXXXXX
 *   XXXXXXXXX   XXXXXXXXX      XXX      XXX   XXX
 *   XXX   XXX   XXXXXXXXX      XXX      XXX   XXX
 *
 */

//Функция авторизации
function auth() {
	var login = $("#login").val();
	var pass = $("#password").val();
	var params = 'login=' + login + '&password=' + pass + '&action=auth';
	go_ajax(params, 'admin', 'login');
}

//Функция выхода
function exitPanel() {
	var params = 'action=exit';
	go_ajax(params, 'admin', 'none');
    $(".profile-window").slideUp(250);
    $("#open-user-menu").attr("data-pos", 0);
	setTimeout(function () {
	    $('html, body').fadeOut(250);
	},250);
	setTimeout(function () {
	    document.location.href = "/admin/";
	},500);
}

/*
 *   XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
 *   XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
 *   XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
 * 
 */

/*
 *   XXXXXXXXX         XXX   XXXXXXXXX   XXX   XXX
 *   XXX   XXX         XXX   XXX   XXX   XXX   XXX
 *   XXX   XXX         XXX   XXX   XXX      XXX
 *   XXXXXXXXX   XXX   XXX   XXXXXXXXX   XXX   XXX
 *   XXX   XXX   XXXXXXXXX   XXX   XXX   XXX   XXX
 *
 */
 
/*
 * Функция для AJAX-работы с контентом
 *
 * @param integer item ID записи в бд
 * @param string type1 Тип записи
 * @param string act Что с записью делать
 * @param string form_id ID формы
 */
function action_item(item, type1, act, form_id) {
	var loc3 = document.location.href; //Ссылка на текущую страница
	var loc4 = loc3.split("/"); //Ссылка на текущую страницу в виде массива
	var alias = '';
	var params = 'action=' + act + '&type=' + type1;
	var addparams = '';
	var lol = 0;
	act == 'add' ? num = '' : num = 2;
	act == 'add' ? tg = 'add' : tg = 'edit';
	if(act == 'update') params += '&item=' + item;
	
	if(loc4[4] == 'settings') params = 'action=settings&type=' + type1;
    $(form_id + " input, " + form_id + " select").each(function(i) {
        alias = $(this).attr("data-alias");
		if(typeof(alias) !== "undefined")
		{
		    if(($(this).val() == "" || typeof($(this).val()) === "undefined") && ($(this).val() != 'play_market' && $(this).val() != 'istore'
			 && $(this).val() != 'steam_store' && $(this).val() != 'yardteam_store' && $(this).val() != 'weblink'))
			{
			    color = $(this).css("color");
				$(this).animate({"background-color" : "rgba(255, 0, 0, 0.2)", "color" : "#FFFFFF"},250);
				if(lol == 0 && loc4[4] != 'login' && loc4[4] != 'settings')
				{
				    $("#" + tg + "_" + type1 + "_scroll" + num).mCustomScrollbar("scrollTo","top");
					lol = 1;
				};
				$(this).delay(2000).animate({"background-color" : "rgba(255,255,255,0.0)", "color" : color},250);
				setTimeout(function() {
				    $(this).removeAttr("style");
				},2500);
			};
			params += '&' + alias + '=' + escapeHtml($(this).val());
		};
    });
	
	$(form_id + " textarea").each(function(i) {
        alias = $(this).attr("data-alias");
	
		if(typeof(alias) !== "undefined")
		{
			if(alias == 'keys') {
			    params += '&' + alias + '=' + $(this).val();
			} else {
			    if(alias == 'small_description')
			    {
			        params += '&' + alias + '=' + escapeHtml($(this).val());
			    } else {
			        params += '&' + alias + '=' + escapeHtml(CKEDITOR.instances[$(this).attr("id")].getData());
			    }
			}
		};
    });
debugger;
    var category_id = $(form_id + ' select[name=category]').val();
    if (category_id) params += '&' + 'category_id' + '=' + escapeHtml(category_id);

	params += addparams;
	go_ajax(params, 'admin/' + loc4[4], act + type1);
}

// Подтверждение удаления
function del_approve(item, type1, title) {
    $("#del_item .zaglav-win h2").text('Удалить ' + title + '?');
	if(type1 == 'del_newstaff_settings' || type1 == 'del_footersections_settings' || type1 == 'del_support_settings')
	{
	    $("#del_item .choose .accept").attr('OnClick', 'del_staff_settings(\'' + item + '\', \'' + type1 + '\');');
	} else {
		$("#del_item .choose .accept").attr('OnClick', 'delete_item(\'' + item + '\', \'' + type1 + '\');');
	}
	$("#del_item").fadeIn(250);
}

// Удаление материала
function delete_item(item, type1) {
	var loc3 = document.location.href; //Ссылка на текущую страница
	var loc4 = loc3.split("/"); //Ссылка на текущую страницу в виде массива
	var params = 'action=delete&type=' + type1 + '&item=' + item;
	go_ajax(params, 'none', 'none');
	$('#sitesections_td-' + item).css("background", "#AA0000").animate({"opacity" : 0.0},250);
	setTimeout(function() {
	    $("#del_item").fadeOut(250);
		$('#' + type1 + '_td-' + item).fadeOut(250);
	},250);
	setTimeout(function() {
	    document.location.href = "/admin/" + loc4[4] + "/";
	},500);
}
/*
 * Функция для AJAX-работы с контентом. Отправка запроса.
 *
 * @param string params Сформированная строка с параметрами для запроса
 * @param string gotopage На какую страницу переадресовывать после завершения операции(если нужно)
 * @param string messid ID для вывода сообщения об итоге операции
 */
function go_ajax(params, gotopage, messid) {
	$.ajax({
        type: 'POST',
        url: '/admin/ajax/',
        data: params,
        success: function(data){
			var otv = data.replace(/[^a-z]+/ig,"");
//            debugger;
			if(messid != 'none') $('#' + messid + '_' + otv).slideDown(250).animate({opacity: "1.0"},250).delay(1000).animate({opacity: "0.7"},250).slideUp(250);

			if(otv == 'success')
			{
				if(gotopage != 'none')
				{
				    if(messid == 'login')
				    {
                        login_effect(gotopage);
				    } else {
                        debugger;
                        ajax_success(gotopage);
					}
				};
			};
        }
    });
}

/*
 * AJAX-Функция для вызова окна редактирования материала
 *
 * @param integer item ID записи в бд
 * @param string type1 Тип записи
 * @param string to В какой блок поместить форму редактирования
 */
function editajax(item, type1, to) {
	var loc3 = document.location.href; //Ссылка на текущую страница
	var loc4 = loc3.split("/"); //Ссылка на текущую страницу в виде массива
	$.ajax({
        type: 'POST',
        url: '/admin/editwindow/',
        data: 'item=' + item + '&type=' + type1,
        success: function(data){
            setTimeout(function() {
                $("html, body").css("overflow-y", "hidden");
            },250);
            debugger;
			$(to).html(data).delay(250).fadeIn(250);
			if(type1 == 'portfolio') upgradestaff2();
            if(loc4[4] == 'sections' || loc4[4] == 'reviews')
            {
                $(".file").css("width", "510px");
            	$(".file h3").css("max-width", "350px");
            };
            if(loc4[4] == 'settings')
            {
                $(".file").css("width", "310px");
                $(".file h3").css("max-width", "250px");
            	$(".file button").css({"width" : "80px", "height" : "24px"});
            };
        }
    });
}

/*
 * AJAX-Функция для вызова окна показа описания
 *
 * @param integer item ID записи в бд
 * @param string type1 Тип записи
 * @param string to В какой блок поместить форму редактирования
 */
function show_description(item, type1, to, title) {
	$.ajax({
        type: 'POST',
        url: '/admin/descriptionwindow/',
        data: 'item=' + item + '&type=' + type1 + '&to=' + to + '&title=' + title,
        success: function(data){
			setTimeout(function() {
                $("html, body").css("overflow-y", "hidden");
            },250);
			$(to).html(data).delay(250).fadeIn(250);
        }
    });
}

/*
 *   XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
 *   XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
 *   XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
 * 
 */
 
/*
 *   XXX   XXX   XXXXXXXXX   XXX         XXXXXXXXX   XXXXXXXXX   XXXXXX
 *   XXX   XXX   XXX   XXX   XXX         XXX   XXX   XXX   XXX   XXX   XXX
 *   XXX   XXX   XXX   XXX   XXX         XXX   XXX   XXX   XXX   XXX   XXX
 *   XXXXXXXXX   XXXXXXXXX   XXX         XXX   XXX   XXXXXXXXX   XXX   XXX
 *   XXXXXXXXX   XXX         XXXXXXXXX   XXXXXXXXX   XXX   XXX   XXXXXX
 *
 */
// Нажатие на кнопку "Загрузить"
function upload_file(num, form_button, form_id, type1) {
    parseInt(num) == 2 ? num = 2 : num = "";
	$(form_button).trigger('click').attr('OnChange', 'loadfile(\'' + num + '\', \'' + form_id + '\', \'' + type1 + '\', \'' + form_button + '\');');
}

// Механизм загрузки файла на сервер
function loadfile(num, form_id, type1, form_button) {
	parseInt(num) == 2 ? num = 2 : num = "";
	del_old(type1, num, '#' + type1 + '_hide_input_file' + num);
	var name = toTranslit($("#" + type1 + "_title" + num).val());
	SendFile(type1, name, form_id, num, form_button);
}

// Отправка файла на сервер с помощью AJAX
function SendFile(type1, name, form_id, num, form_button) {
	tourl = '/admin/upload/' + type1 + '-0-' + name + '-0-' + type1 + '_hide_input_file' + num + '/';

	$$f({
		formid:form_id,
		url:tourl
	});
	
	setTimeout(function() {
	    upload_success(num, form_button, form_id, type1);
	},500);
	return false;
}

// AJAX удаление файла
function del_file(img, type1, num) {
    var params = 'img=' + img + '&action=del_' + type1 + '_file';
	go_ajax(params, 'none', 'none');
	
	delfile_success(num, type1);
}

// Действие при успешной загрузке файла
function upload_success(num, form_button, form_id, type1) {
	var loc3 = document.location.href; //Ссылка на текущую страница
	var loc4 = loc3.split("/"); //Ссылка на текущую страницу в виде массива
	num == 2 ? num = 2 : num = '';
    img = $("#" + type1 + "_hide_input_file" + num).val();
    toappend = '<div class="choosen-file"><div class="file"><img src="/templates/admin/images/choosen-file.png" /><h3>' + img + '</h3><input type="button" value="Заменить" OnClick="upload_file(\'' + num + '\', \'' + form_button + '\', \'' + form_id + '\', \'' + type1 + '\'); return false;" /></div><input type="button" class="del-file" OnClick="del_file(\'' + img + '\', \'' + type1 + '\', \'' + num + '\');return false;" /></div>';
    $("#no_icon_uploaded" + num).remove();
    $("#add_" + type1 + "_form" + num + " .filestatus").html(toappend);
    if(loc4[4] == 'sections' || loc4[4] == 'reviews')
    {
        $(".file").css("width", "510px");
    	$(".file h3").css("max-width", "350px");
    };
	if(loc4[4] == 'settings')
	{
        $(".file").css("width", "310px");
        $(".file h3").css("max-width", "250px");
		$(".file button").css({"width" : "80px", "height" : "24px"});
	};
}

// Действие при успешном удалении файла
function delfile_success(num, type1) {
	var loc3 = document.location.href; //Ссылка на текущую страница
	var loc4 = loc3.split("/"); //Ссылка на текущую страницу в виде массива
    $("#" + type1 + "_hide_input_file" + num).val('');
    toappend = '<div id="no_icon_uploaded' + num + '" class="file"><img src="/templates/admin/images/file.png" /><h3>Нет файла...</h3><input id="choose_' + type1 + '_icon' + num + '" type="button" value="Выбрать файл" OnClick="upload_file(\'' + num + '\', \'#add_' + type1 + '_tp_file' + num + '\', \'add_' + type1 + '_file' + num + '\', \'' + type1 + '\');return false;"/></div>';
    $("#no_icon_uploaded" + num).remove();
    $("#add_" + type1 + "_form" + num + " .filestatus").html(toappend);
    if(loc4[4] == 'sections' || loc4[4] == 'reviews')
    {
        $(".file").css("width", "510px");
    	$(".file h3").css("max-width", "350px");
    };
	if(loc4[4] == 'settings')
	{
        $(".file").css("width", "310px");
        $(".file h3").css("max-width", "250px");
		$(".file button").css({"width" : "80px", "height" : "24px"});
	};
}

// Удаление старого файла
function del_old(type1, num, input_id) {
    var name_old = $(input_id).val();
    del_file(name_old, type1, num);
}
/*
 *   XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
 *   XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
 *   XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
 * 
 */

/*
 *   XXXXXXXXX   XXXXXXXXX   XXX   XXX   XXXXXXXXX   XXXXXXXXX
 *   XXX   XXX      XXX      XXX   XXX   XXX         XXX   XXX
 *   XXX   XXX      XXX      XXXXXXXXX   XXXXXXXXX   XXXXXX
 *   XXX   XXX      XXX      XXX   XXX   XXX         XXX   XXX
 *   XXXXXXXXX      XXX      XXX   XXX   XXXXXXXXX   XXX   XXX
 *
 */

// Перевод текста в транслит
function toTranslit(text) {
    if(text != '' && typeof(text) != "undefined")
	{
	    return text.replace(/([а-яё])|([\s_-])|([^a-z\d])/gi,
        function (all, ch, space, words, i) {
            if (space || words) {
                return space ? '-' : '';
            }
            var code = ch.charCodeAt(0),
                index = code == 1025 || code == 1105 ? 0 :
                    code > 1071 ? code - 1071 : code - 1039,
                t = ['yo', 'a', 'b', 'v', 'g', 'd', 'e', 'zh',
                    'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
                    'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh',
                    'shch', '', 'y', '', 'e', 'yu', 'ya'
                ]; 
            return t[index];
        });
	};
}

// Функция для преобразования текста в безопасный вид
function escapeHtml(text) {
  return text
      .replace(/&/g, "-0-0-")
      .replace(/</g, "-1-1-")
      .replace(/>/g, "-2-2-")
      .replace(/"/g, "-3-3-")
      .replace(/'/g, "-4-4-")
	  .replace(/\+/g, "-5-5-");
}

//Спрятать элемент
function closeitem(item, clear) {
	$(item).fadeOut(250);
	setTimeout(function() {
	    $("html, body").css("overflow-y", "auto");
	},250);
    if(parseInt(clear) == 1) clearform(item);
	return false;
}

//Показать элемент
function showitem(item) {
	$(item).fadeIn(250);
	$("html, body").css("overflow-y", "hidden");
	return false;
}

// Очистка формы при закрытии модального окна
function clearform(item) {
	var type1 = item.split("_");
	del_old(type1[1], '', '#' + type1[1]+ '_hide_input_file');
	delfile_success('', type1[1]);
	setTimeout(function() {
		$(item + " input, " + item + " textarea").each(function(i) {
            alias = $(this).attr("data-alias");
	    	if(typeof(alias) !== "undefined")
	    	{
	    	    $(this).val('');
	    	};
        });
	},250);
}

// Эффект при входе в панель
function login_effect(gotopage) {
    setTimeout(function () {
        $('html, body').fadeOut(250);
    },2000);
    setTimeout(function() {
    	document.location.href = "/" + gotopage + "/";
    },2250);
}

// Эффект при успешном завершении ajax-запроса
function ajax_success(gotopage) {
    setTimeout(function() {
        $(".window-1, .window-2").fadeOut(250);
    },2000);
    setTimeout(function() {
    	document.location.href = "/" + gotopage + "/";
    },2250);
}

// Открытие селекта
function open_select(act) {
    var selh = '#select-button-open';
	var sel = '#select-file-type';
	if(typeof window.open2 === "undefined") window.open2 = 0;
	if(window.open2 == 0)
    {
        $(selh + act).css({"border" : "1px solid #00AAFF"});
    	$(sel + act).slideDown(250).animate({"opacity" : 1.0},250);
    	window.open2 = 1;
    } else {
        $(selh + act).css({"border" : "1px solid #d5d5d5"});
    	$(sel + act).animate({"opacity" : 0.5},250).slideUp(250);
    	window.open2 = 0;
    }
    return false;
}

// Выбор из селекта
function selected_select(type2, text1, target, act) {
	var loc3 = document.location.href; //Ссылка на текущую страницу
	var loc4 = loc3.split("/"); //Ссылка на текущую страницу в виде массива
	
    var selh = '#select-button-open';
	var sel = '#select-file-type';
	
	$(selh + act + " h3").html(text1).attr("data-type", type2);
	$(selh + act).css({"border" : "1px solid #d5d5d5"});
	$(sel + act).animate({"opacity" : 0.5},250).slideUp(250);
	$(target + act).val(type2);
	
	window.open2 = 0;
	return false;
}

// Показать вкладку с ключами
function show_game_keys(id, id2) {
    $(id2).animate({"opacity" : 0.7},250).slideUp(250);
	$(id).slideDown(250).animate({"opacity" : 1.0},250);
	$(id + '_link').animate({"color" : "#FFFFFF", "backgroundColor" : "#00AAFF"},250);
	$(id2 + '_link').animate({"color" : "#00AAFF", "backgroundColor" : "#FFFFFF"},250);
	return false;
}