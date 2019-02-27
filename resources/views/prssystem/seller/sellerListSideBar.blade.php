<div id="shopify-section-Ishi_sidebar" class="shopify-section">
            <div data-section-id="Ishi_sidebar" data-section-type="sidebar-section">
               <div class="left-column sidebar-categories">
                  <div class="left-title clearfix hidden-lg-up collapsed" data-target="#subcategories-container" data-toggle="collapse">
                     <span class="h3 block-heading">
                     <a title="">Products By Store Type</a>
                     </span>
                     <span class="navbar-toggler collapse-icons">
                     <i class="material-icons add"></i>
                     <i class="material-icons remove"></i>
                     </span>    
                  </div>
                  <div class="section-header sidebar-title hidden-lg-down">
                     <a title="">Category</a>
                  </div>
                  <div id="subcategories-container" class="block-categories categories collapse data-toggler">
                     <div class="panel-group categories-menu" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php if(!empty($storeList)){ ?>
                        <?php foreach($storeList as $cat){ ?>
                        <div class="panel panel-custom categories-items">
                           <div class="panel-heading" role="tab" id="headingOne-{{$cat['id']}}" style="padding-top:5px;padding-bottom:10px; border-bottom: solid 1px #EEE; ">
                              <h4 class="panel-title link-title">
                                 <a href="javascript:void(0)" style="text-decoration:none" id="cat_{{$cat['id']}}" class="catSearch">{{$cat['name']}}</a>
                                 <a class="collapse-icon collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$cat['id']}}" aria-expanded="false" aria-controls="collapse-{{$cat['id']}}">
                                 <?php if(count($cat['children'])>0){ ?>
                                 <i class="material-icons add"></i>
                                 <i class="material-icons remove"></i>
                                 <?php } ?>
                                 </a>
                              </h4>
                           </div>
                              <?php if(count($cat['children'])>0){ ?>
                              <div id="collapse-{{$cat['id']}}" class="panel-collapse dropdown-submenu collapse" role="tabpanel" aria-labelledby="headingOne-{{$cat['id']}}" aria-expanded="false" style="height: 0px;">
                                  <?php foreach($cat['children'] as $child){ ?>
                              <div class="panel-body category_submenu">
                                 <a href="javascript:void(0)" style="text-decoration:none" id="catsub_{{$cat['id']}}" class="dropdown-item catSubSearch">
                                 {{$child['name']}}
                                 </a>
                              </div>
                              <?php } ?>   
                           </div>
                           <?php } ?>
                        </div>
                        <?php } ?>
                        <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
<script type="text/javascript">
   $(document).ready(function(){
      $('.catSearch').on('click',function(e){
         var id =e.target.id;
         var idArr =id.split('_');
         load_more_category_items(idArr[1]);
      });

      $('.catSubSearch').on('click',function(e){
         var id =e.target.id;
         var idArr =id.split('_');
         load_more_category_items(idArr[1]);
      });
   });
   function load_more_category_items(cat_id){
      var url = "{{url()->full()}}/"+cat_id;
      $.ajax({
               url: url,
               type: "get",
               datatype: "html",
               beforeSend: function(){
                   $('.ajax-loading').show();
                   $('.ajax-loading').addClass('alert alert-danger');
                   $('#result').html('<p><center>Loading...</center><p>');
                  }
              }).done(function(data){
                  $('#result').html('');
                  if(data.length == 0){
                      //notify user if nothing to load
                      $('.ajax-loading').addClass('alert alert-danger');
                      $('.ajax-loading').html('No More Product.');
                      return;
                  }
                  $('.ajax-loading').hide(); //hide loading animation once data is received
                  $("#results").hide().html(data).fadeIn('slow'); //append data into #results element          
              }).fail(function(jqXHR, ajaxOptions, thrownError){
                    //alert('No response from server');
                    $('.ajax-loading').show();
                    $('.ajax-loading').addClass('alert alert-danger');
                    $('.ajax-loading').html('No More Product.')
              });
    }
</script>