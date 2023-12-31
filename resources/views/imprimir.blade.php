<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}
            .invoice-font{
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                font-size: 10px;
                color: #555;
            }

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr >
					<td colspan="3">
						<table>
							<tr>
								<td class="title">
									<img src="vendor/adminlte/dist/img/logosr.png" style="width: 100%; max-width: 300px" />
								</td>
                                <td></td>
								<td align="right">
									Fecha: {{ date('Y-m-d') }}<br />
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="3">
						<table>
							<tr>
								<td width="30%">
									Wanlac GT<br />
									Quetzaltenango<br />
									Guatemala Centroamerica 
								</td>
                                <td></td>
								<td width="70%" align="right">
									{{ $cliente['0']->nombrecliente }}<br />
									{{ $cliente['0']->nitcliente }}<br />
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
                    
					<td width="30%">Metodo de pago</td>
                    <td></td>
					<td width="70%" align="right">Numero de orden</td>
                    
				</tr>

				<tr class="details">
                   
					<td >{{ $pago['0']->nombretipo }}</td>
                    <td></td>
					<td align="right">{{ $orden }}</td>
				</tr>

				<tr class="heading">
                    <td width="10%">Cantidad</td>

					<td width="80%" align="left">Producto</td>

					<td width="10%" align="right">Precio</td>
				</tr>
                @foreach($detallef as $det)
				<tr class="item">
                    <td width="10%" >{{ $det->cantidad }}</td>
					<td width="80%" align="left">{{ $det->nombreproducto }}</td>

					<td width="10%" align="right">{{ $det->subtotal }}</td>
				</tr>
                @endforeach

				<tr class="total">
					<td></td>
                    <td></td>
					<td align="right">Total Q.{{ $encabezadof['0']->montototal }}</td>
				</tr>
			</table>
		</div>
        <div class="invoice-font" >
            <table cellpadding="0" cellspacing="0">
				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									Esta factura esta sujeta a pagos trimestrales, respaldada por FEL resolucion No. 5589191 autorizada por SAT<br />

								</td>
							</tr>
						</table>
					</td>
				</tr>
            </table>
        </div>
	</body>
</html>