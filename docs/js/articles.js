$(function(){
    var page = 2;

    $('button').on('click', more);

    function more()
    {
        var params = 'page=' + page;
        var pathname = location.pathname.split('/');
        if(pathname[1] == 'category') {
            params += '&category=' + pathname[3];
        }
        console.log(params);

        $.ajax({
            type: 'GET',
            url: '/articles/ajax/',
            dataType: 'json',
            data: params,
            success: function(data){
                console.log(data);
                if(data.error == true) {

                    $('button').text('Больше статей нету').prop('disabled', true);

                } else {
                    page++;
                    $.each(data, addArticle);
                }

            }
        });
    }


    function addArticle(index, data) {
        debugger;
        var source   = $('#article-template').html();
        var template = Handlebars.compile(source);
        var html = template(data);
        $(html).appendTo($('#container')).hide().fadeIn();
    }

});
