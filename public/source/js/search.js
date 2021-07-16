var type, minYear, maxYear;

$("#mydd li a").click(function(){
	// remove previously added selectedLi
	$('.selectedLi').removeClass('selectedLi');
	// add class `selectedLi`
	$(this).addClass('selectedLi');
	type = $(this).text();///User selected value...****
  });


$("#mydd2 li a").click(function(){
	// remove previously added selectedLi
	$('.selectedLi').removeClass('selectedLi');
	// add class `selectedLi`
	$(this).addClass('selectedLi');
	minYear = $(this).text();///User selected value...****
  });

$("#mydd3 li a").click(function(){
	// remove previously added selectedLi
	$('.selectedLi').removeClass('selectedLi');
	// add class `selectedLi`
	$(this).addClass('selectedLi');
	maxYear = $(this).text();///User selected value...****
});

$('#search').click(function(){
	var keyword = $('#keyword').val();
	var price = $('#amount').val();
	$.ajax({
		async: true,
		type: 'GET',
		data: { keyword: keyword, type:type, minYear:minYear, maxYear:maxYear, price:price },
		success: function(response) {
			jQuery("body").html(response);
		}
	});
});