<?php


class Bill
{
    public $dayKilowats;
    public $nightKilowats;
    public $dayTariffe;
    public $nightTariffe;
    public $paymentMonth;

    public function set_day_kilowats($n)
    {
        $this->dayKilowats = $n;
    }

    public function get_day_kilowats()
    {
        return $this->dayKilowats;
    }
    public function set_night_kilowats($n)
    {
        $this->nightKilowats = $n;
    }
    public function get_night_kilowats()
    {
        return $this->nightKilowats;
    }
    public function set_day_tariffe($n)
    {
        $this->dayTariffe = $n;
    }
    public function get_day_tariffe()
    {
        return $this->dayTariffe;
    }
    public function set_night_tariffe($n)
    {
        $this->nightTariffe = $n;
    }
    public function get_night_tariffe()
    {
        return $this->nightTariffe;
    }
    public function set_payment_month($n)
    {
        $this->paymentMonth = $n;
    }
    public function get_payment_month()
    {
        return $this->paymentMonth;
    }

    public function dayCosts()
    {
        return $this->dayTariffe * $this->dayKilowats;
    }

    public function nightCosts()
    {
        return $this->nightTariffe * $this->nightKilowats;
    }

    public function totalCosts()
    {
        return $this->dayCosts() + $this->nightCosts();
    }
}


function saveBills(array $bills): string
{
    $filename = 'bill.json';
    return file_put_contents($filename, json_encode($bills));
}

function readBills(): array
{
    $filename = 'bill.json';
    if(file_exists($filename)){
        return json_decode(file_get_contents($filename), true);
    }
    return [];
}
class BillDetails{

}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['payButton'])) {
        $paid = true;
        $existingBills = readBills();
        $bill = unserialize(urldecode($_POST['payment']));
        array_push($existingBills, $bill);
        saveBills($existingBills);
        $totalCosts = $bill->totalCosts();
        $totalCostsParam = urlencode($totalCosts);
        header("Location: /index.php?paid=".$totalCostsParam);
    } else  {
        $bill = new Bill();
        if (isset($_POST['klwD'])) {
            $bill->set_day_kilowats(htmlspecialchars($_POST['klwD']) ?? 0);
        }
        if (isset($_POST['klwN'])) {
            $bill->set_night_kilowats(htmlspecialchars($_POST['klwN']) ?? 0);
        }
        if (isset($_POST['tariffD'])) {
            $bill->set_day_tariffe(htmlspecialchars($_POST['tariffD']) ?? 0);
        }
        if (isset($_POST['tariffN'])) {
            $bill->set_night_tariffe(htmlspecialchars($_POST['tariffN']) ?? 0);
        }
        if (isset($_POST['paymentMonth'])) {
            $bill->set_payment_month($_POST['paymentMonth'] ?? '');

            $currentDate = new DateTime();
            $currentDate->setTime(0, 0);
            $payment = urlencode(serialize($bill));
            $paymentDate = DateTime::createFromFormat("Y-m", $bill->get_payment_month());
            $prevMonth = (clone $currentDate)->modify('-1 month');
        class Validator extends Exception {
            public function validateEarly($paymentDate, $currentDate):void{

                if ($paymentDate >= $currentDate) {
                    echo '<h2><a href="index.php">Atgal į formą</a></h2>';
                    throw new Exception("Mokėjimas atliekamas per anksti " . "\n");
            }
            }
            public function validateLate($paymentDate,$prevMonth):void {
                if ($paymentDate < $prevMonth) {
                $interval = $paymentDate->diff($prevMonth);
                throw new Exception("Jūs vėluojate sumokėti " . ($interval->days) . " dienų");
            }
            }
        }
        try {
            $validator = new Validator();
            $validator->validateEarly($paymentDate, $currentDate);
            $validator->validateLate($paymentDate, $prevMonth);
        } catch (Exception $exception){

            echo $exception->getMessage();
            exit;
        }
}


        $dayCosts = $bill->dayCosts();
        $nightCosts = $bill->nightCosts();
        $totalCosts = $bill->totalCosts();
        echo <<<END_OF_TEXT
    <table>
    <thead>
    <tr>
    <th colspan="2">JŪSŲ MOKĖJIMO INFORMACIJA:</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>Dienos laiko zonos sunaudotos kilovatvalandės:</td> 
            <td>$bill->dayKilowats</td>
          </tr>
       <tr>
            <td>Nakties laiko zonos sunaudotos kilovatvalandės:</td>
            <td>$bill->nightKilowats</td>
       </tr>
       <tr>
            <td>Dienos laiko zonos tarifas (EUR/kWh):</td>
            <td>$bill->dayTariffe</td>
       </tr>
        <tr>
            <td>Nakties laiko zonos tarifas (EUR/kWh):</td> 
            <td>$bill->nightTariffe</td>
        </tr>
        <tr>  
            <td>Mėnuo, už kurį mokama:</td> 
            <td>$bill->paymentMonth</td>
        </tr>
        <tr>
            <td>Dienos laiko zonos mokėjimo suma:</td> 
            <td>$dayCosts EUR</td>
        </tr>
        <tr>
            <td>Nakties laiko zonos mokėjimo suma:</td>
            <td>$nightCosts EUR</td>
        </tr>
        <tr>
            <td colspan="2">Bendra mokėtina suma: $totalCosts EUR</td>
         </tr>
    </tbody>
    </table>
    <link rel="stylesheet" media="all" href="./public/stylesheet.css"/>
        <form method="post">
        <input type="hidden" name="payment" value="$payment"></input>
        <input type="submit" name="payButton" class="button" value="DEKLARUOTI IR SUMOKĖTI"</input>
     </form>
    END_OF_TEXT;
    }
}