$(function () {
	$('#slider-container').slider({
		range: true,
		min: 0,
		max: 1000,
		values: [0, 1000],
		create: function () {
//              $("#amount").val("$299 - $1099");
			$('#min').text('0 AED');
			$('#max').text('1000 AED');
		},
		slide: function (event, ui) {
			$('#min').text(ui.values[0] + " AED" );
			$('#max').text(ui.values[1] + " AED" );

		}
	})
});

function filterSystem(minPrice, maxPrice) {
	$("#computers div.system").hide().filter(function () {
		var price = parseInt($(this).data("price"), 10);
		return price >= minPrice && price <= maxPrice;
	}).show();
}