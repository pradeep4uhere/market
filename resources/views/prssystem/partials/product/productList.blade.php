<div class="page-width collection_templete">
   <div class="row">
      <div class="col-md-3 col-sm-12 col-xs-12 normal-sidebar sidebar_content">
         @include('prssystem.partials.product.productListSideBar')
      </div>
      <div class="col-md-9 col-sm-12 col-xs-12 normal_main_content">
         <div id="shopify-section-collection-template" class="shopify-section">
            <div data-section-id="collection-template" data-section-type="collection-template" class="collection__main">
               <header class="collection-header">
                 <!--  <div class="collection-hero">
                     <img class="collection-hero__image ratio-container js lazyloaded" src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/{{$store_type}}" data-widths="[1170]" alt="Furniture Shop"  style="width: 100%;height: 100px;" >
                     <div class="collection-hero__title-wrapper">
                        <h1 class="collection-hero__title page-width">Furniture Shop</h1>
                     </div>
                  </div> -->
                  <div class="category-info">
                     <h1 class="category_name"> 
                        ALL PRODUCTS LISTS
                     </h1>
                     <p class="collection-heading">All procuts collections by seller.</p>
                     <!-- <div class="collection-desc">
                        <p>This category includes all the basics of your wardrobe and much more:&nbsp;</p>
                        <p>shoes, accessories, printed t-shirts, feminine dresses, women's jeans!</p>
                     </div> -->
                  </div>
                  <div class="filters-toolbar-wrapper">
                     <div class="filters-toolbar">
                        <div class="collection-view">
                           <div id="grid-img" class="grid-img checked">  
                           </div>
                           <div id="list-img" class="list-img"> 
                           </div>
                        </div>
                        <div class="filters-toolbar__item filters-toolbar__item--count">
                           <span class="filters-toolbar__product-count">There are {{count($productList)}} products</span>
                        </div>
                        <div class="filters-toolbar__item">
                           <label for="SortBy" class="sort-label">Sort by:</label>
                           <div class="select-wrapper">
                              <select name="SortBy" id="SortBy" class="filters-toolbar__input filters-toolbar__input--sort" style="width: 89px;">
                                 <option value="title-ascending" selected="selected">Sort by:</option>
                                 <option value="best-selling">Best Selling</option>
                                 <option value="title-ascending">Alphabetically, A-Z</option>
                                 <option value="title-descending">Alphabetically, Z-A</option>
                                 <option value="price-ascending">Price, low to high</option>
                                 <option value="price-descending">Price, high to low</option>
                                 <option value="created-descending">Date, new to old</option>
                                 <option value="created-ascending">Date, old to new</option>
                              </select>
                           </div>
                           <label for="SortBy" class="sort-label" onclick="load_more_category_items(0)">Clear All:</label>
                           <input class="collection-header__default-sort" type="hidden" value="manual">
                        </div>
                     </div>
                  </div>
               </header>
               <div class="row" id="Collection">
                  @include('prssystem.frontend.productItemGrid',array('productList'=>$productList))
               </div>
               <center><div class="ajax-loading" style="display: none"></div></center>
            </div>
         </div>
      </div>
      <div class="responsive-sidebar sidebar_content"></div>
   </div>
</div>
<script type="text/javascript">
var page = 1; //track user scroll as page number, right now page number is 1
load_more(page); //initial content load
$(window).scroll(function() { 
   //detect page scroll
    if($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled from top to bottom of the page
        page++; //page number increment
        load_more(page); //load content   
    }
});     
function load_more(page){
  $.ajax(
        {
         url: '?page=' + page,
         type: "get",
         datatype: "html",
         beforeSend: function()
         {
             $('.ajax-loading').show();
             $('.ajax-loading').addClass('alert alert-danger');
             $('.ajax-loading').html('Loading...');
         }
        })
        .done(function(data)
        {
            if(data.length == 0){
            console.log(data.length);
                //notify user if nothing to load
                $('.ajax-loading').addClass('alert alert-danger');
                $('.ajax-loading').html('No More Product.');
                return;
            }
            $('.ajax-loading').hide(); //hide loading animation once data is received
            $("#results").append(data); //append data into #results element          
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
              //alert('No response from server');
              $('.ajax-loading').show();
              $('.ajax-loading').addClass('alert alert-danger');
              $('.ajax-loading').html('No More Product.');

        });
 }
</script>