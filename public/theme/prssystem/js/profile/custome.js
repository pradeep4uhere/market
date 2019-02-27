var CSRF_TOKEN=CSRF_TOKEN;
if($("#category_id").length>0) {
    var POST_URL=POST_URL;
    var POST_BRAND_URL=POST_BRAND_URL;
    $('#category_id').change(function(){
       var catId=$(this).val();
       var postJson={_token:CSRF_TOKEN,id:catId};
        getAjaxCall(POST_URL,postJson);
        getBrandAjaxCall(POST_BRAND_URL,postJson);
    });
}


if($("#sub_category_id").length>0) {
    var POST_BRAND_URL=POST_BRAND_URL;
    $('#sub_category_id').change(function(){
       var catId=$(this).val();
       var parentCatId=$("#category_id").val();
       var postJson={_token:CSRF_TOKEN,parentCatId:parentCatId,id:catId};
        getBrandAjaxCall(POST_BRAND_URL,postJson);
    });
}

//Check Unit
if($("#unit_id").length>0){
    $('#unit_id').change(function(){
       $('#qntyId').html($("#unit_id option:selected").text());
    });
}


if($("#product_unlimited").length>0){
    $('#product_unlimited').change(function(){
       if($("#product_unlimited").val()==0){
            $('#productQuantity').show();
       }else{
           $('#productQuantity').hide();
       }
    });
}


//Call ajax Call General
//Pass URL
//Pass post Json Value
function getBrandAjaxCall(url,postJson){
    //console.log(url);
    //console.log(postJson);
    $.ajax({
        type:'POST',
        url:url,
        data:postJson,        
        success:function(res){
        var str="<option value=''>Choose Brand</option>";
        if(res.status=='success'){
           if(res.data.length!=0){
                for(key in res.data){
                    str+="<option value='"+key+"'>"+res.data[key]+"</option>";
                    $('#brand_id').html(str);
                };
            }else{
                $('#brand_id').html(str);
            }
        }else{
            $('#brand_id').html(str);
            alert("somthing went wrong.");
        }
        }
    });
};





//Uplaod Logo By the USer for Seller Accoutn
if($("#logo").length>0) {
$("#logo").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $('#msg').html("Only formats are allowed : "+fileExtension.join(', '));
            $('#logo').val('');
        }
    });
}





//Call ajax Call General
//Pass URL
//Pass post Json Value
function getAjaxCall(url,postJson){
    //console.log(url);
    //console.log(postJson);
    $.ajax({
        type:'POST',
        url:url,
        data:postJson,        
        success:function(res){
        var str="<option value=''>Choose SubCategory</option>";
        if(res.status=='success'){
           if(res.data.length!=0){
                for(key in res.data){
                    str+="<option value='"+key+"'>"+res.data[key]+"</option>";
                    $('#sub_category_id').html(str);
                };
            }else{
                $('#sub_category_id').html(str);
            }
        }else{
            $('#sub_category_id').html(str);
            alert("somthing went wrong.");
        }
        }
    });
};


function getSubCategoryList(category_id){
	alert(545);
	var POST_URL=POST_URL;
    var POST_BRAND_URL=POST_BRAND_URL;
	var catId=$(this).val();
    var postJson={_token:CSRF_TOKEN,id:catId};
    getAjaxCall(POST_URL,postJson);
    getBrandAjaxCall(POST_BRAND_URL,postJson);
	
	
}
