<?php
require('../librerias/fpdf183/fpdf.php');
require_once '../clasesPrincipales/Conector.php';

//encabezado y pie de página 
foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;



class PDF extends FPDF
{
    function Header()
    {
        $this->SetTextColor(121, 58, 44);
        $this->Image("../img/logoPrincipal.png", 10, 8, 20);
        $this->SetFont("Helvetica", "B", "15");
        $this->Cell(0, 10, "FINANZAS DEL HOGAR", 0, 0, "C");
        $this->Ln(30);
        $this->SetFont("Helvetica", "B", "14");
        $this->Cell(0, 10, "::: LISTADO DE GASTOS :::", 0, 0, "C");
        $this->Ln(14);
    }
    function Footer()
    {
        $this->SetY(-18);
        $this->SetFont("Helvetica", "I", "9");
        $this->Cell(0, 7, utf8_decode("Dirección: Cra. 22B ## 2-57, Pasto, Nariño Tel 3212818756"), 0, 1, "C");
        $this->Cell(0, 7, "Pagina " . $this->PageNo() . " de {nb}", 0, 0, "C");
    }
}

$doc = new PDF();
$doc->AliasNbPages(); //Habilita conteo
$doc->AddPage();


$bd = conectar();
if (!$bd) {
    $doc->Cell(0, 7, "Error al conectar a la base de datos", 0, 1, "C");
} else {
    //TRANSACCIONES EN BD CON SQL 
    $sql = "SELECT g.fecha,dg.valor,dg.tipo_gasto,dg.descripcion FROM  gastos as g, detalles_gasto as dg WHERE g.id_admin=$id and g.id=dg.id_gasto;";
    $datos = mysqli_query($bd, $sql);

    if ($datos->num_rows != 0) {
        $doc->SetFont("Helvetica", "B", "7");
        $doc->Cell(5, 7, "#", 1, 0);
        $doc->Cell(20, 7, "FECHA", 1, 0);
        $doc->Cell(20, 7, "VALOR", 1, 0);
        $doc->Cell(50, 7, "TIPO DE GASTOS", 1, 0);
        $doc->Cell(100, 7, "DESCRIPCION", 1, 1);
        $cont = 0;
        $total = 0;
        while ($reg2 = mysqli_fetch_array($datos)) { //mientras haya registros -> $reg
            $total = $total + $reg2[1];
            $cont++;
            $doc->Cell(5, 7, $cont, 1, 0);
            $doc->Cell(20, 7, utf8_decode($reg2[0]), 1, 0);
            $doc->Cell(20, 7, "$" . $reg2[1], 1, 0);
            $doc->Cell(50, 7, utf8_decode($reg2[2]), 1, 0);
            $doc->Cell(100, 7, utf8_decode($reg2[3]), 1, 1);
        }
        $doc->SetFont("Helvetica", "B", "11");
        $doc->Cell(25, 7, "TOTAL:", 1, 0);
        $doc->SetFont("Helvetica", "B", "7");
        $doc->Cell(20, 7, "$" . $total, 1, 0);
    } else {
        $doc->Ln(10);
        $doc->Multicell(0, 2, "\nNOTA:\n\n", 1, 1);
        $doc->Multicell(0, 3, "\nNo hay GASTOS por el momento.", 1, 0);
    }
}


mysqli_close($bd);


$doc->Output();
