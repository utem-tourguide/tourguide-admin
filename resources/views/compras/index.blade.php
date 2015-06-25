<html>
<head>
	<title>Compras - TourGuide Admin</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<div class="container-fluid">
		<h1>Compras registradas</h1>
		<table class="table table-striped table-bordered">
			<tr>
				<th>Id</th>
				<th>Usuario id</th>
				<th>Postal id</th>
				<th>Creado en</th>
				<th>Modificado en</th>
			</tr>
			@foreach($compras as $compra)
				<tr>
					<td>{{ $compra->id }}</td>
					<td>{{ $compra->usuario_id }}</td>
					<td>{{ $compra->postal_id }}</td>
					<td>{{ $compra->created_at }}</td>
					<td>{{ $compra->updated_at }}</td>
				</tr>
			@endforeach
		</table>
	</div>
</body>
</html>
