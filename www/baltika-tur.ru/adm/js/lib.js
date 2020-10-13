//---------------------------------------
//  Функции создания интерфейсов админки
//---------------------------------------

function initTree(id)
{
	$('#tree').children().remove();
	$('#tree').append('<img src="images/loading.gif"/>');
	$('#tree').load('init_tree.php',{'id':id,'ss':show_status},makeTree);
}
function initSPO(id)
{
	$('#tree').children().remove();
	$('#tree').append('<img src="images/loading.gif"/>');
	$('#tree').load('init_spo.php');
}
function getTree(id)
{
	$('#tree').children().remove();
	$('#tree').append('<img src="images/loading.gif"/>');
	$('#tree').load('get_tree.php',{'id':id,'ss':show_status},makeTree);
	$('#content').load('get_templates.php',{'id':id});
}

function initMenu()
{
	initSiteMenu();
	initObrMenu()
	initArticleMenu()
	initNewsMenu();
	initMediaMenu('media');
	initMediaMenu('baner');
	$('#myMenu').Accordion(
		{
			headerSelector	: 'dt',
			panelSelector	: 'dd',
			activeClass		: 'myMenuActive',
			hoverClass		: 'myMenuHover',
			panelHeight		: 580,
			speed			: 300
		}
	);
}
function initObrMenu()
{
	$('#menuOBR').load('init_obr.php',{'ss':show_status},function()
	{
		$('span.spOBR').click(function(){
		getContent($(this).attr('id'));	
		});	
	}
	);
}
function initArticleMenu()
{
	$('#menuArticle').load('init_article.php',{'ss':show_status},function()
	{
		$('span.spArticle').click(function(){
		getArticle($(this).attr('id'));	
		});	
	}
	); 
}
function initSiteMenu()
{
 	$('#menuSites').load('get_sites.php',{},function()
	{
		$('span.spSites').click(function(){
		getTree($(this).attr('id'));	
		});	
	}
	);
}
function initNewsMenu()
{
	$('#menuNews').load('init_news.php',{'ss':show_status},function()
	{
		$('span.spNews').click(function(){
      getNews($(this).attr('id'));	
      $('#tree').load('news_tree.php',{'ss':show_status},makeMediaTree);
		});	
	}
	);
}

function initMediaMenu(type)
{
	$('#menu'+type).load('init_media.php',{'type':type,'ss':show_status},function()
	{
		$('span.sp'+type).click(function(){
      getMedia($(this).attr('id'));	
      $('#tree').load('media_tree.php',{'type':type,'ss':show_status},makeMediaTree);
		});	
	}
	);
}

//--------- функции привязки контейнеров контента к страницам
function conectContent(id)
{
	$('#content').load('conect_content.php',{'id':id,'ss':show_status});
}
function conectMedia(id)
{
	$('#content').load('conect_media.php',{'id':id,'ss':show_status});
}	
function newConectContent(opt,id)
{
	 for (i=0;i<opt.length;i++){
		if(opt[i].selected){
		 	newId = opt[i].value;
		 	var newCON=': '+newId;
		 }
	}
	$.post('post_conect.php',{'cid':newId,'id':id},function(){
		$('#'+id).html(newCON);
		conectContent(id);
	});
}
function newConectMedia(opt,id,type)
{
	 for (i=0;i<opt.length;i++){
		if(opt[i].selected)newId = opt[i].value;
	}
	$.post('post_conect_media.php',{'id':newId,'cid':id},function(){
		$('#tree').load('media_tree.php',{'type':type,'ss':show_status},makeMediaTree);
	});
}
function newConectNews(opt,id)
{
	for (i=0;i<opt.length;i++){
		if(opt[i].selected)newId = opt[i].value;
	}
	$.post('post_conect_media.php',{'id':newId,'cid':id},function(){
		$('#tree').load('news_tree.php',{'ss':show_status},makeMediaTree);
	});
}
function newLinkMedia(opt,id)
{
	 for (i=0;i<opt.length;i++){
		if(opt[i].selected)newId = opt[i].value;
  }
	$.post('change_db.php',{'id':id,'type':'link','value':newId,'db':'ve_photos'},function(){
		getMedia(id)
	});
}

function newLinkNews(opt,id)
{
	 for (i=0;i<opt.length;i++){
		if(opt[i].selected)newId = opt[i].value;
  }
	$.post('change_db.php',{'id':id,'type':'link','value':newId,'db':'ve_news'},function(){
		getMedia(id)
	});
}

function newConectAkc(opt,id)
{
	 for (i=0;i<opt.length;i++){
		if(opt[i].selected)newId = opt[i].value;
	}
	$.post('post_conect_media.php',{'id':newId,'cid':id},function(){
		getContent(id);
	});
}


// -----------------------------
// ---- функции drag and dropa
// -----------------------------	
function movePage(id,pid)
{
 	id = id.substr(2);
 	pid = pid.substr(2);
	$.post('move_page.php',{'pid':pid,'id':id});
}	
function moveDesk(id,pid)
{
	$.post('move_desk.php',{'pid':pid,'id':id});
}
function moveFoto(id,pid)
{
	$.post('move_foto.php',{'pid':pid,'id':id});
}

//---------------------------------------
//-------- функции редактирования полей БД
//---------------------------------------
function saveText (cid, id,type, db)
{
	var value=$('.markItUpEditor').val();
	$.post('change_db.php',{'id':id,'type':type,'value':value,'db':db});
}
function changeDB (id,type,value,db)
{
	$.post('change_db.php',{'id':id,'type':type,'value':value,'db':db});
}
function changePage (id,type,value,db)
{
	$.post('change_db.php',{'id':id,'type':type,'value':value,'db':db});
	$('#pg'+id).html(value);
}
function changeContents (cid, id,type,value, db)
{
	$.post('change_db.php',{'id':id,'type':type,'value':value,'db':db},function(){
    $('#tree').load('content_tree.php',{'id':cid,'ss':show_status},makeContentTree);
    initObrMenu();
	});
}
function changeArticle (cid, id,type,value, db)
{
	$.post('change_db.php',{'id':id,'type':type,'value':value,'db':db},function(){
    $('#tree').load('content_tree.php',{'id':cid,'ss':show_status},makeContentTree);
    initArticleMenu();
	});
}
function changeMedia (id,type,value, db,typem)
{
	$.post('change_db.php',{'id':id,'type':type,'value':value,'db':db},function(){
	$('#tree').load('media_tree.php',{'type':typem,'ss':show_status},makeMediaTree);
	initMediaMenu(typem);
	});
}
function changeNews (id,type,value, db)
{
	$.post('change_db.php',{'id':id,'type':type,'value':value,'db':db},function(){
	$('#tree').load('news_tree.php',{'ss':show_status},makeMediaTree);
	initNewsMenu();
	});
}
function changeType (id)
{
 	var val = $("input[@type=radio][@checked]").attr('value');
 	$.post('change_db.php',{'id':id,'type':'type','value':val,'db':'ve_pages'});
 	$('#img'+id).attr({'src': 'images/'+val+'.gif'});
}
//------------------------------------------------------
//---------------------------------------
//-------- функции создания записей БД
//---------------------------------------

function newSite (id)
{
	$.post('new_site.php',{'id':id},function(data){
    if(data > 0){
      initSiteMenu();
      getTree(data);
    } else {
      alert('Возникла проблема')
    }
	});
}
function newPage (id)
{
	$.post('new_page.php',{'id':id},function(data){
		$('#'+id,'#tree').parent().parent().append(data);
	});
}
function newDescription (id, pid)
{
	$.post('new_description.php',{'pid':pid},function(){
		$('#tree').load('content_tree.php',{'id':id,'ss':show_status},makeContentTree);
	});
}
function newMediaCont (type)
{
	$.post('new_media_cont.php',{'type':type},function(){
		$('#tree').load('media_tree.php',{'type':type,'ss':show_status},makeMediaTree);
	});
}
function newNewsCont ()
{
	$.post('new_media_cont.php',{'type':'news'},function(){
		$('#tree').load('news_tree.php',{'ss':show_status},makeMediaTree);
	});
}
function newNews ()
{
	$.post('new_news.php',{},function(data){
		initNewsMenu();
		getNews(data);
	});
}
function newContent ()
{
	$.post('new_content.php',{},function(data){
	$('#menuOBR').load('init_obr.php',{'ss':show_status},function()
	{
		$('span.spOBR').click(function(){
		getContent($(this).attr('id'));	
		});	
		getContent(data);
	}
	);
	});
}
function newArticle ()
{
	$.post('new_article.php',{},function(data){
		$('#menuArticle').load('init_article.php',{'ss':show_status},function()
	{
		$('span.spArticle').click(function(){
		getArticle($(this).attr('id'));	
		});	
		getArticle(data);
	}
	);
	});
}
function newPhoto (cid,pid,type)
{
 	var value = $("input[@type=radio][@checked]").attr('value');
 	ajaxFileUpload(cid,pid,type,value);
}

function newTableOfContent (id)
{
	$.post('new_table_of_contents.php',{'id':id});
	$('#tree').load('content_tree.php',{'id':id,'ss':show_status},makeContentTree);
}

//------------------------------------------------------

//---------------------------------------
//-------- функции удаления записей БД
//---------------------------------------


function delContents (id,pid,db)
{
	$.post('del_db.php',{'id':pid,'db':db}, function (){
	 getContent(id);
	 });
}

function delPage (id)
{
	$.post('del_db.php',{'id':id,'db':'ve_pages'},function(data)
	{
	 if(data == 1)$('#pg'+id).parent().attr('style', 'opacity: 1');
	 else $('#pg'+id).parent().attr('style', 'opacity: 0.5');
	});
}

function delContent (id,db)
{
	$.post('del_db.php',{'id':id,'db':db});
	$('#menuOBR').load('init_obr.php',{'ss':show_status},function()
	{
		$('span.spOBR').click(function(){
		getContent($(this).attr('id'));	
		});	
		getContent(id);
	}
	);
}
function delMedia (id,db,type)
{
	$.post('del_db.php',{'id':id,'db':db},function(){
	  $('#tree').load('media_tree.php',{'type':type,'ss':show_status},makeMediaTree);
	  getMedia(id);
	  initMediaMenu(type);
	});
	
}
function delNews (id,db)
{
  $.post('del_db.php',{'id':id,'db':db},function(){
    $('#tree').load('news_tree.php',{'ss':show_status},makeMediaTree);
    getNews(id);
    initNewsMenu();
  });
}
function delSite (id)
{
$.post('del_db.php',{'id':id,'db':'ve_pages'},function()
	{
		initSiteMenu();
	}
);
}
function delNewsCont (id,db)
{
$.post('del_db.php',{'id':id,'db':db},function()
	{
	 $('#tree').load('news_tree.php',{'ss':show_status},makeMediaTree);
	 	getNewsCont(id);
	}
);
}
function delArticle (id,db)
{
	$.post('del_db.php',{'id':id,'db':db});
	$('#menuArticle').load('init_article.php',{'ss':show_status},function()
	{
		$('span.spArticle').click(function(){
		getArticle($(this).attr('id'));	
		});	
		getArticle(id);
	}
	);
}
function delMediaCont (id,db,type)
{
	$.post('del_db.php',{'id':id,'db':db});
	$('#tree').load('media_tree.php',{'type':'media','ss':show_status},makeMediaTree);
}

function delAkc (id,cid)
{
	$.post('del_db_pr.php',{'id':id,'db':'ve_crosstbl','pole':'id'},function(){
			getContent(cid);
	});
}

function delItem(id)
{
       var agree=confirm("Вы действительно хотите удалить объект?");
       if (agree)
       {
       $.post('del_db_pr.php',{'id':id,'db':'ve_crosstbl','pole':'id'},function(){
               $('#cn_'+id).remove();
});
	}
}

//------------------------------------------------------

//---------------------------------------
//-------- функции инициации записей БД
//---------------------------------------
function getContent(id)
{
	$('#content').load('get_content.php',{'id':id});
	$('#tree').load('content_tree.php',{'id':id,'ss':show_status},makeContentTree);
}
function getArticle(id)
{
	$('#content').load('get_article.php',{'id':id});
	$('#tree').load('content_tree.php',{'id':id,'ss':show_status},makeContentTree);
}

function getNews(id)
{
	$('#content').load('get_news.php',{'id':id});
}
function getNewsCont(id)
{
	$('#content').load('get_news_cont.php',{'id':id});
	
}
function getMedia(id)
{
	$('#content').load('get_media.php',{'id':id});
}
function getMediaCont(id)
{
	$('#content').load('get_cont_media.php',{'id':id});
}
function getFoto(id,cid)
{
	$('#content').load('get_foto.php',{'id':id,'cid':cid});
}
function getFile(id,cid)
{
	$('#content').load('get_file.php',{'id':id,'cid':cid});
}
function getDesk(id,cid)
{
	$('#content').load('get_desk.php',{'id':id,'cid':cid},function(){
		$('#html').markItUp(mySettings);
});
}
function getFolder(id, cid)
{
	$('#content').load('get_folder.php',{'id':id,'cid':cid});
}
function getPage(id)
{
	$('#content').load('get_page.php',{'id':id});
}
function getSeoPage(id)
{
	$('#content').load('get_seo.php',{'id':id},function(){
		$('#html').markItUp(mySettings);
});
}
//------------------------------------------------
//  функция загрузки файлов на сервер
//------------------------------------------------
function ajaxFileUpload(cid, pid, type, id)
	{
$.ajaxFileUpload
		(
			{
				url:'doajaxfileupload.php', 
				secureuri:false,
				fileElementId:'fileToUpload',
				dataType: 'json',
				pid: pid,
				id: id,
				type: type,
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						}else
						{
							if (type == 'photo'){
							 	getFoto(data.msg,cid);
							 	$('#tree').load('content_tree.php',{'id':cid,'ss':show_status},makeContentTree);
							}
							else {
							 	if (type == 'file'){
							 		getFile(data.msg,cid);
							 		$('#tree').load('content_tree.php',{'id':cid,'ss':show_status},makeContentTree);
								}
								else {
							 		getMedia(data.msg)
							 		initMediaMenu(type);
							 	}
							 }
						}
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		)
		
		return false;

}  
//------- функция по изменению статуса отображения удаленых записей
function changeShowStatus()
{
	if (show_status == 0)show_status = 1;
  else show_status = 0;
  initMenu();
}
