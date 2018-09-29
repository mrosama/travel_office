<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>

	<center>
		<h2>احداث الاجتماع <b>{{$meeting->address}}</b></h2>
		<p><h3>الملاحظات الايجابية</h3> :{{$data['positive_remarks']}}</p>
		<p><h3>الملاحظات السلبية</h3> :{{$data['negative_remarks']}}</p>
		<p><h3>التوصيات و الاقتراحات</h3> :{{$data['recommendations']}}</p>
		<p><h3>ملاحظات</h3> :{{$data['notes']}}</p>
	</center>

</body>
</html>
