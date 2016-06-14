var overlay = $('#overlay');
var callback = $("#callback");
$(function(){
	overlay.fadeOut(0);
})


function ajax(url,data){
	$.ajax({
	    async: false,
	    type : "POST",
	    url : url,
	    dataType : 'json',
	    data:data,
	    beforeSend:function(){
	      overlay.fadeIn(0);
	    },
	    success : function(data, textStatus) {
	      overlay.fadeOut(0);
	      
	      callback.find('.inf').html(data.info);
	      callback.modal('show');
	      if(data.status == 1){
	      	setTimeout(function(){
	      		callback.modal('hide');
	      	},2000)
	      }
	    },
	    error:function(XMLHttpRequest, textStatus, errorThrown){
	      overlay.fadeOut(0);
	      if(XMLHttpRequest.status != 200){
	        alert(XMLHttpRequest.statusText);
	      }
	    },

	  })
}

function del(id,url){
	ajax(url,'{id:'+id+'}');
}