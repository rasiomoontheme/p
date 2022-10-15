$.fn.extend({
    paging_H: function(option) {
        var obj = $(this);
        var defaults = {
            pageSize: 10, //可视页码数量
            totalPage:10, //数据总页码
        };
        var settings = $.extend(defaults, option || {});  //初始化
        var totalPage = settings.totalPage;
        var pageSize = settings.pageSize;
		var totalRow = settings.totalRowNum;
		var pageSizeAjax = settings.pageSizeAjax;
		var _cp = settings.cp;
		console.log(settings);		
        init();
        function light(obj) {    //点击页码高亮样式，当前页码
			//console.log(obj);
            obj.addClass("current").siblings().removeClass("current");
        }
		 
        function getCurrentIndex(){
			//console.log($(".page"));
            //return $(".page").index(".current");
			return $(".paging a").index($(".current"));
			
        }
        function getCurrentPage(){
            return parseInt(obj.find("a").eq(getCurrentIndex()).text());
			//return $(".page").index(".current");
        }
        function resetPage(start){
            var objPage = obj.find("a");
            for(var i = 0; i < pageSize ; i++ ) {
                $(objPage[i]).text(start++);
				console.log("当前页码:"+ $(objPage[i]).text());
            }
        }
        function showHome(ishome){
            var homeObj = obj.find("#home");
            if(ishome){
                homeObj.show();
            } else{
                homeObj.hide();
            }

        }
        function showEnd(isend){
            var endObj = obj.find("#end");
            if(isend){
                endObj.show();
            } else{
                endObj.hide();
            }

        }
        function makePage(start,isHome,isEnd) {  //生成页码
            var index = 0;
            var html = '';
            var endPage = start + pageSize-1;
            if(totalPage <= pageSize) {
               endPage = totalPage;
			   console.log('endPage:'+endPage);
            } 
			console.log('endPage:'+endPage);
			/*
            html = '<span class="home" id="home">首页</span><span id="pre" class="home"><</span>';
            for (var i = start; i <= endPage; i++) {
                html += '<span class="page" id="uipage-nav'+ i +'">' + i + "</span>";
            }
            html += '<span id="next" class="end">></span><span  class="end" id="end">末页</span>';
            obj.html(html);
			
			*/
			 html = '<div class="paging_l"><i>共<ii id="i1">'+totalRow+'</ii>条记录,<ii id="i2">'+totalPage+'</ii>页,每页'+pageSizeAjax+'条记录<\/i><span class="cur" id="home">第一页<\/span><span class="cur" id="pre">上一页<\/span>';
            for (var i = start; i <= endPage; i++) {
                html += '<a href="javascript:void(0)" class="page" id="uipage-nav'+ i +'" >'+i+'</a>';
            }
            html += '<span id="next" >下一页<\/span><span id="end">最后一页<\/span><\/div>';
			html += ' <div class="paging_r"  style="display:none;"><i>每页显示：<\/i><a href="javascript:void(0)" id="rePage20" style="margin-left:5px;" id="rePage20" >20<\/a><a href="javascript:void(0)"  id="rePage50">50<\/a><a href="javascript:void(0)"  id="rePage100">100<\/a><a href="javascript:void(0)"  id="rePage200">200<\/a><\/div>';
            obj.html(html);
			
			console.log(html);
            if(!isHome || start == 1){
                showHome(false);
            }
            if(!isEnd){
                showEnd(false);
            }
        }
        function refreshPage(start,nextPage,isEnd,cpindex){   //刷新页码
		  var isEnd = isEnd ? isEnd : false;
		   var cpindex = cpindex ? cpindex : 0;
            var end = start + pageSize - 1;
            if(start <= 1) {
                start = 1;
                resetPage(start);
                showHome(false);
                showEnd(true);
                //light($("#uipage-nav"+nextPage+1));
				if(isEnd==true){
					 
					light(obj.find("a").eq(4)); 
					 
				 }else{
					light(obj.find("a").eq(0)); 
					 
				 }
				 if(end<=5){
					 
					  $(obj.find("a")).each(function(k,v){
						 if($(v).text()==cpindex){
							 
							 light($(v)); 
							 
						 }
					  });
					 
				 }
				 console.log('go-1');
            }else if(start>1 && start+pageSize < totalPage){
                resetPage(start);
                showHome(true);
                showEnd(true);
                //light($("#uipage-nav"+pageSize));
				//light(obj.find("a").eq(0));
				if(isEnd==true){
					 
					light(obj.find("a").eq(4)); 
					 
				 }else{
					light(obj.find("a").eq(0)); 
					 
				 }
				 console.log('go-2');
            }else if(end > totalPage) {
                start = totalPage - pageSize + 1;
                showEnd(false);
                showHome(true);
                resetPage(start);
                var endPage = parseInt(obj.find("a").eq(4).text()); //末页页数
                var showPageIndex = pageSize - (endPage - nextPage);
                  
				 if(isEnd==true){
					 
					light(obj.find("a").eq(4)); 
					 
				 }else{
					light(obj.find("a").eq(0)); 
					 
				 }
				  
					 
					  $(obj.find("a")).each(function(k,v){
						 if($(v).text()==cpindex){
							 
							 light($(v)); 
							 
						 }
					  });
					 
				 
				 console.log('go-3');
            } else if(end == totalPage){
                resetPage(start);
                showEnd(false);
                showHome(true);
                //light(obj.find("a").eq(0));
				 if(isEnd==true){
					 
					light(obj.find("a").eq(4)); 
					 
				 }else{
					light(obj.find("a").eq(0)); 
					 
				 }
				 console.log('go-4 '+isEnd);
            } else {
                resetPage(start);
                showEnd(true);
                showHome(true);
               // light(obj.find("a").eq(0));
				if(isEnd==true){
					 
					light(obj.find("a").eq(4)); 
					 
				 }else{
					light(obj.find("a").eq(0)); 
					 
				 }
				 console.log('go-5');
            }

        }
        function init(){   //初始化页码
           if(totalPage <= 1) { 
                //return false
				makePage(1,false,false);
            } else if(totalPage <= pageSize){
                makePage(1,false,false);
            } else {
                makePage(1,false,true);  
            }
			
           
			if(_cp!=null){
				
				$(obj.find("a")).each(function(k,v){
						 if($(v).text()==_cp){
							 
							 light($(v)); 
							 
						 }
					  });
				
			}else{
				
				 light(obj.find("a").eq(0));
				
			}
        }
		function rePage(size){   //初始化页码
		   var size = size ? size : 5;
            pageSizeAjax = size;
		    sendAjax_H(1,pageSizeAjax);
        }
        obj.find(".page").click(function(){
            var _this = $(this);
            var showPage = _this.text();
            light(_this);
            sendAjax_H(showPage,pageSizeAjax);
			
			
			//eq 0
			var currentIndex = getCurrentIndex();
            var currentPage = getCurrentPage();
			var showPageIndex = currentIndex - 1;
            var nextPage = currentPage - 1;
			if(currentIndex == 0){
				console.log('page-1');
				console.log('1当前序号：'+currentIndex+",最大序号："+(pageSize));
				if(currentIndex == 0 && totalPage>=pageSize && currentPage!=1) {
					
					refreshPage(currentPage - pageSize+1,nextPage,true,currentPage);
				}
				
				  
			}
			if(currentIndex == 4){
				  console.log('page-2');
				   if(currentIndex+1 == pageSize ) {//&& currentPage+1!=totalPage
					   if(currentPage==totalPage){
						   
						   refreshPage(currentPage + 0,nextPage+1,true,currentPage);
					   }else{
						   
						   refreshPage(currentPage + 0,nextPage+1,false,currentPage);
					   }
						console.log('2当前序号：'+(currentPage + 1)+",最大序号："+(nextPage+1));
						
						
					}  
				
				
			}
			
			
        });
        obj.find("#next").click(function(){
            var currentIndex = getCurrentIndex();
            var currentPage = getCurrentPage();
			console.log('2当前页码：'+(currentPage )+",总页码："+(totalPage));
			if(currentPage==totalPage){
				$('#next').addClass('cur');
				alert('已经是最后一页啦');
				return;
				
			}else{
				$('#next').removeClass('cur');
				
			}
			$('#pre').removeClass('cur');
			//console.log(currentIndex);
			//console.log(currentPage);
            var showPageIndex = currentIndex + 1;
            var nextPage = currentPage + 1;
			console.log('1当前序号：'+currentIndex+",最大序号："+(pageSize));
            if(currentIndex+1 == pageSize  ) {//currentPage+1!=totalPage
				console.log('2当前序号：'+(currentPage + 1)+",最大序号："+(nextPage+1));
				
                refreshPage(currentPage + 1,nextPage+1,false,nextPage);
            } else {
                light(obj.find("a").eq(showPageIndex));
            }
			console.log(nextPage);
            sendAjax_H(nextPage,pageSizeAjax);
        });
        obj.find("#pre").click(function(){
            var currentIndex = getCurrentIndex();
            var currentPage = getCurrentPage();
			if(currentPage==1){
				$('#pre').addClass('cur');
				alert('已经是第一页啦');
				return;
				
			}else{
				
				$('#pre').removeClass('cur');
			}
			$('#next').removeClass('cur');
            var showPageIndex = currentIndex - 1;
            var nextPage = currentPage - 1;
			console.log('1当前序号：'+currentIndex+",最大序号："+(pageSize));
            if(currentIndex == 0 && totalPage>=pageSize && currentPage!=1) {
                refreshPage(currentPage - pageSize,nextPage,true,currentPage);
            } else {
                light(obj.find("a").eq(showPageIndex));
            }
            sendAjax_H(nextPage,pageSizeAjax);
        });
        obj.find("#home").click(function(){
            refreshPage(1);
            showEnd(true);
            showHome(false);
            light(obj.find("span").eq(2));
			 light(obj.find("a").eq(0));
            sendAjax_H(1,pageSizeAjax);
			
        });
        obj.find("#end").click(function(){
            refreshPage(totalPage-pageSize+1,totalPage-pageSize+2,true);
            showEnd(false);
            showHome(true);
           // light(obj.find("a").eq(pageSize+1));
            sendAjax_H(totalPage,pageSizeAjax);
        });
		 obj.find("#rePage20").click(function(){
           pageSizeAjax = 20;
			obj.find("#rePage20").addClass('cur');
			obj.find("#rePage50").removeClass('cur');
			obj.find("#rePage100").removeClass('cur');
			obj.find("#rePage200").removeClass('cur');
		   sendAjax_H(1,pageSizeAjax);
		   
			
        });
		 obj.find("#rePage50").click(function(){
           pageSizeAjax = 50;
		   obj.find("#rePage50").addClass('cur');
			obj.find("#rePage20").removeClass('cur');
			obj.find("#rePage100").removeClass('cur');
			obj.find("#rePage200").removeClass('cur');
		    sendAjax_H(1,pageSizeAjax);
        });
		 obj.find("#rePage100").click(function(){
            pageSizeAjax = 100;
			obj.find("#rePage100").addClass('cur');
			obj.find("#rePage50").removeClass('cur');
			obj.find("#rePage20").removeClass('cur');
			obj.find("#rePage200").removeClass('cur');
		    sendAjax_H(1,pageSizeAjax);
        });
		 obj.find("#rePage200").click(function(){
            pageSizeAjax = 200;
			obj.find("#rePage200").addClass('cur');
			obj.find("#rePage50").removeClass('cur');
			obj.find("#rePage100").removeClass('cur');
			obj.find("#rePage20").removeClass('cur');
		    sendAjax_H(1,pageSizeAjax);
        });
    }
});