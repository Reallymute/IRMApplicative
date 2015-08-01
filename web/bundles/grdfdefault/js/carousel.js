jQuery.fn.removeAttributes = function() {
  return this.each(function() {
    var attributes = $.map(this.attributes, function(item) {
      return item.name;
    });
    var elem = $(this);
    $.each(attributes, function(i, item) {
    elem.removeAttr(item);
    });
  });
}

$(document).ready(function(){ 

	var $showList = $('#itemSelect');
	var $viewList = $('#itemView');

	var dotCounter = 1;
	var globalCount = $showList.find('li').length;
	var intId = setInterval(addCounter,3500);
	var activeCounter = false;


	function addCounter(){
		if(activeCounter){
		    	return;
				}
		else{
			var indexTo = $(this).index() + 1;
		    if (dotCounter < globalCount) {
				$showList.find('li[relItem="carou"]:eq(' + dotCounter + ')').addClass('active').siblings().removeAttr('class').removeAttr('style');

				$viewList.find('li[relItem="carou"]:eq(' + (dotCounter - 1) + ')').css('z-index' , '3').addClass('indexed').animate({left:'1000px'}, 1000).siblings().removeAttr('style').removeAttr('class');

				$viewList.find('li[relItem="carou"]:eq(' + (dotCounter) + ')').css('z-index' , '2');

		        dotCounter++;
		    } else {
		    	$showList.find('li[relItem="carou"]:eq(0)').addClass('active').siblings().removeAttr('class').removeAttr('style');

                        if(globalCount > 1) {
                            $viewList.find('li[relItem="carou"]:eq(' + (globalCount - 1) + ')').css('z-index' , '3').addClass('indexed').animate({left:'1000px'}, 1000).siblings().removeAttr('style').removeAttr('class');
                        }

			$viewList.find('li[relItem="carou"]:eq(0)').css('z-index' , '2');
		    	dotCounter = 1;
		    }
		}
	}

	// Caroussel promo
	$showList.on('click', 'li[relItem]:not(.active)', function () {
		var carNum = $(this).index();
		var carPos = $showList.find('li.active').index();

		if(carNum < carPos){
			$viewList.find('li[relItem="carou"]:eq(' + carPos+ ')').css('z-index' , '3').addClass('indexed').animate({left:'-1000px'}, 1000).siblings().removeAttr('class').removeAttr('style');

			$viewList.find('li[relItem="carou"]:eq(' + carNum + ')').css('z-index' , '2');
		}	
		else{
			$viewList.find('li[relItem="carou"]:eq(' + carPos + ')').css('z-index' , '3').addClass('indexed').animate({left:'1000px'}, 1000).siblings().removeAttr('class').removeAttr('style');

			$viewList.find('li[relItem="carou"]:eq(' + carNum + ')').css('z-index' , '2');
		}

		$(this).addClass('active').siblings().removeClass('active');

		$('#controls').addClass('paused');

		activeCounter = true;
	});

	$('#controls').on('click', '.startStop',  function () {
		var counterSet = $showList.find('li.active').index();
		if($('#controls').hasClass('paused')){
			dotCounter = counterSet + 1;
			activeCounter = false;
			$('#controls').removeClass('paused');
		}
		else{
			$('#controls').addClass('paused');
			activeCounter = true;	
		}
	});


	$('#controls').on('click', 'a:not(.startStop)', function () {
		$('#controls').addClass('paused');
		activeCounter = true;	
		if($(this).hasClass('prev')){
			var counterPos = $showList.find('li.active').index() - 1;

			if(counterPos < 0){
				counterPos = globalCount - 1;

				$viewList.find('li[relItem="carou"]:eq(0)').css('z-index' , '3').addClass('indexed').animate({left:'-1000px'}, 1000).siblings().removeAttr('class').removeAttr('style');

				$viewList.find('li[relItem="carou"]:eq(' + (globalCount - 1) + ')').css('z-index' , '2');
			}
			else{
				$viewList.find('li[relItem="carou"]:eq(' + (counterPos + 1) + ')').css('z-index' , '3').addClass('indexed').animate({left:'1000px'}, 1000).siblings().removeAttr('class').removeAttr('style');

				$viewList.find('li[relItem="carou"]:eq(' + (counterPos) + ')').css('z-index' , '2');
			}
		}
		else{
			var counterPos = $showList.find('li.active').index() + 1;

			if(counterPos == globalCount){
				counterPos = 0;

				$viewList.find('li[relItem="carou"]:eq(' + (globalCount - 1) + ')').css('z-index' , '3').addClass('indexed').animate({left:'1000px'}, 1000).siblings().removeAttr('class').removeAttr('style');

				$viewList.find('li[relItem="carou"]:eq(0)').css('z-index' , '2');
			}
			else{
				$viewList.find('li[relItem="carou"]:eq(' + (counterPos - 1) + ')').css('z-index' , '3').addClass('indexed').animate({left:'1000px'}, 1000).siblings().removeAttr('class').removeAttr('style');
				$viewList.find('li[relItem="carou"]:eq(' + (counterPos) + ')').css('z-index' , '2');
			}


		}
		$showList.find('li[relItem="carou"]:eq(' + counterPos + ')').addClass('active').siblings().removeAttr('class').removeAttr('style');
	});

});