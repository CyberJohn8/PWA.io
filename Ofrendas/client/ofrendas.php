<php>

    require 'vendor/autoload.php';

    use PayPal\Api\Payment;
    use PayPal\Api\Payer;
    use PayPal\Api\RedirectUrls;
    use PayPal\Api\Transaction;

    $payer = new Payer();
    $payer->setPaymentMethod("paypal");

    $amount = new \PayPal\Api\Amount();
    $amount->setTotal($_POST['monto']);
    $amount->setCurrency("USD");

    $transaction = new Transaction();
    $transaction->setAmount($amount);
    $transaction->setDescription("Donación para nuestro proyecto");

    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl("https://tu-sitio.com/confirmacion.php")
                ->setCancelUrl("https://tu-sitio.com/cancelar.php");

    $payment = new Payment();
    $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

    try {
        $payment->create($apiContext);
        header("Location: " . $payment->getApprovalLink());
        exit;
    } catch (Exception $ex) {
        echo "Error: " . $ex->getMessage();
    }
    
</php>




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofrendas</title>
    <link rel="stylesheet" href="/CSS/ofrendas.css">
</head>

<body>

    <header>
        <a href="../index.html" class="menu-button">&#8592; Inicio</a>
        <h1>Ofrendas</h1>
    </header>



    <form action="procesar_donacion.php" method="POST">
        <label for="monto">Monto de la donación:</label>
        <input type="number" id="monto" name="monto" required min="1" step="any">
        
        <label for="metodo_pago">Método de pago:</label>
        <select id="metodo_pago" name="metodo_pago" required>
            <option value="paypal">PayPal</option>
            <option value="stripe">Tarjeta de Crédito</option>
        </select>
        
        <button type="submit">Donar</button>
    </form>



    <footer>
        <p>© 2024 Directorio de Iglesias. Todos los derechos reservados.</p>
    </footer>

</body>

</html>
