/*
City-List logic

*/

(function($) {

	function Citylist() {
		
		this.cities = [
					{ name: "Архангельск", name2: "Архангельска", ioslink: "/arkhangelsk/ios", andlink : "/arkhangelsk/android"},
					{ name: "Белгород", name2: "Белгорода",ioslink: "/belgorod/ios", andlink : "/belgorod/android"},
					{ name: "Рязань", name2: "Рязани",ioslink: "/ryazan/ios", andlink : "/ryazan/android"},
					{ name: "Ставрополь", name2: "Ставрополя",ioslink: "/stavropol/ios", andlink : "/stavropol/android"},
					{ name: "Тула", name2: "Тулы",ioslink: "/tula/ios", andlink : "/tula/android"}
					
					];
		
		this.renderList = function() {
			
			var $container = $(".city-container");
			var output = '<ul class="srf-citylist">';
			var addclass = "";
			
			for (i=0; i<this.cities.length;i++) {
				addclass = (i==0) ? ' first' : '';
				output += '<li class="srf-citylist-item '+ addclass + '"><a class="srf-citylink" id="'+i+'">' + this.cities[i].name +'</a></li>';
				
			}
			output += '</ul>';
			$container.html(output);
		
			var self = this;
			$('.srf-citylink').click(function() {
				self.renderPlatforms($(this).attr('id'));
				
			});
			
			
		}
		
		this.renderPlatforms = function(cityid) {
			
			var $container = $(".platform-container");
			
			$container.hide()
			
			if (typeof(cityid) != "undefined") {
			
					var android_content = "";
					var ios_content = "";
					
					if (typeof(this.cities[cityid].andlink) != "undefined") {
						android_content = '<a class="srf-appbutton" href="'+this.cities[cityid].andlink+'"><img style="width: 200px;" alt="Доступно в Google Play" src="images/google-play-badge.png" /></a>';
					}
					
					if (typeof(this.cities[cityid].ioslink) != "undefined") {
						ios_content = '<a class="srf-appbutton" href="'+this.cities[cityid].ioslink+'"><img style="width: 205px; padding: 12px;" alt="Загрузите в AppStore" src="images/apple-badge.svg" /></a>';
					}
					
					var appname = '<span class="srf-appname">Скидки '+ this.cities[cityid].name2 + '</span>';
					var output = "<p>Загрузите приложение "+ appname +" для вашего устройства:</p>" + android_content + ios_content;
					
			
					$container.html(output);
					$container.show()
			}
			
			
		}
	
	}
	
	var cl = new Citylist();
	cl.renderList();
	

})(jQuery);