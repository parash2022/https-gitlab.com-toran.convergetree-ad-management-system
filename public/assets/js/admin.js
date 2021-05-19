jQuery(document).ready(function($) {  

  $('#client_id').on('change',function(){
    var client_id = $(this).val();
    if(client_id == '0'){
      $('#create-client').removeClass('d-none');
    }else{
      $('#create-client').addClass('d-none');
    }
  });    
  
  $('#ad-category').change(function(){
    var catid = $(this).val();
    if(catid != null && catid != ''){

      var posturl = baseurl+'/ajax/getSubCats';
      
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); 
      $.ajax({
        url : posturl,
        type: "POST",
        data: {'catid' : catid, '_token' : CSRF_TOKEN},
        success:function( response ){          
          var obj = JSON.parse(response); 
          
          var str = '<option value="">Select sub-category</option>';
            $.each(obj, function(key,value){ 
              var id = key.split('_');              
              str += '<option value="'+id[1]+'">'+value+'</option>';
            });
          
          $('#ad-subcategory').html(str);
        }
      });
    }
  });

  $('.browse-featured-photo').on('click',function(e){
      e.preventDefault();
      $(this).closest('.featured-photo-box').find('.featured-photo').trigger('click');
  });

  $('.featured-photo').on('change',function(){
    var box =  $(this).closest('.featured-photo-box');
    var input_name = $(this).attr('data-name');
    if($(this).val()){
      box.find('.featured-input.hidable').addClass('d-none');  
    }
    
    var imgPath = this.value;
    var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
        readFeaturedPhotoURL(this,box,input_name);
    else
        alert("Please select image file (jpg, jpeg, png).");    
  });

  $(document).on('click','.addmore__sml',function(e){
    e.preventDefault();
    var appendable = $('.sm-item-input.d-none').clone();
    appendable.removeClass('d-none');
    $('.sm-item-input-box').append(appendable);
  });

  $(document).on('click','.remove__sml',function(e){
    e.preventDefault();
    $(this).closest('.sm-item-input').remove();
  });

  function readFeaturedPhotoURL(input,box,input_name) { 
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function (e) {
            var cln = $('.featured-input.clonable').clone();
          cln.removeClass('d-none clonable');
          cln.find('img').attr('src',e.target.result);
          cln.find('input').attr('name',input_name).val(e.target.result);
          box.append(cln);
        };
    }
  }

  $(document).on('click','.remove-featured-photo',function(e){
    e.preventDefault();
    var box = $(this).closest('.featured-photo-box');
    box.find('.featured-input.has-thumb').remove();
    box.find('.thumb-preview').closest('div.featured-input').remove();
    box.find('input').val('');
    box.find('.featured-input').removeClass('d-none');  

  });

  $(document).on('click','.remove-featured-old-photo',function(e){
    e.preventDefault();
    //var box = $(this).closest('.featured-photo-box');
    $('.featured-photo-box').removeClass('d-none');  
    $('.old-pic').remove(); 
  });

});