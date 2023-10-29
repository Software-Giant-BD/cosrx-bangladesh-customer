function loadData(load_url)
{
    var scrollhight = 300;
    $(window).scroll(function() {
        var dataCount = $('.load-more').attr('dataCount');
        request_url = load_url +"/"+dataCount;
        console.log(request_url)
        if (($(window).scrollTop() + $(window).height() + 1 > scrollhight)) {
            $.ajax({
                type: 'GET',
                url: request_url,
                success: function(html) {
                    if(html.length > 0)
                    {
                        $('.load-more').remove();
                        $('#load-data').append(html);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log("Load data error");
                }
            });
            scrollhight = scrollhight + 1200;
        }

    });

}
