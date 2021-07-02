<?php
session_start();
require_once "../../include/connect.php";
require_once('../jpgraph/jpgraph.php');
require_once('../jpgraph/jpgraph_line.php');

$dataX=array();
$dataY=array();

$SQL = $_SESSION["sql"];
$query = $pdo->query($SQL);

if($_SESSION['f_or_l'] == 'l'){
    $x = intval($_SESSION["num"]);
    for( $i=0; $i<intval($_SESSION["num"]); $i++){
        $row = $query->fetch(PDO::FETCH_OBJ);
        $dataY[]=intval($row->temperature);
        $dataX[]=intval($x);
        $x--;
    }
}else{
    $x = 0;
    for( $i=0; $i<intval($_SESSION["num"]); $i++){
        $row = $query->fetch(PDO::FETCH_OBJ);
        $dataY[]=intval($row->temperature);
        $dataX[]=intval($x);
        $x++;
    }
}

$width=500;
$height=300;

$graph=new Graph($width,$height);
$graph->SetScale('linlin');

$graph->title->Set('Temperature during the given period');
$graph->title->SetMargin(10);

$graph->xaxis->title->Set('x-th record');

$lineplot=new LinePlot($dataY,$dataX);

$graph->Add($lineplot);

$graph->Stroke();
?>