
var cat_selector_input;
var get_categories_endpoint = "/api/v3/get_categories.php";

$(document).ready(function() {
	
	 
	cat_selector_input = 'input[name="offer_cat_id"]';
	$("#category_selectors").on("change", "select", renderChildCategories);

	generateSelectors();

});

function generateSelectors() {
			
			var catValue = $(cat_selector_input).val();
		 
		 	$.ajax({
			url: get_categories_endpoint + "?section=foods",
			success: function(output) {
				
				var all_categories = JSON.parse(output).categories;

				
				
				if (catValue && catValue !=0) {
					getParentCategories(catValue);

					$('.category-selector').last().trigger("change");
					
				}
				else {
					
					createParentSelector(null,0);
				}
				
				
				function getParentCategories(id) {

					
						for (var i=0;i<all_categories.length;i++) {
							if (all_categories[i].id == id) {
							
								
								createParentSelector(all_categories[i].parent_id, id )
								getParentCategories(all_categories[i].parent_id);
							}
						}
					
				}
				
			
				
				
				function createParentSelector(parent_id, selected_id) {
				
					var newSelectorHtml = '<select class="category-selector" name="offer_cat_id_parent_' + parent_id + '"><option value="0">(выберите подкатегорию)</option>';
						
						for (var i=0; i < all_categories.length; i++ ) {
							if (all_categories[i].parent_id == parent_id) {
								
								var selected="";
								if (all_categories[i].id == selected_id) selected = 'selected="selected"'; 
								newSelectorHtml += '<option ' + selected + ' value="'+ all_categories[i].id+'">' + all_categories[i].name + '</option>';
							}
							
						}
						newSelectorHtml += '</select>';
						$("#category_selectors").prepend(newSelectorHtml);
				}
				
				
				
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.status + " " + thrownError);
			}
			
			
		});
		 
		 
		 
}
	
function renderChildCategories() {
				
		var $thisSelector = $(this);
		
		$thisSelector.nextAll().remove();
		
		if 	($thisSelector.val() == "0") {
			
			$(cat_selector_input).val($thisSelector.prev().val());
			return false;
		} 
		else {
			
			$(cat_selector_input).val($thisSelector.val());
		}
		
		
		
		
			
		$.ajax({
			url: get_categories_endpoint + "?parentid=" + $thisSelector.val() + "&section=foods",
			success: function(output) {
				
				var sub_categories = JSON.parse(output).categories;

				if (sub_categories.length) {
						
						var newSelectorHtml = '<select class="category-selector" name="offer_cat_id"><option selected="selected" value="0">(выберите подкатегорию)</option>';
						
						for (var i=0; i < sub_categories.length; i++ ) {
							newSelectorHtml += '<option value="'+ sub_categories[i].id+'">' + sub_categories[i].name + '</option>';
						}
						newSelectorHtml += '</select>';
						$("#category_selectors").append(newSelectorHtml);
				
				
				}
				
				
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.status + " " + thrownError);
			}
			
			
		});
	}