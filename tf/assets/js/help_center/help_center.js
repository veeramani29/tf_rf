/***************
@author: Vikas Arora
@Description: handles different events in help center pages
**************Stiches all parts of history api urls and routes together
******************/

/****************pushState event********************/

articleHelpful();
$('.get_content').on('click', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    updateArticleContent(url);
});

/********************End of push state events*******/

/*Get the article from popular keywords*/
$('.get_popular_article').on('click', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    updateArticleContent(url);
})
/**************************************/

/********************Popstate event*****************/
$(window).bind('popstate', function(event) {
    event.preventDefault();
    var url = location.href;
    var splitURL = url.split('/');
	console.log(splitURL);
    if(!splitURL[4]){
       //window.location = WEB_URL+'/help';
    }

    if(splitURL[4] == "article") { 
        loadArticle(url);
    } else if(splitURL[4].slice(0, 6) == "search") {
        loadSearch(url);
    } else if(splitURL[4] == "articlelink") {
    	loadArticleLink(url)
    } else {
        window.location = WEB_URL+'/help';
    }
});

function loadArticle(url) { 
    $.ajax({
        url: url+'/1',
        dataType: 'json',
        success: function(r) {
            console.log(r);
            if(r['contentObject'][0]['content_type'] == 3) {
                $('#contentLink').empty();
                $('#contentLink').show();
                $('#articleLoad').hide();
                $('#contentLoad').hide();

                $('#contentLink').append('<div class="full martb contentLinkShell"></div>');
                $('.contentLinkShell').append('<h3 class="inpagehed" id="contentLinkTitle">'+r['contentTitle']+'</h3>')

                $('.contentLinkShell').append('<ul class="contentLinkList"></ul>');
               
                for(var key in r['contentObject']) {
                    $('.contentLinkList').append("<li class='qustiononly'><a class='loadLinkContent' href="+WEB_URL+"/help/articlelink/"+r['contentObject'][key]['menu_id']+"/"+r['contentObject'][key]['sub_menu_id']+"/"+r['contentObject'][key]['cont_id']+" >"+r['contentObject'][key]['hedding']+"</a></li>");
                    console.log(r['contentObject'][key]['hedding']);
                }
                articleHelpful(3);
            } else{
	            $('#contentLink').hide();
	            $('#articleLoad').show();
	            $('#contentLoad').show();
	            $('#searchLoad').hide();
	            $('#contentSubHead').empty();
	            $('#contentBody').empty();
	            $('#contentTitle').empty();
	            if(r.length != 0) {
	                $('#contentSubHead').html('');
	                $('#contentTitle').html(r['contentTitle']);
	                $('#contentBody').html(r['contentObject'][0]['content']);

                    if((r['contentObject'][0]['sub_image']) != 'no image' && r['contentObject'][0]['sub_image'] ) {
                  
                        $('#contentImage').html("<img src='"+help_upload_dir+"/admin/upload_files/help_desk/"+r['contentObject'][0]['sub_image']+"' alt=''> ");
                    } else {
                        $('#contentImage').html("");    
                    }

	            } else {
	                $('#contentTitle').html('<i>No content!</i>');
	                $('#contentSubHead').html('Currently there is no content available. Try after sometime..');
	                $('#contentBody').html("");
	            }
                articleHelpful();
        	}
        }
    });
}

function loadSearch(url) { 
    var urlPath = removeParameter(url);
    var searchQuery = getParameterByName('q');
    var browser_url = urlPath+'?q='+searchQuery;
    var url_param = urlPath+'/1?q='+searchQuery;
    $.ajax({
        url: url_param,
        data: {'ajaxRequest':1},
        method: 'GET',
        dataType: 'json',
        success: function(r) {
            $('#contentLoad').hide();
            $('#articleLoad').hide();
            $('#searchLoad').show();
            $('#resultCounter').text(r.searchCount);
            $('#resultSearchTerm').text("'"+searchQuery+"'");
            $('#searchResultList').empty();
            for(var result_k in r.searchResult) {
                var createShell =   '<div class="col-md-10 my8n" style="padding-top: 10px">'+
                                        '<h4 class="divihed searchArticleTitle">'+
                                            '<i class="icon-file-text"></i>'+
                                            '<a class="get_search_content" href="'+WEB_URL+'/help/article/'+r.searchResult[result_k]['menu_id']+'/'+r.searchResult[result_k]['sub_menu_id']+'">'+r.searchResult[result_k]['con_title']+'</a>'+
                                        '</h4>'+
                                        '<div class="divip searchArticleBody">'+
                                            r.searchResult[result_k]['content'].slice(0, 200)+'...'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="clear"></div>'+
                                    '<div style="border-bottom: 1px solid #dedede; margin: 20px 0px 0px 0px"></div>';
                $('#searchResultList').append(createShell);
            }
        }
    });
}

function loadArticleLink(url) {
	$.ajax({
		url: url+'/1',
		dataType: 'json',
		success: function(r) {
			//alert();
			$('#articleLoad').show();
			$('#contentLoad').show();
			$('#contentLink').hide();
			$('#linkDynamicLoad').hide();
			$('#articleDynamicLoad').show();
			$('#contentTitle').html(r['contentObject']['con_title']);
			$('#contentBody').html(r['contentObject']['content']);
            articleHelpful();
		}
	});
}

function removeParameter(url) {
    var oldURL = url;
    var index = 0;
    var newURL = oldURL;
    index = oldURL.indexOf('?');
    if(index == -1){
        index = oldURL.indexOf('#');
    }
    if(index != -1){
       return newURL = oldURL.substring(0, index);
    }
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
/****************End of popstate event**************/

/**************Pushstate events for search**************************/
$('#helpCenterSearchForm').submit(function(e) {
    e.preventDefault();
    $('#contentLoad').hide();
    $('#articleLoad').hide();
    $('#searchLoad').show();
    var searchQuery = $('#helpSearchInput').val();
    var url = $(this).attr('action');
    var browser_url = $(this).attr('action')+'?q='+searchQuery;
    var url_param = url+'/1?q='+searchQuery;
    $.ajax({
        url: url_param,
        data: {'ajaxRequest':1},
        method: 'GET',
        dataType: 'json',
        success: function(r) {
            console.log(r);
            $('#resultCounter').text(r.searchCount);
            $('#resultSearchTerm').text("'"+searchQuery+"'");
            $('#searchResultList').empty();
            for(var result_k in r.searchResult) {
                var createShell =   '<div class="col-md-10 my8n" style="padding-top: 10px">'+
                                        '<h4 class="divihed searchArticleTitle">'+
                                            '<i class="icon-file-text"></i>'+
                                            '<a class="get_search_content" href="'+WEB_URL+'/help/article/'+r.searchResult[result_k]['menu_id']+'/'+r.searchResult[result_k]['sub_menu_id']+'">'+r.searchResult[result_k]['con_title']+'</a>'+
                                        '</h4>'+
                                        '<div class="divip searchArticleBody">'+
                                            r.searchResult[result_k]['content'].slice(0, 200)+'...'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="clear"></div>'+
                                    '<div style="border-bottom: 1px solid #dedede; margin: 20px 0px 0px 0px"></div>';
                $('#searchResultList').append(createShell);
            }
        }
    });
    history.pushState(null, 'title', browser_url); 
    $('.suggestion_box').hide();
})
/*************End of pustate event for search********************************/

$(document).on('click', '.get_search_content', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    updateArticleContent(url);
});

function updateArticleContent(url) {
    $('#searchLoad').hide();
    $('#contentLoad').show();
    $('#articleLoad').show();

    $.ajax({
        url: url+'/1',
        dataType: 'json',
        success: function(r) {

            if(r['contentObject'][0]['content_type'] == 3) { 
                $('#contentLink').empty();
                $('#contentLink').show();
                $('#articleLoad').hide();
                $('#contentLoad').hide();

                $('#contentLink').append('<div class="full martb contentLinkShell"></div>');
                $('.contentLinkShell').append('<h3 class="inpagehed" id="contentLinkTitle">'+r['contentTitle']+'</h3>')

                $('.contentLinkShell').append('<ul class="contentLinkList"></ul>');
               
                for(var key in r['contentObject']) {
                    $('.contentLinkList').append("<li class='qustiononly'><a class='loadLinkContent' href="+WEB_URL+"/help/articlelink/"+r['contentObject'][key]['menu_id']+"/"+r['contentObject'][key]['sub_menu_id']+"/"+r['contentObject'][key]['cont_id']+" >"+r['contentObject'][key]['hedding']+"</a></li>");
                    //console.log(r['contentObject'][key]);
                }

               articleHelpful(3);
            
            } else { 
            	$('#contentLink').hide();
	            $('#contentLoad').show();
	            $('#contentSubHead').empty();
	            $('#contentBody').empty();
	            $('#contentTitle').empty();
	            if(r.length != 0) {

	                $('#contentSubHead').html('');
	                $('#contentTitle').html(r['contentTitle']);
	                $('#contentBody').html(r['contentObject'][0]['content']);
                  
                    if((r['contentObject'][0]['sub_image']) != 'no image' && r['contentObject'][0]['sub_image'] ) {
                  
                        $('#contentImage').html("<img src='"+help_upload_dir+"/admin/upload_files/help_desk/"+r['contentObject'][0]['sub_image']+"' alt=''> ");
                    } else {
                        $('#contentImage').html("");    
                    }
                    
                    articleHelpful();
	            } else {
	                $('#contentTitle').html('<i>No content!</i>');
	                $('#contentSubHead').html('Currently there is no content available. Try after sometime..');
	                $('#contentBody').html("");
	            }
            }
        }
    });
    history.pushState(null, 'title', url);
}

/*************************************************************/

/******************ajax call on the user input in the search field************/
/*Not using currently*/

// $('#helpSearchInput').on('keyup', function(e) { 
//     var keyupVal = $(this).val();
//     if($('#helpSearchInput').val().length == 0) {
//         $('.suggestion_box').hide();
//     }
//     $.ajax({
//         url: WEB_URL+"/help/get_quick_results/"+keyupVal,   /*WEB_URL is defined in header.php*/
//         dataType: 'json',
//         success: function(r) {
//             console.log(r);
//             if(r['quickLink'].length > 0) {
//                 $('.suggestion_box').show();
//                 $('.suggestion_box > ul').empty();
//                 for(var i in r['quickLink']) {
//                     $('.suggestion_box > ul').append('<li>'+r['quickLink'][i]+'</li>');
//                 }    
//             } else {
//                 $('.suggestion_box').show();
//                 $('.suggestion_box > ul').empty();
//                 $('.suggestion_box > ul').append('<li class="abandonSearch">No result found.</li>');
//             }
//         }
//     })
// });

$(document).click(function(e) {
    if(!$(e.target).is('.suggestion_box > ul > li')) {
        $('.suggestion_box').hide();
    }
});

$(document).on('click', '.suggestion_box > ul > li', function() {
    if($(this).hasClass('abandonSearch')) {

    } else {
        $('#helpSearchInput').val($(this).text());
        $('#helpCenterSearchForm').submit();    
    }
});

/**************End of ajax call in search field***********************/

$(document).on('click', '.loadLinkContent', function(e) {
	e.preventDefault();
	var url = $(this).attr('href');

	$.ajax({
		url: url+'/1',
		dataType: 'json',
		success: function(r) {
			// alert();
			$('#articleLoad').show();
			$('#contentLoad').show();
			$('#contentLink').hide();
			$('#linkDynamicLoad').hide();
			$('#articleDynamicLoad').show();
			$('#contentTitle').html(r['contentObject']['con_title']);
			$('#contentBody').html(r['contentObject']['content']);
            if((r['contentObject']['sub_image']) != 'no image' && r['contentObject']['sub_image'] ) {
                $('#contentImage').html("<img src='"+help_upload_dir+"/admin/upload_files/help_desk/"+r['contentObject']['sub_image']+"' alt=''> ");
            } else {
                $('#contentImage').html("");    
            }
		}
	});
	history.pushState(null, 'title', url);
    articleHelpful();
});

/****************Was it helpful module starts here******************************/

function articleHelpful(content_type) {
   // return false;
    var curr_url = location.href;
    var splitURL = curr_url.split('/');
    window.menu_id = splitURL[6];
    window.submenu_id = splitURL[7];
   
    if(splitURL[5] == 'article') {
        window.cont_id = "";
    } else if(splitURL[5] == 'articlelink') {
        window.cont_id = splitURL[8];
    } else {
        window.cont_id = "";
    }

    if(!menu_id || !submenu_id) {
        return false;
    }

/*Dynamically create the feedback box*/

    window.feedbackHelpHtml = "<div class='full martb' id='helpFeedBack'>" +
                                "<div style='padding: 15px;' class='contentdivi'>"+
                                    "<div class='col-md-6 my4n'>"+
                                        "<span class='h4 label-inline'>Was this helpful?</span>"+
                                        "<span style='margin-left: 20px'></span>"+
                                        "<a href='#' data-fb='1' class='feed_back' id='fbYes'>Yes"+
                                            
                                        "</a>"+
                                        "<span style='margin-left: 10px'></span>"+
                                        "<a href='#'' data-fb='0' class='feed_back' id='fbNo'>No"+
                                            
                                        "</a>"+
                                    "</div>"+
                                    "<div class='clear'></div>"+
                                "</div>"+
                            "</div>";

    window.feedbackDoneHtml =  "<div class='full martb' id='helpFeedBack'>" +
                                "<div style='padding: 15px;' class='contentdivi'>"+
                                    "<div class='col-md-6 my4n'>"+
                                        "<span class='h4 label-inline'>Thank you for the feedback!</span>"+
                                    "</div>"+
                                    "<div class='clear'></div>"+
                                "</div>"+
                            "</div>";

    $('#articleReview').empty();
    if(content_type == 3) {
        $('#articleReview').append('');
    } else {
        $('#articleReview').append(feedbackHelpHtml);    
    }
    
 //   alert();
   
}

$(document).on('click', '.feed_back', function(e) {
    e.preventDefault();
    var feedback = $(this).data('fb');

    $.ajax({
        url: WEB_URL+'/help/addFeedback/',
        data: {menu_id: menu_id, submenu_id: submenu_id, cont_id: cont_id, feedback: feedback},
        method: 'POST',
        success: function(r) { console.log(r);
            $('#articleReview').empty();
                $('#articleReview').append(feedbackDoneHtml);
                
        }
    });
});