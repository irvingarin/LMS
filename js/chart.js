//pie
$(document).ready(function(){
var lb;
var dt;
var str;
var col;

jQuery.ajax({
	url:'chartdata.php',
	type:'post',
	dataType:'json',
	data:'chart=true',
	success:function(d){
		lb=d.label.split("|");
		dt=d.no.split("|");
		//alert('"'+lb[0]+'",'+'"'+lb[1]+'"');
		//alert(lb);

/*
var c = lb.length();
var x = 0;
for(x = 0; x<c; x++){
	str += '"'+lb[0]+'"'
}
	-blue: #007bff;
    --indigo: #6610f2;
    --purple: #6f42c1;
    --pink: #e83e8c;
    --red: #dc3545;
    --orange: #fd7e14;
    --yellow: #ffc107;
    --green: #28a745;
    --teal: #20c997;
    --cyan: #17a2b8;
    --white: #fff;
    --gray: #6c757d;
    --gray-dark: #343a40;
    --primary: #007bff;
    --secondary: #6c757d;
    --success: #28a745;
    --info: #17a2b8;
    --warning: #ffc107;
    --danger: #dc3545;
    --light: #f8f9fa;
    --dark: #343a40;

 */

//alert(lb);

var ctxP=document.getElementById("pieChart").getContext('2d');
var myPieChart = new Chart(ctxP, {
	type:'pie',
	data:{
		labels: lb,
		datasets: [
			{
				data: dt,
				backgroundColor: ["#ff4444","#ffbb33","#00C851","#33b5e5","#2BBBAD","#4285F4","#AA66CC","#AD1457","#FFC400","#EF6C00","#2e7d32","#00e676","#ffca28","#ff9100","#ff8a65","#d84315","#59698d","#4fc3f7","#0288d1","#00897b","#cddc39","#ea80fc","#ab47bc"],
				hoverBackgroundColor: ["#CC0000","#FF8800","#007E33","0099CC","#00695C","#0D47A1","#9933CC","#880E4f","#FFAb00","#E65100","#1b5e20","#00c853","#ffc107","#ff6d00","#ff7043","#bf360c","#45526e","#29b6f6","#0277bd","#00796b","#c0ca33","#e040fb","#9c27b0"]
			}
		]
	},
	options:{
		responsive:true
	}
});

	}
});

})